<?php
/**
 * شبكة الباقات
 * @package BandarFit
 */

// جلب الباقات من قاعدة البيانات
$packages_query = new WP_Query([
    'post_type' => 'package',
    'posts_per_page' => 3,
    'meta_query' => [
        'relation' => 'OR',
        [
            'key' => '_package_style',
            'value' => 'standard',
        ],
        [
            'key' => '_package_style',
            'compare' => 'NOT EXISTS',
        ]
    ],
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

if ($packages_query->have_posts()) :
?>

<div class="packages-grid">
    <?php while ($packages_query->have_posts()) : $packages_query->the_post(); 
        $post_id = get_the_ID();
        $subtitle = get_post_meta($post_id, '_package_subtitle', true);
        $price = get_post_meta($post_id, '_package_price', true);
        $currency = get_post_meta($post_id, '_package_currency', true) ?: 'ريال';
        $button_text = get_post_meta($post_id, '_package_button_text', true) ?: 'اطلب الباقة';
        $is_featured = get_post_meta($post_id, '_package_is_featured', true) === '1';
        $features_raw = get_post_meta($post_id, '_package_features', true);
        $features = explode("\n", str_replace("\r", "", $features_raw));
    ?>
        <div class="price-card <?php echo $is_featured ? 'featured' : ''; ?>">
            <?php if ($is_featured) : ?>
                <div class="price-card-badge"><?php _e('الأكثر طلباً', 'bandar-fit'); ?></div>
            <?php endif; ?>
            <h3 class="price-card-title"><?php the_title(); ?></h3>
            <p class="price-card-subtitle"><?php echo esc_html($subtitle); ?></p>
            <div class="price-amount">
                <span class="price-number"><?php echo esc_html($price); ?></span>
                <span class="price-currency"><?php echo esc_html($currency); ?></span>
            </div>
            <ul class="price-features">
                <?php foreach ($features as $feature) : if (trim($feature)) : ?>
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <?php echo esc_html(trim($feature)); ?>
                    </li>
                <?php endif; endforeach; ?>
            </ul>
            <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn <?php echo $is_featured ? 'btn-primary' : 'btn-secondary'; ?> btn-block">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php else : ?>
    <!-- باقات افتراضية في حال عدم وجود محتوى -->
    <div class="packages-grid">
        <div class="price-card">
            <h3 class="price-card-title">باقة الانطلاق</h3>
            <p class="price-card-subtitle">06 حصص تدريبية</p>
            <div class="price-amount">
                <span class="price-number">1,200</span>
                <span class="price-currency">ريال</span>
            </div>
            <ul class="price-features">
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> حصة تدريبية ميدانية مكثفة</li>
            </ul>
            <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn btn-secondary btn-block">اطلب الباقة</a>
        </div>
    </div>
<?php endif; ?>

<style>
.packages-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 30px;
    align-items: center;
    margin-top: 50px;
}

@media (min-width: 768px) {
    .packages-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.price-card {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 40px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
}

.price-card.featured {
    border: 2px solid var(--brand-primary);
    transform: scale(1.05);
    box-shadow: var(--shadow-2xl);
    background: linear-gradient(135deg, var(--bg-secondary) 0%, rgba(197, 168, 128, 0.05) 100%);
}

@media (max-width: 768px) {
    .price-card.featured {
        transform: scale(1);
    }
}

.price-card-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--brand-primary);
    color: var(--brand-dark);
    font-size: 11px;
    font-weight: 900;
    padding: 6px 20px;
    border-radius: 50px;
    text-transform: uppercase;
    white-space: nowrap;
}

.price-card-title {
    font-size: 24px;
    font-weight: 900;
    font-style: italic;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.price-card-subtitle {
    color: var(--text-muted);
    font-size: 12px;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.price-amount {
    margin-bottom: 25px;
}

.price-number {
    font-size: 48px;
    font-weight: 900;
    color: var(--brand-primary);
}

.price-currency {
    font-size: 14px;
    color: var(--text-muted);
}

.price-description {
    color: var(--text-secondary);
    font-size: 14px;
    margin-bottom: 30px;
}

.price-features {
    list-style: none;
    margin-bottom: 30px;
}

.price-features li {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 8px 0;
    font-size: 13px;
}

.price-features svg {
    color: var(--brand-primary);
    flex-shrink: 0;
}

.btn-block {
    display: block;
    width: 100%;
}
</style>