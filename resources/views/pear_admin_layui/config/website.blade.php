@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">网站信息</li>
                    <li>网站备案</li>
                    <li>政策协议</li>
                </ul>
                <div class="layui-tab-content" style="padding:15px;">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">后台设置</h3>

                            @include('component.text', ['label' => '首页标题', 'name' => 'config[website][admin_index_title]', 'value' => $config['website']['admin_index_title'], 'block' => 1])

                            @include('component.text', ['label' => 'title', 'name' => 'config[website][admin_title]', 'value' => $config['website']['admin_title'], 'block' => 1])

                            @include('component.text', ['label' => 'keywords', 'name' => 'config[website][admin_keywords]', 'value' => $config['website']['admin_keywords'], 'block' => 1])

                            @include('component.text', ['label' => 'description', 'name' => 'config[website][admin_description]', 'value' => $config['website']['admin_description'], 'block' => 1])

                            @include('component.single_image', ['label' => '网站ico', 'name' => 'config[website][admin_ico]', 'value' => $config['website']['admin_ico']])

                            @include('component.single_image', ['label' => '网站logo', 'name' => 'config[website][admin_logo]', 'value' => $config['website']['admin_logo']])

                            @include('component.single_image', ['label' => '登录页banner', 'name' => 'config[website][admin_login_banner]', 'value' => $config['website']['admin_login_banner']])

                            @include('component.text', ['label' => '登录页标题', 'name' => 'config[website][admin_login_title]', 'value' => $config['website']['admin_login_title'], 'block' => 1])

                            @include('component.text', ['label' => '后台页脚', 'name' => 'config[website][admin_footer]', 'value' => $config['website']['admin_footer'], 'block' => 1])
                            <hr>

                            @include('component.submit', ['append' => 1])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            @include('component.text', ['label' => '备案名称', 'name' => 'config[website][beian]', 'value' => $config['website']['beian'], 'block' => 1])

                            @include('component.text', ['label' => '备案链接', 'name' => 'config[website][beian_url]', 'value' => $config['website']['beian_url'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 2])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            @include('component.wangeditor', ['label' => '服务协议', 'name' => 'config[website][admin_service_agreement]', 'value' => $config['website']['admin_service_agreement'], 'block' => 1])

                            @include('component.wangeditor', ['label' => '隐私协议', 'name' => 'config[website][admin_privacy_agreement]', 'value' => $config['website']['admin_privacy_agreement'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 3])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myjs')
    <script>
        layui.use(['form', 'laydate', 'util', 'jquery', 'element'], function () {
            var form = layui.form;
            var layer = layui.layer;
            var $ = layui.jquery;

            form.on('submit({{ getDomIdKey('', 'submit', '1') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.website') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });

            form.on('submit({{ getDomIdKey('', 'submit', '2') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.website') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });

            form.on('submit({{ getDomIdKey('', 'submit', '3') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.website') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });
        });
    </script>
@endsection
