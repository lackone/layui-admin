<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('api.route.prefix'),
    'as' => config('api.route.name'),
    'namespace' => config('api.route.namespace'),
    'middleware' => [],
], function () {

    Route::any('/gzh', 'IndexController@gzh')->name('gzh');
    Route::any('/gzh_serve', 'IndexController@gzhServe')->name('gzh_serve');

    Route::any('/mini_login', 'IndexController@miniLogin')->name('mini_login');
});
