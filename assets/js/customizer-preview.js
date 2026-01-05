/**
 * Customizer Live Preview
 *
 * @package Stapp_Theme
 */

(function($) {
    'use strict';

    // Logo Width
    wp.customize('stapp_logo_width', function(value) {
        value.bind(function(newval) {
            $('.custom-logo-link img').css('width', newval + 'px');
        });
    });

    // Logo Height
    wp.customize('stapp_logo_height', function(value) {
        value.bind(function(newval) {
            if (newval > 0) {
                $('.custom-logo-link img').css('height', newval + 'px');
            } else {
                $('.custom-logo-link img').css('height', 'auto');
            }
        });
    });

})(jQuery);
