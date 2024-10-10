@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '中文名', 'name' => 'name', 'value' => $dict['name'], 'verify' => 'required', 'block' => 1])

        @include('component.text', ['label' => '编码', 'name' => 'code', 'value' => $dict['code'], 'verify' => 'required', 'block' => 1])

        @include('component.radio', ['label' => '类型', 'name' => 'type', 'list' => \App\Models\Dict::$typeList, 'value' => $dict['type']])

        @include('component.textarea', ['label' => '内容', 'name' => 'value', 'value' => $dict['value']])

        @include('component.search_select_multi', ['label' => '父级', 'name' => 'pid', 'list' => $dict_tree, 'title' => 'name', 'value' => $dict['pid']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\Dict::$statusList, 'value' => $dict['status']])

        @include('component.text', ['label' => '排序', 'name' => 'sort', 'value' => $dict['sort'], 'block' => 1])

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
                $.post("{{ route('admin.dict.save', $dict['id']) }}", field, function (res) {
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
