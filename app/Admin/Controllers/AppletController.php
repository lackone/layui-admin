<?php

namespace App\Admin\Controllers;

use App\Models\Applet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppletController extends Controller
{
    /**
     * 列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        if (adminIsAjax()) {
            $order_field = $params['order_field'] ?: 'id';
            $order = $params['order'] ?: 'desc';

            $query = Applet::where(function ($query) use ($params) {
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['name', 'appid', 'start_time', 'end_time', 'status']) && $value != '') {
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

            $list = $query->paginate($params['limit'] ?? 10);

            return toList($list);
        }

        return view('applet.list', compact('params'));
    }

    /**
     * 新增或修改
     * @param Request $request
     */
    public function save(Request $request, Applet $applet)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['name']) {
                    throw new \Exception('名称不能为空');
                }

                if ($params['private_key'] && (!$applet['private_key_path'] || $applet['private_key'] != $params['private_key'])) {
                    $day = date('YmdHis');
                    $path = "{$day}_private_key.pem";
                    Storage::disk('cert')->put($path, $params['private_key']);
                    $params['private_key_path'] = Storage::disk('cert')->path($path);
                }

                if ($params['certificate'] && (!$applet['certificate_path'] || $applet['certificate'] != $params['certificate'])) {
                    $day = date('YmdHis');
                    $path = "{$day}_certificate.pem";
                    Storage::disk('cert')->put($path, $params['certificate']);
                    $params['certificate_path'] = Storage::disk('cert')->path($path);
                }

                if ($applet['id']) {
                    if (Applet::where('appid', $params['appid'])->where('id', '<>', $applet['id'])->first()) {
                        throw new \Exception('已经存在相同小程序appid');
                    }
                    $applet->update($params);
                } else {
                    if (Applet::where('appid', $params['appid'])->first()) {
                        throw new \Exception('小程序appid已存在');
                    }
                    Applet::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        return view('applet.save', compact('applet'));
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

            Applet::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }

    /**
     * 设置
     * @param Request $request
     */
    public function set(Request $request)
    {
        $params = $request->all();
        try {
            $id = $params['id'] ?: 0;

            if (!$id) {
                throw new \Exception('id不能为空');
            }

            Applet::where('id', $id)->update([
                $params['key'] => $params['value'],
            ]);

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
