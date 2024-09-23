<?php
return [
    //名称
    'name' => 'layui-admin',

    //LOGO
    'logo' => '',

    //后台目录
    'directory' => app_path('Admin'),

    //标题
    'title' => 'layui-admin后台管理系统',

    //关键字
    'keywords' => 'layui-admin后台管理系统',

    //描述
    'description' => 'layui-admin后台管理系统',

    //模板
    'theme' => 'pear_admin_layui',

    //图标
    'favicon' => '',

    'https' => env('ADMIN_HTTPS', false),

    //路由相关配置
    'route' => [
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'name' => env('ADMIN_ROUTE_NAME', 'admin.'),
        'namespace' => 'App\\Admin\\Controllers',
        'middleware' => ['AdminLoginCheck', 'AdminAuthCheck',],
    ],
];
