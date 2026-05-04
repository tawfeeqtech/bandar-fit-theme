<?php
/**
 * تحسين الأداء والتخزين المؤقت
 * @package BandarFit
 */

/**
 * إزالة استعلامات CSS/JS غير الضرورية
 */
function bandar_remove_unused_assets() {
    // إزالة أنماط Gutenberg من الواجهة الأمامية
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    
    // إزالة أنماط التعليقات غير الضرورية
    if (!is_singular() && !is_admin()) {
        wp_deregister_script('comment-reply');
    }
    
    // إزالة إصدار WordPress من الروابط
    remove_action('wp_head', 'wp_generator');
    
    // إزالة روابط REST API
    remove_action('wp_head', 'rest_output_link_wp_head');
    
    // إزالة روابط oEmbed
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    
    // إزالة روابط الإصدارات
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('wp_enqueue_scripts', 'bandar_remove_unused_assets', 100);

/**
 * إضافة سمات defer و async للـ JS
 */
function bandar_add_defer_attributes($tag, $handle, $src) {
    // قائمة بالملفات التي تريد إضافة defer لها
    $defer_handles = ['bandar-main', 'bandar-animations', 'bandar-whatsapp'];
    
    // قائمة بالملفات التي تريد إضافة async لها
    $async_handles = ['jquery'];
    
    if (in_array($handle, $defer_handles)) {
        return '<script src="' . $src . '" defer></script>';
    }
    
    if (in_array($handle, $async_handles)) {
        return '<script src="' . $src . '" async></script>';
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'bandar_add_defer_attributes', 10, 3);

/**
 * إضافة سمات preload للخطوط
 */
function bandar_preload_fonts() {
    ?>
    <link rel="preload" href="https://fonts.gstatic.com/s/cairo/v28/SLXGc1nY6HkvalIkTpu0xg.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action('wp_head', 'bandar_preload_fonts', 1);

/**
 * تحسين تحميل الصور (Lazy Loading)
 */
function bandar_add_lazy_loading($content) {
    if (is_admin()) {
        return $content;
    }
    
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    $content = preg_replace('/<iframe(.*?)src=/i', '<iframe$1loading="lazy" src=', $content);
    
    return $content;
}
add_filter('the_content', 'bandar_add_lazy_loading');

/**
 * إضافة سمات sizes للصور المصغرة
 */
function bandar_add_img_sizes_attr($attr, $attachment, $size) {
    if (is_array($size) || $size === 'full') {
        $attr['sizes'] = '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw';
    } elseif ($size === 'large') {
        $attr['sizes'] = '(max-width: 768px) 100vw, 1024px';
    } elseif ($size === 'medium') {
        $attr['sizes'] = '(max-width: 768px) 50vw, 300px';
    }
    
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'bandar_add_img_sizes_attr', 10, 3);

/**
 * تخزين مؤقت للاستعلامات
 */
function bandar_cache_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // تفعيل التخزين المؤقت لمدة ساعة
    $query->set('cache_results', true);
}
add_action('pre_get_posts', 'bandar_cache_query');

/**
 * إضافة رؤوس التخزين المؤقت للمتصفح
 */
function bandar_add_cache_headers() {
    if (is_user_logged_in() || is_admin()) {
        return;
    }
    
    $expires = 7 * 24 * 60 * 60; // 7 أيام
    
    header('Cache-Control: public, max-age=' . $expires);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
}
add_action('send_headers', 'bandar_add_cache_headers');

/**
 * تقليل حجم HTML عن طريق إزالة المسافات الزائدة
 */
function bandar_minify_html($html) {
    if (is_admin() || defined('WP_DEBUG') && WP_DEBUG) {
        return $html;
    }
    
    $search = [
        '/\>[^\S ]+/s',     // إزالة المسافات بعد علامات الإغلاق
        '/[^\S ]+\</s',     // إزالة المسافات قبل علامات الفتح
        '/(\s)+/s',         // تقليل المسافات المتعددة
        '/<!--(.|\s)*?-->/' // إزالة التعليقات
    ];
    
    $replace = ['>', '<', '\\1', ''];
    
    $html = preg_replace($search, $replace, $html);
    
    return $html;
}
add_filter('final_output', 'bandar_minify_html');
ob_start('bandar_minify_html');

/**
 * تعطيل تعقب الإصدارات في CSS/JS
 */
function bandar_remove_version_from_assets($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'bandar_remove_version_from_assets', 9999);
add_filter('script_loader_src', 'bandar_remove_version_from_assets', 9999);

/**
 * دمج CSS في ملف واحد في الإنتاج
 */
function bandar_combine_css() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        return;
    }
    
    // يمكن إضافة منطق لدمج الملفات هنا
}
add_action('wp_enqueue_scripts', 'bandar_combine_css', 99);


// inc/performance.php - إضافة Critical CSS
function bandar_add_critical_css() {
    if (is_admin()) return;
    
    $critical_css = '
        /* Critical CSS for above-the-fold content */
        body {
            background-color: #0F0F0F;
            color: #FFFFFF;
            font-family: "Cairo", sans-serif;
            margin: 0;
            padding: 0;
        }
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 110;
            background: rgba(26, 26, 26, 0.9);
            backdrop-filter: blur(12px);
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .hero-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-weight: 900;
            text-decoration: none;
            border-radius: 50px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #C5A880, #A68B63);
            color: #0F0F0F;
        }
    ';
    
    wp_register_style('bandar-critical', false);
    wp_enqueue_style('bandar-critical');
    wp_add_inline_style('bandar-critical', $critical_css);
}
add_action('wp_enqueue_scripts', 'bandar_add_critical_css', 5);


// inc/performance.php - إضافة preload
function bandar_add_preload_links() {
    ?>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php
    $hero_image = get_theme_mod('hero_image', BANDAR_IMAGES_URI . '/hero-default.jpg');
    if ($hero_image) {
        echo '<link rel="preload" as="image" href="' . esc_url($hero_image) . '">';
    }
    ?>
    <?php
}
add_action('wp_head', 'bandar_add_preload_links', 1);

// inc/performance.php - إضافة Schema.org
function bandar_add_schema_markup() {
    if (is_singular('product')) {
        // Product schema
        $product = wc_get_product(get_the_ID());
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<?php echo esc_js($product->get_name()); ?>",
            "description": "<?php echo esc_js(strip_tags($product->get_short_description())); ?>",
            "offers": {
                "@type": "Offer",
                "priceCurrency": "SAR",
                "price": "<?php echo esc_js($product->get_price()); ?>",
                "availability": "https://schema.org/InStock"
            }
        }
        </script>
        <?php
    } elseif (is_front_page()) {
        // LocalBusiness schema
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SportsClub",
            "name": "<?php bloginfo('name'); ?>",
            "description": "<?php bloginfo('description'); ?>",
            "url": "<?php echo home_url(); ?>",
            "logo": "<?php echo wp_get_attachment_url(get_theme_mod('custom_logo')); ?>",
            "sameAs": [
                <?php
                $socials = bandar_get_social_links();
                $links = [];
                foreach ($socials as $url) {
                    if ($url && $url !== '#') {
                        $links[] = '"' . esc_url($url) . '"';
                    }
                }
                echo implode(',', $links);
                ?>
            ]
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'bandar_add_schema_markup', 20);