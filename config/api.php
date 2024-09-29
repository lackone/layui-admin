<?php
return [
    //路由相关配置
    'route' => [
        'prefix' => env('API_ROUTE_PREFIX', 'api'),
        'name' => env('API_ROUTE_NAME', 'api.'),
        'namespace' => 'App\\Api\\Controllers',
        'middleware' => [],
    ],
];
