<?php

namespace App\Admin\Controllers;

use App\Admin\Services\RBACService;
use App\Admin\Services\UserService;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\AdminRoleAssoc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Admin\Exports\AdminExport;

class AdminController extends Controller
{
    /**
     * 用户列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        if (adminIsAjax()) {
            $order_field = $params['order_field'] ?: 'id';
            $order = $params['order'] ?: 'desc';

            $query = Admin::with(['roles'])->where(function ($query) use ($params) {
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['account', 'phone', 'start_time', 'end_time', 'status']) && $value != '') {
                            switch ($key) {
                                case 'account':
                                case 'phone':
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
                return (new AdminExport($query))->download("admin_{$now}");
            }

            $list = $query->paginate($params['limit'] ?? 10);

            return toList($list);
        }

        return view('admin.list', compact('params'));
    }

    /**
     * 新增或修改用户
     * @param Request $request
     */
    public function save(Request $request, Admin $admin)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['account']) {
                    throw new \Exception('账号不能为空');
                }

                if ($params['password']) {
                    $params['salt'] = Str::random(6);
                    $params['password'] = UserService::makePassword($params['salt'], $params['password']);
                } else {
                    unset($params['password']);
                }

                if ($admin['id']) {
                    if (Admin::where('account', $params['account'])->where('id', '<>', $admin['id'])->first()) {
                        throw new \Exception('已经存在相同账号');
                    }

                    $admin->update($params);
                } else {
                    if (Admin::where('account', $params['account'])->first()) {
                        throw new \Exception('已经存在相同账号');
                    }
                    if (!$params['password']) {
                        throw new \Exception('密码不能为空');
                    }
                    Admin::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        return view('admin.save', compact('admin'));
    }

    /**
     * 分配角色
     * @param Request $request
     */
    public function setRole(Request $request, Admin $admin)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$admin['id']) {
                    throw new \Exception('请选择用户');
                }

                AdminRoleAssoc::where('admin_id', $admin['id'])->delete();

                $insert = [];
                if ($params['role_ids']) {
                    $now = time();
                    foreach ($params['role_ids'] as $role_id) {
                        $insert[] = ['admin_id' => $admin['id'], 'role_id' => $role_id, 'created' => $now, 'updated' => $now];
                    }
                }
                $insert && AdminRoleAssoc::insert($insert);

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $role_list = AdminRole::optionList('id', 'name', [['status', '=', AdminRole::STATUS_ENABLE]]);

        $role_ids = RBACService::roleIdsById($admin['id']);

        return view('admin.set_role', compact('admin', 'role_list', 'role_ids'));
    }

    /**
     * 删除
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

            Admin::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
