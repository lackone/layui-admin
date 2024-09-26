<?php

namespace App\Admin\Exports;

use App\Models\AdminRole;

class RoleExport extends ExportXls
{
    /**
     * 映射字段
     *
     * @param object $model
     * @return array
     */
    public function map($model, $key = ''): array
    {
        return [
            $model['id'],
            $model['name'],
            AdminRole::$statusList[$model['status']],
            $model['remark'],
            $model['created'],
            $model['updated'],
        ];
    }

    /**
     * 表头
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '角色名',
            '状态',
            '备注',
            '创建时间',
            '更新时间',
        ];
    }
}
