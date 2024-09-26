<?php

namespace App\Admin\Services;

use App\Models\Admin;
use App\Models\AdminAuth;
use App\Models\AdminRole;
use Illuminate\Support\Str;

class RBACService
{
    /**
     * 检测用户的权限
     * @param $admin_id
     * @param $auth
     * @return bool
     */
    public static function checkAuth($admin_id, $auth)
    {
        if (!$auth) {
            return false;
        }

        $admin = Admin::find($admin_id);
        if ($admin['is_super'] == Admin::IS_SUPER_YES) {
            return true;
        }

        $auth_list = self::authListById($admin_id);

        return collect(array_column($auth_list, 'name'))->contains(fn($pattern) => Str::is(ltrim($pattern, '/'), $auth)) ||
            collect(array_column($auth_list, 'name'))->contains(fn($pattern) => Str::is(ltrim($pattern, '/'), $auth . '/'));
    }

    /**
     * 获取用户的所有角色名称
     * @param $admin_id
     * @return array
     */
    public static function roleNameById($admin_id)
    {
        $admin = Admin::with(['roles' => function ($query) {
            $query->where('status', AdminRole::STATUS_ENABLE);
        }])->find($admin_id);

        $role_name = [];

        if ($admin['is_super'] == Admin::IS_SUPER_YES) {
            $role_name[] = '超级管理员';
        }

        if ($admin->roles) {
            foreach ($admin->roles as $role) {
                $role_name[] = $role['name'];
            }
        }
        return $role_name;
    }

    /**
     * 获取用户的所有角色ID
     * @param $admin_id
     * @return array
     */
    public static function roleIdsById($admin_id)
    {
        $admin = Admin::with(['roles' => function ($query) {
            $query->where('status', AdminRole::STATUS_ENABLE);
        }])->find($admin_id);

        $role_ids = [];
        if ($admin->roles) {
            foreach ($admin->roles as $role) {
                $role_ids[] = $role['id'];
            }
        }
        return $role_ids;
    }

    /**
     * 获取用户的所有权限IDS
     * @param $admin_id
     * @return array
     */
    public static function authIdsById($admin_id)
    {
        static $cache_ids = [];

        if (is_null($cache_ids[$admin_id])) {
            $admin = Admin::with(['roles' => function ($query) {
                $query->where('status', AdminRole::STATUS_ENABLE);
            }])->find($admin_id);

            if ($admin['is_super'] == Admin::IS_SUPER_YES) {
                $ids = AdminAuth::pluck('id')->toArray();
                $cache_ids[$admin_id] = $ids;
                return $ids;
            }

            $auth_ids = [];
            if ($admin->roles) {
                foreach ($admin->roles as $role) {
                    $auth_ids = array_merge($auth_ids, explode(',', $role['auth_ids']) ?: []);
                }
            }
            $ids = array_unique($auth_ids) ?: [];
            $cache_ids[$admin_id] = $ids;
            return $ids;
        }

        return $cache_ids[$admin_id];
    }

    /**
     * 获取用户的所有权限
     * @param $admin_id
     * @return array
     */
    public static function authListById($admin_id, $type = 0)
    {
        static $cache_list = [];

        if (is_null($cache_list[$admin_id . '_' . $type])) {
            $auth_ids = self::authIdsById($admin_id);

            $list = AdminAuth::whereIn('id', $auth_ids)
                ->where('status', AdminAuth::STATUS_ENABLE)
                ->where(function ($query) use ($type) {
                    $type && $query->where('type', $type);
                })
                ->orderBy('sort', 'asc')
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();

            $cache_list[$admin_id . '_' . $type] = $list;
            return $list;
        }

        return $cache_list[$admin_id . '_' . $type];
    }

    /**
     * 获取用户的所有权限
     * @param $admin_id
     * @return array
     */
    public static function authTreeById($admin_id, $type = 0)
    {
        return makeTree(self::authListById($admin_id, $type));
    }

    /**
     * 获取所有权限
     */
    public static function allAuthList($status = 0)
    {
        return AdminAuth::select('id', 'pid', 'name', 'title', 'status', 'type')
            ->where(function ($query) use ($status) {
                $status && $query->where('status', $status);
            })
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * 获取所有权限树
     */
    public static function allAuthTree($status = 0)
    {
        return makeTree(self::allAuthList($status));
    }

    /**
     * 角色所有权限
     * @param $role_id
     */
    public static function roleAuthList($role_id)
    {
        $auth_list = self::allAuthList(AdminAuth::STATUS_ENABLE);
        if ($auth_list) {
            $role = AdminRole::find($role_id);
            $auth_ids = explode(',', $role['auth_ids']) ?: [];
            foreach ($auth_list as $key => $value) {
                if (in_array($value['id'], $auth_ids)) {
                    $auth_list[$key]['checked'] = true;
                } else {
                    $auth_list[$key]['checked'] = false;
                }
            }
        }
        return $auth_list;
    }
}
