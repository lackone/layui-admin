<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (app()->environment() == 'local' || app()->environment() == 'testing' || app()->environment() == 'dev') {
            error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
        } else {
            error_reporting(0);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(99999)->by($request->user()?->id ?: $request->ip());
        });
    }
}
