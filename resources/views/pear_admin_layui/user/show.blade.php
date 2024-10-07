@extends('layouts.iframe')

@section('content')
    <form class="layui-form" action="">
        @csrf

        @include('component.text_raw', ['label' => 'SN', 'name' => 'sn', 'value' => $user['sn'], 'block' => 1])

        @include('component.text_raw', ['label' => '账号', 'name' => 'account', 'value' => $user['account'], 'block' => 1])

        @include('component.text_raw', ['label' => '真实姓名', 'name' => 'account', 'value' => $user['real_name'], 'block' => 1])

        @include('component.text_raw', ['label' => '昵称', 'name' => 'account', 'value' => $user['nick_name'], 'block' => 1])

        @include('component.text_raw', ['label' => '渠道', 'name' => 'account', 'value' => $user['channel'], 'block' => 1])

        @include('component.text_raw', ['label' => '最后登录IP', 'name' => 'account', 'value' => $user['last_login_ip'], 'block' => 1])

        @include('component.text_raw', ['label' => '最后登录时间', 'name' => 'account', 'value' => $user['last_login_time'] ? date('Y-m-d H:i:s', $user['last_login_time']) : '', 'block' => 1])

        @include('component.text_raw', ['label' => '设备类型', 'name' => 'account', 'value' => \App\Models\User::$deviceTypeList[$user['device_type']], 'block' => 1])

        @include('component.text_raw', ['label' => '来源', 'name' => 'account', 'value' => \App\Models\User::$sourceList[$user['source']], 'block' => 1])

    </form>
@endsection
