<?php

namespace App\Admin\Services;

use App\Models\ArticleCategory;

class ArticleCategoryService
{
    /**
     * 获取所有分类
     */
    public static function allCategoryList($status = 0)
    {
        return ArticleCategory::select('id', 'pid', 'name', 'code', 'status')
            ->where(function ($query) use ($status) {
                $status && $query->where('status', $status);
            })
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * 获取所有分类树
     */
    public static function allCategoryTree($status = 0)
    {
        return makeTree(self::allCategoryList($status));
    }
}
