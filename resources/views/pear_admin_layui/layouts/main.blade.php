<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ cfg('website', 'admin_keywords') }}">
    <meta name="description" content="{{ cfg('website', 'admin_description') }}">
    <title>{{ cfg('website', 'admin_title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ cfg('website', 'admin_ico') ?: config('admin.default_icon') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ adminAsset('component/pear/css/pear.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/admin.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/admin.dark.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/variables.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/result.css') }}"/>
    <style>
        .pear-nav-tree .layui-nav-child dd a i {
            display: inline-block;
            margin-left: 20px;
            margin-right: 0;
        }
        .pear-nav-tree .layui-nav-child dd a span {
            margin-left: 18px !important;
        }
    </style>
    <script src="{{ adminAsset('component/wangeditor/wangEditor.min.js') }}"></script>
</head>
<!-- 结 构 代 码 -->
<body class="layui-layout-body pear-admin">
<!-- 布 局 框 架 -->
<div class="layui-layout layui-layout-admin">
    <!-- 顶 部 样 式 -->
    @include('common.header')

    <!-- 侧 边 区 域 -->
    @include('common.side')

    <!-- 视 图 页 面 -->
    <div class="layui-body">
        <!-- 内 容 页 面 -->
        <div id="content">
            @include('common.message')

            @yield('content')
        </div>
    </div>

    <!-- 页脚 -->
    @include('common.footer')
</div>
<!-- 移 动 端 便 捷 操 作 -->
<div class="pear-collapsed-pe collapse">
    <a href="#" class="layui-icon layui-icon-shrink-right"></a>
</div>
<!-- 依 赖 脚 本 -->
<script src="{{ adminAsset('component/layui/layui.js') }}"></script>
<script src="{{ adminAsset('component/pear/pear.js') }}"></script>
<script src="{{ adminAsset('component/jquery/jquery-3.7.1.min.js') }}"></script>
<!-- 框 架 初 始 化 -->
<script>
    var load_index;
    layui.use(['admin', 'jquery', 'popup', 'layer', 'laytpl', 'table', 'util'], function () {
        var admin = layui.admin;
        var popup = layui.popup;
        var $ = layui.jquery;
        var layer = layui.layer;
        var laytpl = layui.laytpl;
        var table = layui.table;
        var util = layui.util;

        // yml | json | api
        admin.setConfigurationPath("{{ route('admin.config') }}");

        // 渲染
        admin.render();

        // 基本资料
        util.on('lay-on', {
            'basic-info': function () {
                layer.open({
                    title: '编辑 - id:' + "{{ session('admin_id') }}",
                    type: 2,
                    area: ['80%', '80%'],
                    content: '{{ route('admin.admin.save', session('admin_id')) }}'
                });
            }
        })

        // 注销
        admin.logout(function () {
            $.get("{{ route('admin.logout') }}", function () {
                popup.success("退出登录", function () {
                    location.href = "{{ route('admin.login') }}";
                });

                // 清空 tabs 缓存
                return new Promise((resolve) => {
                    resolve(true)
                });
            });
        });

        // 模板设置
        laytpl.config({
            open: '<%',
            close: '%>'
        });

        // 全局设置
        table.set({
            headers: {'pear-admin-table': 'pear-admin-table'},
            request: {
                pageName: 'page',
                limitName: 'limit'
            },
            cellMinWidth: 80,
            totalRow: false, // 开启合计行
            page: true,
            css: [
                '.layui-table-tool-temp{padding-right: 145px;}'
            ].join(''),
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '导出',
                layEvent: 'custom_export',
                icon: 'layui-icon layui-icon-export'
            }],
            loading: false,
            autoSort: false
        });

        //发送ajax前的统一设置
        $.ajaxSetup({
            //超时时间:5秒
            timeout: 5000,
            //请求头添加参数
            headers: {
                //请求头防止csrf攻击(参考php框架laravel)
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            //统一返回类型
            dataType: 'json'
        });

        $(document).ajaxStart(function () {
            load_index = layer.load(2, {
                shade: [0.1, '#000'] //0.1透明度的白色背景
            });
        });

        $(document).ajaxStop(function () {
            layer.close(load_index);
        });

        $(document).ajaxComplete(function (event, xhr, options) {
            layer.close(load_index);
        });

        $(document).ajaxError(function (evt, request, settings) {
            layer.close(load_index);
        });
    })
</script>
</body>
</html>
