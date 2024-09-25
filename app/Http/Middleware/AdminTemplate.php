<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTemplate
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $theme = config('admin.theme', 'pear_admin_layui');

        $path = resource_path("views/{$theme}/");

        $finder = app('view')->getFinder();

        $finder->prependLocation($path);

        return $next($request);
    }
}
