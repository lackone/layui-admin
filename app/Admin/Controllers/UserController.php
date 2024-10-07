<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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

            $query = User::with([])->where(function ($query) use ($params) {
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['account', 'sn', 'start_time', 'end_time', 'status']) && $value != '') {
                            switch ($key) {
                                case 'account':
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

            $list = $query->paginate($params['limit'] ?? 10);

            return toList($list);
        }

        return view('user.list', compact('params'));
    }

    /**
     * 查看用户
     * @param Request $request
     */
    public function show(Request $request, User $user)
    {
        $params = $request->all();

        return view('user.show', compact('user'));
    }
}
