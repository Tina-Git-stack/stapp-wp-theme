/**
 * Main JavaScript File
 *
 * @package STApp_WP_Theme
 */

(function($) {
    'use strict';

    /**
     * Get the nav breakpoint from CSS variable
     */
    function getNavBreakpoint() {
        var bp = getComputedStyle(document.documentElement).getPropertyValue('--nav-breakpoint').trim();
        return parseInt(bp, 10) || 768;
    }

    /**
     * Update mobile/desktop state based on breakpoint
     */
    function updateNavResponsiveState() {
        var header = $('#masthead');
        var navigation = $('#site-navigation');
        var breakpoint = getNavBreakpoint();

        if (window.innerWidth <= breakpoint) {
            header.addClass('nav-mobile').removeClass('nav-desktop');
            navigation.addClass('mobile-active');
        } else {
            header.addClass('nav-desktop').removeClass('nav-mobile');
            navigation.removeClass('mobile-active toggled');
            $('.mobile-menu-overlay').removeClass('active');
            $('body').removeClass('mobile-menu-open');
        }
    }

    /**
     * Close mobile menu
     */
    function closeMobileMenu() {
        var navigation = $('#site-navigation');
        navigation.removeClass('toggled');
        $('.menu-toggle').attr('aria-expanded', 'false').removeClass('is-active');
        $('.mobile-menu-overlay').removeClass('active');
        $('body').removeClass('mobile-menu-open');
    }

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        var menuToggle = $('.menu-toggle');
        var navigation = $('#site-navigation');
        var overlay = $('.mobile-menu-overlay');
        var closeBtn = $('.mobile-menu-close');

        menuToggle.on('click', function() {
            var isOpen = navigation.hasClass('toggled');

            if (isOpen) {
                closeMobileMenu();
            } else {
                navigation.addClass('toggled');
                $(this).attr('aria-expanded', 'true').addClass('is-active');
                overlay.addClass('active');
                $('body').addClass('mobile-menu-open');
            }
        });

        closeBtn.on('click', function() {
            closeMobileMenu();
        });

        overlay.on('click', function() {
            closeMobileMenu();
        });
    }

    /**
     * Submenu hover/click logic
     */
    function initSubmenus() {
        // Desktop: hover to open submenus
        $('.main-navigation li').on('mouseenter', function() {
            if ($('#masthead').hasClass('nav-desktop')) {
                $(this).addClass('focus');
            }
        }).on('mouseleave', function() {
            if ($('#masthead').hasClass('nav-desktop')) {
                $(this).removeClass('focus');
            }
        });

        // Mobile: click to toggle submenus
        $('.main-navigation .menu-item-has-children > a').on('click', function(e) {
            if ($('#masthead').hasClass('nav-mobile')) {
                var $parent = $(this).parent();
                if (!$parent.hasClass('focus')) {
                    e.preventDefault();
                    $parent.siblings().removeClass('focus');
                    $parent.addClass('focus');
                }
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
                location.hostname === this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800);
                    return false;
                }
            }
        });
    }

    /**
     * Add class to header on scroll
     */
    function initStickyHeader() {
        var header = $('.site-header');
        var scrollThreshold = 100;

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > scrollThreshold) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });
    }

    /**
     * Hero Parallax Effect
     */
    function initHeroParallax() {
        var hero = $('.hero-section, .is-style-hero-section');

        if (hero.length === 0) return;

        // Check for reduced motion preference
        var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (prefersReducedMotion) return;

        hero.attr('data-parallax', 'true');

        $(window).on('scroll', function() {
            var scrolled = $(this).scrollTop();
            var heroHeight = hero.outerHeight();

            // Only apply parallax while hero is visible
            if (scrolled < heroHeight) {
                var parallaxValue = scrolled * 0.5;
                hero.css('transform', 'translateY(' + parallaxValue + 'px)');
            }
        });
    }

    /**
     * Initialize all functions
     */
    $(document).ready(function() {
        updateNavResponsiveState();
        initMobileMenu();
        initSubmenus();
        initSmoothScroll();
        initStickyHeader();
        // initHeroParallax(); // Temporarily disabled for debugging

        $(window).on('resize', updateNavResponsiveState);

        console.log('STApp WP Theme JavaScript loaded');
    });

})(jQuery);
