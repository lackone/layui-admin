<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @yield('css')
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/result.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/analysis.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/css/other/exception.css') }}"/>
    <style>
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
    @yield('mycss')
</head>
<body>
<div class="pear-container">
    @include('common.message')

    @yield('content')
</div>
@yield('js')
<script></script>
@yield('myjs')
</body>
</html>
