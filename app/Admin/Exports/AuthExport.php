<?php

namespace App\Admin\Exports;

use App\Models\AdminRole;

class AuthExport extends ExportXls
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

        ];
    }
}
