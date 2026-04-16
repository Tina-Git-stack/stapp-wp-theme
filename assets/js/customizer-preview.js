/**
 * Customizer Live Preview
 *
 * @package STApp_WP_Theme
 */

(function($) {
    'use strict';

    /**
     * Helper: Convert hex to rgba
     */
    function hexToRgba(hex, opacity) {
        hex = hex.replace('#', '');
        if (hex.length === 3) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);
        return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + opacity + ')';
    }

    /**
     * Helper: Update a CSS variable on :root
     */
    function setCssVar(name, value) {
        document.documentElement.style.setProperty(name, value);
    }

    // =========================================================================
    // Logo
    // =========================================================================

    wp.customize('stapp_wp_logo_width', function(value) {
        value.bind(function(newval) {
            $('.custom-logo-link img').css('width', newval + 'px');
        });
    });

    wp.customize('stapp_wp_logo_height', function(value) {
        value.bind(function(newval) {
            $('.custom-logo-link img').css('height', newval > 0 ? newval + 'px' : 'auto');
        });
    });

    // =========================================================================
    // Header
    // =========================================================================

    wp.customize('stapp_wp_header_bg_color', function(value) {
        value.bind(function(newval) {
            var opacity = wp.customize('stapp_wp_header_bg_opacity').get() / 100;
            setCssVar('--stapp-header-bg', hexToRgba(newval, opacity));
        });
    });

    wp.customize('stapp_wp_header_bg_opacity', function(value) {
        value.bind(function(newval) {
            var color = wp.customize('stapp_wp_header_bg_color').get();
            setCssVar('--stapp-header-bg', hexToRgba(color, newval / 100));
        });
    });

    wp.customize('stapp_wp_header_text_color', function(value) {
        value.bind(function(newval) {
            setCssVar('--stapp-header-text', newval);
        });
    });

    // =========================================================================
    // Footer
    // =========================================================================

    wp.customize('stapp_wp_footer_bg_color', function(value) {
        value.bind(function(newval) {
            var opacity = wp.customize('stapp_wp_footer_bg_opacity').get() / 100;
            setCssVar('--stapp-footer-bg', hexToRgba(newval, opacity));
        });
    });

    wp.customize('stapp_wp_footer_bg_opacity', function(value) {
        value.bind(function(newval) {
            var color = wp.customize('stapp_wp_footer_bg_color').get();
            setCssVar('--stapp-footer-bg', hexToRgba(color, newval / 100));
        });
    });

    wp.customize('stapp_wp_footer_text_color', function(value) {
        value.bind(function(newval) {
            setCssVar('--stapp-footer-text', newval);
        });
    });

    wp.customize('stapp_wp_footer_copyright', function(value) {
        value.bind(function(newval) {
            var text = newval || '';
            text = text.replace('{year}', new Date().getFullYear());
            text = text.replace('{sitename}', document.title);
            $('.site-info .copyright-text').html(text);
        });
    });

    // =========================================================================
    // Background
    // =========================================================================

    wp.customize('stapp_wp_bg_gradient_color1', function(value) {
        value.bind(function(newval) {
            var color2 = wp.customize('stapp_wp_bg_gradient_color2').get();
            var base = wp.customize('stapp_wp_bg_base_color').get();
            setCssVar('--stapp-bg-gradient', 'linear-gradient(160deg, ' + newval + ' 0%, ' + base + ' 30%, ' + color2 + ' 60%, ' + base + ' 100%)');
        });
    });

    wp.customize('stapp_wp_bg_gradient_color2', function(value) {
        value.bind(function(newval) {
            var color1 = wp.customize('stapp_wp_bg_gradient_color1').get();
            var base = wp.customize('stapp_wp_bg_base_color').get();
            setCssVar('--stapp-bg-gradient', 'linear-gradient(160deg, ' + color1 + ' 0%, ' + base + ' 30%, ' + newval + ' 60%, ' + base + ' 100%)');
        });
    });

    wp.customize('stapp_wp_bg_base_color', function(value) {
        value.bind(function(newval) {
            var color1 = wp.customize('stapp_wp_bg_gradient_color1').get();
            var color2 = wp.customize('stapp_wp_bg_gradient_color2').get();
            setCssVar('--stapp-bg-gradient', 'linear-gradient(160deg, ' + color1 + ' 0%, ' + newval + ' 30%, ' + color2 + ' 60%, ' + newval + ' 100%)');
        });
    });

    wp.customize('stapp_wp_bg_blur_enabled', function(value) {
        value.bind(function(newval) {
            if (newval) {
                var opacity = wp.customize('stapp_wp_bg_blur_opacity').get() / 100;
                setCssVar('--stapp-blur-opacity', opacity);
            } else {
                setCssVar('--stapp-blur-opacity', '0');
            }
        });
    });

    wp.customize('stapp_wp_bg_blur_color1', function(value) {
        value.bind(function(newval) {
            setCssVar('--stapp-blur-color1', newval);
        });
    });

    wp.customize('stapp_wp_bg_blur_color2', function(value) {
        value.bind(function(newval) {
            setCssVar('--stapp-blur-color2', newval);
        });
    });

    wp.customize('stapp_wp_bg_blur_opacity', function(value) {
        value.bind(function(newval) {
            var enabled = wp.customize('stapp_wp_bg_blur_enabled').get();
            setCssVar('--stapp-blur-opacity', enabled ? newval / 100 : '0');
        });
    });

    wp.customize('stapp_wp_bg_qualityline_color', function(value) {
        value.bind(function(newval) {
            setCssVar('--stapp-qualityline-color', newval);
        });
    });

})(jQuery);
