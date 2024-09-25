<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AdminRole extends BaseModel
{
    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    public static $statusHtmlList = [
        self::STATUS_ENABLE => '<span class="badge text-bg-success bg-success">启用</span>',
        self::STATUS_DISABLE => '<span class="badge text-bg-danger bg-danger">禁用</span>',
    ];

    /**
     * 拥有此角色的用户
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_role_assocs', 'role_id', 'admin_id');
    }
}
