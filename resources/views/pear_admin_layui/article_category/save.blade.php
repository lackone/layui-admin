@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '分类名', 'name' => 'name', 'value' => $article_category['name'], 'verify' => 'required'])

        @include('component.text', ['label' => '编码', 'name' => 'code', 'value' => $article_category['code'], 'verify' => 'required'])

        @include('component.search_select_multi', ['label' => '父级', 'name' => 'pid', 'list' => $category_tree, 'title' => 'name', 'value' => $article_category['pid']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\ArticleCategory::$statusList, 'value' => $article_category['status']])

        @include('component.text', ['label' => '排序', 'name' => 'sort', 'value' => $article_category['sort']])

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
                $.post("{{ route('admin.article_category.save', $article_category['id']) }}", field, function (res) {
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
