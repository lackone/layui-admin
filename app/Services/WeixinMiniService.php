<?php

namespace App\Services;

class WeixinMiniService
{
    public $app = null;

    /**
     * 初始化函数
     * @param $id
     * @param $rewrite
     */
    public function __construct($id = '', $rewrite = [])
    {
        $this->app = WeixinService::getApp('mini', $id, $rewrite);
    }

    /**
     * 小程序-根据code获取微信信息
     * @param $code
     * @param $id
     * @param $rewrite
     */
    public function getInfoByCode($code)
    {
        $utils = $this->app->getUtils();
        $res = $utils->codeToSession($code);

        if (!isset($res['openid']) || empty($res['openid'])) {
            throw new \Exception('获取openID失败');
        }

        return $res;
    }

    /**
     * 小程序-获取手机号
     * @param $code
     * @param $id
     * @param $rewrite
     * @return mixed
     */
    public function getPhoneByCode($code)
    {
        return $this->app->getClient()->postJson(config('app.wx.mini.getuserphonenumber'), [
            'code' => $code,
        ])->toArray(false);
    }

    /**
     * 获取跳转链接
     * @param $post
     * @return mixed
     */
    public function getWxJumpLink($post = [])
    {
        $env_version = config('app.wx.mini.wv_jump_version');
        $url = config('app.wx.mini.generate_urllink');

        $params = [
            'json' => [
                'path' => config('app.wx.mini.wv_jump_path'),
                'query' => http_build_query($post),
                'env_version' => $env_version,
            ],
        ];

        $res = $this->app->getClient()->post($url, $params)->toArray(false);

        if (!isset($res['errcode']) || $res['errcode'] != 0) {
            throw new \Exception($res['errmsg']);
        }

        return $res;
    }
}
