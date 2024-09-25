<?php

namespace App\Admin\Controllers;

use App\Admin\Services\RBACService;
use App\Models\AdminAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * 权限列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        $auth_list = RBACService::allAuthList();

        return view('auth.list', compact('auth_list', 'params'));
    }

    /**
     * 新增或修改权限
     * @param Request $request
     */
    public function save(Request $request, AdminAuth $auth)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['name']) {
                    throw new \Exception('规则名不能为空');
                }

                if ($auth['id']) {
                    if (AdminAuth::where('name', $params['name'])->where('id', '<>', $auth['id'])->first()) {
                        throw new \Exception('已经存在相同规则名');
                    }
                    $auth->update($params);
                } else {
                    if (AdminAuth::where('name', $params['name'])->first()) {
                        throw new \Exception('规则名已存在');
                    }
                    AdminAuth::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $auth_tree = RBACService::allAuthTree();

        if (!$auth['id'] && $params['pid']) {
            $auth['pid'] = $params['pid'];
        }

        return view('auth.save', compact('auth', 'auth_tree'));
    }

    /**
     * 删除权限
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $params = $request->all();
        try {
            $id = $params['id'] ?: 0;

            if (!$id) {
                throw new \Exception('id不能为空');
            }

            AdminAuth::where('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
