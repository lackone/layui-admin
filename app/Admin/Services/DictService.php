<?php

namespace App\Admin\Services;

use App\Models\Dict;

class DictService
{
    /**
     * 获取所有权限
     */
    public static function allDictList($status = 0)
    {
        return Dict::select('id', 'pid', 'name', 'code', 'status', 'type')
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
    public static function allDictTree($status = 0)
    {
        return makeTree(self::allDictList($status));
    }
}
