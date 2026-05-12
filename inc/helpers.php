<?php
/**
 * الدوال المساعدة للثيم
 * @package BandarFit
 */

/**
 * تنسيق السعر
 */
function bandar_format_price($price, $currency = 'SAR') {
    return number_format($price, 2) . ' ' . $currency;
}

/**
 * الحصول على مقتطف النص
 */
function bandar_excerpt($limit = 20) {
    $excerpt = get_the_excerpt();
    if (str_word_count($excerpt, 0) > $limit) {
        $words = str_word_count($excerpt, 2);
        $pos = array_keys($words);
        $excerpt = substr($excerpt, 0, $pos[$limit]) . '...';
    }
    return $excerpt;
}

/**
 * الحصول على الصورة المصغرة أو صورة افتراضية
 */
function bandar_get_thumbnail($post_id = null, $size = 'large') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    
    return BANDAR_IMAGES_URI . '/placeholder-' . $size . '.jpg';
}

/**
 * إضافة كلاسات مخصصة للجسم body
 */
function bandar_body_classes($classes) {
    if (is_rtl()) {
        $classes[] = 'rtl';
    } else {
        $classes[] = 'ltr';
    }
    
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    if (is_user_logged_in()) {
        $classes[] = 'logged-in';
    }
    
    return $classes;
}
add_filter('body_class', 'bandar_body_classes');

/**
 * سمات اللغة لوسم HTML
 */
function bandar_language_attributes() {
    $language = get_bloginfo('language');
    $direction = is_rtl() ? 'rtl' : 'ltr';
    return 'lang="' . $language . '" dir="' . $direction . '"';
}

/**
 * عرض الترقيم الصفحي
 */
function bandar_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    $pages = paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'prev_text' => __('السابق', 'bandar-fit'),
        'next_text' => __('التالي', 'bandar-fit'),
    ]);
    
    if (is_array($pages)) {
        echo '<div class="pagination"><ul class="pagination-list">';
        foreach ($pages as $page) {
            echo '<li>' . $page . '</li>';
        }
        echo '</ul></div>';
    }
}

/**
 * عرض شعار الموقع
 */
function bandar_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<div class="site-logo-text">';
        echo '<a href="' . home_url('/') . '">';
        echo '<span class="logo-text">' . get_bloginfo('name') . '</span>';
        echo '</a>';
        echo '</div>';
    }
}

/**
 * جلب ميتاداتا المنشور بشكل آمن
 */
function bandar_safe_get_post_meta($post_id, $key, $default = '') {
    if (!$post_id || !is_numeric($post_id)) {
        return $default;
    }
    
    $value = get_post_meta($post_id, $key, true);
    return !empty($value) ? $value : $default;
}

/**
 * جلب جزء القالب بشكل آمن
 */
function bandar_safe_get_template_part($slug, $name = null) {
    try {
        get_template_part($slug, $name);
    } catch (Exception $e) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Template part error: ' . $e->getMessage());
        }
        echo '<!-- Template part error: ' . esc_html($slug) . ' -->';
    }
}

/**
 * السماح بوسوم SVG في wp_kses
 */
function bandar_allow_svg_tags($allowed_tags, $context) {
    if ($context === 'post' || $context === 'data') {
        $allowed_tags['svg'] = [
            'xmlns'       => true,
            'width'       => true,
            'height'      => true,
            'viewbox'     => true,
            'fill'        => true,
            'stroke'      => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'class'       => true,
            'aria-hidden' => true,
            'data-lucide' => true,
        ];
        $allowed_tags['path'] = [
            'd'    => true,
            'fill' => true,
        ];
        $allowed_tags['circle'] = [
            'cx'   => true,
            'cy'   => true,
            'r'    => true,
            'fill' => true,
        ];
        $allowed_tags['polyline'] = [
            'points' => true,
        ];
        $allowed_tags['line'] = [
            'x1' => true,
            'y1' => true,
            'x2' => true,
            'y2' => true,
        ];
    }
    return $allowed_tags;
}
add_filter('wp_kses_allowed_html', 'bandar_allow_svg_tags', 10, 2);
