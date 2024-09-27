<?php

namespace App\Models;

class Dict extends BaseModel
{
    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    //类型(1:原始内容,2:json)
    const TYPE_RAW = 1;
    const TYPE_JSON = 2;

    public static $typeList = [
        self::TYPE_RAW => '原始内容',
        self::TYPE_JSON => 'json',
    ];

    /**
     * 获取博客文章的评论
     */
    public function children()
    {
        return $this->hasMany(Dict::class, 'pid', 'id');
    }
}
