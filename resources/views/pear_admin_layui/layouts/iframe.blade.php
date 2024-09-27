<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @yield('css')
    <link rel="stylesheet" href="{{ adminAsset('component/pear/css/pear.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/admin.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/admin.dark.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/variables.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/result.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/analysis.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/exception.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('component/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('component/ztree/css/zTreeStyle/zTreeStyle.css') }}"/>
    <style>
        .select2-container--default .select2-selection--multiple {
            border-color: #eee !important;
        }
    </style>
    @yield('mycss')
    <script src="{{ adminAsset('component/layui/layui.js') }}"></script>
    <script src="{{ adminAsset('component/pear/pear.js') }}"></script>
    <script src="{{ adminAsset('component/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ adminAsset('component/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ adminAsset('component/ztree/js/jquery.ztree.all.min.js') }}"></script>
    <script src="{{ adminAsset('component/wangeditor/wangEditor.min.js') }}"></script>
    <script>
        var load_index;
        layui.use(['jquery', 'layer', 'laytpl'], function () {
            var $ = layui.jquery;
            var layer = layui.layer;
            var laytpl = layui.laytpl;

            // 模板设置
            laytpl.config({
                open: '<%',
                close: '%>'
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
</head>
<body>
<div class="pear-container">
    @include('common.message')

    @yield('content')
</div>
@yield('js')
<script>
</script>
@yield('myjs')
</body>
</html>
