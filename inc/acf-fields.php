<?php
/**
 * حقول ACF المخصصة (إذا كانت الإضافة مفعلة)
 * @package BandarFit
 */

/**
 * التحقق من وجود ACF وتفعيل الحقول
 */
function bandar_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // ============================================
    // 1. خيارات الصفحة الرئيسية
    // ============================================
    acf_add_options_page([
        'page_title' => __('خيارات BANDAR FIT', 'bandar-fit'),
        'menu_title' => __('خيارات الثيم', 'bandar-fit'),
        'menu_slug'  => 'bandar-theme-options',
        'capability' => 'manage_options',
        'redirect'   => true,
        'position'   => 2,
        'icon_url'   => 'dashicons-admin-settings',
    ]);
    
    // خيارات الهيرو
    acf_add_local_field_group([
        'key' => 'group_bandar_hero',
        'title' => __('خيارات الهيرو', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_hero_title',
                'label' => __('عنوان الهيرو الرئيسي', 'bandar-fit'),
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => __('العنوان الرئيسي الذي يظهر في أعلى الصفحة', 'bandar-fit'),
                'default_value' => 'إعدادك بدنياً مع كوتش بندر',
            ],
            [
                'key' => 'field_hero_subtitle',
                'label' => __('النص الثانوي', 'bandar-fit'),
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'default_value' => '"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"',
            ],
            [
                'key' => 'field_hero_tagline',
                'label' => __('الشفرة العلوية', 'bandar-fit'),
                'name' => 'hero_tagline',
                'type' => 'text',
                'default_value' => 'Football Performance Architecture',
            ],
            [
                'key' => 'field_hero_background',
                'label' => __('صورة خلفية الهيرو', 'bandar-fit'),
                'name' => 'hero_background',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_hero_video',
                'label' => __('فيديو خلفية الهيرو (اختياري)', 'bandar-fit'),
                'name' => 'hero_video',
                'type' => 'url',
                'instructions' => __('رابط فيديو MP4', 'bandar-fit'),
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'bandar-theme-options',
                ],
            ],
        ],
        'menu_order' => 1,
    ]);
    
    // ============================================
    // 2. خيارات التواصل الاجتماعي
    // ============================================
    acf_add_local_field_group([
        'key' => 'group_bandar_social',
        'title' => __('معلومات التواصل', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_whatsapp_number',
                'label' => __('رقم واتساب', 'bandar-fit'),
                'name' => 'whatsapp_number',
                'type' => 'text',
                'instructions' => __('أدخل رقم الجوال مع مفتاح الدولة (مثال: 966500000000)', 'bandar-fit'),
                'default_value' => '966500000000',
            ],
            [
                'key' => 'field_whatsapp_message',
                'label' => __('رسالة واتساب الافتراضية', 'bandar-fit'),
                'name' => 'whatsapp_message',
                'type' => 'textarea',
                'default_value' => 'مرحباً، أريد الاستفسار عن خدمات BANDAR FIT',
            ],
            [
                'key' => 'field_instagram',
                'label' => __('انستقرام', 'bandar-fit'),
                'name' => 'instagram',
                'type' => 'url',
            ],
            [
                'key' => 'field_twitter',
                'label' => __('تويتر / X', 'bandar-fit'),
                'name' => 'twitter',
                'type' => 'url',
            ],
            [
                'key' => 'field_snapchat',
                'label' => __('سناب شات', 'bandar-fit'),
                'name' => 'snapchat',
                'type' => 'url',
            ],
            [
                'key' => 'field_tiktok',
                'label' => __('تيك توك', 'bandar-fit'),
                'name' => 'tiktok',
                'type' => 'url',
            ],
            [
                'key' => 'field_youtube',
                'label' => __('يوتيوب', 'bandar-fit'),
                'name' => 'youtube',
                'type' => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'bandar-theme-options',
                ],
            ],
        ],
        'menu_order' => 2,
    ]);
    
    // ============================================
    // 3. حقول مخصصة للخدمات (Service)
    // ============================================
    acf_add_local_field_group([
        'key' => 'group_bandar_service',
        'title' => __('تفاصيل الخدمة', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_service_icon',
                'label' => __('أيقونة الخدمة', 'bandar-fit'),
                'name' => 'service_icon',
                'type' => 'select',
                'choices' => [
                    'medal' => __('ميدالية (Medal)', 'bandar-fit'),
                    'clipboard-check' => __('قائمة تدقيق (Clipboard)', 'bandar-fit'),
                    'dumbbell' => __('دمبل (Dumbbell)', 'bandar-fit'),
                    'heart-pulse' => __('قلب (Heart)', 'bandar-fit'),
                    'timer' => __('مؤقت (Timer)', 'bandar-fit'),
                    'activity' => __('نشاط (Activity)', 'bandar-fit'),
                ],
                'default_value' => 'medal',
            ],
            [
                'key' => 'field_service_link',
                'label' => __('رابط الخدمة', 'bandar-fit'),
                'name' => 'service_link',
                'type' => 'page_link',
                'instructions' => __('اختر الصفحة التي تريد توجيه المستخدم إليها', 'bandar-fit'),
            ],
            [
                'key' => 'field_service_price',
                'label' => __('السعر (إذا كان مدفوع)', 'bandar-fit'),
                'name' => 'service_price',
                'type' => 'number',
                'instructions' => __('اتركه فارغاً إذا كانت الخدمة مجانية أو "تواصل معنا"', 'bandar-fit'),
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ],
            ],
        ],
    ]);
    
    // ============================================
    // 4. حقول مخصصة للتقييمات (Evaluation)
    // ============================================
    acf_add_local_field_group([
        'key' => 'group_bandar_evaluation',
        'title' => __('تفاصيل التقييم', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_eval_icon',
                'label' => __('أيقونة التقييم', 'bandar-fit'),
                'name' => 'eval_icon',
                'type' => 'select',
                'choices' => [
                    'lungs' => __('التحمل (Lungs)', 'bandar-fit'),
                    'timer' => __('السرعة (Timer)', 'bandar-fit'),
                    'move' => __('الرشاقة (Move)', 'bandar-fit'),
                    'zap' => __('القوة (Zap)', 'bandar-fit'),
                    'target' => __('الدقة (Target)', 'bandar-fit'),
                ],
                'default_value' => 'lungs',
            ],
            [
                'key' => 'field_eval_price',
                'label' => __('سعر التقييم', 'bandar-fit'),
                'name' => 'eval_price',
                'type' => 'number',
                'default_value' => 499,
            ],
            [
                'key' => 'field_eval_duration',
                'label' => __('مدة التقييم (بالدقائق)', 'bandar-fit'),
                'name' => 'eval_duration',
                'type' => 'number',
                'default_value' => 60,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'evaluation',
                ],
            ],
        ],
    ]);
    
    // ============================================
    // 5. إعدادات الألوان المخصصة
    // ============================================
    acf_add_local_field_group([
        'key' => 'group_bandar_colors',
        'title' => __('تخصيص الألوان', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_primary_color',
                'label' => __('اللون الأساسي', 'bandar-fit'),
                'name' => 'primary_color',
                'type' => 'color_picker',
                'default_value' => '#C5A880',
            ],
            [
                'key' => 'field_secondary_color',
                'label' => __('اللون الثانوي', 'bandar-fit'),
                'name' => 'secondary_color',
                'type' => 'color_picker',
                'default_value' => '#A68B63',
            ],
            [
                'key' => 'field_dark_bg',
                'label' => __('لون الخلفية الداكن', 'bandar-fit'),
                'name' => 'dark_bg',
                'type' => 'color_picker',
                'default_value' => '#0F0F0F',
            ],
            [
                'key' => 'field_surface_bg',
                'label' => __('لون السطح', 'bandar-fit'),
                'name' => 'surface_bg',
                'type' => 'color_picker',
                'default_value' => '#1A1A1A',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'bandar-theme-options',
                ],
            ],
        ],
        'menu_order' => 3,
    ]);
    
    // ============================================
    // 6. إعدادات الخطوط
    // ============================================
    acf_add_local_field_group([
        'key' => 'group_bandar_typography',
        'title' => __('تخصيص الخطوط', 'bandar-fit'),
        'fields' => [
            [
                'key' => 'field_body_font',
                'label' => __('خط النصوص', 'bandar-fit'),
                'name' => 'body_font',
                'type' => 'select',
                'choices' => [
                    'Cairo' => 'Cairo',
                    'Tajawal' => 'Tajawal',
                    'Almarai' => 'Almarai',
                    'Noto Kufi Arabic' => 'Noto Kufi Arabic',
                ],
                'default_value' => 'Cairo',
            ],
            [
                'key' => 'field_heading_font',
                'label' => __('خط العناوين', 'bandar-fit'),
                'name' => 'heading_font',
                'type' => 'select',
                'choices' => [
                    'Cairo' => 'Cairo',
                    'Tajawal' => 'Tajawal',
                    'Almarai' => 'Almarai',
                ],
                'default_value' => 'Cairo',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'bandar-theme-options',
                ],
            ],
        ],
        'menu_order' => 4,
    ]);
}

