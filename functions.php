<?php
/**
 * BANDAR FIT Theme Functions
 * @package BandarFit
 */

// تعريف الثوابت
define('BANDAR_VERSION', '1.0.0');
define('BANDAR_DIR', get_template_directory());
define('BANDAR_URI', get_template_directory_uri());

// تحميل الملفات المنظمة
require_once BANDAR_DIR . '/inc/setup.php';
require_once BANDAR_DIR . '/inc/enqueue.php';
require_once BANDAR_DIR . '/inc/custom-post-types.php';
require_once BANDAR_DIR . '/inc/woocommerce-config.php';
require_once BANDAR_DIR . '/inc/customizer.php';
require_once BANDAR_DIR . '/inc/helpers.php';
require_once BANDAR_DIR . '/inc/performance.php';
require_once BANDAR_DIR . '/inc/security.php';

// تحميل المكونات
foreach (glob(BANDAR_DIR . '/components/*.php') as $component) {
    require_once $component;
}

// ACF Fields (إذا كان ACF نشط)
if (function_exists('acf_add_options_page')) {
    require_once BANDAR_DIR . '/inc/acf-fields.php';
}