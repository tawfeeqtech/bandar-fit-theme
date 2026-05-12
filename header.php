<!DOCTYPE html>
<html <?php echo bandar_language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <meta name="theme-color" content="#0F0F0F">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    
    <?php wp_head(); ?>
    
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php bloginfo('name'); ?>">
    <meta itemprop="description" content="<?php bloginfo('description'); ?>">
    
    <!-- Open Graph meta -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:image" content="<?php echo BANDAR_IMAGES_URI; ?>/og-image.jpg">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo BANDAR_IMAGES_URI; ?>/twitter-card.jpg">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ============================================
     WhatsApp Floating Button
     ============================================ -->
<?php if (get_theme_mod('footer_whatsapp_floating_enable', true)) : ?>
<a href="<?php echo bandar_get_whatsapp_url(); ?>" 
   target="_blank" 
   class="whatsapp-float" 
   title="<?php esc_attr_e('تواصل معنا عبر واتساب', 'bandar-fit'); ?>"
   rel="noopener noreferrer">
    <svg class="w-8 h-8 fill-current" viewBox="0 0 448 512"> 
        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.7 17.8 69.4 27.2 106.2 27.2 122.4 0 222-99.6 222-222 0-59.3-23-115.1-65-157.1zM223.9 446.3c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 365.9l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.5-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 54 81.2 54 130.4 0 101.7-82.8 184.5-184.5 184.5zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.1-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.5-.3-8.5 2.5-11.2 2.5-2.6 5.5-6.5 8.3-9.7 2.8-3.2 3.7-5.5 5.6-9.2 1.9-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path> 
    </svg> 
</a>
<?php endif; ?>

<!-- ============================================
     Top Bar
     ============================================ -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-inner">
            <div class="top-bar-brand">
                <span class="top-bar-text">
                    <?php echo get_theme_mod('top_bar_text', __('BANDAR PERFORMANCE ARCHITECTURE', 'bandar-fit')); ?>
                </span>
            </div>
            <div class="top-bar-social">
                <?php
                $social_links = bandar_get_social_links();
                foreach ($social_links as $platform => $link) {
                    if ($link && $link !== '#') {
                        echo '<a href="' . esc_url($link) . '" class="top-bar-social-link" target="_blank" rel="noopener noreferrer">';
                        echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
                        switch ($platform) {
                            case 'instagram':
                                echo '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>';
                                break;
                            case 'twitter':
                                echo '<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>';
                                break;
                            default:
                                echo '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>';
                        }
                        echo '</svg>';
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     Main Header
     ============================================ -->
<header class="site-header" id="mainHeader" role="banner" aria-label="<?php esc_attr_e('الرأس الرئيسي', 'bandar-fit'); ?>">
    <div class="container">
        <div class="header-inner">
            <div class="site-logo" role="banner">
                <?php bandar_logo(); ?>
            </div>
            
            <nav class="primary-nav" role="navigation" aria-label="<?php esc_attr_e('القائمة الرئيسية', 'bandar-fit'); ?>">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => false,
                    'depth' => 2,
                    'walker' => new Bandar_Walker_Nav_Menu(),
                ]); ?>
            </nav>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn" 
                    aria-label="<?php esc_attr_e('فتح القائمة', 'bandar-fit'); ?>"
                    aria-expanded="false"
                    aria-controls="mobileMenuOverlay">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
                <span class="screen-reader-text"><?php _e('القائمة', 'bandar-fit'); ?></span>
            </button>
        </div>
    </div>
</header>

<!-- ============================================
     Mobile Menu Overlay
     ============================================ -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay" 
     role="dialog" 
     aria-modal="true" 
     aria-label="<?php esc_attr_e('القائمة المتنقلة', 'bandar-fit'); ?>"
     hidden>
    <div class="mobile-menu-header">
        <div class="site-logo">
            <?php bandar_logo(); ?>
        </div>
        <button class="mobile-menu-close" id="mobileMenuClose" 
                aria-label="<?php esc_attr_e('إغلاق القائمة', 'bandar-fit'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    
    <nav class="mobile-nav" role="navigation" aria-label="<?php esc_attr_e('القائمة المتنقلة', 'bandar-fit'); ?>">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class' => 'mobile-nav-menu',
            'container' => false,
            'fallback_cb' => false,
        ]);
        ?>
    </nav>
    
    <div class="mobile-menu-footer">
        <a href="<?php echo bandar_get_whatsapp_url(); ?>" 
           class="btn btn-primary btn-large w-full"
           aria-label="<?php esc_attr_e('تواصل معنا عبر واتساب', 'bandar-fit'); ?>">
            <?php _e('تواصل معنا عبر واتساب', 'bandar-fit'); ?>
        </a>
    </div>
</div>

<main id="main-content">