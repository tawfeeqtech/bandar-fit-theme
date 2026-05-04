<?php
/**
 * BANDAR FIT Theme Functions
 * @package BandarFit
 * @version 1.0.0
 */

// ============================================
// تعريف الثوابت الأساسية
// ============================================
define('BANDAR_VERSION', '1.0.0');
define('BANDAR_DIR', get_template_directory());
define('BANDAR_URI', get_template_directory_uri());
define('BANDAR_ASSETS_URI', BANDAR_URI . '/assets');
define('BANDAR_CSS_URI', BANDAR_ASSETS_URI . '/css');
define('BANDAR_JS_URI', BANDAR_ASSETS_URI . '/js');
define('BANDAR_IMAGES_URI', BANDAR_ASSETS_URI . '/images');

// ============================================
// تحميل الملفات المنظمة
// ============================================

// ملفات الإعدادات الأساسية
require_once BANDAR_DIR . '/inc/setup.php';
require_once BANDAR_DIR . '/inc/enqueue.php';
require_once BANDAR_DIR . '/inc/helpers.php';
require_once BANDAR_DIR . '/inc/walker-nav-menu.php';

// ملفات المحتوى المخصص
require_once BANDAR_DIR . '/inc/custom-post-types.php';
require_once BANDAR_DIR . '/inc/acf-fields.php';

// ملفات WooCommerce
if (class_exists('WooCommerce')) {
    require_once BANDAR_DIR . '/inc/woocommerce-config.php';
}

// ملفات التخصيص والأداء
require_once BANDAR_DIR . '/inc/customizer.php';
require_once BANDAR_DIR . '/inc/performance.php';
require_once BANDAR_DIR . '/inc/security.php';

// ============================================
// تحميل المكونات تلقائياً
// ============================================
foreach (glob(BANDAR_DIR . '/components/*.php') as $component_file) {
    require_once $component_file;
}

// ============================================
// تحميل أجزاء القوالب تلقائياً (اختياري)
// ============================================
function bandar_load_template_part($part_name, $args = []) {
    if (!empty($args) && is_array($args)) {
        extract($args);
    }
    $template_path = BANDAR_DIR . '/template-parts/' . $part_name . '.php';
    if (file_exists($template_path)) {
        include $template_path;
    }
}

// ============================================
// دوال مساعدة إضافية
// ============================================

/**
 * الحصول على رابط واتساب
 */
function bandar_get_whatsapp_url() {
    $number = get_theme_mod('whatsapp_number', '966500000000');
    $message = get_theme_mod('whatsapp_message', __('مرحباً، أريد الاستفسار عن خدمات BANDAR FIT', 'bandar-fit'));
    return 'https://wa.me/' . $number . '?text=' . urlencode($message);
}

/**
 * الحصول على روابط التواصل الاجتماعي
 */
function bandar_get_social_links() {
    return [
        'instagram' => get_theme_mod('social_instagram', '#'),
        'twitter' => get_theme_mod('social_twitter', '#'),
        'snapchat' => get_theme_mod('social_snapchat', '#'),
        'tiktok' => get_theme_mod('social_tiktok', '#'),
        'youtube' => get_theme_mod('social_youtube', '#'),
    ];
}

/**
 * التحقق من الصفحة النشطة
 */
function bandar_is_active_menu($slug) {
    global $post;
    if ($slug && isset($post->post_name)) {
        return $post->post_name === $slug;
    }
    return false;
}