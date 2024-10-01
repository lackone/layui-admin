<header class="main-header">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box">
                    <figure class="logo"><a href="/"><img
                                src="{{ cfg('website', 'front_ico') ?: config('web.default_logo') }}" alt=""></a>
                    </figure>
                </div>
                <div class="nav-outer clearfix">
                    <div class="menu-area">
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="current "><a href="/">首页</a></li>
                                    <li class="dropdown"><a href="#">短剧</a>
                                        <ul>
                                            <li><a href="{{ route('wx_mini_program') }}">短剧小程序端</a></li>
                                            <li><a href="{{ route('bytedance') }}">短剧字节跳动端</a></li>
                                            <li><a href="{{ route('back_manage') }}">短剧小程序后台管理</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">软件开发</a>
                                        <ul>
                                            <li><a href="{{ route('mini_program_dev') }}">小程序开发</a></li>
                                            <li><a href="{{ route('wx_gzh_h5_dev') }}">公众号H5开发</a></li>
                                            <li><a href="{{ route('website_app_dev') }}">网站APP开发</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">新闻资讯</a>
                                        <ul>
                                            <li><a href="{{ route('company_intro') }}">公司简介</a></li>
                                            <li><a href="{{ route('industry_news') }}">行业新闻</a></li>
                                            <li><a href="{{ route('version_update') }}">版本更新</a></li>
                                            <li><a href="{{ route('contact_us') }}">联系我们</a></li>
                                            <li><a href="{{ route('playlet_system') }}">短剧系统</a></li>
                                            <li><a href="{{ route('customer_case') }}">客户案例</a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a href="{{ route('question_answers') }}">问答中心</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="outer-box">
                        <div class="btn-box"><a href="{{ route('search') }}">搜索</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="/"><img src="{{ cfg('website', 'front_ico') ?: config('web.default_logo') }}" alt=""></a></figure>
            <div class="menu-area">
                <nav class="main-menu navbar-expand-lg">
                    <div class="navbar-header">
                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix">
                        <ul class="navigation clearfix">
                            <li class="current "><a href="/">首页</a></li>
                            <li class="dropdown"><a href="#">短剧</a>
                                <ul>
                                    <li><a href="{{ route('wx_mini_program') }}">短剧小程序端</a></li>
                                    <li><a href="{{ route('bytedance') }}">短剧字节跳动端</a></li>
                                    <li><a href="{{ route('back_manage') }}">短剧小程序后台管理</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">软件开发</a>
                                <ul>
                                    <li><a href="{{ route('mini_program_dev') }}">小程序开发</a></li>
                                    <li><a href="{{ route('wx_gzh_h5_dev') }}">公众号H5开发</a></li>
                                    <li><a href="{{ route('website_app_dev') }}">网站APP开发</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">新闻资讯</a>
                                <ul>
                                    <li><a href="{{ route('company_intro') }}">公司简介</a></li>
                                    <li><a href="{{ route('industry_news') }}">行业新闻</a></li>
                                    <li><a href="{{ route('version_update') }}">版本更新</a></li>
                                    <li><a href="{{ route('contact_us') }}">联系我们</a></li>
                                    <li><a href="{{ route('playlet_system') }}">短剧系统</a></li>
                                    <li><a href="{{ route('customer_case') }}">客户案例</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="{{ route('question_answers') }}">问答中心</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div><!-- sticky-header end -->
</header>
