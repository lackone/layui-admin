<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ cfg('website', 'front_keywords') }}">
    <meta name="description" content="{{ cfg('website', 'front_description') }}">
    <title>{{ cfg('website', 'front_title') ?: config('web.default_title') }}</title>
    <link rel="shortcut icon" type="image/x-icon"
          href="{{ cfg('website', 'front_ico') ?: config('web.default_icon') }}">
    <!-- Stylesheets -->
    @yield('css')
    <link href="{{ frontAsset('css/style.css') }}" rel="stylesheet">
    <link href="{{ frontAsset('css/responsive.css') }}" rel="stylesheet">
    @yield('mycss')
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


<!-- .preloader -->
<div class="preloader"></div>
<!-- /.preloader -->


<!-- Main Header -->
@include('common.header')
<!-- End Main Header -->


<!-- banner-section -->
<section class="blog-banner centred" style="background-image: url({{ frontAsset('images/background/banner-bg-16.png') }});">
    <div class="container">
        <div class="content-box">
            <h1>@yield('title')</h1>
            <div class="search-box">
                <form action="{{ route('search') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <input type="search" name="keyword" placeholder="Search..." required="">
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->


<!-- blog-classic -->
<section class="blog-details sidebar-page-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="inner-box">
                        <div class="title-inner">
                            @yield('content_title')
                        </div>
                        <div class="text">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="sidebar">
                    <div class="sidebar-categories sidebar-widget">
                        <h3 class="widget-title">分类</h3>
                        <div class="widget-content">
                            @yield('sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog-classic end -->


<!-- main-footer -->
@include('common.footer')
<!-- main-footer end -->


<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
    <span class="text">Top</span>
</button>


<!-- jequery plugins -->
@yield('js')
<script src="{{ frontAsset('js/jquery.js') }}"></script>
<script src="{{ frontAsset('js/popper.min.js') }}"></script>
<script src="{{ frontAsset('js/bootstrap.min.js') }}"></script>
<script src="{{ frontAsset('js/owl.js') }}"></script>
<script src="{{ frontAsset('js/wow.js') }}"></script>
<script src="{{ frontAsset('js/validation.js') }}"></script>
<script src="{{ frontAsset('js/jquery.fancybox.js') }}"></script>
<script src="{{ frontAsset('js/appear.js') }}"></script>
<script src="{{ frontAsset('js/jquery.paroller.min.js') }}"></script>

<!-- main-js -->
<script src="{{ frontAsset('js/script.js') }}"></script>

@yield('myjs')
</body><!-- End of .page_wrapper -->
</html>
