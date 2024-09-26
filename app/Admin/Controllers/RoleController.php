<?php

namespace App\Admin\Controllers;

use App\Admin\Services\RBACService;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Admin\Exports\RoleExport;

class RoleController extends Controller
{
    /**
     * 角色列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        if (adminIsAjax()) {
            $order_field = $params['order_field'] ?: 'id';
            $order = $params['order'] ?: 'desc';

            $query = AdminRole::where(function ($query) use ($params) {
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['name', 'start_time', 'end_time', 'status']) && $value != '') {
                            switch ($key) {
                                case 'name':
                                    $query->where($key, 'like', $value . '%');
                                    break;
                                case 'start_time':
                                    $query->where('created', '>=', strtotime($value));
                                    break;
                                case 'end_time':
                                    $query->where('created', '<', strtotime($value));
                                    break;
                                default:
                                    $query->where($key, $value);
                                    break;
                            }
                        }
                    }
                }
            })->orderBy($order_field, $order);

            if ($params['export']) {
                $now = date('YmdHis');
                return (new RoleExport($query))->download("role_{$now}");
            }

            $list = $query->paginate($params['limit'] ?? 10);

            return toList($list);
        }

        return view('role.list', compact('params'));
    }

    /**
     * 新增或修改角色
     * @param Request $request
     */
    public function save(Request $request, AdminRole $role)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['name']) {
                    throw new \Exception('角色名不能为空');
                }

                if ($role['id']) {
                    $role->update($params);
                } else {
                    AdminRole::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $auth_list = RBACService::roleAuthList($role['id']);

        return view('role.save', compact('role', 'auth_list'));
    }

    /**
     * 删除角色
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

            $id = is_array($id) ? $id : [$id];

            AdminRole::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
