<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('web.route.prefix'),
    'as' => config('web.route.name'),
    'namespace' => config('web.route.namespace'),
    'middleware' => ['web', 'FrontTemplate'],
], function () {

    Route::any('/', 'IndexController@index')->name('index');

    //�̾��ֽ�������
    Route::any('/bytedance', 'IndexController@bytedance')->name('bytedance');

    //�̾���ֶ�
    Route::any('/kuaishou', 'IndexController@kuaishou')->name('kuaishou');

    //�̾�С�����
    Route::any('/wx_mini_program', 'IndexController@wxMiniProgram')->name('wx_mini_program');

    //�̾�С�����̨����
    Route::any('/back_manage', 'IndexController@backManage')->name('back_manage');

    //С���򿪷�
    Route::any('/mini_program_dev', 'IndexController@miniProgramDev')->name('mini_program_dev');

    //���ں�H5����
    Route::any('/wx_gzh_h5_dev', 'IndexController@wxGzhH5Dev')->name('wx_gzh_h5_dev');

    //��վAPP����
    Route::any('/website_app_dev', 'IndexController@websiteAppDev')->name('website_app_dev');

    //��˾���
    Route::any('/company_intro', 'IndexController@companyIntro')->name('company_intro');

    //��ҵ����
    Route::any('/industry_news', 'IndexController@industryNews')->name('industry_news');

    //�汾����
    Route::any('/version_update', 'IndexController@versionUpdate')->name('version_update');

    //��ϵ����
    Route::any('/contact_us', 'IndexController@contactUs')->name('contact_us');

    //�̾�ϵͳ
    Route::any('/playlet_system', 'IndexController@playletSystem')->name('playlet_system');

    //�ͻ�����
    Route::any('/customer_case', 'IndexController@customerCase')->name('customer_case');

    //�ʴ�����
    Route::any('/question_answers', 'IndexController@questionAnswers')->name('question_answers');

    //�������Ȩ
    Route::any('/soft_copyright', 'IndexController@softCopyright')->name('soft_copyright');

    //��Ȩ���Э����
    Route::any('/auth_license', 'IndexController@authLicense')->name('auth_license');

    //����
    Route::any('/search', 'IndexController@search')->name('search');

    //����
    Route::any('/detail/{article}', 'IndexController@detail')->name('detail');
});


