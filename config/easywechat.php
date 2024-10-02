<?php

return [
    //微信公众号
    'gzh' => [
        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id' => '',         // AppID
        'secret' => '',         // AppSecret
        'token' => '',          // Token
        'aes_key' => '',        // EncodingAESKey，兼容与安全模式下请一定要填写！！！

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_gzh.log'),
        ],

        /**
         * 是否使用 Stable Access Token
         * 默认 false
         * https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/getStableAccessToken.html
         * true 使用 false 不使用
         */
        'use_stable_access_token' => false,

        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * redirect_url：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            'redirect_url' => '',
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'timeout' => 10.0,
            // 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'status_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],
    //微信支付
    'pay' => [
        'mch_id' => 1360649000,

        // 商户证书
        'private_key' => '',
        'certificate' => '',

        // v3 API 秘钥
        'secret_key' => '',

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_pay.log'),
        ],

        // v2 API 秘钥
        'v2_secret_key' => '',

        // 平台证书：微信支付 APIv3 平台证书，需要使用工具下载
        // 下载工具：https://github.com/wechatpay-apiv3/CertificateDownloader
        'platform_certs' => [
            // 请使用绝对路径
            // '/path/to/wechatpay/cert.pem',
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 10.0,
            // 'base_uri' => 'https://api.mch.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri
        ],
    ],
    //小程序
    'mini' => [
        'app_id' => '',
        'secret' => '',
        'token' => '',
        'aes_key' => '',

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_mini.log'),
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 10.0,
            // 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'status_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],
    //开放平台
    'open' => [
        'app_id' => '', // 开放平台账号的 appid
        'secret' => '',   // 开放平台账号的 secret
        'token' => '',  // 开放平台账号的 token
        'aes_key' => '',   // 明文模式请勿填写 EncodingAESKey

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_open.log'),
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 10.0,
            // 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'status_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],
    //企业微信
    'corp' => [
        'corp_id' => '',
        'secret' => '',
        'token' => '',
        'aes_key' => '',

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_corp.log'),
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 10.0,
            // 'base_uri' => 'https://qyapi.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'status_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],
    //企业微信开放平台
    'corp_open' => [
        'corp_id' => '',
        'provider_secret' => '',
        'token' => '',
        'aes_key' => '', // 明文模式请勿填写 EncodingAESKey

        'response_type' => 'array', //指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名

        'log' => [
            'level' => 'debug',
            'file' => storage_path('logs/weixin_corp_open.log'),
        ],

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 10.0,
            // 'base_uri' => 'https://qyapi.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'status_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],
];
