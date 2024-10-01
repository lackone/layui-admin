@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '菜单名称', 'name' => 'title', 'value' => $auth['title'], 'verify' => 'required'])

        @include('component.text', ['label' => '菜单URL', 'name' => 'name', 'value' => $auth['name'], 'verify' => 'required'])

        @include('component.radio', ['label' => '类型', 'name' => 'type', 'list' => \App\Models\AdminAuth::$typeList, 'value' => $auth['type']])

        @include('component.search_select_multi', ['label' => '父级', 'name' => 'pid', 'list' => $auth_tree, 'title' => 'title', 'value' => $auth['pid']])

        @include('component.sel_icon', ['label' => '图标', 'name' => 'icon', 'value' => $auth['icon']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\AdminAuth::$statusList, 'value' => $auth['status']])

        @include('component.text', ['label' => '排序', 'name' => 'sort', 'value' => $auth['sort']])

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
                $.post("{{ route('admin.auth.save', $auth['id']) }}", field, function (res) {
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
