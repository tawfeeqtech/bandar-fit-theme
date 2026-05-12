/**
 * Customizer Preview JavaScript
 * Handles real-time preview updates for theme customizer settings
 */

(function($) {
    // Logo width preview
    wp.customize('logo_width', function(value) {
        value.bind(function(newval) {
            $('.custom-logo-link img').css('max-width', newval + 'px');
        });
    });

    // Brand primary color preview
    wp.customize('brand_primary', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--brand-primary', newval);
        });
    });

    // Brand dark color (background) preview
    wp.customize('brand_dark', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--brand-dark', newval);
        });
    });

    // Hero title preview
    wp.customize('hero_title', function(value) {
        value.bind(function(newval) {
            $('.hero-title').text(newval);
        });
    });

    // Hero subtitle preview
    wp.customize('hero_subtitle', function(value) {
        value.bind(function(newval) {
            $('.hero-subtitle').html(newval);
        });
    });

    // Hero tagline preview
    wp.customize('hero_tagline', function(value) {
        value.bind(function(newval) {
            $('.hero-tagline').text(newval);
        });
    });

    // Site title preview
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            $('.site-title a').text(newval);
        });
    });

    // Site description preview
    wp.customize('blogdescription', function(value) {
        value.bind(function(newval) {
            $('.site-description').text(newval);
        });
    });

})(jQuery);
