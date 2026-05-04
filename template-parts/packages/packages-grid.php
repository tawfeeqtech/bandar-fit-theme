<?php
/**
 * شبكة الباقات (منتجات WooCommerce)
 * @package BandarFit
 */

// جلب الباقات من WooCommerce
if (class_exists('WooCommerce')) {
    $packages = wc_get_products([
        'limit' => 3,
        'category' => ['packages'],
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);
}

// إذا لم توجد منتجات، عرض باقات افتراضية
if (empty($packages)) {
    $default_packages = [
        [
            'title' => __('باقة الانطلاق', 'bandar-fit'),
            'subtitle' => __('06 حصص تدريبية', 'bandar-fit'),
            'price' => '1,200',
            'features' => [
                __('حصة تدريبية ميدانية مكثفة', 'bandar-fit'),
                __('تحليل الأحمال البدنية اليومي', 'bandar-fit'),
                __('جدول غذائي رياضي مخصص', 'bandar-fit'),
            ]
        ],
        [
            'title' => __('باقة الاحتراف', 'bandar-fit'),
            'subtitle' => __('12 حصة تدريبية شاملة', 'bandar-fit'),
            'price' => '1,900',
            'featured' => true,
            'features' => [
                __('حصص تدريبية ميدانية أسبوعية', 'bandar-fit'),
                __('نظام تتبع الأحمال الرقمي', 'bandar-fit'),
                __('برنامج غذائي متكامل حسب الهدف', 'bandar-fit'),
                __('بروتوكول استشفاء ووقاية شامل', 'bandar-fit'),
            ]
        ],
        [
            'title' => __('باقة النخبة', 'bandar-fit'),
            'subtitle' => __('24 حصة تدريبية', 'bandar-fit'),
            'price' => '3,399',
            'features' => [
                __('اختبارات بدنية كاملة', 'bandar-fit'),
                __('برنامج إعداد بدني طويل المدى', 'bandar-fit'),
                __('متابعة أسبوعية مع كوتش بندر', 'bandar-fit'),
            ]
        ]
    ];
    ?>
    <div class="packages-grid">
        <?php foreach ($default_packages as $package) : ?>
            <div class="price-card <?php echo isset($package['featured']) ? 'featured' : ''; ?>">
                <?php if (isset($package['featured'])) : ?>
                    <div class="price-card-badge"><?php _e('الأكثر طلباً', 'bandar-fit'); ?></div>
                <?php endif; ?>
                <h3 class="price-card-title"><?php echo esc_html($package['title']); ?></h3>
                <p class="price-card-subtitle"><?php echo esc_html($package['subtitle']); ?></p>
                <div class="price-amount">
                    <span class="price-number"><?php echo esc_html($package['price']); ?></span>
                    <span class="price-currency"><?php _e('ريال', 'bandar-fit'); ?></span>
                </div>
                <ul class="price-features">
                    <?php foreach ($package['features'] as $feature) : ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <?php echo esc_html($feature); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn <?php echo isset($package['featured']) ? 'btn-primary' : 'btn-secondary'; ?> btn-block">
                    <?php _e('اطلب الباقة', 'bandar-fit'); ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return;
}
?>

<div class="packages-grid">
    <?php foreach ($packages as $index => $product) : 
        $is_featured = $index === 1; // جعل المنتج الثاني مميزاً
    ?>
        <div class="price-card <?php echo $is_featured ? 'featured' : ''; ?>">
            <?php if ($is_featured) : ?>
                <div class="price-card-badge"><?php _e('الأكثر طلباً', 'bandar-fit'); ?></div>
            <?php endif; ?>
            
            <h3 class="price-card-title"><?php echo esc_html($product->get_name()); ?></h3>
            <p class="price-card-subtitle"><?php echo esc_html($product->get_short_description()); ?></p>
            
            <div class="price-amount">
                <span class="price-number"><?php echo esc_html(number_format($product->get_price())); ?></span>
                <span class="price-currency"><?php echo esc_html(get_woocommerce_currency_symbol()); ?></span>
            </div>
            
            <div class="price-description">
                <?php echo wp_kses_post($product->get_description()); ?>
            </div>
            
            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn <?php echo $is_featured ? 'btn-primary' : 'btn-secondary'; ?> btn-block">
                <?php _e('اطلب الباقة', 'bandar-fit'); ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>

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