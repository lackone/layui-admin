<?php

namespace App\Http\Middleware;

use App\Admin\Services\RBACService;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin_id = session('admin_id');

        $admin = Admin::find($admin_id);

        $auth = $request->decodedPath();

        if ($admin['is_super'] != Admin::IS_SUPER_YES && !RBACService::checkAuth($admin_id, $auth)) {
            if ($request->ajax() && $request->header('pear-admin-table')) {
                return error("你没有该权限[{$auth}]，请联系管理员");
            }
            return redirect(route('admin.forbidden', ['msg' => "你没有该权限[{$auth}]，请联系管理员"]));
        }

        return $next($request);
    }
}
