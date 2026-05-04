<?php
/**
 * تحميل الملفات (CSS, JS)
 * @package BandarFit
 */

/**
 * تحميل الملفات في الواجهة الأمامية
 */
function bandar_enqueue_scripts() {
    // ============================================
    // تحميل الخطوط (Google Fonts)
    // ============================================
    wp_enqueue_style(
        'bandar-fonts',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap',
        [],
        null
    );
    
    // ============================================
    // تحميل CSS الرئيسي
    // ============================================
    wp_enqueue_style(
        'bandar-main',
        BANDAR_CSS_URI . '/main.css',
        [],
        BANDAR_VERSION
    );
    
    // ============================================
    // تحميل CSS الخاص بـ WooCommerce
    // ============================================
    if (class_exists('WooCommerce')) {
        wp_enqueue_style(
            'bandar-woocommerce',
            BANDAR_CSS_URI . '/woocommerce.css',
            ['bandar-main'],
            BANDAR_VERSION
        );
    }
    
    // ============================================
    // تحميل CSS المتجاوب
    // ============================================
    wp_enqueue_style(
        'bandar-responsive',
        BANDAR_CSS_URI . '/responsive.css',
            ['bandar-main'],
        BANDAR_VERSION
    );
    
    // ============================================
    // تحميل JavaScript
    // ============================================
    
    // jQuery (مضمنة في WordPress)
    wp_enqueue_script('jquery');
    
    // الملف الرئيسي للـ JS
    wp_enqueue_script(
        'bandar-main',
        BANDAR_JS_URI . '/main.js',
        ['jquery'],
        BANDAR_VERSION,
        true
    );
    
    // ملف الأنيميشن
    wp_enqueue_script(
        'bandar-animations',
        BANDAR_JS_URI . '/animations.js',
        ['bandar-main'],
        BANDAR_VERSION,
        true
    );
    
    // ملف واتساب
    wp_enqueue_script(
        'bandar-whatsapp',
        BANDAR_JS_URI . '/whatsapp.js',
        ['bandar-main'],
        BANDAR_VERSION,
        true
    );
    
    // ملف السلة (WooCommerce)
    if (class_exists('WooCommerce') && is_cart()) {
        wp_enqueue_script(
            'bandar-cart',
            BANDAR_JS_URI . '/cart.js',
            ['jquery', 'wc-cart'],
            BANDAR_VERSION,
            true
        );
    }
    
    // ============================================
    // تمرير البيانات إلى JavaScript
    // ============================================
    wp_localize_script('bandar-main', 'bandarAjax', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('bandar_nonce'),
        'whatsappUrl' => bandar_get_whatsapp_url(),
        'siteUrl' => home_url(),
        'themeUrl' => BANDAR_URI,
        'isRtl' => is_rtl(),
    ]);
    
    // ============================================
    // تحميل التعليقات (إذا لزم الأمر)
    // ============================================
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bandar_enqueue_scripts');

/**
 * تحميل الملفات في لوحة التحكم
 */
function bandar_admin_enqueue_scripts($hook) {
    // تحميل CSS خاص بلوحة التحكم
    wp_enqueue_style(
        'bandar-admin',
        BANDAR_CSS_URI . '/admin.css',
        [],
        BANDAR_VERSION
    );
    
    // تحميل JS خاص بلوحة التحكم
    wp_enqueue_script(
        'bandar-admin',
        BANDAR_JS_URI . '/admin.js',
        ['jquery'],
        BANDAR_VERSION,
        true
    );
}
add_action('admin_enqueue_scripts', 'bandar_admin_enqueue_scripts');

/**
 * تحميل خطوط المحرر
 */
function bandar_editor_styles() {
    add_editor_style('assets/css/editor-style.css');
    add_editor_style('https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap');
}
add_action('admin_init', 'bandar_editor_styles');

/**
 * إضافة سمات defer/async للـ JS
 */
function bandar_defer_scripts($tag, $handle, $src) {
    $defer_scripts = ['bandar-main', 'bandar-animations'];
    
    if (in_array($handle, $defer_scripts)) {
        return '<script src="' . $src . '" defer></script>';
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'bandar_defer_scripts', 10, 3);