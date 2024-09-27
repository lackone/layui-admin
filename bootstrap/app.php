<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function() {
            Route::middleware('api')
                ->namespace('App\\Api\\Controllers')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //全局中间件
        $middleware->use([
            // \Illuminate\Http\Middleware\TrustHosts::class,
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        //web中间件
        $middleware->web([

        ]);

        //api中间件
        $middleware->api([

        ]);

        //中间件别名
        $middleware->alias([
            'AdminLoginCheck' => \App\Http\Middleware\AdminLoginCheck::class,
            'AdminAuthCheck' => \App\Http\Middleware\AdminAuthCheck::class,
            'AdminTemplate' => \App\Http\Middleware\AdminTemplate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if ($exceptions instanceof \Illuminate\Database\QueryException) {
            Log::channel('sql_error')->info($exceptions->getMessage());
            throw new \Exception('sql错误');
        }
    })->create();
