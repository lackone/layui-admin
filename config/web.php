<?php
return [
    //路由相关配置
    'route' => [
        'prefix' => env('WEB_ROUTE_PREFIX', ''),
        'name' => env('WEB_ROUTE_NAME', ''),
        'namespace' => 'App\\Http\\Controllers',
        'middleware' => [],
    ],
];
