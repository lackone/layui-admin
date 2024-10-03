<?php

namespace App\Services;

use App\Models\UserSession;
use App\Models\UserWeixin;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserService
{
    const TOKEN_PREFIX = 'token:';

    /**
     * 通用登录方法
     */
    public static function login($type, $raw = [])
    {
        $source = 0;

        switch ($type) {
            case 'gzh':
                //公众号
                $user = self::gzhLogin($raw);
                $source = User::SOURCE_WX_GZH;
                break;
            case 'mini':
                //小程序
                $user = self::miniLogin($raw);
                $source = User::SOURCE_WX_MINI;
                break;
        }

        if ($user['status'] == User::STATUS_DISABLE) {
            throw new \Exception('该用户已禁用');
        }

        return [
            'token' => self::generateToken($user['id'], $source),
        ];
    }

    /**
     * 小程序登录
     * @param $raw
     */
    public static function miniLogin($raw = [])
    {
        if (!$raw['openid']) {
            throw new \Exception('openid不能为空');
        }

        $user_wx = UserWeixin::firstOrCreate([
            'openid' => $raw['openid'],
        ], [
            'source' => UserWeixin::SOURCE_WX_MINI,
        ]);

        if ($user_wx['user_id']) {
            $user = self::updateUser($user_wx['user_id']);
        } else {
            $user = self::createUser([
                'source' => User::SOURCE_WX_MINI,
            ]);
            $user_wx->user_id = $user->id;
            $user_wx->save();
        }

        return $user;
    }

    /**
     * 生成token
     */
    public static function generateToken($user_id, $source = 0)
    {
        $user_session = UserSession::where('user_id', $user_id)
            ->where('source', $source)
            ->first();

        if ($user_session && $user_session['expire_time'] > (time() + config('app.user_token.be_expire_duration'))) {
            return $user_session['token'];
        }

        $old_token = $user_session['token'] ?? '';
        $new_token = createToken($user_id);

        $user_session = UserSession::updateOrCreate([
            'user_id' => $user_id,
            'source' => $source,
        ], [
            'token' => $new_token,
            'expire_time' => time() + config('app.user_token.expire_duration'),
        ]);

        self::updateTokenInfo($user_id, $new_token);

        Cache::forget(self::TOKEN_PREFIX . $old_token);

        return $user_session['token'];
    }

    /**
     * 延长token有效期
     */
    public static function delayToken($token)
    {
        $user_session = UserSession::where('token', $token)->first();
        if (!$user_session) {
            throw new \Exception('token不存在');
        }

        $user_session->expire_time = time() + config('app.user_token.expire_duration');
        $user_session->save();

        self::updateTokenInfo($user_session['user_id'], $token);

        return true;
    }

    /**
     * 根据token获取信息
     * @param $token
     * @return array|mixed
     */
    public static function getInfoByToken($token)
    {
        return Cache::get(self::TOKEN_PREFIX . $token) ?: [];
    }

    /**
     * 更新token中的信息
     */
    public static function updateTokenInfo($user_id, $token)
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new \Exception('未找到用户');
        }
        $user = $user->toArray();
        $user['token'] = $token;
        $user['expire_time'] = time() + config('app.user_token.expire_duration');
        Cache::put(self::TOKEN_PREFIX . $token, $user, config('app.user_token.expire_duration'));
    }

    /**
     * 公众号登录
     * @param $raw
     * @return void
     * @throws \Exception
     */
    public static function gzhLogin($raw)
    {
        if (!$raw['openid']) {
            throw new \Exception('openid不能为空');
        }

        $user_wx = UserWeixin::firstOrCreate([
            'openid' => $raw['openid'],
        ], [
            'source' => UserWeixin::SOURCE_WX_GZH,
            'unionid' => $raw['unionid'] ?? '',
        ]);

        if ($user_wx['user_id']) {
            $user = self::updateUser($user_wx['user_id'], [
                'avatar' => $raw['headimgurl'] ?? '',
                'nick_name' => $raw['nickname'] ?? '',
            ]);
        } else {
            $user = self::createUser([
                'avatar' => $raw['headimgurl'] ?? '',
                'nick_name' => $raw['nickname'] ?? '',
                'source' => User::SOURCE_WX_GZH,
            ]);
            $user_wx->user_id = $user->id;
            $user_wx->save();
        }

        return $user;
    }

    /**
     * 更新用户信息
     * @param $user_id
     * @param $raw
     */
    public static function updateUser($user_id, $raw = [])
    {
        $user = User::find($user_id);
        if (!$user) {
            throw new \Exception('未找到用户');
        }
        $raw['last_login_ip'] = getRealIp();
        $raw['last_login_time'] = time();
        $user->fill($raw)->save();
        return $user;
    }


    /**
     * 创建用户
     * @param $raw
     */
    public static function createUser($raw = [])
    {
        $salt = Str::random(6);
        $password = Str::random(8);
        $sn = self::createUserSn();

        return User::create(array_merge($raw, [
            'sn' => $sn,
            'account' => 'U' . $sn,
            'salt' => $salt,
            'password' => self::makePassword($salt, $password),
            'last_login_ip' => getRealIp(),
            'last_login_time' => time(),
            'device_type' => self::getDeviceType(),
            'invite_code' => self::createInviteCode(),
            'days' => date('Ymd'),
        ]));
    }

    /**
     * 获取设备类型
     * @return int
     */
    public static function getDeviceType()
    {
        $device_type = getDeviceType();

        if ($device_type == 'Android') {
            return User::DEVICE_TYPE_ANDROID;
        } else if ($device_type == 'IOS') {
            return User::DEVICE_TYPE_IOS;
        } else if ($device_type == 'Windows') {
            return User::DEVICE_TYPE_WINDOWS;
        }

        return User::DEVICE_TYPE_UNKNOWN;
    }

    /**
     * 创建编号
     * @param $prefix
     * @param $length
     * @return string
     */
    public static function createUserSn($prefix = '', $length = 8)
    {
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= mt_rand(1, 9);
        }
        $sn = $prefix . $str;
        if (User::where('sn', $sn)->first()) {
            return self::createUserSn($prefix, $length);
        }
        return $sn;
    }

    /**
     * 创建邀请码
     */
    public static function createInviteCode($length = 6)
    {
        $invite_code = substr(md5(uniqid(md5(microtime(true)), true)), 0, $length);
        if (User::where('invite_code', $invite_code)->first()) {
            return self::createInviteCode($length);
        }
        return $invite_code;
    }

    /**
     * 生成密码
     * @param $salt
     * @param $password
     * @return string
     */
    public static function makePassword($salt, $password)
    {
        return md5(md5($salt) . $password);
    }
}
