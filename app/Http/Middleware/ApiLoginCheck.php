<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');
        if (!$token) {
            $token = $request->input('token');
        }

        $class = $request->route()->getControllerClass();
        $controller = app()->make($class);
        $is_not_need_login = $controller->isNotNeedLogin();

        if (empty($token) && !$is_not_need_login) {
            return error('请求参数缺token');
        }

        $user_info = UserService::getInfoByToken($token);

        if (empty($user_info) && !$is_not_need_login) {
            return error('登录超时，请重新登录');
        }

        if ($user_info &&
            $user_info['expire_time'] > (time() + config('app.user_token.be_expire_duration'))
        ) {
            try {
                UserService::delayToken($token);
            } catch (\Exception $e) {
                return error('登录过期');
            }
        }

        $request->offsetSet('user_info', $user_info);
        $request->offsetSet('user_id', $user_info['id']);

        return $next($request);
    }
}
