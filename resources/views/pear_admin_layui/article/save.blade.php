@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '文章标题', 'name' => 'title', 'value' => $article['title'], 'verify' => 'required'])

        @include('component.text', ['label' => '子标题', 'name' => 'sub_title', 'value' => $article['sub_title']])

        @include('component.text', ['label' => '编码', 'name' => 'code', 'value' => $article['code']])

        @include('component.search_select_multi', ['label' => '分类ID', 'name' => 'category_id', 'list' => $category_tree, 'title' => 'name', 'value' => $article['category_id']])

        @include('component.text', ['label' => '作者', 'name' => 'author', 'value' => $article['author']])

        @include('component.single_image', ['label' => '文章banner', 'name' => 'banner', 'value' => $article['banner']])

        @include('component.wangeditor', ['label' => '内容', 'name' => 'context', 'value' => $article['context'], 'block' => 1])

        @include('component.text', ['label' => '排序(越小越前)', 'name' => 'sort', 'value' => $article['sort']])

        @include('component.radio', ['label' => '置顶', 'name' => 'is_hot', 'list' => \App\Models\Article::$isHotList, 'value' => $article['is_hot']])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\Article::$statusList, 'value' => $article['status']])

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
                $.post("{{ route('admin.article.save', $article['id']) }}", field, function (res) {
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
