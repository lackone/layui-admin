<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\AdminAuth;
use App\Models\AdminRole;
use App\Models\Article;
use App\Models\Config;
use App\Models\Dict;
use App\Models\ArticleCategory;
use App\Observers\AdminAuthObserver;
use App\Observers\AdminObserver;
use App\Observers\AdminRoleObserver;
use App\Observers\ArticleCategoryObserver;
use App\Observers\ArticleObserver;
use App\Observers\ConfigObserver;
use App\Observers\DictObserver;
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

        AdminAuth::observe(AdminAuthObserver::class);
        AdminRole::observe(AdminRoleObserver::class);
        Admin::observe(AdminObserver::class);
        Config::observe(ConfigObserver::class);
        Dict::observe(DictObserver::class);
        Article::observe(ArticleObserver::class);
        ArticleCategory::observe(ArticleCategoryObserver::class);
    }
}