add_action('acf/init', 'bandar_register_acf_fields');

/**
 * تطبيق الألوان الديناميكية من ACF إلى CSS
 */
function bandar_dynamic_css_from_acf() {
    if (!function_exists('get_field')) {
        return;
    }
    
    $primary_color = get_field('primary_color', 'option');
    $secondary_color = get_field('secondary_color', 'option');
    $dark_bg = get_field('dark_bg', 'option');
    $surface_bg = get_field('surface_bg', 'option');
    
    if (!$primary_color && !$secondary_color) {
        return;
    }
    
    $custom_css = ":root {\n";
    if ($primary_color) {
        $custom_css .= "    --brand-primary: {$primary_color};\n";
        $custom_css .= "    --brand-primary-dark: " . bandar_darken_color($primary_color, 20) . ";\n";
    }
    if ($secondary_color) {
        $custom_css .= "    --brand-secondary: {$secondary_color};\n";
    }
    if ($dark_bg) {
        $custom_css .= "    --brand-dark: {$dark_bg};\n";
    }
    if ($surface_bg) {
        $custom_css .= "    --brand-surface: {$surface_bg};\n";
    }
    $custom_css .= "}\n";
    
    wp_add_inline_style('bandar-main', $custom_css);
}
add_action('wp_enqueue_scripts', 'bandar_dynamic_css_from_acf', 20);

/**
 * دالة لتغميق اللون
 */
function bandar_darken_color($hex, $percent) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    
    $r = max(0, min(255, $r - ($r * $percent / 100)));
    $g = max(0, min(255, $g - ($g * $percent / 100)));
    $b = max(0, min(255, $b - ($b * $percent / 100)));
    
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}