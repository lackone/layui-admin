@extends('layouts.main')

@section('content')
    <!-- works-section -->
    <section class="works-section centred">
        <div class="container">
            <div class="sec-title">
                <h1>功能特点</h1>
                <!--<p></p>-->
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="work-content-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-chart"></i></div>
                            <h4><a href="#">短剧追剧小程序</a></h4>
                            <div class="text">
                                用户通过签到、邀请好友、充值和做任务等获取金豆，金豆用于解锁短剧。也可以开通年费会员，解锁所有短剧。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="work-content-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-graph"></i></div>
                            <h4><a href="#">代理分销模块</a></h4>
                            <div class="text">
                                小程序拥有分销模式，可以让代理帮助推广小程序，代理获取相应比例的抽成。不同代理可设置不同返佣比例
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="work-content-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-writing"></i></div>
                            <h4><a href="#">小程序矩阵</a></h4>
                            <div class="text">
                                购买一套系统即可免费对接多个微信小程序，不同的小程序可展示不同的内容和对接不同的客服。支持矩阵运营，轻松获取更大流量
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- works-section end -->


    <!-- overview-section -->
    <section class="overview-section bg-color-1 sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box clearfix">
                        <figure class="image image-1"><img src="{{ frontAsset('images/resource/dashbord-1.jpg') }}" alt=""></figure>
                        <figure class="image image-2"><img src="{{ frontAsset('images/resource/dashbord-2.jpg') }}" alt=""></figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title"><h2>做短剧系统，为什么选择网络科技？</h2></div>
                        <div class="text">
                            <p>①短剧系统功能丰富，且一套系统支持绑定多个微信小程序<br/>
                                ②每个小程序的数据分开展示<br/>
                                ③支持无限多个代理商分销<br/>
                                ④支持国内多个主流广告平台的数据回传对接<br/>
                                ⑤拥有丰富的短剧相关资源和经验，从系统搭建到运营管理，我们可提供全流程的专业指导和服务<br/>
                                ⑥成功客户案例众多，小艺剧院，小艺视频等都是我们的签约客户
                            </p>
                        </div>
                        <div class="btn-box"><a href="#" class="theme-btn">开始使用</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- overview-section end -->


    <!-- overview-style-two -->
    <section class="overview-style-two sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title"><h2>网络科技为您搭建网络微短剧平台</h2></div>
                        <div class="text">
                            <p>
                                短剧作为当下热门行业之一，网络科技技术团队精心研发的禾店短剧平台，包括微信端、快手端、字节跳动端并打通巨量引擎广告系统，代理商拥有专属后台管理权限，所有端均可在PC管理后台统一管理，便捷且高效。</p>
                        </div>
                        <div class="btn-box"><a href="#" class="theme-btn">开始使用</a></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box clearfix">
                        <figure class="image image-1"><img src="{{ frontAsset('images/resource/dashbord-3.jpg') }}" alt=""></figure>
                        <figure class="image image-2"><img src="{{ frontAsset('images/resource/dashbord-4.jpg') }}" alt=""></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- overview-style-two end -->


    <!-- video-section -->
    <!--
    <section class="video-section sec-pad centred" style="background-image: url(images/background/video-bg-5.jpg);">
        <div class="container">
            <div class="sec-title">
                <h2>Introduce with Awesome Features</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has<br />been the industry's standard dummy text ever since</p>
            </div>
            <div class="inner-box">
                <div class="video-inner">
                    <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption=""><i class="flaticon-music-player-play"></i></a>
                </div>
                <div class="btn-box"><a href="#" class="theme-btn">Learn More</a></div>
            </div>
        </div>
    </section>-->
    <!-- video-section end -->


    <!-- pricing-section -->
    <section class="pricing-section sec-pad centred">
        <div class="container">
            <div class="sec-title">
                <h2>价格方案</h2>
                <!--<p></p>-->
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                    <div class="pricing-block-one">
                        <div class="pricing-table">
                            <div class="table-header">
                                <h1 class="price" style="color:">¥30000</h1>
                                <div class="text">短剧系统(仅授权非源码版)</div>
                            </div>
                            <div class="table-content">
                                <ul>
                                    <li>微信小程序端</li>
                                    <li>支持免费+付费看剧</li>
                                    <li>邀请新用户奖励金豆</li>
                                    <li>可部署1个微信小程序</li>
                                    <li>PC端管理后台</li>
                                    <li>支持代理商模式</li>
                                    <li>接入巨量广告和快手广告</li>
                                    <li>卡密兑换</li>
                                    <li>更多功能...</li>
                                    <li>该版本不提供源代码</li>
                                </ul>
                            </div>
                            <div class="table-footer">
                                <a href="#" class="choose-btn">购买咨询</a>
                                <a href="#" class="trial-btn">无隐藏费用！</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                    <div class="pricing-block-one">
                        <div class="pricing-table">
                            <div class="table-header">
                                <h1 class="price">¥39999</h1>
                                <div class="text">短剧系统(源码版)</div>
                            </div>
                            <div class="table-content">
                                <ul>
                                    <li>包含旗舰版全部功能</li>
                                    <li>微信小程序端</li>
                                    <li>可部署无限个微信小程序</li>
                                    <li>PC端管理后台</li>
                                    <li>支持机构账号</li>
                                    <li>支持代理商模式</li>
                                    <li>接入巨量广告和快手广告</li>
                                    <li>卡密兑换</li>
                                    <li>该版本提供源代码</li>
                                    <li>可二次开发</li>
                                </ul>
                            </div>
                            <div class="table-footer">
                                <a href="#" class="choose-btn">购买咨询</a>
                                <a href="#" class="trial-btn">无隐藏费用！</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                    <div class="pricing-block-one">
                        <div class="pricing-table">
                            <div class="table-header">
                                <h1 class="price">¥35000</h1>
                                <div class="text">小说系统(源码版)</div>
                            </div>
                            <div class="table-content">
                                <ul>
                                    <li>微信小程序端</li>
                                    <li>支持免费+付费看小说</li>
                                    <li>支持充值订单回传</li>
                                    <li>可部署1个微信小程序</li>
                                    <li>PC端管理后台</li>
                                    <li>支持代理商模式</li>
                                    <li>接入巨量广告和广点通广告</li>
                                    <li>卡密兑换</li>
                                    <li>更多功能...</li>
                                    <li>该版提供源代码</li>
                                </ul>
                            </div>
                            <div class="table-footer">
                                <a href="#" class="choose-btn">购买咨询</a>
                                <a href="#" class="trial-btn">无隐藏费用！</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-section end -->


    <!-- fact-counter -->
    <section class="fact-counter bg-color-1 sec-pad centred">
        <div class="container">
            <div class="sec-title">
                <h2>Success in Numbers</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has<br/>been
                    the
                    industry's standard dummy text ever since</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one">
                        <div class="icon-box"><i class="flaticon-avatar"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="170">0</span><span>k</span>
                        </div>
                        <div class="text">Total Users</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one">
                        <div class="icon-box"><i class="flaticon-user"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="40">0</span><span>k</span>
                        </div>
                        <div class="text">Regular Users</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one">
                        <div class="icon-box"><i class="flaticon-rating"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="4.9">0</span>
                        </div>
                        <div class="text">User Rating</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one">
                        <div class="icon-box"><i class="flaticon-customer-reviews"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="10">0</span><span>k</span>
                        </div>
                        <div class="text">Positive Feedback</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- fact-counter end -->


    <!-- download-section -->
    <section class="download-section bg-color-3 sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>Ready to Use? Download Now</h2>
                        </div>
                        <div class="inner-box">
                            <div class="single-item">
                                <div class="number">1</div>
                                <h4><a href="#">Signup Your Account in App</a></h4>
                                <div class="text">Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem
                                    has been the standard dummy text.
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="number">2</div>
                                <h4><a href="#">Input Your Personal Data</a></h4>
                                <div class="text">Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem
                                    has been the standard dummy text.
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="number">3</div>
                                <h4><a href="#">Get Daily Report and Update</a></h4>
                                <div class="text">Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem
                                    has been the standard dummy text.
                                </div>
                            </div>
                            <div class="download-btn">
                                <a href="#"><i class="flaticon-apple"></i>App Store</a>
                                <a href="#"><i class="flaticon-android-logo"></i>Play Store</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                    <figure class="image-box float-bob-y"><img src="{{ frontAsset('images/resource/phone-3.png') }}" alt=""></figure>
                </div>
            </div>
        </div>
    </section>
    <!-- download-section end -->


    <!-- testimonial-section -->
    <section class="testimonial-section sec-pad">
        <div class="container">
            <div class="sec-title centred">
                <h2>What User Say About Us</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has<br/>been
                    the
                    industry's standard dummy text ever since</p>
            </div>
            <div class="testimonial-inner">
                <div class="three-column-carousel-2 owl-carousel owl-theme">
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="content-box">
                                <div class="icon-box"><i class="flaticon-left-quotes-sign"></i></div>
                                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elitsed eiusmod
                                    tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb">
                                    <img src="{{ frontAsset('images/resource/testimonial-1.png') }}" alt="">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </figure>
                                <h5 class="author-name">Tarisha Jahan</h5>
                                <span class="designation">UI/UX Designner</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="content-box">
                                <div class="icon-box"><i class="flaticon-left-quotes-sign"></i></div>
                                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elitsed eiusmod
                                    tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb">
                                    <img src="{{ frontAsset('images/resource/testimonial-2.png') }}" alt="">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </figure>
                                <h5 class="author-name">Rakib AL Mahmud</h5>
                                <span class="designation">UI/UX Designner</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="content-box">
                                <div class="icon-box"><i class="flaticon-left-quotes-sign"></i></div>
                                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elitsed eiusmod
                                    tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>
                            </div>
                            <div class="author-info">
                                <figure class="author-thumb">
                                    <img src="{{ frontAsset('images/resource/testimonial-3.png') }}" alt="">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </figure>
                                <h5 class="author-name">Eusra Ahmed Rima</h5>
                                <span class="designation">UI/UX Designner</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->


    <!-- news-section -->
    <section class="news-section bg-color-1 sec-pad">
        <div class="container">
            <div class="sec-title centred">
                <h2>Latest News Updates</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has<br/>been
                    the
                    industry's standard dummy text ever since</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="blog-details.html"><img src="{{ frontAsset('images/resource/news-1.jpg') }}"
                                                                                       alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="blog-details.html">How App Is Going To Change Your Business Strategies</a>
                                </h4>
                                <div class="post-date"><i class="flaticon-calendar"></i>25 January, 2019</div>
                                <div class="link-btn"><a href="blog-details.html">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="blog-details.html"><img src="{{ frontAsset('images/resource/news-2.jpg') }}"
                                                                                       alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="blog-details.html">Things That Make You Love And Hate Software</a></h4>
                                <div class="post-date"><i class="flaticon-calendar"></i>24 January, 2019</div>
                                <div class="link-btn"><a href="blog-details.html">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="blog-details.html"><img src="{{ frontAsset('images/resource/news-3.jpg') }}"
                                                                                       alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="blog-details.html">You Won’t Believe These Bizarre Truth Of
                                        Applications</a>
                                </h4>
                                <div class="post-date"><i class="flaticon-calendar"></i>23 January, 2019</div>
                                <div class="link-btn"><a href="blog-details.html">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- news-section end -->


    <!-- call-to-action -->
    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                    <figure class="image-box paroller clearfix" data-paroller-factor="-0.15"
                            data-paroller-factor-lg="-0.15"
                            data-paroller-factor-md="-0.15" data-paroller-factor-sm="-0.15"
                            data-paroller-type="foreground"
                            data-paroller-direction="horizontal"><img src="{{ frontAsset('images/resource/imac-1.png') }}" alt=""></figure>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>Get in Touch</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod on tempor
                                incididunt ut
                                labore et dolore magna aliqua.</p>
                        </div>
                        <div class="subscribe-form">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" required="">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" required="">
                                </div>
                                <div class="form-group">
                                    <label>Your Message</label>
                                    <textarea name="message"></textarea>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="create-acc">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox" checked="checked">
                                                <span>Also subscribe our newsletter</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="message-btn">
                                        <button type="submit" class="theme-btn">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- call-to-action end -->
@endsection
