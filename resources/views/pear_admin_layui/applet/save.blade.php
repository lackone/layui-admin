@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text', ['label' => '小程序名称', 'name' => 'name', 'value' => $applet['name'], 'verify' => 'required', 'block' => 1])

        @include('component.text', ['label' => '小程序原始id', 'name' => 'oid', 'value' => $applet['oid'], 'block' => 1])

        @include('component.text', ['label' => '小程序绑定pid', 'name' => 'pid', 'value' => $applet['pid'], 'block' => 1])

        @include('component.text', ['label' => '小程序appid', 'name' => 'appid', 'value' => $applet['appid'], 'block' => 1])

        @include('component.text', ['label' => '小程序appsecret', 'name' => 'appsecret', 'value' => $applet['appsecret'], 'block' => 1])

        @include('component.radio', ['label' => '状态', 'name' => 'status', 'list' => \App\Models\Applet::$statusList, 'value' => $applet['status']])

        <hr>

        <h3 style="margin-bottom:15px;">支付相关配置</h3>

        @include('component.text', ['label' => '商户号mch_id', 'name' => 'mch_id', 'value' => $applet['mch_id'], 'block' => 1])

        @include('component.text', ['label' => '商户API密钥', 'name' => 'secret_key', 'value' => $applet['secret_key'], 'block' => 1])

        @include('component.textarea', ['label' => '微信支付证书', 'name' => 'certificate', 'value' => $applet['certificate']])

        @include('component.textarea', ['label' => '微信证书密钥', 'name' => 'private_key', 'value' => $applet['private_key']])

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
                $.post("{{ route('admin.applet.save', $applet['id']) }}", field, function (res) {
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
