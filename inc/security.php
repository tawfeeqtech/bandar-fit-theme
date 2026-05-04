<?php
/**
 * إجراءات الأمان والحماية
 * @package BandarFit
 */

/**
 * تعطيل إصدار WordPress
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/**
 * حماية ملف wp-config.php
 */
function bandar_protect_wp_config() {
    if (file_exists(ABSPATH . 'wp-config.php')) {
        $htaccess = ABSPATH . '.htaccess';
        $rule = "\n# Protect wp-config.php\n<files wp-config.php>\norder allow,deny\ndeny from all\n</files>\n";
        
        if (is_writable($htaccess)) {
            file_put_contents($htaccess, $rule, FILE_APPEND);
        }
    }
}
add_action('init', 'bandar_protect_wp_config');

/**
 * منع عرض أخطاء PHP
 */
if (!defined('WP_DEBUG_DISPLAY')) {
    define('WP_DEBUG_DISPLAY', false);
}

/**
 * إزالة أسماء المستخدمين من مسار المؤلف
 */
function bandar_remove_author_slug() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'profile';
}
add_action('init', 'bandar_remove_author_slug');

/**
 * منع الوصول إلى ملفات PHP الحساسة مباشرة
 */
function bandar_block_php_direct_access() {
    $protected_files = ['wp-config.php', '.htaccess', 'wp-config-sample.php'];
    $current_file = basename($_SERVER['SCRIPT_FILENAME']);
    
    if (in_array($current_file, $protected_files)) {
        wp_die(__('غير مصرح بالوصول المباشر لهذا الملف.', 'bandar-fit'));
    }
}
add_action('init', 'bandar_block_php_direct_access');

/**
 * إضافة رؤوس أمان إضافية
 */
function bandar_security_headers() {
    if (!is_admin()) {
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com https://www.google.com https://www.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://images.unsplash.com https://*.unsplash.com; connect-src 'self';");
    }
}
add_action('send_headers', 'bandar_security_headers');

/**
 * تعطيل محرر الملفات في لوحة التحكم
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * حماية من هجمات SQL Injection
 */
function bandar_sanitize_input($input) {
    if (is_array($input)) {
        return array_map('bandar_sanitize_input', $input);
    }
    return sanitize_text_field($input);
}

/**
 * التحقق من صحة nonce في كل طلبات AJAX
 */
function bandar_verify_ajax_nonce() {
    // التحقق فقط للـ AJAX actions المخصصة للثيم
    if (wp_doing_ajax() && isset($_REQUEST['action'])) {
        $theme_actions = ['bandar_custom_action', 'bandar_whatsapp_action', 'bandar_contact_action'];
        
        if (in_array($_REQUEST['action'], $theme_actions)) {
            if (!check_ajax_referer('bandar_nonce', 'nonce', false)) {
                wp_die('تحقق الأمان فشل.', 'فشل', ['response' => 403]);
            }
        }
    }
}
add_action('init', 'bandar_verify_ajax_nonce');

/**
 * تسجيل محاولات تسجيل الدخول الفاشلة
 */
function bandar_log_failed_login($username) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $log_entry = sprintf("[%s] محاولة فاشلة - المستخدم: %s - IP: %s\n", current_time('mysql'), $username, $ip);
    
    $log_file = WP_CONTENT_DIR . '/uploads/failed-logins.log';
    if (is_writable(dirname($log_file))) {
        file_put_contents($log_file, $log_entry, FILE_APPEND);
    }
}
add_action('wp_login_failed', 'bandar_log_failed_login');

/**
 * تقييد محاولات تسجيل الدخول (5 محاولات في 10 دقائق)
 */
function bandar_limit_login_attempts($username) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'login_attempts_' . md5($ip);
    $attempts = get_transient($transient_key);
    
    if ($attempts === false) {
        $attempts = 0;
    }
    
    $attempts++;
    set_transient($transient_key, $attempts, 600); // 10 دقائق
    
    if ($attempts > 5) {
        wp_die(__('لقد تجاوزت الحد الأقصى لمحاولات تسجيل الدخول. الرجاء المحاولة بعد 10 دقائق.', 'bandar-fit'));
    }
}
add_action('wp_authenticate', 'bandar_limit_login_attempts');

/**
 * إخفاء واجهة إدارة WordPress للمستخدمين غير المصرح لهم
 */
function bandar_redirect_non_admins() {
    if (is_admin() && !current_user_can('administrator') && !wp_doing_ajax()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'bandar_redirect_non_admins');

/**
 * منع الوصول إلى REST API للمستخدمين غير المسجلين
 */
function bandar_restrict_rest_api($access) {
    if (!is_user_logged_in()) {
        return new WP_Error('rest_not_logged_in', __('يجب تسجيل الدخول للوصول إلى REST API.', 'bandar-fit'), ['status' => 401]);
    }
    return $access;
}
add_filter('rest_authentication_errors', 'bandar_restrict_rest_api');