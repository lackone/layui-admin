<?php
return [
    //模板
    'theme' => 'website',

    'default_title' => '短剧小程序开发',

    'default_icon' => '/website/images/favicon.ico',

    'default_logo' => '/website/images/logo.png',

    'default_footer_logo' => '/website/images/footer-logo.png',

    'default_address' => '',

    'default_footer' => '2024 All Rights Reserved.',

    'default_beian' => '',

    'https' => env('ADMIN_HTTPS', false),

    //路由相关配置
    'route' => [
        'prefix' => env('WEB_ROUTE_PREFIX', ''),
        'name' => env('WEB_ROUTE_NAME', ''),
        'namespace' => 'App\\Http\\Controllers',
        'middleware' => [],
    ],
];
