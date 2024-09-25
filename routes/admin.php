<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('admin.route.prefix'),
    'as' => config('admin.route.name'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => ['web', 'AdminTemplate'],
], function () {
    //test
    Route::any('/test', 'IndexController@test')->name('test');
    //登录
    Route::any('/login', 'IndexController@login')->name('login');
    //登出
    Route::any('/logout', 'IndexController@logout')->name('logout');
    //错误页
    Route::any('/forbidden', 'IndexController@forbidden')->name('forbidden');
    //上传
    Route::any('/upload', 'IndexController@upload')->name('upload');
    //配置
    Route::any('/config', 'IndexController@config')->name('config');

    Route::group([
        'middleware' => config('admin.route.middleware'),
    ], function () {
        //首页
        Route::any('/', 'IndexController@index')->name('index');
        //欢迎
        Route::any('/welcome', 'IndexController@welcome')->name('welcome');

        //用户列表
        Route::any('/user/list', 'UserController@list')->name('user.list');
        Route::any('/user/save/{admin?}', 'UserController@save')->name('user.save');
        Route::any('/user/delete', 'UserController@delete')->name('user.delete');
        Route::any('/user/set_role/{admin?}', 'UserController@setRole')->name('user.set_role');
        Route::any('/user/changePassword', 'UserController@changePassword')->name('user.change_password');

        //角色列表
        Route::any('/role/list', 'RoleController@list')->name('role.list');
        Route::any('/role/save/{role?}', 'RoleController@save')->name('role.save');
        Route::any('/role/delete', 'RoleController@delete')->name('role.delete');

        //权限列表
        Route::any('/auth/list', 'AuthController@list')->name('auth.list');
        Route::any('/auth/save/{auth?}', 'AuthController@save')->name('auth.save');
        Route::any('/auth/delete', 'AuthController@delete')->name('auth.delete');


    });
});

Route::fallback(function () {
    abort(404);
});
