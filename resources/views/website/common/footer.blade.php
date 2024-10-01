<footer class="main-footer" style="background-image: url({{ frontAsset('images/background/footer-bg.png') }});">
    <div class="container">
        <div class="footer-top">
            <div class="widget-section">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="logo-widget footer-widget">
                            <figure class="footer-logo"><a href="/"><img src="{{ cfg('website', 'front_footer_logo') ?: config('web.default_footer_logo') }}"
                                                                                  alt=""></a></figure>
                            <div class="widget-content">
                                <div class="text">{{ cfg('website', 'front_address') ?: config('web.default_address') }}</div>
                                <ul class="footer-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget">
                            <h4 class="widget-title">公司简介</h4>
                            <div class="widget-content">
                                <ul>
                                    <li><a href="{{ route('contact_us') }}">联系我们</a></li>
                                    <li><a href="{{ route('soft_copyright') }}">软件著作权</a></li>
                                    <li><a href="{{ route('auth_license') }}">授权许可协议书</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget">
                            <h4 class="widget-title">行业方案</h4>
                            <div class="widget-content">
                                <ul>
                                    <li><a href="{{ route('wx_mini_program') }}">短剧小程序--微信端</a></li>
                                    <li><a href="{{ route('kuaishou') }}">短剧小程序--快手端</a></li>
                                    <li><a href="{{ route('bytedance') }}">短剧小程序--字节跳动端</a></li>
                                    <li><a href="{{ route('back_manage') }}">短剧小程序后台管理</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget">
                            <h4 class="widget-title">联系我们</h4>
                            <div class="widget-content">
                                <ul>
                                    <li><a href="#">15907146375</a></li>
                                    <li><a href="#">15623080865</a></li>
                                    <li><a href="#">fxlx@xfenglang.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom clearfix">
            <!--
            <ul class="footer-nav pull-left">
                <li><a href="#">Terms and Conditions</a></li>
                <li><a href="#">Privacy & Policy</a></li>
                <li><a href="#">Legal</a></li>
                <li><a href="#">Notice</a></li>
            </ul>-->
            <div class="copyright pull-right">
                {{ cfg('website', 'front_footer') ?: config('web.default_footer') }}
                <a href="#">{{ cfg('website', 'beian') ?: config('web.default_beian') }}</a>
            </div>
        </div>
    </div>
</footer>
