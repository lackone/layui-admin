<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('api.route.prefix'),
    'as' => config('api.route.name'),
    'namespace' => config('api.route.namespace'),
    'middleware' => [],
], function () {

    Route::any('/test', 'TestController@test')->name('test');

});
