<?php
/**
 * صفحة الخطأ 404
 * @package BandarFit
 */

get_header(); ?>

<div class="error-404-page">
    <div class="container">
        <div class="error-content text-center">
            <div class="error-code">
                <span>4</span>
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>4</span>
            </div>
            <h1 class="error-title"><?php _e('عذراً! الصفحة غير موجودة', 'bandar-fit'); ?></h1>
            <p class="error-message"><?php _e('يبدو أنك قد ضللت الطريق. الصفحة التي تبحث عنها لا exist أو تم نقلها.', 'bandar-fit'); ?></p>
            
            <div class="error-actions">
                <a href="<?php echo home_url('/'); ?>" class="btn btn-primary">
                    <?php _e('العودة إلى الرئيسية', 'bandar-fit'); ?>
                </a>
                <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn btn-secondary">
                    <?php _e('تواصل معنا', 'bandar-fit'); ?>
                </a>
            </div>
            
            <div class="error-search">
                <p><?php _e('أو يمكنك البحث هنا:', 'bandar-fit'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<style>
.error-404-page {
    min-height: 70vh;
    display: flex;
    align-items: center;
    padding: 80px 0;
}
.error-code {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
}
.error-code span {
    font-size: 120px;
    font-weight: 900;
    color: var(--brand-primary);
}
.error-code svg {
    color: var(--brand-primary);
}
.error-title {
    font-size: 32px;
    margin-bottom: 20px;
}
.error-message {
    color: var(--text-secondary);
    margin-bottom: 40px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}
.error-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 50px;
    flex-wrap: wrap;
}
.error-search {
    max-width: 400px;
    margin: 0 auto;
}
.error-search p {
    margin-bottom: 15px;
    color: var(--text-muted);
}
@media (max-width: 768px) {
    .error-code span {
        font-size: 70px;
    }
    .error-code svg {
        width: 50px;
        height: 50px;
    }
    .error-title {
        font-size: 24px;
    }
}
</style>

<?php get_footer(); ?>