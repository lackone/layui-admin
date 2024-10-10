@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '账号(登录)', 'name' => 'account', 'value' => $admin['account'], 'verify' => 'required', 'block' => 1])

        @include('component.text', ['label' => '昵称', 'name' => 'nick_name', 'value' => $admin['nick_name'], 'block' => 1])

        @include('component.text', ['label' => '真实姓名', 'name' => 'real_name', 'value' => $admin['real_name'], 'block' => 1])

        @include('component.single_image', ['label' => '头像', 'name' => 'avatar', 'value' => $admin['avatar']])

        @include('component.radio', ['label' => '性别', 'name' => 'sex', 'list' => \App\Models\Admin::$sexList, 'value' => $admin['sex']])

        @include('component.text', ['label' => '密码', 'name' => 'password', 'value' => '', 'block' => 1])

        @include('component.text', ['label' => '手机号', 'name' => 'phone', 'value' => $admin['phone'], 'block' => 1])

        @include('component.text', ['label' => '座机', 'name' => 'tel', 'value' => $admin['tel'], 'block' => 1])

        @include('component.text', ['label' => '邮箱', 'name' => 'email', 'value' => $admin['email'], 'block' => 1])

        @include('component.text', ['label' => '微信', 'name' => 'weixin', 'value' => $admin['weixin'], 'block' => 1])

        @include('component.radio', ['label' => '超级管理员', 'name' => 'is_super', 'list' => \App\Models\Admin::$isSuperList, 'value' => $admin['is_super']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\Admin::$statusList, 'value' => $admin['status']])

        @include('component.textarea', ['label' => '地址', 'name' => 'address', 'value' => $admin['address']])

        @include('component.textarea', ['label' => '备注', 'name' => 'remark', 'value' => $admin['remark']])

        @include('component.submit')
    </form>
@endsection

@section('myjs')
    <script>
        layui.use(['form', 'laydate', 'util', 'jquery'], function () {
            var form = layui.form;
            var layer = layui.layer;
            var $ = layui.jquery;

            form.on('submit({{ getDomIdKey('', 'submit') }})', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.admin.save', $admin['id']) }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功', function () {
                            top.layer.closeAll();
                            top.layui.admin.refresh();
                        });
                    } else {
                        layer.msg(res.msg);
                    }
                }, "json");
                return false;
            });
        });
    </script>
@endsection
