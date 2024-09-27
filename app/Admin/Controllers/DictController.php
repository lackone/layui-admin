<?php

namespace App\Admin\Controllers;

use App\Admin\Services\DictService;
use App\Models\Dict;
use Illuminate\Http\Request;

class DictController extends Controller
{
    /**
     * 字典列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        if (adminIsAjax()) {
            $order_field = $params['order_field'] ?: 'id';
            $order = $params['order'] ?: 'desc';

            $query = Dict::with(['children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }, 'children.children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }, 'children.children.children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }])->where(function ($query) use ($params) {
                $query->where('pid', 0);
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['name', 'code']) && $value != '') {
                            switch ($key) {
                                case 'name':
                                case 'code':
                                    $query->where($key, 'like', $value . '%');
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

        return view('dict.list', compact('params'));
    }

    /**
     * 新增或修改字典
     * @param Request $request
     */
    public function save(Request $request, Dict $dict)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['name']) {
                    throw new \Exception('字典名不能为空');
                }

                if ($dict['id']) {
                    if (Dict::where('code', $params['code'])->where('id', '<>', $dict['id'])->first()) {
                        throw new \Exception('已经存在相同编码');
                    }
                    $dict->update($params);
                } else {
                    if (Dict::where('code', $params['code'])->first()) {
                        throw new \Exception('编码已存在');
                    }
                    Dict::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $dict_tree = DictService::allDictTree();

        if (!$dict['id'] && $params['pid']) {
            $dict['pid'] = $params['pid'];
        }

        return view('dict.save', compact('dict', 'dict_tree'));
    }

    /**
     * 删除字典
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

            Dict::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
