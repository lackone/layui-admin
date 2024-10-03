<?php

namespace App\Api\Controllers;

use App\Services\UserService;
use App\Services\WeixinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public $not_need_login = [];

    /**
     * 微信公众号
     * @param Request $request
     */
    public function gzhServe(Request $request)
    {
        $app = WeixinService::getApp('gzh');
        $server = $app->getServer();

        $server->addMessageListener('text', function ($message, \Closure $next) {
            return 'test!';
        });

        $server->addEventListener('subscribe', function ($message, \Closure $next) {
            return '感谢您关注!';
        });

        return $server->serve();
    }

    /**
     * 微信公众号
     * @param Request $request
     */
    public function gzh(Request $request)
    {
        $params = $request->all();

        $app = WeixinService::getApp('gzh', '', ['oauth' => ['redirect_url' => route('api.gzh')]]);

        $oauth = $app->getOauth();

        if (!$params['code']) {
            $redirectUrl = $oauth->scopes(['snsapi_userinfo'])->redirect();
            return redirect($redirectUrl);
        }

        $user = $oauth->userFromCode($params['code']);
        $raw = $user->getRaw();
        $data = UserService::login('gzh', $raw);

        return success($data);
    }

    /**
     * 小程序登录
     * @param Request $request
     */
    public function miniLogin(Request $request)
    {
        try {
            $params = $request->all();

            $valid = Validator::make($params, [
                'code' => 'required',
                'appid' => 'required',
            ], [
                'code.required' => 'code必填',
                'appid.required' => 'appid必填',
            ]);

            if ($valid->fails()) {
                throw new \Exception($valid->errors()->first());
            }

            $raw = WeixinService::miniGetInfoByCode($params['code'], $params['appid']);

            $data = UserService::login('mini', $raw);

            return success($data);

        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }

    public function test()
    {
        dump(WeixinService::getConfig('mini'));
        dump(WeixinService::getConfig('pay', '22222'));
        dump(WeixinService::$configs);
    }
}
