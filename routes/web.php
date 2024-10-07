<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('web.route.prefix'),
    'as' => config('web.route.name'),
    'namespace' => config('web.route.namespace'),
    'middleware' => ['web', 'FrontTemplate'],
], function () {

    Route::any('/', 'IndexController@index')->name('index');

    //短剧字节跳动端
    Route::any('/bytedance', 'IndexController@bytedance')->name('bytedance');

    //短剧快手端
    Route::any('/kuaishou', 'IndexController@kuaishou')->name('kuaishou');

    //短剧小程序端
    Route::any('/wx_mini_program', 'IndexController@wxMiniProgram')->name('wx_mini_program');

    //短剧小程序后台管理
    Route::any('/back_manage', 'IndexController@backManage')->name('back_manage');

    //小程序开发
    Route::any('/mini_program_dev', 'IndexController@miniProgramDev')->name('mini_program_dev');

    //公众号H5开发
    Route::any('/wx_gzh_h5_dev', 'IndexController@wxGzhH5Dev')->name('wx_gzh_h5_dev');

    //网站APP开发
    Route::any('/website_app_dev', 'IndexController@websiteAppDev')->name('website_app_dev');

    //公司简介
    Route::any('/company_intro', 'IndexController@companyIntro')->name('company_intro');

    //行业新闻
    Route::any('/industry_news', 'IndexController@industryNews')->name('industry_news');

    //版本更新
    Route::any('/version_update', 'IndexController@versionUpdate')->name('version_update');

    //联系我们
    Route::any('/contact_us', 'IndexController@contactUs')->name('contact_us');

    //短剧系统
    Route::any('/playlet_system', 'IndexController@playletSystem')->name('playlet_system');

    //客户案例
    Route::any('/customer_case', 'IndexController@customerCase')->name('customer_case');

    //问答中心
    Route::any('/question_answers', 'IndexController@questionAnswers')->name('question_answers');

    //软件著作权
    Route::any('/soft_copyright', 'IndexController@softCopyright')->name('soft_copyright');

    //授权许可协议书
    Route::any('/auth_license', 'IndexController@authLicense')->name('auth_license');

    //搜索
    Route::any('/search', 'IndexController@search')->name('search');

    //详情
    Route::any('/detail/{article}', 'IndexController@detail')->name('detail');
});
