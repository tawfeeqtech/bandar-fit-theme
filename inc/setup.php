<?php
function bandar_setup_theme() {
    // دعم RTL
    add_theme_support('rtl');
    
    // دعم WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // دعم الصورة المصغرة
    add_theme_support('post-thumbnails');
    
    // دعم الشعار المخصص
    add_theme_support('custom-logo', [
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    
    // دعم القوائم
    register_nav_menus([
        'primary' => __('القائمة الرئيسية', 'bandar-fit'),
        'footer' => __('قائمة الفوتر', 'bandar-fit'),
        'social' => __('روابط التواصل', 'bandar-fit'),
    ]);
    
    // دعم عنوان الصفحة التلقائي
    add_theme_support('title-tag');
    
    // دعم HTML5
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    
    // دعم الترجمة
    load_theme_textdomain('bandar-fit', BANDAR_DIR . '/languages');
}
add_action('after_setup_theme', 'bandar_setup_theme');