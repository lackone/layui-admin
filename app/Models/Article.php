<?php

namespace App\Models;

class Article extends BaseModel
{
    //状态(-1:禁用,1:启用)
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    //状态列表
    public static $statusList = [
        self::STATUS_ENABLE => '启用',
        self::STATUS_DISABLE => '禁用',
    ];

    //置顶(-1：否,1：是)
    const IS_HOT_DISABLE = -1;
    const IS_HOT_ENABLE = 1;

    //状态列表
    public static $isHotList = [
        self::IS_HOT_DISABLE => '否',
        self::IS_HOT_ENABLE => '是',
    ];

    public $nullable = ['code'];

    /**
     * 通过code获取文章
     * @param $code
     */
    protected function getArticleByCode($code)
    {
        return $this->where('code', $code)->first();
    }

    /**
     * 通过分类ID来获取文章
     * @param $cate_id
     */
    protected function getListByCateId($cate_id = 0, $where = [])
    {
        return $this->where('status', self::STATUS_ENABLE)
            ->where(function ($query) use ($cate_id, $where) {
                $cate_id && $query->where('category_id', $cate_id);
                $where && $query->where($where);
            })->orderBy('is_hot', 'desc')->orderBy('sort', 'asc')->orderBy('id', 'desc')->paginate();
    }
}
