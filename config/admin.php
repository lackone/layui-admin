<?php
return [
    //名称
    'name' => 'layui-admin',

    //LOGO
    'logo' => '',

    //后台目录
    'directory' => app_path('Admin'),

    //标题
    'title' => '小风浪短剧系统',

    //关键字
    'keywords' => '小风浪短剧系统',

    //描述
    'description' => '小风浪短剧系统',

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

    'pear_admin_layui_config' => [
        'logo' => [
            //网站名称
            'title' => '小风浪短剧系统',
            //网站图标
            'image' => '/pear_admin_layui/admin/images/logo.png',
        ],
        'menu' => [
            //菜单数据
            'data' => '',
            //GET / POST
            'method' => 'GET',
            //菜单手风琴
            'accordion' => true,
            //默认折叠状态
            'collapse' => false,
            //多菜单模式
            'control' => false,
            'controlWidth' => 500,
            //默认选中的菜单项
            'select' => 'welcome',
            //是否开启异步菜单，false 时 data 属性设置为静态数据，true 时为后端接口
            'async' => false,
        ],
        'tab' => [
            //是否开启多选项卡
            'enable' => true,
            //保持视图状态
            'keepState' => false,
            //开启选项卡记忆
            'session' => true,
            //浏览器刷新时是否预加载非激活标签页
            'preload' => false,
            //可打开的数量, false 不限制极值
            'max' => '30',
            //首页
            'index' => [
                //标识 ID , 建议与菜单项中的 ID 一致
                'id' => 'welcome',
                //页面地址
                'href' => '',
                //标题
                'title' => '欢迎页',
            ],
        ],
        'theme' => [
            //默认主题色，对应 colors 配置中的 ID 标识
            'defaultColor' => '2',
            //默认的菜单主题 dark-theme 黑 / light-theme 白
            'defaultMenu' => 'dark-theme',
            //默认的顶部主题 dark-theme 黑 / light-theme 白
            'defaultHeader' => 'light-theme',
            //是否允许用户切换主题，false 时关闭自定义主题面板
            'allowCustom' => true,
            //通栏配置
            'banner' => false,
            'dark' => false,
        ],
        //主题色配置列表
        'colors' => [
            0 => [
                'id' => '1',
                'color' => '#16baaa',
                'second' => '#ecf5ff',
            ],
            1 => [
                'id' => '2',
                'color' => '#009688',
                'second' => '#ecf5ff',
            ],
            2 => [
                'id' => '3',
                'color' => '#36b368',
                'second' => '#f0f9eb',
            ],
            3 => [
                'id' => '4',
                'color' => '#f6ad55',
                'second' => '#fdf6ec',
            ],
            4 => [
                'id' => '5',
                'color' => '#f56c6c',
                'second' => '#fef0f0',
            ],
            5 => [
                'id' => '6',
                'color' => '#3963bc',
                'second' => '#ecf5ff',
            ],
        ],
        'other' => [
            //主页动画时长
            'keepLoad' => '1200',
            //布局顶部主题
            'autoHead' => false,
            //页脚
            'footer' => true,
        ],
        'header' => [
            //站内消息，通过 false 设置关闭
            'message' => false,
        ],
    ],
];
