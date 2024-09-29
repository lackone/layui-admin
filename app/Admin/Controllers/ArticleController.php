<?php

namespace App\Admin\Controllers;

use App\Admin\Services\ArticleCategoryService;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
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

            $query = Article::where(function ($query) use ($params) {
                if ($params) {
                    foreach ($params as $key => $value) {
                        if (in_array($key, ['title', 'sub_title', 'start_time', 'end_time', 'status']) && $value != '') {
                            switch ($key) {
                                case 'name':
                                    $query->where($key, 'like', $value . '%');
                                    break;
                                case 'start_time':
                                    $query->where('created', '>=', strtotime($value));
                                    break;
                                case 'end_time':
                                    $query->where('created', '<', strtotime($value));
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

        return view('article.list', compact('params'));
    }

    /**
     * 新增或修改
     * @param Request $request
     */
    public function save(Request $request, Article $article)
    {
        $params = $request->all();

        if ($request->isMethod('POST')) {
            try {
                if (!$params['title']) {
                    throw new \Exception('标题不能为空');
                }

                if ($article['id']) {
                    $article->update($params);
                } else {
                    Article::create($params);
                }

                return success();
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        $category_tree = ArticleCategoryService::allCategoryTree();

        return view('article.save', compact('article', 'category_tree'));
    }

    /**
     * 删除
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

            Article::whereIn('id', $id)->delete();

            return success();
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
