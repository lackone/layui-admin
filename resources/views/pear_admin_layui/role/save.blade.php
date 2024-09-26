@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '角色名', 'name' => 'name', 'value' => $role['name'], 'verify' => 'required'])

        @include('component.ztree', ['label' => '权限', 'name' => 'auth_ids', 'list' => $auth_list])

        @include('component.textarea', ['label' => '备注', 'name' => 'remark', 'value' => $role['remark']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\AdminRole::$statusList, 'value' => $role['status']])

        @include('component.submit')
    </form>
@endsection

@section('myjs')
    <script>
        layui.use(['form', 'laydate', 'util', 'jquery'], function () {
            var form = layui.form;
            var layer = layui.layer;
            var $ = layui.jquery;

            form.on('submit({{ getDomId() }}_submit)', function (data) {
                var field = data.field; // 获取表单字段值
                $.post("{{ route('admin.role.save', $role['id']) }}", field, function (res) {
                    if (res.code == 200) {
                        layer.msg('成功', function () {
                            parent.layer.closeAll();
                            parent.layui.admin.refresh();
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
