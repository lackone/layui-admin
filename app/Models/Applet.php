<?php

namespace App\Models;

class Applet extends BaseModel
{
    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];
}
