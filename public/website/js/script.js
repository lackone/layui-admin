(function ($) {

    "use strict";
    //����ģ������ʣ�https://www.bootstrapmb.com
    //Hide Loading Box (Preloader)
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }

    //Update Header Style and Scroll to Top
    function headerStyle() {
        if ($('.main-header').length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $('.main-header');
            var scrollLink = $('.scroll-top');
            if (windowpos >= 110) {
                siteHeader.addClass('fixed-header');
                scrollLink.addClass('open');
            } else {
                siteHeader.removeClass('fixed-header');
                scrollLink.removeClass('open');
            }
        }
    }

    headerStyle();

    // dropdown menu
    var mobileWidth = 992;
    var navcollapse = $('.navigation li.dropdown');

    $(window).on('resize', function () {
        navcollapse.children('ul').hide();
    });

    navcollapse.hover(function () {
        if ($(window).innerWidth() >= mobileWidth) {
            $(this).children('ul').stop(true, false, true).slideToggle(300);
        }
    });

    //Submenu Dropdown Toggle
    if ($('.main-header .navigation li.dropdown ul').length) {
        $('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');

        //Dropdown Button
        $('.main-header .navigation li.dropdown .dropdown-btn').on('click', function () {
            $(this).prev('ul').slideToggle(500);
        });

        //Disable dropdown parent link
        $('.navigation li.dropdown > a').on('click', function (e) {
            e.preventDefault();
        });
    }

    // Scroll to a Specific Div
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function () {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }

    // Elements Animation
    if ($('.wow').length) {
        var wow = new WOW({
            mobile: false
        });
        wow.init();
    }

    //Contact Form Validation
    if ($('#contact-form').length) {
        $('#contact-form').validate({
            rules: {
                username: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            }
        });
    }

    //Fact Counter + Text Count
    if ($('.count-box').length) {
        $('.count-box').appear(function () {

            var $t = $(this),
                n = $t.find(".count-text").attr("data-stop"),
                r = parseInt($t.find(".count-text").attr("data-speed"), 10);

            if (!$t.hasClass("counted")) {
                $t.addClass("counted");
                $({
                    countNum: $t.find(".count-text").text()
                }).animate({
                    countNum: n
                }, {
                    duration: r,
                    easing: "linear",
                    step: function () {
                        $t.find(".count-text").text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $t.find(".count-text").text(this.countNum);
                    }
                });
            }

        }, {accY: 0});
    }


    //LightBox / Fancybox
    if ($('.lightbox-image').length) {
        $('.lightbox-image').fancybox({
            openEffect: 'fade',
            closeEffect: 'fade',
            helpers: {
                media: {}
            }
        });
    }


    //Accordion Box
    if ($('.accordion-box').length) {
        $(".accordion-box").on('click', '.acc-btn', function () {

            var outerBox = $(this).parents('.accordion-box');
            var target = $(this).parents('.accordion');

            if ($(this).hasClass('active') !== true) {
                $(outerBox).find('.accordion .acc-btn').removeClass('active');
            }

            if ($(this).next('.acc-content').is(':visible')) {
                return false;
            } else {
                $(this).addClass('active');
                $(outerBox).children('.accordion').removeClass('active-block');
                $(outerBox).find('.accordion').children('.acc-content').slideUp(300);
                target.addClass('active-block');
                $(this).next('.acc-content').slideDown(300);
            }
        });
    }


    //Tabs Box
    if ($('.tabs-box').length) {
        $('.tabs-box .tab-buttons .tab-btn').on('click', function (e) {
            e.preventDefault();
            var target = $($(this).attr('data-tab'));

            if ($(target).is(':visible')) {
                return false;
            } else {
                target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                $(this).addClass('active-btn');
                target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
                $(target).fadeIn(300);
                $(target).addClass('active-tab');
            }
        });
    }


    if ($('.paroller').length) {
        $('.paroller').paroller({
            factor: 0.05,            // multiplier for scrolling speed and offset, +- values for direction control
            factorLg: 0.05,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control
            type: 'foreground',     // background, foreground
            direction: 'horizontal' // vertical, horizontal
        });
    }


    //three-column-carousel
    if ($('.three-column-carousel').length) {
        $('.three-column-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 3000,
            autoplay: 4000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                }
            }
        });
    }


    //three-column-carousel
    if ($('.three-column-carousel-2').length) {
        $('.three-column-carousel-2').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            smartSpeed: 3000,
            autoplay: 4000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                }
            }
        });
    }


    //Testimonial Carousel
    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'zoomIn',
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 10000,
            autoHeight: true,
            autoplay: true,
            autoplayTimeout: 10000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
    }


    //Main Slider Carousel
    if ($('.main-slider-carousel').length) {
        $('.main-slider-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            active: true,
            smartSpeed: 1000,
            autoplay: 6000,
            navText: ['<span class="flaticon-back-1"></span>', '<span class="flaticon-right-arrow-angle"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });
    }


    //three-column-carousel
    if ($('.screenshort-carousel').length) {
        $('.screenshort-carousel').owlCarousel({
            loop: true,
            margin: 50,
            nav: true,
            smartSpeed: 3000,
            autoplay: 4000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                }
            }
        });
    }

    //Screenshot carousel
    if ($('.appscreenshot-carousel').length) {
        $('.appscreenshot-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            smartSpeed: 700,
            autoplay: 5000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 3
                },
                992: {
                    items: 4,
                    center: true
                },
                1200: {
                    items: 5,
                    center: true
                },
            }
        });
    }


    // clients-carousel
    if ($('.clients-carousel').length) {
        $('.clients-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            smartSpeed: 3000,
            autoplay: true,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                600: {
                    items: 3
                },
                800: {
                    items: 4
                },
                1200: {
                    items: 6
                }

            }
        });
    }


    // Testimonial Carousel
    if ($('.testimonial-carousel-2').length) {
        $('.testimonial-carousel-2').owlCarousel({
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 1,
            loop: true,
            margin: 0,
            nav: true,
            smartSpeed: 300,
            autoplay: 3000,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>']
        });
    }


    // single-item-carousel
    if ($('.single-item-carousel').length) {
        $('.single-item-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            smartSpeed: 3000,
            autoplay: true,
            navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 1
                },
                1200: {
                    items: 1
                }

            }
        });
    }


    //Side Content Toggle
    if ($('.error-page-section .nav-btn').length) {
        //Show Form
        $('.error-page-section .nav-btn').on('click', function (e) {
            e.preventDefault();
            $('body').addClass('side-content-visible');
        });
        //Hide Form
        $('.hidden-bar .inner-box .cross-icon,.form-back-drop,.close-menu').on('click', function (e) {
            e.preventDefault();
            $('body').removeClass('side-content-visible');
        });
        //Dropdown Menu
        $('.fullscreen-menu .navigation li.dropdown > a').on('click', function () {
            $(this).next('ul').slideToggle(500);
        });
    }

    //Side Content Toggle
    if ($('.coming-soon-section .nav-btn').length) {
        //Show Form
        $('.coming-soon-section .nav-btn').on('click', function (e) {
            e.preventDefault();
            $('body').addClass('side-content-visible');
        });
        //Hide Form
        $('.hidden-bar .inner-box .cross-icon,.form-back-drop,.close-menu').on('click', function (e) {
            e.preventDefault();
            $('body').removeClass('side-content-visible');
        });
        //Dropdown Menu
        $('.fullscreen-menu .navigation li.dropdown > a').on('click', function () {
            $(this).next('ul').slideToggle(500);
        });
    }

    //Hidden Sidebar
    if ($('.hidden-bar').length) {
        $('.hidden-bar').mCustomScrollbar({
            theme: "dark"
        });
    }


    //Hidden Bar Menu Config
    function hiddenBarMenuConfig() {
        var menuWrap = $('.hidden-bar .side-menu');
        // appending expander button
        menuWrap.find('.dropdown').children('a').append(function () {
            return '<button type="button" class="btn expander"><i class="fa fa-angle-down"></i></button>';
        });
        // hidding submenu
        menuWrap.find('.dropdown').children('ul').hide();
        // toggling child ul
        menuWrap.find('.btn.expander').each(function () {
            $(this).on('click', function () {
                $(this).parent() // return parent of .btn.expander (a)
                    .parent() // return parent of a (li)
                    .children('ul').slideToggle();

                // adding class to expander container
                $(this).parent().toggleClass('current');
                // toggling arrow of expander
                $(this).find('i').toggleClass('');

                return false;

            });
        });
    }


    if ($('.timer').length) {
        $(function () {
            $('[data-countdown]').each(function () {
                var $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    $this.html(event.strftime('%D days %H:%M:%S'));
                });
            });
        });

        $('.cs-countdown').countdown('').on('update.countdown', function (event) {
            var $this = $(this).html(event.strftime('<div class="count-col"><h6>days</h6><span>%D</span></div> <div class="count-col"><h6>Hours</h6><span>%H</span></div> <div class="count-col"><h6>Minutes</h6><span>%M</span></div> <div class="count-col"><h6>Seconds</h6><span>%S</span></div>'));
        });
    }


    //Sortable Masonary with Filters
    function enableMasonry() {
        if ($('.sortable-masonry').length) {

            var winDow = $(window);
            // Needed variables
            var $container = $('.sortable-masonry .items-container');
            var $filter = $('.filter-btns');

            $container.isotope({
                filter: '*',
                masonry: {
                    columnWidth: '.masonry-item.small-column'
                },
                animationOptions: {
                    duration: 500,
                    easing: 'linear'
                }
            });


            // Isotope Filter
            $filter.find('li').on('click', function () {
                var selector = $(this).attr('data-filter');

                try {
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 500,
                            easing: 'linear',
                            queue: false
                        }
                    });
                } catch (err) {

                }
                return false;
            });


            winDow.on('resize', function () {
                var selector = $filter.find('li.active').attr('data-filter');

                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear',
                        queue: false
                    }
                });
            });


            var filterItemA = $('.filter-btns li');

            filterItemA.on('click', function () {
                var $this = $(this);
                if (!$this.hasClass('active')) {
                    filterItemA.removeClass('active');
                    $this.addClass('active');
                }
            });
        }
    }

    enableMasonry();


    /*	=========================================================================
    When document is Scrollig, do
    ========================================================================== */

    jQuery(document).on('ready', function () {
        (function ($) {
            // add your functions
            hiddenBarMenuConfig();
        })(jQuery);
    });


    /* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

    $(window).on('scroll', function () {
        headerStyle();
    });


    /* ==========================================================================
   When document is loaded, do
   ========================================================================== */

    $(window).on('load', function () {
        handlePreloader();
        enableMasonry();
    });


})(window.jQuery);
