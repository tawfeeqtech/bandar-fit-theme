<?php
/**
 * إعدادات الثيم الأساسية
 * @package BandarFit
 */

/**
 * إعدادات الثيم بعد التفعيل
 */
function bandar_theme_setup() {
    // دعم RTL (العربية)
    add_theme_support('rtl');
    
    
    // دعم الصور المصغرة
    add_theme_support('post-thumbnails');
    
    // أبعاد الصور المخصصة
    add_image_size('bandar-hero', 1920, 1080, true);
    add_image_size('bandar-card', 600, 400, true);
    add_image_size('bandar-thumbnail', 400, 300, true);
    add_image_size('bandar-athlete', 800, 600, true);
    
    // دعم الشعار المخصص
    add_theme_support('custom-logo', [
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => ['site-title', 'site-description'],
    ]);
    
    // دعم خلفية الصفحة
    add_theme_support('custom-background', [
        'default-color' => '0f0f0f',
        'default-image' => '',
    ]);
    
    // دعم عنوان الصفحة التلقائي
    add_theme_support('title-tag');
    
    // دعم HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    
    // دعم الترجمة
    load_theme_textdomain('bandar-fit', BANDAR_DIR . '/languages');
    
    // دعم الروابط الثابتة التلقائية
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    
    // إضافة أنماط المحرر
    add_editor_style('assets/css/editor-style.css');
    
    // دعم القوائم
    register_nav_menus([
        'primary' => __('القائمة الرئيسية', 'bandar-fit'),
        'footer' => __('قائمة الفوتر', 'bandar-fit'),
        'social' => __('قائمة التواصل الاجتماعي', 'bandar-fit'),
        'mobile' => __('القائمة المتنقلة', 'bandar-fit'),
    ]);
    
    // إعدادات RSS
    add_theme_support('automatic-feed-links');
    
    // دعم تخصيص الوحدات
    add_theme_support('widgets');
}
add_action('after_setup_theme', 'bandar_theme_setup');

/**
 * تعيين الحد الأقصى لعرض المحتوى
 */
function bandar_content_width() {
    $GLOBALS['content_width'] = apply_filters('bandar_content_width', 1200);
}
add_action('after_setup_theme', 'bandar_content_width', 0);

/**
 * تسجيل مناطق الويدجت
 */
function bandar_widgets_init() {
    // الويدجت الرئيسي في السايدبار
    register_sidebar([
        'name' => __('السايدبار الرئيسي', 'bandar-fit'),
        'id' => 'sidebar-main',
        'description' => __('المنطقة الجانبية الرئيسية', 'bandar-fit'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
    
    // ويدجت الفوتر - العمود 1
    register_sidebar([
        'name' => __('فوتر - عمود 1', 'bandar-fit'),
        'id' => 'footer-1',
        'description' => __('العمود الأول في الفوتر', 'bandar-fit'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ]);
    
    // ويدجت الفوتر - العمود 2
    register_sidebar([
        'name' => __('فوتر - عمود 2', 'bandar-fit'),
        'id' => 'footer-2',
        'description' => __('العمود الثاني في الفوتر', 'bandar-fit'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ]);
    
    // ويدجت الفوتر - العمود 3
    register_sidebar([
        'name' => __('فوتر - عمود 3', 'bandar-fit'),
        'id' => 'footer-3',
        'description' => __('العمود الثالث في الفوتر', 'bandar-fit'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ]);
    
    // ويدجت الفوتر - العمود 4
    register_sidebar([
        'name' => __('فوتر - عمود 4', 'bandar-fit'),
        'id' => 'footer-4',
        'description' => __('العمود الرابع في الفوتر', 'bandar-fit'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'bandar_widgets_init');