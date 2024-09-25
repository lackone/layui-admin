<?php

namespace App\Models;

class AdminAuth extends BaseModel
{
    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    //类型(1:菜单,2:按钮)
    const TYPE_MENU = 1;
    const TYPE_BUTTON = 2;

    public static $typeList = [
        self::TYPE_MENU => '菜单',
        self::TYPE_BUTTON => '按钮',
    ];
}
