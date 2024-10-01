<?php

namespace App\Http\Controllers;

use app\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        return view('index.index', compact(''));
    }
}
