<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends BaseModel
{
    use SoftDeletes;

    //超级管理员(-1:否,1:是)
    const IS_SUPER_YES = 1;
    const IS_SUPER_NO = -1;

    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //性别(0:未知,1:男,2:女)
    const SEX_UNKNOWN = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    public static $statusHtmlList = [
        self::STATUS_ENABLE => '<span class="badge text-bg-success bg-success">启用</span>',
        self::STATUS_DISABLE => '<span class="badge text-bg-danger bg-danger">禁用</span>',
    ];

    public static $isSuperList = [
        self::IS_SUPER_YES => '是',
        self::IS_SUPER_NO => '否',
    ];

    public static $sexList = [
        self::SEX_UNKNOWN => '未知',
        self::SEX_MAN => '男',
        self::SEX_WOMAN => '女',
    ];

    /**
     * 用户所拥有的角色
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_assocs', 'admin_id', 'role_id');
    }
}
