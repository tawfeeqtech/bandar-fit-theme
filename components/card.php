<?php
/**
 * مكون البطاقة Card Component
 * @package BandarFit
 */

/**
 * بطاقة خدمة Service Card
 */
function bandar_service_card($title, $description, $icon, $link = '#', $price = null) {
    ob_start();
    ?>
    <div class="service-card" onclick="location.href='<?php echo esc_url($link); ?>'">
        <div class="service-card-icon">
            <i data-lucide="<?php echo esc_attr($icon); ?>" width="32" height="32"></i>
        </div>
        <h3 class="service-card-title"><?php echo esc_html($title); ?></h3>
        <p class="service-card-subtitle"><?php echo esc_html($description); ?></p>
        <?php if ($price) : ?>
            <div class="service-card-price"><?php echo esc_html($price); ?></div>
        <?php endif; ?>
        <div class="service-card-link">
            <span><?php _e('اكتشف المزيد', 'bandar-fit'); ?></span>
            <i data-lucide="arrow-left" width="16" height="16"></i>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * بطاقة سعر Price Card
 */
function bandar_price_card($title, $price, $features, $featured = false, $button_text = null, $button_link = '#') {
    $button_text = $button_text ?: __('اختر الباقة', 'bandar-fit');
    $featured_class = $featured ? 'featured' : '';
    
    ob_start();
    ?>
    <div class="price-card <?php echo esc_attr($featured_class); ?>">
        <?php if ($featured) : ?>
            <div class="price-card-badge"><?php _e('الأكثر طلباً', 'bandar-fit'); ?></div>
        <?php endif; ?>
        
        <h3 class="price-card-title"><?php echo esc_html($title); ?></h3>
        
        <div class="price-amount">
            <span class="price-number"><?php echo esc_html($price); ?></span>
            <span class="price-currency"><?php _e('ريال', 'bandar-fit'); ?></span>
        </div>
        
        <ul class="price-features">
            <?php foreach ($features as $feature) : ?>
                <li>
                    <i data-lucide="check" width="16" height="16"></i>
                    <span><?php echo esc_html($feature); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <a href="<?php echo esc_url($button_link); ?>" class="btn <?php echo $featured ? 'btn-primary' : 'btn-secondary'; ?> btn-block">
            <?php echo esc_html($button_text); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * بطاقة تقييم Evaluation Card
 */
function bandar_evaluation_card($title, $description, $icon, $price = null) {
    ob_start();
    ?>
    <div class="eval-card">
        <div class="eval-icon">
            <i data-lucide="<?php echo esc_attr($icon); ?>" width="32" height="32"></i>
        </div>
        <h3 class="eval-title"><?php echo esc_html($title); ?></h3>
        <p class="eval-description"><?php echo esc_html($description); ?></p>
        <?php if ($price) : ?>
            <div class="eval-price"><?php echo esc_html($price); ?></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}