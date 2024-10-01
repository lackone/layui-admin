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

        //角色列表
        Route::any('/role/list', 'RoleController@list')->name('role.list');
        Route::any('/role/save/{role?}', 'RoleController@save')->name('role.save');
        Route::any('/role/delete', 'RoleController@delete')->name('role.delete');

        //权限列表
        Route::any('/auth/list', 'AuthController@list')->name('auth.list');
        Route::any('/auth/save/{auth?}', 'AuthController@save')->name('auth.save');
        Route::any('/auth/delete', 'AuthController@delete')->name('auth.delete');

        //字典列表
        Route::any('/dict/list', 'DictController@list')->name('dict.list');
        Route::any('/dict/save/{dict?}', 'DictController@save')->name('dict.save');
        Route::any('/dict/delete', 'DictController@delete')->name('dict.delete');

        //网站设置
        Route::any('/config/website', 'ConfigController@website')->name('config.website');
        Route::any('/config/weixin', 'ConfigController@weixin')->name('config.weixin');

        //文章
        Route::any('/article/list', 'ArticleController@list')->name('article.list');
        Route::any('/article/save/{article?}', 'ArticleController@save')->name('article.save');
        Route::any('/article/delete', 'ArticleController@delete')->name('article.delete');

        //文章分类
        Route::any('/article_category/list', 'ArticleCategoryController@list')->name('article_category.list');
        Route::any('/article_category/save/{article_category?}', 'ArticleCategoryController@save')->name('article_category.save');
        Route::any('/article_category/delete', 'ArticleCategoryController@delete')->name('article_category.delete');
    });
});

Route::fallback(function () {
    abort(404);
});
