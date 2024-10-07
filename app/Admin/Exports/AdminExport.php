<?php

namespace App\Admin\Exports;

use App\Models\Admin;

class AdminExport extends ExportXls
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
            $model['account'],
            implode(',', $model['roles'] ? $model['roles']->pluck('name')->all() : []) ?: '',
            $model['phone'],
            $model['email'],
            Admin::$statusList[$model['status']] ?: '',
            Admin::$isSuperList[$model['is_super']] ?: '',
            $model['remark'],
            paramConvert($model['last_login_time'], 'datetime'),
            $model['last_login_ip'],
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
            '账号',
            '所属角色',
            '手机号',
            '邮箱',
            '状态',
            '超级管理员',
            '备注',
            '登录时间',
            'IP',
        ];
    }
}
