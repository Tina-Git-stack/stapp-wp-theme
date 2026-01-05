/**
 * Main JavaScript File
 *
 * @package Stapp_Theme
 */

(function($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = $('.menu-toggle');
        const navigation = $('#site-navigation');

        menuToggle.on('click', function() {
            navigation.toggleClass('toggled');
            const expanded = $(this).attr('aria-expanded') === 'true' || false;
            $(this).attr('aria-expanded', !expanded);
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
        const header = $('.site-header');
        const scrollThreshold = 100;

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
        const hero = $('.hero-section, .is-style-hero-section');

        if (hero.length === 0) return;

        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (prefersReducedMotion) return;

        hero.attr('data-parallax', 'true');

        $(window).on('scroll', function() {
            const scrolled = $(this).scrollTop();
            const heroHeight = hero.outerHeight();

            // Only apply parallax while hero is visible
            if (scrolled < heroHeight) {
                const parallaxValue = scrolled * 0.5;
                hero.css('transform', 'translateY(' + parallaxValue + 'px)');
            }
        });
    }

    /**
     * Initialize all functions
     */
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initStickyHeader();
        // initHeroParallax(); // Temporarily disabled for debugging

        // Add console message
        console.log('Stapp Theme JavaScript loaded');
    });

})(jQuery);
