<?php
/**
 * القسم الرئيسي (Hero Section)
 * @package BandarFit
 */

// الحصول على الإعدادات من ACF أو Customizer
$hero_title = get_theme_mod('hero_title', 'إعدادك بدنياً مع <span class="gold-text gold-glow">كوتش بندر</span>');
$hero_subtitle = get_theme_mod('hero_subtitle', '"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"');
$hero_tagline = get_theme_mod('hero_tagline', 'Football Performance Architecture');
$hero_image = get_theme_mod('hero_image', BANDAR_IMAGES_URI . '/hero-default.jpg');
?>

<section class="hero-main">
    <div class="hero-background">
        <?php if ($hero_image) : ?>
            <img src="<?php echo esc_url($hero_image); ?>" 
                 alt="<?php esc_attr_e('خلفية الهيرو', 'bandar-fit'); ?>" 
                 class="hero-bg-image">
        <?php endif; ?>
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-inner">
                <span class="hero-tagline"><?php echo esc_html($hero_tagline); ?></span>
                
                <h1 class="hero-title">
                    <?php echo wp_kses_post($hero_title); ?>
                </h1>
                
                <p class="hero-subtitle">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>

                <div class="hero-buttons">
                    <a href="#services" class="btn btn-primary btn-large">
                        <?php _e('ابدأ رحلتك', 'bandar-fit'); ?>
                    </a>
                    <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn btn-outline btn-large">
                        <?php _e('تواصل معنا', 'bandar-fit'); ?>
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label"><?php _e('عميل محترف', 'bandar-fit'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label"><?php _e('رضا العملاء', 'bandar-fit'); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <span class="stat-label"><?php _e('سنة خبرة', 'bandar-fit'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-main {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero-bg-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.4);
    animation: heroKenburns 20s infinite alternate ease-in-out;
}

@keyframes heroKenburns {
    0% { transform: scale(1); }
    100% { transform: scale(1.15); }
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 0%, var(--brand-dark) 95%);
}

.hero-content {
    position: relative;
    z-index: 10;
    padding: 120px 0 80px;
    text-align: center;
}

.hero-inner {
    max-width: 900px;
    margin: 0 auto;
}

.hero-tagline {
    display: inline-block;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: var(--brand-primary);
    margin-bottom: 20px;
}

.hero-title {
    font-size: 48px;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    line-height: 1.1;
    margin-bottom: 20px;
}

@media (min-width: 768px) {
    .hero-title {
        font-size: 72px;
    }
}

.hero-subtitle {
    font-size: 18px;
    color: var(--text-secondary);
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 60px;
    flex-wrap: wrap;
}

.hero-stats {
    display: flex;
    gap: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 32px;
    font-weight: 900;
    color: var(--brand-primary);
    margin-bottom: 5px;
}

.stat-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--text-muted);
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 32px;
    }
    .hero-stats {
        gap: 20px;
    }
    .stat-number {
        font-size: 24px;
    }
}
</style>