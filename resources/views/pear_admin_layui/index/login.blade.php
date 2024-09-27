<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="{{ cfg('website', 'admin_keywords') }}">
    <meta name="description" content="{{ cfg('website', 'admin_description') }}">
    <title>登录 - {{ cfg('website', 'admin_title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ cfg('website', 'admin_ico') ?: config('admin.default_icon') }}">
    <link rel="stylesheet" href="{{ adminAsset('component/pear/css/pear.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/login.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/variables.css') }}"/>
    <script>
        if (window.self != window.top) {
            top.location.reload();
        }
    </script>
</head>
<body>
<div class="login-page" style="background-image: url({{ adminAsset('admin/images/background.svg') }})">
    <div class="layui-row">
        <div class="layui-col-sm6 login-bg layui-hide-xs">
            <img class="login-bg-img" src="{{ cfg('website', 'admin_login_banner') ?: config('admin.default_login_banner') }}" alt=""/>
        </div>
        <div class="layui-col-sm6 layui-col-xs12 login-form">
            <div class="layui-form">
                <div class="form-center">
                    <div class="form-center-box">
                        <div class="top-log-title">
                            <img class="top-log" src="{{ cfg('website', 'admin_logo') ?: config('admin.default_logo') }}" alt=""/>
                            <span>{{ cfg('website', 'admin_login_title') ?: config('admin.default_login_title') }}</span>
                        </div>
                        <div class="top-desc">
                            以 超 乎 想 象 的 效 率 提 升 运 营 转 化
                        </div>
                        <div style="margin-top: 30px;">
                            @csrf
                            <div class="layui-form-item">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-username"></i>
                                    </div>
                                    <input lay-verify="required" name="account" placeholder="账户" autocomplete="off"
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-password"></i>
                                    </div>
                                    <input type="password" name="password" value=""
                                           lay-verify="required" placeholder="密码" autocomplete="off"
                                           class="layui-input" lay-affix="eye">
                                </div>
                            </div>
                            <div class="login-btn">
                                <button type="button" lay-submit lay-filter="login" class="layui-btn login">登 录
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 资 源 引 入 -->
<script src="{{ adminAsset('component/layui/layui.js') }}"></script>
<script src="{{ adminAsset('component/pear/pear.js') }}"></script>
<script>
    layui.use(['form', 'button', 'popup', 'jquery'], function () {
        var form = layui.form;
        var button = layui.button;
        var popup = layui.popup;
        var $ = layui.jquery;

        form.on('submit(login)', function (data) {
            var field = data.field;

            $.post("{{ route('admin.login') }}", field, function (res) {
                if (res.code == 200) {
                    button.load({
                        elem: '.login',
                        time: 1500,
                        done: function () {
                            popup.success("登录成功", function () {
                                location.href = "{{ route('admin.index') }}"
                            });
                        }
                    });
                } else {
                    popup.failure(res.msg);
                }
            });
            return false;
        });
    })
</script>
</body>
</html>
