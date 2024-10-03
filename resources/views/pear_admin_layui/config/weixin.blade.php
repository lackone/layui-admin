@extends('layouts.sub')

@section('content')
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">微信小程序</li>
                    <li>微信公众号</li>
                    <li>开放平台</li>
                    <li>微信支付</li>
                    <li>企业微信</li>
                    <li>企业微信开放平台</li>
                </ul>
                <div class="layui-tab-content" style="padding:15px;">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">小程序设置</h3>

                            @include('component.text', ['label' => 'AppID', 'name' => 'config[weixin][mini_app_id]', 'value' => $config['weixin']['mini_app_id'], 'block' => 1])

                            @include('component.text', ['label' => 'AppSecret', 'name' => 'config[weixin][mini_app_secret]', 'value' => $config['weixin']['mini_app_secret'], 'block' => 1])

                            @include('component.text', ['label' => 'token', 'name' => 'config[weixin][mini_token]', 'value' => $config['weixin']['mini_token'], 'block' => 1])

                            @include('component.text', ['label' => 'AESKey', 'name' => 'config[weixin][mini_aes_key]', 'value' => $config['weixin']['mini_aes_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 1])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">公众号设置</h3>

                            @include('component.text', ['label' => 'AppID', 'name' => 'config[weixin][gzh_app_id]', 'value' => $config['weixin']['gzh_app_id'], 'block' => 1])

                            @include('component.text', ['label' => 'AppSecret', 'name' => 'config[weixin][gzh_app_secret]', 'value' => $config['weixin']['gzh_app_secret'], 'block' => 1])

                            @include('component.text', ['label' => 'token', 'name' => 'config[weixin][gzh_token]', 'value' => $config['weixin']['gzh_token'], 'block' => 1])

                            @include('component.text', ['label' => 'AESKey', 'name' => 'config[weixin][gzh_aes_key]', 'value' => $config['weixin']['gzh_aes_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 2])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">开发平台设置</h3>

                            @include('component.text', ['label' => 'AppID', 'name' => 'config[weixin][open_app_id]', 'value' => $config['weixin']['open_app_id'], 'block' => 1])

                            @include('component.text', ['label' => 'AppSecret', 'name' => 'config[weixin][open_app_secret]', 'value' => $config['weixin']['open_app_secret'], 'block' => 1])

                            @include('component.text', ['label' => 'token', 'name' => 'config[weixin][open_token]', 'value' => $config['weixin']['open_token'], 'block' => 1])

                            @include('component.text', ['label' => 'AESKey', 'name' => 'config[weixin][open_aes_key]', 'value' => $config['weixin']['open_aes_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 3])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">微信支付</h3>

                            @include('component.text', ['label' => '商户号mch_id', 'name' => 'config[weixin][pay_mch_id]', 'value' => $config['weixin']['pay_mch_id'], 'block' => 1])

                            @include('component.text', ['label' => '商户API密钥', 'name' => 'config[weixin][pay_secret_key]', 'value' => $config['weixin']['pay_secret_key'], 'block' => 1])

                            @include('component.textarea', ['label' => '微信支付证书', 'name' => 'config[weixin][pay_certificate]', 'value' => $config['weixin']['pay_certificate'], 'block' => 1])

                            @include('component.textarea', ['label' => '微信证书密钥', 'name' => 'config[weixin][pay_private_key]', 'value' => $config['weixin']['pay_private_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 4])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">企业微信</h3>

                            @include('component.text', ['label' => 'AppID', 'name' => 'config[weixin][corp_id]', 'value' => $config['weixin']['corp_id'], 'block' => 1])

                            @include('component.text', ['label' => 'AppSecret', 'name' => 'config[weixin][corp_secret]', 'value' => $config['weixin']['corp_secret'], 'block' => 1])

                            @include('component.text', ['label' => 'token', 'name' => 'config[weixin][corp_token]', 'value' => $config['weixin']['corp_token'], 'block' => 1])

                            @include('component.text', ['label' => 'AESKey', 'name' => 'config[weixin][corp_aes_key]', 'value' => $config['weixin']['corp_aes_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 5])
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <form class="layui-form" action="">
                            @csrf

                            <h3 style="margin-bottom:15px;">企业微信开放平台</h3>

                            @include('component.text', ['label' => 'AppID', 'name' => 'config[weixin][corp_open_id]', 'value' => $config['weixin']['corp_open_id'], 'block' => 1])

                            @include('component.text', ['label' => 'ProviderSecret', 'name' => 'config[weixin][corp_open_provider_secret]', 'value' => $config['weixin']['corp_open_provider_secret'], 'block' => 1])

                            @include('component.text', ['label' => 'token', 'name' => 'config[weixin][corp_open_token]', 'value' => $config['weixin']['corp_open_token'], 'block' => 1])

                            @include('component.text', ['label' => 'AESKey', 'name' => 'config[weixin][corp_open_aes_key]', 'value' => $config['weixin']['corp_open_aes_key'], 'block' => 1])

                            <hr>

                            @include('component.submit', ['append' => 6])
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
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
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
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
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
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });

            form.on('submit({{ getDomIdKey('', 'submit', '4') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });

            form.on('submit({{ getDomIdKey('', 'submit', '5') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功');
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });

            form.on('submit({{ getDomIdKey('', 'submit', '6') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.config.weixin') }}", field, function (res) {
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
