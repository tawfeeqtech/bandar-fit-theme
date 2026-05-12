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
        'description' => __('إعدادات الشعار والألوان الأساسية للثيم', 'bandar-fit'),
    ]);
    
    // الشعار (تم دعمه مسبقاً من WordPress)
    $wp_customize->add_setting('logo_width', [
        'default'           => 200,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control('logo_width', [
        'label'       => __('عرض الشعار (بكسل)', 'bandar-fit'),
        'section'     => 'bandar_brand',
        'type'        => 'number',
        'input_attrs' => ['min' => 50, 'max' => 300],
        'description' => __('تحكم في عرض الشعار في الموقع', 'bandar-fit'),
    ]);
    
    // ============================================
    // الألوان الأساسية
    // ============================================
    $wp_customize->add_setting('brand_primary', [
        'default'           => '#C5A880',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_primary', [
        'label'    => __('اللون الأساسي', 'bandar-fit'),
        'section'  => 'bandar_brand',
        'description' => __('اللون الرئيسي للعناوين والأزرار', 'bandar-fit'),
    ]));
    
    $wp_customize->add_setting('brand_dark', [
        'default'           => '#0F0F0F',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_dark', [
        'label'    => __('لون الخلفية', 'bandar-fit'),
        'section'  => 'bandar_brand',
        'description' => __('لون خلفية الموقع الرئيسية', 'bandar-fit'),
    ]));
    
    // ============================================
    // قسم الهيرو
    // ============================================
    $wp_customize->add_section('bandar_hero', [
        'title'    => __('قسم الهيرو', 'bandar-fit'),
        'priority' => 30,
        'description' => __('تخصيص محتوى قسم الهيرو الرئيسي', 'bandar-fit'),
    ]);
    
    // عنوان الهيرو الرئيسي
    $wp_customize->add_setting('hero_title', [
        'default'           => 'إعدادك بدنياً مع كوتش بندر',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control('hero_title', [
        'label'       => __('عنوان الهيرو الرئيسي', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'text',
        'description' => __('العنوان الكبير في قسم الهيرو', 'bandar-fit'),
    ]);
    
    // النص الثانوي للهيرو
    $wp_customize->add_setting('hero_subtitle', [
        'default'           => '"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control('hero_subtitle', [
        'label'       => __('النص الثانوي للهيرو', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'textarea',
        'description' => __('النص التوضيحي تحت العنوان الرئيسي', 'bandar-fit'),
    ]);
    
    // الشفرة العلوية للهيرو
    $wp_customize->add_setting('hero_tagline', [
        'default'           => 'Football Performance Architecture',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    
    $wp_customize->add_control('hero_tagline', [
        'label'       => __('الشفرة العلوية', 'bandar-fit'),
        'section'     => 'bandar_hero',
        'type'        => 'text',
        'description' => __('النص الصغير في أعلى قسم الهيرو', 'bandar-fit'),
    ]);
    
    
    // ============================================
    // قسم عناوين المنهجية
    // ============================================
    $wp_customize->add_section('bandar_methodology', [
        'title'    => __('عناوين المنهجية', 'bandar-fit'),
        'priority' => 25,
    ]);
    
    // العنوان الفرعي (Professional Methodology)
    $wp_customize->add_setting('methodology_subtitle', [
        'default'           => 'Professional Methodology',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('methodology_subtitle', [
        'label'       => __('العنوان الفرعي (إنجليزي)', 'bandar-fit'),
        'section'     => 'bandar_methodology',
        'type'        => 'text',
        'description' => __('العنوان الفرعي الصغير فوق العنوان الرئيسي', 'bandar-fit'),
    ]);
    
    // العنوان الرئيسي (هندسة الأداء البدني)
    $wp_customize->add_setting('methodology_title', [
        'default'           => 'هندسة الأداء البدني',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('methodology_title', [
        'label'       => __('العنوان الرئيسي', 'bandar-fit'),
        'section'     => 'bandar_methodology',
        'type'        => 'text',
        'description' => __('العنوان الرئيسي الكبير للقسم', 'bandar-fit'),
    ]);
    
    // الوصف (5 خطوات علمية...)
    $wp_customize->add_setting('methodology_description', [
        'default'           => '5 خطوات علمية لنقل مستواك من الهاوي إلى المحترف تحت إشراف كوتش بندر.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('methodology_description', [
        'label'       => __('الوصف', 'bandar-fit'),
        'section'     => 'bandar_methodology',
        'type'        => 'textarea',
        'description' => __('الوصف التفصيلي تحت العنوان الرئيسي', 'bandar-fit'),
    ]);
    
    // ============================================
    // قسم كواليس صناعة الأبطال
    // ============================================
    $wp_customize->add_section('bandar_behind_the_scenes', [
        'title'    => __('كواليس صناعة الأبطال', 'bandar-fit'),
        'priority' => 30,
    ]);
    
    // العنوان الرئيسي
    $wp_customize->add_setting('behind_scenes_title', [
        'default'           => 'كواليس صناعة الأبطال',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_title', [
        'label'       => __('العنوان الرئيسي', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'text',
        'description' => __('عنوان القسم الرئيسي', 'bandar-fit'),
    ]);
    
    // الوصف الرئيسي
    $wp_customize->add_setting('behind_scenes_description', [
        'default'           => 'في هذه الجلسات الميدانية، ننتقل من مجرد التمارين العادية إلى **هندسة الحركة الواقعية**. نقوم بمحاكاة سيناريوهات المباراة الحقيقية لتطوير سرعتك الانفجارية، رشاقتك التكتيكية، وقوة التحمل تحت الضغط.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_description', [
        'label'       => __('الوصف الرئيسي', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'textarea',
        'description' => __('الوصف التفصيلي للقسم (يدعم HTML)', 'bandar-fit'),
    ]);
    
    // رابط الفيديو
    $wp_customize->add_setting('behind_scenes_video_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_video_url', [
        'label'       => __('رابط الفيديو', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'url',
        'description' => __('رابط الفيديو (YouTube/Vimeo/MP4)', 'bandar-fit'),
    ]);
    
    // صورة الفيديو (Thumbnail)
    $wp_customize->add_setting('behind_scenes_video_thumbnail', [
        'default'           => 'https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?q=80&w=800',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'behind_scenes_video_thumbnail', [
        'label'    => __('صورة الفيديو (Thumbnail)', 'bandar-fit'),
        'section'  => 'bandar_behind_the_scenes',
        'description' => __('صورة الغلاف للفيديو', 'bandar-fit'),
    ]));
    
    // الميزة الأولى
    $wp_customize->add_setting('behind_scenes_feature1_icon', [
        'default'           => 'target',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_feature1_icon', [
        'label'       => __('أيقونة الميزة الأولى (Lucide)', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'text',
        'description' => __('مثال: target, zap, shield, star', 'bandar-fit'),
    ]);
    
    $wp_customize->add_setting('behind_scenes_feature1_text', [
        'default'           => 'تطوير التوافق العضلي العصبي لرد فعل أسرع.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_feature1_text', [
        'label'       => __('نص الميزة الأولى', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'text',
    ]);
    
    // الميزة الثانية
    $wp_customize->add_setting('behind_scenes_feature2_icon', [
        'default'           => 'zap',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_feature2_icon', [
        'label'       => __('أيقونة الميزة الثانية (Lucide)', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'text',
        'description' => __('مثال: target, zap, shield, star', 'bandar-fit'),
    ]);
    
    $wp_customize->add_setting('behind_scenes_feature2_text', [
        'default'           => 'استخدام أدوات قياس اللحظة لزيادة السرعة القصوى.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('behind_scenes_feature2_text', [
        'label'       => __('نص الميزة الثانية', 'bandar-fit'),
        'section'     => 'bandar_behind_the_scenes',
        'type'        => 'text',
    ]);
    
    
    
    // ============================================
    // قسم إعدادات الفوتر المبسط
    // ============================================
    $wp_customize->add_section('bandar_footer', [
        'title'    => __('إعدادات الفوتر', 'bandar-fit'),
        'priority' => 65,
    ]);
    
    // اسم العلامة التجارية
    $wp_customize->add_setting('footer_brand_name', [
        'default'           => 'BANDAR FIT',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_brand_name', [
        'label'       => __('اسم العلامة التجارية', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'text',
    ]);
    
    // رقم WhatsApp (تم نقله لقسم واتساب المخصص)
    
    // حقوق الطبع والنشر
    $wp_customize->add_setting('footer_copyright_text', [
        'default'           => '2026 BANDAR FIT | جميع الحقوق محفوظة © 2026 كوتش بندر',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_copyright_text', [
        'label'       => __('نص حقوق الطبع والنشر (كامل)', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'textarea',
        'description' => __('يمكنك كتابة النص بالكامل هنا، سيحل محل السطر السفلي في الفوتر', 'bandar-fit'),
    ]);
    
    // رابط Instagram
    $wp_customize->add_setting('footer_instagram_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_instagram_url', [
        'label'       => __('رابط Instagram', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'url',
    ]);
    
    // أيقونة Instagram SVG
    $wp_customize->add_setting('footer_instagram_svg', [
        'default'           => '<i data-lucide="instagram" class="w-5 h-5"></i>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_instagram_svg', [
        'label'       => __('أيقونة Instagram (SVG)', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'textarea',
        'description' => __('أيقونة Instagram مخصصة أو اتركها فارغة لاستخدام الافتراضية', 'bandar-fit'),
    ]);
    
    // رابط TikTok
    $wp_customize->add_setting('footer_tiktok_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_tiktok_url', [
        'label'       => __('رابط TikTok', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'url',
    ]);
    
    // أيقونة TikTok SVG
    $wp_customize->add_setting('footer_tiktok_svg', [
        'default'           => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="music-2" aria-hidden="true" class="lucide lucide-music-2 w-5 h-5"><circle cx="8" cy="18" r="4"></circle><path d="M12 18V2l7 4"></path></svg>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_tiktok_svg', [
        'label'       => __('أيقونة TikTok (SVG)', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'textarea',
        'description' => __('أيقونة TikTok مخصصة أو اتركها فارغة لاستخدام الافتراضية', 'bandar-fit'),
    ]);
    
    // رابط Twitter
    $wp_customize->add_setting('footer_twitter_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_twitter_url', [
        'label'       => __('رابط Twitter', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'url',
    ]);
    
    // أيقونة Twitter SVG
    $wp_customize->add_setting('footer_twitter_svg', [
        'default'           => '<i data-lucide="twitter" class="w-5 h-5"></i>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_twitter_svg', [
        'label'       => __('أيقونة Twitter (SVG)', 'bandar-fit'),
        'section'     => 'bandar_footer',
        'type'        => 'textarea',
        'description' => __('أيقونة Twitter مخصصة أو اتركها فارغة لاستخدام الافتراضية', 'bandar-fit'),
    ]);
    
    // --- زر واتساب العائم (تم نقله لقسم واتساب المخصص)
    
    // تم دمج هذا الحقل مع النص الكامل أعلاه

    // ============================================
    // قسم إعدادات واتساب الموحد
    // ============================================
    $wp_customize->add_section('bandar_whatsapp', [
        'title'    => __('إعدادات واتساب', 'bandar-fit'),
        'priority' => 66,
    ]);

    // رقم واتساب الموحد
    $wp_customize->add_setting('whatsapp_number', [
        'default'           => '966500000000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('whatsapp_number', [
        'label'       => __('رقم واتساب الأساسي', 'bandar-fit'),
        'description' => __('أدخل الرقم مع رمز الدولة بدون + أو أصفار (مثال: 9665xxxxxxxx)', 'bandar-fit'),
        'section'     => 'bandar_whatsapp',
        'type'        => 'text',
    ]);

    // رسالة واتساب الافتراضية
    $wp_customize->add_setting('whatsapp_message', [
        'default'           => 'مرحباً، أريد الاستفسار عن خدمات BANDAR FIT',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('whatsapp_message', [
        'label'       => __('رسالة واتساب التلقائية', 'bandar-fit'),
        'section'     => 'bandar_whatsapp',
        'type'        => 'textarea',
    ]);

    // تفعيل الزر العائم
    $wp_customize->add_setting('footer_whatsapp_floating_enable', [
        'default'           => true,
        'sanitize_callback' => 'bandar_sanitize_checkbox',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_whatsapp_floating_enable', [
        'label'    => __('تفعيل زر واتساب العائم', 'bandar-fit'),
        'section'  => 'bandar_whatsapp',
        'type'     => 'checkbox',
    ]);

    // لون الزر العائم
    $wp_customize->add_setting('footer_whatsapp_floating_color', [
        'default'           => '#25D366',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_whatsapp_floating_color', [
        'label'    => __('لون الزر العائم', 'bandar-fit'),
        'section'  => 'bandar_whatsapp',
    ]));

    // موقع الزر العائم
    $wp_customize->add_setting('footer_whatsapp_floating_position', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    
    $wp_customize->add_control('footer_whatsapp_floating_position', [
        'label'    => __('موقع الزر العائم', 'bandar-fit'),
        'section'  => 'bandar_whatsapp',
        'type'     => 'select',
        'choices'  => [
            'left'  => __('يسار', 'bandar-fit'),
            'right' => __('يمين', 'bandar-fit'),
        ],
    ]);
}
add_action('customize_register', 'bandar_customize_register');

/**
 * وظيفة لتنظيف خانة الاختيار (Checkbox Sanitization)
 */
function bandar_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

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

        .whatsapp-float {
            background-color: <?php echo esc_attr(get_theme_mod('footer_whatsapp_floating_color', '#25D366')); ?>;
            <?php echo (get_theme_mod('footer_whatsapp_floating_position', 'right') === 'right') ? 'right: 30px;' : 'left: 30px;'; ?>
            display: <?php echo get_theme_mod('footer_whatsapp_floating_enable', true) ? 'flex' : 'none'; ?>;
        }

        /* Hero section dynamic styles */
        .hero-title {
            color: var(--brand-primary);
        }
        
        .hero-subtitle {
            color: var(--brand-primary);
        }
        
        .hero-tagline {
            color: var(--brand-primary);
        }
    </style>
    <?php
}
add_action('wp_head', 'bandar_customizer_css');