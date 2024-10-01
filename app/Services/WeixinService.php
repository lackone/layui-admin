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
                $config = config('easywechat.gzh', []);

                $config['app_id'] = cfg('weixin', 'gzh_app_id');
                $config['secret'] = cfg('weixin', 'gzh_app_secret');
                $config['token'] = cfg('weixin', 'gzh_token');
                $config['aes_key'] = cfg('weixin', 'gzh_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$apps[$type][trim($config['app_id'])] = new \EasyWeChat\OfficialAccount\Application($config);

                break;
            case 'mini':
                $config = config('easywechat.mini', []);

                $config['app_id'] = cfg('weixin', 'mini_app_id');
                $config['secret'] = cfg('weixin', 'mini_app_secret');
                $config['token'] = cfg('weixin', 'mini_token');
                $config['aes_key'] = cfg('weixin', 'mini_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$apps[$type][trim($config['app_id'])] = new \EasyWeChat\MiniApp\Application($config);

                break;
            case 'pay':
                $config = config('easywechat.pay', []);

                $config['mch_id'] = cfg('weixin', 'pay_mch_id');
                $config['private_key'] = cfg('weixin', 'pay_private_key', true);
                $config['certificate'] = cfg('weixin', 'pay_certificate', true);
                $config['secret_key'] = cfg('weixin', 'pay_secret_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['mch_id'])] = $config;
                self::$configs[$type][trim($config['mch_id'])] = new \EasyWeChat\Pay\Application($config);

                break;
            case 'open':
                $config = config('easywechat.open', []);

                $config['app_id'] = cfg('weixin', 'open_app_id');
                $config['secret'] = cfg('weixin', 'open_app_secret');
                $config['token'] = cfg('weixin', 'open_token');
                $config['aes_key'] = cfg('weixin', 'open_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['app_id'])] = $config;
                self::$configs[$type][trim($config['app_id'])] = new \EasyWeChat\OpenPlatform\Application($config);

                break;
            case 'corp':
                $config = config('easywechat.corp', []);

                $config['corp_id'] = cfg('weixin', 'corp_id');
                $config['secret'] = cfg('weixin', 'corp_secret');
                $config['token'] = cfg('weixin', 'corp_token');
                $config['aes_key'] = cfg('weixin', 'corp_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['corp_id'])] = $config;
                self::$configs[$type][trim($config['corp_id'])] = new \EasyWeChat\Work\Application($config);

                break;
            case 'corp_open':
                $config = config('easywechat.corp_open', []);

                $config['corp_id'] = cfg('weixin', 'corp_open_id');
                $config['provider_secret'] = cfg('weixin', 'corp_open_provider_secret');
                $config['token'] = cfg('weixin', 'corp_open_token');
                $config['aes_key'] = cfg('weixin', 'corp_open_aes_key');

                $config = array_merge($config, $rewrite);

                self::$configs[$type][trim($config['corp_id'])] = $config;
                self::$configs[$type][trim($config['corp_id'])] = new \EasyWeChat\OpenWork\Application($config);

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
}
