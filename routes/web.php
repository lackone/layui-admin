<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('web.route.prefix'),
    'as' => config('web.route.name'),
    'namespace' => config('web.route.namespace'),
    'middleware' => ['web', 'FrontTemplate'],
], function () {

    Route::any('/', 'IndexController@index')->name('index');
});
