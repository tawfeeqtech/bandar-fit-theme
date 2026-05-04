<?php
/**
 * قسم الحث على الشراء (Call to Action)
 * @package BandarFit
 */

$cta_title = get_theme_mod('cta_title', __('جاهز للانتقال إلى المستوى التالي؟', 'bandar-fit'));
$cta_subtitle = get_theme_mod('cta_subtitle', __('انضم إلى نخبة الرياضيين الذين يثقون بتدريبات كوتش بندر', 'bandar-fit'));
$cta_button_text = get_theme_mod('cta_button_text', __('ابدأ الآن', 'bandar-fit'));
?>

<section class="cta-section">
    <div class="container">
        <div class="cta-wrapper">
            <div class="cta-content">
                <span class="cta-tagline"><?php _e('احجز مكانك الآن', 'bandar-fit'); ?></span>
                <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
                <p class="cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
                
                <div class="cta-buttons">
                    <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn btn-primary btn-large">
                        <?php echo esc_html($cta_button_text); ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <?php if (class_exists('WooCommerce') && wc_get_page_id('shop')) : ?>
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-outline btn-large">
                        <?php _e('استكشف الباقات', 'bandar-fit'); ?>
                    </a>
                    <?php else : ?>
                    <a href="#" class="btn btn-outline btn-large" onclick="window.location.href='<?php echo home_url('/contact'); ?>'; return false;">
                        <?php _e('استكشف الباقات', 'bandar-fit'); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="cta-features">
                    <div class="cta-feature">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4l3 3"/>
                        </svg>
                        <span><?php _e('دعم فوري', 'bandar-fit'); ?></span>
                    </div>
                    <div class="cta-feature">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span><?php _e('جدول مرن', 'bandar-fit'); ?></span>
                    </div>
                    <div class="cta-feature">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 12H4M12 4v16"/>
                        </svg>
                        <span><?php _e('نتائج مضمونة', 'bandar-fit'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.cta-section {
    position: relative;
    padding: 80px 0;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, rgba(197, 168, 128, 0.1) 100%);
    overflow: hidden;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.05"><path fill="%23C5A880" d="M100 0L120 70L200 70L135 115L155 185L100 140L45 185L65 115L0 70L80 70L100 0Z"/></svg>');
    background-repeat: repeat;
    background-size: 40px;
    pointer-events: none;
}

.cta-wrapper {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.cta-tagline {
    display: inline-block;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--brand-primary);
    margin-bottom: 20px;
}

.cta-title {
    font-size: 42px;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    margin-bottom: 15px;
}

@media (min-width: 768px) {
    .cta-title {
        font-size: 56px;
    }
}

.cta-subtitle {
    font-size: 18px;
    color: var(--text-secondary);
    margin-bottom: 40px;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 50px;
    flex-wrap: wrap;
}

.cta-features {
    display: flex;
    gap: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-feature {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: var(--text-muted);
}

.cta-feature svg {
    color: var(--brand-primary);
}
</style>