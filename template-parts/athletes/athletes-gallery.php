<?php
/**
 * معرض الرياضيين
 * @package BandarFit
 */

// جلب الرياضيين من Custom Post Type
$athletes = get_posts([
    'post_type' => 'athlete',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
]);
?>

<div class="athletes-gallery">
    <?php if (!empty($athletes)) : ?>
        <div class="athletes-grid">
            <?php foreach ($athletes as $athlete) : ?>
                <?php bandar_athlete_card($athlete->ID); ?>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="athletes-placeholder">
            <div class="athletes-grid">
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <div class="athlete-card">
                        <div class="athlete-card-image">
                            <img src="<?php echo BANDAR_IMAGES_URI; ?>/athlete-placeholder.jpg" alt="<?php _e('رياضي نموذج', 'bandar-fit'); ?>">
                            <div class="athlete-card-overlay"></div>
                        </div>
                        <div class="athlete-card-content">
                            <h3 class="athlete-card-name"><?php _e('رياضي نموذج', 'bandar-fit'); ?></h3>
                            <p class="athlete-card-position"><?php _e('لاعب خط وسط', 'bandar-fit'); ?></p>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <p class="athletes-placeholder-text"><?php _e('أضف الرياضيين من لوحة التحكم ← الرياضيون', 'bandar-fit'); ?></p>
        </div>
    <?php endif; ?>
</div>

<style>
.athletes-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(1, 1fr);
}

@media (min-width: 576px) {
    .athletes-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 992px) {
    .athletes-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.athletes-placeholder-text {
    text-align: center;
    margin-top: 1.5rem;
    color: var(--text-muted);
    font-size: 0.875rem;
}
</style>