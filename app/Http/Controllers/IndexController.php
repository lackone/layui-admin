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

    /**
     * 获取右边栏
     * @param $key
     * @return array|array[]
     */
    public function getSidebar($key)
    {
        $sidebar = [];

        if (in_array($key, ['bytedance', 'kuaishou', 'wx_mini_program', 'back_manage'])) {
            $sidebar = [
                ['title' => '短剧小程序端', 'url' => route('wx_mini_program')],
                ['title' => '短剧字节跳动端', 'url' => route('bytedance')],
                ['title' => '短剧快手端', 'url' => route('kuaishou')],
                ['title' => '短剧小程序后台管理', 'url' => route('back_manage')],
            ];
        } else if (in_array($key, ['mini_program_dev', 'wx_gzh_h5_dev', 'website_app_dev'])) {
            $sidebar = [
                ['title' => '小程序开发', 'url' => route('mini_program_dev')],
                ['title' => '公众号H5开发', 'url' => route('wx_gzh_h5_dev')],
                ['title' => '网站APP开发', 'url' => route('website_app_dev')],
            ];
        } else if (in_array($key, ['company_intro', 'contact_us', 'playlet_system'])) {
            $sidebar = [
                ['title' => '公司简介', 'url' => route('company_intro')],
                ['title' => '联系我们', 'url' => route('contact_us')],
                ['title' => '短剧系统', 'url' => route('playlet_system')],
                ['title' => '软件著作权', 'url' => route('soft_copyright')],
                ['title' => '授权许可协议书', 'url' => route('auth_license')],
            ];
        } else {
            $sidebar = [
                ['title' => '短剧小程序端', 'url' => route('wx_mini_program')],
                ['title' => '短剧字节跳动端', 'url' => route('bytedance')],
                ['title' => '短剧小程序后台管理', 'url' => route('back_manage')],
                ['title' => '小程序开发', 'url' => route('mini_program_dev')],
                ['title' => '公众号H5开发', 'url' => route('wx_gzh_h5_dev')],
                ['title' => '网站APP开发', 'url' => route('website_app_dev')],
                ['title' => '公司简介', 'url' => route('company_intro')],
                ['title' => '联系我们', 'url' => route('contact_us')],
                ['title' => '短剧系统', 'url' => route('playlet_system')],
                ['title' => '软件著作权', 'url' => route('soft_copyright')],
                ['title' => '授权许可协议书', 'url' => route('auth_license')],
            ];
        }

        return $sidebar;
    }

    /**
     * 短剧字节跳动端
     */
    public function bytedance()
    {
        $sidebar = $this->getSidebar('bytedance');
        $article = Article::getArticleByCode('bytedance');
        $title = '短剧字节跳动端';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 短剧快手端
     */
    public function kuaishou()
    {
        $sidebar = $this->getSidebar('kuaishou');
        $article = Article::getArticleByCode('kuaishou');
        $title = '短剧快手端';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 短剧小程序端
     */
    public function wxMiniProgram()
    {
        $sidebar = $this->getSidebar('wx_mini_program');
        $article = Article::getArticleByCode('wx_mini_program');
        $title = '短剧小程序端';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 短剧小程序后台管理
     */
    public function backManage()
    {
        $sidebar = $this->getSidebar('back_manage');
        $article = Article::getArticleByCode('back_manage');
        $title = '短剧小程序后台管理';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 小程序开发
     */
    public function miniProgramDev()
    {
        $sidebar = $this->getSidebar('mini_program_dev');
        $article = Article::getArticleByCode('mini_program_dev');
        $title = '小程序开发';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 公众号H5开发
     */
    public function wxGzhH5Dev()
    {
        $sidebar = $this->getSidebar('wx_gzh_h5_dev');
        $article = Article::getArticleByCode('wx_gzh_h5_dev');
        $title = '公众号H5开发';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 网站APP开发
     */
    public function websiteAppDev()
    {
        $sidebar = $this->getSidebar('website_app_dev');
        $article = Article::getArticleByCode('website_app_dev');
        $title = '网站APP开发';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 公司简介
     */
    public function companyIntro()
    {
        $sidebar = $this->getSidebar('company_intro');
        $article = Article::getArticleByCode('company_intro');
        $title = '公司简介';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 行业新闻
     */
    public function industryNews()
    {
        $cate_id = ArticleCategory::getArticleCategoryIdByCode('industry_news');
        $list = Article::getListByCateId($cate_id);
        $title = '行业新闻';

        return view('index.list', compact('list', 'title'));
    }

    /**
     * 版本更新
     */
    public function versionUpdate()
    {
        $cate_id = ArticleCategory::getArticleCategoryIdByCode('version_update');
        $list = Article::getListByCateId($cate_id);
        $title = '版本更新';

        return view('index.list', compact('list', 'title'));
    }

    /**
     * 联系我们
     */
    public function contactUs()
    {
        $sidebar = $this->getSidebar('contact_us');
        $article = Article::getArticleByCode('contact_us');
        $title = '联系我们';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 短剧系统
     */
    public function playletSystem()
    {
        $sidebar = $this->getSidebar('playlet_system');
        $article = Article::getArticleByCode('playlet_system');
        $title = '短剧系统';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 客户案例
     */
    public function customerCase()
    {
        $cate_id = ArticleCategory::getArticleCategoryIdByCode('customer_case');
        $list = Article::getListByCateId($cate_id);
        $title = '客户案例';

        return view('index.list', compact('list', 'title'));
    }

    /**
     * 问答中心
     */
    public function questionAnswers()
    {
        $cate_id = ArticleCategory::getArticleCategoryIdByCode('question_answers');
        $list = Article::getListByCateId($cate_id);
        $title = '问答中心';

        return view('index.list', compact('list', 'title'));
    }

    /**
     * 软件著作权
     */
    public function softCopyright()
    {
        $sidebar = $this->getSidebar('soft_copyright');
        $article = Article::getArticleByCode('soft_copyright');
        $title = '软件著作权';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 授权许可协议书
     */
    public function authLicense()
    {
        $sidebar = $this->getSidebar('auth_license');
        $article = Article::getArticleByCode('auth_license');
        $title = '授权许可协议书';

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 详情
     */
    public function detail(Request $request, Article $article)
    {
        $sidebar = $this->getSidebar('detail');
        $title = '详情 - ' . $article['title'];

        return view('index.show', compact('article', 'sidebar', 'title'));
    }

    /**
     * 搜索
     */
    public function search(Request $request)
    {
        $params = $request->all();

        $list = Article::getListByCateId(0, [
            ['title', 'like', "%{$params['keyword']}%"]
        ]);
        $title = '搜索';

        return view('index.list', compact('list', 'title'));
    }
}
