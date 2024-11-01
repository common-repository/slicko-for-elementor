(function ($) {

    "use strict";

    // progress bar script starts
    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
        var triggerClass = '.slicko-progress-bar-' + id;
        if ('function' === typeof ldBar) {
            if ('line' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('line-bubble' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
                $($('.slicko-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ('circle' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    'stroke-dir': 'normal',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('fan' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M10 90A40 40 0 0 1 90 90',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
        }
    }

    var SlickoProgressBar = function ($scope, $) {
        var progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
        if ($.isFunction($.fn.waypoint)) {
            progressBarWrapper.waypoint(function () {
                var element = $(this.element),
                    id = element.data('id'),
                    type = element.data('type'),
                    value = element.data('progress-bar-value'),
                    strokeWidth = element.data('progress-bar-stroke-width'),
                    strokeTrailWidth = element.data('progress-bar-stroke-trail-width'),
                    color = element.data('stroke-color'),
                    trailColor = element.data('stroke-trail-color');
                animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });
        }
    }
    // progress bar script ends


    // animated text script starts
    var SlickoAnimatedText = function ($scope, $) {

        var animatedWrapper = $scope.find('.slicko-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.slicko-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');

        if ('function' === typeof Typed) {
            if ('slicko-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }


        if ($.isFunction($.fn.Morphext)) {
            if ('slicko-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }
    // animated text script ends

    //Nav menu
    // Main Menu
    var navMenu = function ($scope, $) {
        $('.slicko-mega-menu').closest('.elementor-container').addClass('megamenu-full-container');
        var count = 0;
        $(".main-navigation ul.navbar-nav>li.slicko-mega-menu>.sub-menu>li").each(function (index) {
            count++;
            if ($(this).is('li:last-child')) {
                $(this).parent().addClass('mg-column-' + count);
                count = 0;
            }
        });
        $('.main-navigation ul.navbar-nav>li').each(function (i, v) {
            $(v).find('a').contents().wrap('<span class="menu-item-text"/>')
        });
        $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');

        function navMenu() {
            $('.navbar.mobile-menu-style-1').closest('body').addClass('mobile-menu-style-1');
            $('.navbar.mobile-menu-style-2').closest('body').addClass('mobile-menu-style-2');
            $('.navbar.mobile-menu-style-3').closest('body').addClass('mobile-menu-style-3');

            if (jQuery('.slicko-main-menu-wrap').hasClass('menu-style-inline')) {
                if (jQuery(window).width() < 1025) {
                    jQuery('.slicko-main-menu-wrap').addClass('menu-style-flyout');
                    jQuery('.slicko-main-menu-wrap').removeClass('menu-style-inline');
                } else {
                    jQuery('.slicko-main-menu-wrap').removeClass('menu-style-flyout');
                    jQuery('.slicko-main-menu-wrap').addClass('menu-style-inline');
                }
                $(window).resize(function () {
                    if (jQuery(window).width() < 1025) {
                        jQuery('.slicko-main-menu-wrap').addClass('menu-style-flyout');
                        jQuery('.slicko-main-menu-wrap').removeClass('menu-style-inline');
                    } else {
                        jQuery('.slicko-main-menu-wrap').removeClass('menu-style-flyout');
                        jQuery('.slicko-main-menu-wrap').addClass('menu-style-inline');
                    }
                })
            }
            // main menu toggleer icon (Mobile site only)
            $('[data-toggle="navbarToggler"]').on("click", function (e) {
                $('.navbar').toggleClass('active');
                $('.navbar-toggler-icon').toggleClass('active');
                $('body').toggleClass('offcanvas--open');

                e.stopPropagation();
                e.preventDefault();
            });
            $('.navbar-inner').on("click", function (e) {
                e.stopPropagation();
            });
            // Remove class when click on body
            $('body').on("click", function () {
                $('.navbar').removeClass('active');
                $('.navbar-toggler-icon').removeClass('active');
                $('body').removeClass('offcanvas--open');
            });
            $('.main-navigation ul.navbar-nav li.menu-item-has-children>a .dropdownToggle').on("click", function (e) {
                e.preventDefault();
                $(this).parent('a').siblings('.sub-menu').toggle();
                $(this).parent('a').parent('li').toggleClass('dropdown-active');
            })
        }
        navMenu();

    }


    var slicko_modal_popup = function ($scope, $) {

        $('.popup-menubar').on('click', function () {
            $('.slicko-addons-popup-content').addClass('show')
        })

        $('#offset-menu-close-btn').on('click', function () {
            $('.slicko-addons-popup-content').removeClass('show')
        });
    }

    /*---------------------------------------------------
    VIDEO BUTTON
    ----------------------------------------------------*/
    var slicko_video_button = function ($scope, $) {

        var modalWrapper = $scope.find('.slicko-modal').eq(0),
            modalOverlayWrapper = $scope.find('.slicko-modal-overlay'),
            modalItem = $scope.find('.slicko-modal-item'),
            modalAction = modalWrapper.find('.slicko-modal-image-action'),
            closeButton = modalWrapper.find('.slicko-close-btn');

        modalAction.on('click', function (e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('slicko-modal');

            var overlay = $(this).data('slicko-overlay');
            modalItem.css('display', 'block');
            setTimeout(function () {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function () {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function () {
            var overlay_click_close = $(this).data('slicko_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.slicko-modal-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    }


    //Creative Button
    var Slicko_Creative_Button = function ($scope) {

        var btn_wrap = $scope.find('.slicko-creative-btn-wrap');
        var magnetic = btn_wrap.data('magnetic');
        var btn = btn_wrap.find('a.slicko-creative-btn');
        if ('yes' == magnetic) {
            btn_wrap.on('mousemove', function (e) {
                var x = e.pageX - (btn_wrap.offset().left + (btn_wrap.outerWidth() / 2));
                var y = e.pageY - (btn_wrap.offset().top + (btn_wrap.outerHeight() / 2));
                btn.css("transform", "translate(" + x * 0.3 + "px, " + y * 0.5 + "px)");
            });
            btn_wrap.on('mouseout', function (e) {
                btn.css("transform", "translate(0px, 0px)");
            });
        }
        //For expandable button style only
        var expandable = $scope.find('.slicko-eft--expandable');
        var text = expandable.find('.text');
        if (expandable.length > 0 && text.length > 0) {
            text[0].addEventListener("transitionend", function () {
                if (text[0].style.width) {
                    text[0].style.width = "auto";
                }
            });
            expandable[0].addEventListener("mouseenter", function (e) {
                e.currentTarget.classList.add('hover');
                text[0].style.width = "auto";
                var predicted_answer = text[0].offsetWidth;
                text[0].style.width = "0";
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "".concat(predicted_answer, "px");

            });
            expandable[0].addEventListener("mouseleave", function (e) {
                e.currentTarget.classList.remove('hover');
                text[0].style.width = "".concat(text[0].offsetWidth, "px");
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "";
            });
        }
    };

    // accordion script starts
    var slickoAccordion = function ($scope, $) {
        var accordionTitle = $scope.find('.slicko-accordion-title');

        var accmin = $scope.find('.slicko-accordion-single-item');

        accmin.each(function () {
            if ($(this).hasClass('yes')) {
                $(this).addClass('wraper-active');
            }
        });

        accordionTitle.each(function () {
            if ($(this).hasClass('active-default')) {
                $(this).addClass('active');
                $(this).next('.slicko-accordion-content').slideDown(300);
            }
        });

        // Remove multiple click event for nested accordion
        accordionTitle.unbind('click');

        //$accordionWrapper.children('.slicko-accordion-content').first().show();
        accordionTitle.click(function (e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().slideUp(400);
                $(this).parent().removeClass('wraper-active');

            } else {
                $(this).parent().parent().find('.slicko-accordion-title').removeClass('active');

                accmin.removeClass('wraper-active');

                $(this).parent('.yes').removeClass('wraper-active');

                $(this).parent().parent().find('.slicko-accordion-content').slideUp(300);

                $(this).parent().addClass('wraper-active');

                $(this).toggleClass('active');
                $(this).next().slideToggle(400);

            }
        });
    }
    // accordion script ends


    // animated text script starts
    var slicko_AnimatedText = function ($scope, $) {
        var animatedWrapper = $scope.find('.slicko-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.slicko-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');
        if ('function' === typeof Typed) {
            if ('slicko-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }
        if ($.isFunction($.fn.Morphext)) {
            if ('slicko-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }

    /* Search widget js */

    var Slicko_Search_bos = function () {
        $('#search_icon').click(function () {
            $('.slicko-search-button-wrapper').show("slow");
            $('.slicko-search-overly').addClass('search-body-bg');
            $('.search-main-wrapper').addClass('cross-menu');
        });

        $('#cross_icon').click(function () {
            $('.slicko-search-button-wrapper').hide("slow");
            $('.slicko-search-overly').removeClass('search-body-bg');
            $('.search-main-wrapper').removeClass('cross-menu');
        });
    }



    var Slicko_Advance_Slide_Js = function ($scope, $) {
        var wrapper = $scope.find(".slicko-addons--slide-content-wrap");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "slicko-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                },
            },
            ],
        });
    }



    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-progress-bar.default', SlickoProgressBar);
        elementorFrontend.hooks.addAction("frontend/element_ready/slicko-main-menu.default", navMenu);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-animated.default', SlickoAnimatedText);


        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-advance-slide.default', Slicko_Advance_Slide_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-popup.default', slicko_modal_popup);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-video-button.default', slicko_video_button);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-creative-button.default', Slicko_Creative_Button);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-accordion.default', slickoAccordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-animated.default', slicko_AnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/slicko-search-form.default', Slicko_Search_bos);

    });

})(jQuery);