<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontTemplate
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $theme = config('web.theme', 'website');

        $path = resource_path("views/{$theme}/");

        $finder = app('view')->getFinder();

        $finder->prependLocation($path);

        return $next($request);
    }
}
