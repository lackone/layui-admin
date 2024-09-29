<?php

namespace App\Admin\Controllers;

use App\Admin\Services\ArticleCategoryService;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    /**
     * 列表
     * @param Request $request
     */
    public function list(Request $request)
    {
        $params = $request->all();

        if (adminIsAjax()) {
            $order_field = $params['order_field'] ?: 'id';
            $order = $params['order'] ?: 'desc';

            $query = ArticleCategory::with(['children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }, 'children.children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }, 'children.children.children' => function ($query) {
                $query->orderBy('sort', 'asc')->orderBy('id', 'asc');
            }])->where(function ($query) use ($params) {
                $query->where('pid', 0);
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['name', 'code']) && $value != '') {
                            switch ($key) {
                                case 'name':
                                case 'code':
                                    $query->where($key, 'like', $value . '%');
                                    break;
                                default:
                                    $query->where($key, $value);
                                    break;
                            }
                        }
                    }
                }
            })->orderBy($order_field, $order);

            $list = $query->paginate($params['limit'] ?? 10);

            return toList($list);
        }

        return view('article_category.list', compact('params'));
    }

    /**
     * 新增或修改分类
     * @param Request $request
     */
    public function save(Request $request, ArticleCategory $article_category)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['name']) {
                    throw new \Exception('分类名不能为空');
                }

                if ($article_category['id']) {
                    if (ArticleCategory::where('name', $params['name'])->where('id', '<>', $article_category['id'])->first()) {
                        throw new \Exception('已经存在相同分类名');
                    }
                    $article_category->update($params);
                } else {
                    if (ArticleCategory::where('name', $params['name'])->first()) {
                        throw new \Exception('分类名已存在');
                    }
                    ArticleCategory::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $category_tree = ArticleCategoryService::allCategoryTree();

        if (!$article_category['id'] && $params['pid']) {
            $article_category['pid'] = $params['pid'];
        }

        return view('article_category.save', compact('article_category', 'category_tree'));
    }

    /**
     * 删除分类
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $params = $request->all();
        try {
            $id = $params['id'] ?: 0;

            if (!$id) {
                throw new \Exception('id不能为空');
            }

            $id = is_array($id) ? $id : [$id];

            ArticleCategory::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
