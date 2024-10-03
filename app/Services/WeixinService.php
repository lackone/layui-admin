<?php

namespace App\Services;

class WeixinService
{
    public static $apps = [];
    public static $configs = [];

    /**
     * 获取对应的配置
     * @param $type
     * @param array $rewrite
     */
    public static function getConfig($type, $rewrite = [])
    {
        $config = [];

        switch ($type) {
            case 'gzh':
                //公众号
                $config = config('easywechat.gzh', []);

                $config['app_id'] = cfg('weixin', 'gzh_app_id');
                $config['secret'] = cfg('weixin', 'gzh_app_secret');
                $config['token'] = cfg('weixin', 'gzh_token');
                $config['aes_key'] = cfg('weixin', 'gzh_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$apps[$type][trim($config['app_id'])] = new \EasyWeChat\OfficialAccount\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['app_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['app_id'])]->setCache(app('cache.store'));
                }

                break;
            case 'mini':
                //小程序
                $config = config('easywechat.mini', []);

                $config['app_id'] = cfg('weixin', 'mini_app_id');
                $config['secret'] = cfg('weixin', 'mini_app_secret');
                $config['token'] = cfg('weixin', 'mini_token');
                $config['aes_key'] = cfg('weixin', 'mini_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$apps[$type][trim($config['app_id'])] = new \EasyWeChat\MiniApp\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['app_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['app_id'])]->setCache(app('cache.store'));
                }

                break;
            case 'pay':
                //微信支付
                $config = config('easywechat.pay', []);

                $config['mch_id'] = cfg('weixin', 'pay_mch_id');
                $config['private_key'] = cfg('weixin', 'pay_private_key', true);
                $config['certificate'] = cfg('weixin', 'pay_certificate', true);
                $config['secret_key'] = cfg('weixin', 'pay_secret_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['mch_id'])] = $config;
                self::$apps[$type][trim($config['mch_id'])] = new \EasyWeChat\Pay\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['mch_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['mch_id'])]->setCache(app('cache.store'));
                }

                break;
            case 'open':
                //开放平台
                $config = config('easywechat.open', []);

                $config['app_id'] = cfg('weixin', 'open_app_id');
                $config['secret'] = cfg('weixin', 'open_app_secret');
                $config['token'] = cfg('weixin', 'open_token');
                $config['aes_key'] = cfg('weixin', 'open_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$apps[$type][trim($config['app_id'])] = new \EasyWeChat\OpenPlatform\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['app_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['app_id'])]->setCache(app('cache.store'));
                }

                break;
            case 'corp':
                //企业微信
                $config = config('easywechat.corp', []);

                $config['corp_id'] = cfg('weixin', 'corp_id');
                $config['secret'] = cfg('weixin', 'corp_secret');
                $config['token'] = cfg('weixin', 'corp_token');
                $config['aes_key'] = cfg('weixin', 'corp_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['corp_id'])] = $config;
                self::$apps[$type][trim($config['corp_id'])] = new \EasyWeChat\Work\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['corp_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['corp_id'])]->setCache(app('cache.store'));
                }

                break;
            case 'corp_open':
                //企业微信开放平台
                $config = config('easywechat.corp_open', []);

                $config['corp_id'] = cfg('weixin', 'corp_open_id');
                $config['provider_secret'] = cfg('weixin', 'corp_open_provider_secret');
                $config['token'] = cfg('weixin', 'corp_open_token');
                $config['aes_key'] = cfg('weixin', 'corp_open_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['corp_id'])] = $config;
                self::$apps[$type][trim($config['corp_id'])] = new \EasyWeChat\OpenWork\Application($config);

                if (\is_callable([self::$apps[$type][trim($config['corp_id'])], 'setCache'])) {
                    self::$apps[$type][trim($config['corp_id'])]->setCache(app('cache.store'));
                }

                break;
            default:
                break;
        }

        return $config;
    }

    /**
     * 获取app
     * @param $type
     * @param string $id
     * @param $rewrite
     */
    public static function getApp($type, $id = '', $rewrite = [])
    {
        self::getConfig($type, $rewrite);

        if ($id) {
            return self::$apps[$type][$id];
        }

        //没有指定ID，则默认返回第一个
        return current(self::$apps[$type]);
    }

    /**
     * 获取AccessToken
     * @param $type
     * @param $id
     * @param $rewrite
     * @return mixed
     */
    public static function getAccessToken($type, $id = '', $rewrite = [])
    {
        $app = self::getApp($type, $id, $rewrite);

        return $app->getAccessToken()->getToken();
    }

    /**
     * 刷新AccessToken并获取
     * @param $type
     * @param $id
     * @param $rewrite
     * @return mixed
     */
    public static function getRefreshAccessToken($type, $id = '', $rewrite = [])
    {
        $app = self::getApp($type, $id, $rewrite);

        $app->getAccessToken()->refresh();
        return $app->getAccessToken()->getToken();
    }

    /**
     * 小程序-根据code获取微信信息
     * @param $code
     * @param $id
     * @param $rewrite
     */
    public static function miniGetInfoByCode($code, $id = '', $rewrite = [])
    {
        $app = self::getApp('mini', $id, $rewrite);

        $utils = $app->getUtils();
        $response = $utils->codeToSession($code);

        if (!isset($response['openid']) || empty($response['openid'])) {
            throw new \Exception('获取openID失败');
        }

        return $response;
    }

    /**
     * 小程序-获取手机号
     * @param $code
     * @param $id
     * @param $rewrite
     * @return mixed
     */
    public static function miniGetPhoneByCode($code, $id = '', $rewrite = [])
    {
        $app = self::getApp('mini', $id, $rewrite);

        return $app->getClient()->postJson('wxa/business/getuserphonenumber', [
            'code' => $code,
        ]);
    }
}
