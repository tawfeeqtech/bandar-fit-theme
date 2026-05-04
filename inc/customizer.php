<?php
/**
 * تخصيص الثيم (Theme Customizer)
 * @package BandarFit
 */

/**
 * إضافة أقسام التخصيص
 */
function bandar_customize_register($wp_customize) {
    
    // ============================================
    // قسم العلامة التجارية
    // ============================================
    $wp_customize->add_section('bandar_brand', [
        'title'    => __('العلامة التجارية', 'bandar-fit'),
        'priority' => 20,
    ]);
    
    // الشعار (تم دعمه مسبقاً من WordPress)
    $wp_customize->add_setting('logo_width', [
        'default'           => 200,
        'sanitize_callback' => 'absint',
    ]);
    
    $wp_customize->add_control('logo_width', [
        'label'       => __('عرض الشعار (بكسل)', 'bandar-fit'),
        'section'     => 'bandar_brand',
        'type'        => 'number',
        'input_attrs' => ['min' => 50, 'max' => 300],
    ]);
    
    // الألوان
    $wp_customize->add_setting('brand_primary', [
        'default'           => '#C5A880',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_primary', [
        'label'    => __('اللون الأساسي', 'bandar-fit'),
        'section'  => 'bandar_brand',
    ]));
    
    $wp_customize->add_setting('brand_dark', [
        'default'           => '#0F0F0F',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_dark', [
        'label'    => __('لون الخلفية الداكن', 'bandar-fit'),
        'section'  => 'bandar_brand',
    ]));
    
    // ============================================
    // قسم الهيرو
    // ============================================
    $wp_customize->add_section('bandar_hero', [
        'title'    => __('قسم الهيرو', 'bandar-fit'),
        'priority' => 30,
    ]);
    
    $wp_customize->add_setting('hero_title', [
        'default'           => 'إعدادك بدنياً مع كوتش بندر',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('hero_title', [
        'label'       => __('عنوان الهيرو', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'text',
    ]);
    
    $wp_customize->add_setting('hero_subtitle', [
        'default'           => '"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('hero_subtitle', [
        'label'       => __('النص الثانوي', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'textarea',
    ]);
    
    $wp_customize->add_setting('hero_tagline', [
        'default'           => 'Football Performance Architecture',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('hero_tagline', [
        'label'       => __('الشفرة العلوية', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'text',
    ]);
    
    $wp_customize->add_setting('hero_image', [
        'default'           => BANDAR_IMAGES_URI . '/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label'    => __('صورة الهيرو', 'bandar-fit'),
        'section'  => 'bandar_hero',
    ]));
    
    // ============================================
    // قسم التواصل
    // ============================================
    $wp_customize->add_section('bandar_contact', [
        'title'    => __('معلومات التواصل', 'bandar-fit'),
        'priority' => 40,
    ]);
    
    $wp_customize->add_setting('whatsapp_number', [
        'default'           => '966500000000',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('whatsapp_number', [
        'label'       => __('رقم واتساب', 'bandar-fit'),
        'section'     => 'bandar_contact',
        'type'        => 'tel',
        'description' => __('أدخل الرقم بدون علامة + (مثال: 966500000000)', 'bandar-fit'),
    ]);
    
    $wp_customize->add_setting('whatsapp_message', [
        'default'           => 'مرحباً، أريد الاستفسار عن خدمات BANDAR FIT',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('whatsapp_message', [
        'label'       => __('الرسالة الافتراضية', 'bandar-fit'),
        'section'     => 'bandar_contact',
        'type'        => 'textarea',
    ]);
    
    // وسائل التواصل الاجتماعي
    $socials = ['instagram', 'twitter', 'snapchat', 'tiktok', 'youtube'];
    foreach ($socials as $social) {
        $wp_customize->add_setting("social_{$social}", [
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        
        $wp_customize->add_control("social_{$social}", [
            'label'       => sprintf(__('رابط %s', 'bandar-fit'), ucfirst($social)),
            'section'     => 'bandar_contact',
            'type'        => 'url',
        ]);
    }
    
    // ============================================
    // قسم الـ CTA
    // ============================================
    $wp_customize->add_section('bandar_cta', [
        'title'    => __('قسم الحث على الشراء', 'bandar-fit'),
        'priority' => 50,
    ]);
    
    $wp_customize->add_setting('cta_title', [
        'default'           => 'جاهز للانتقال إلى المستوى التالي؟',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('cta_title', [
        'label'   => __('عنوان القسم', 'bandar-fit'),
        'section' => 'bandar_cta',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('cta_subtitle', [
        'default'           => 'انضم إلى نخبة الرياضيين الذين يثقون بتدريبات كوتش بندر',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('cta_subtitle', [
        'label'   => __('النص الثانوي', 'bandar-fit'),
        'section' => 'bandar_cta',
        'type'    => 'textarea',
    ]);
    
    $wp_customize->add_setting('cta_button_text', [
        'default'           => 'ابدأ الآن',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('cta_button_text', [
        'label'   => __('نص الزر', 'bandar-fit'),
        'section' => 'bandar_cta',
        'type'    => 'text',
    ]);
    
    // ============================================
    // قسم التذييل
    // ============================================
    $wp_customize->add_section('bandar_footer', [
        'title'    => __('التذييل', 'bandar-fit'),
        'priority' => 60,
    ]);
    
    $wp_customize->add_setting('copyright_text', [
        'default'           => 'جميع الحقوق محفوظة',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('copyright_text', [
        'label'   => __('نص حقوق النشر', 'bandar-fit'),
        'section' => 'bandar_footer',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('footer_credits', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    
    $wp_customize->add_control('footer_credits', [
        'label'   => __('إظهار إشباع المطور', 'bandar-fit'),
        'section' => 'bandar_footer',
        'type'    => 'checkbox',
    ]);
}
add_action('customize_register', 'bandar_customize_register');

/**
 * تطبيق إعدادات التخصيص على CSS
 */
function bandar_customizer_css() {
    $primary = get_theme_mod('brand_primary', '#C5A880');
    $dark = get_theme_mod('brand_dark', '#0F0F0F');
    $logo_width = get_theme_mod('logo_width', 200);
    ?>
    <style type="text/css">
        :root {
            --brand-primary: <?php echo esc_attr($primary); ?>;
            --brand-dark: <?php echo esc_attr($dark); ?>;
        }
        
        .custom-logo-link img {
            max-width: <?php echo esc_attr($logo_width); ?>px;
            height: auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'bandar_customizer_css');