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
     * Initialize all functions
     */
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initStickyHeader();

        // Add console message
        console.log('Stapp Theme JavaScript loaded');
    });

})(jQuery);
