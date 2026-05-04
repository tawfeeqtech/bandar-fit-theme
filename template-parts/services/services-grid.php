<?php
/**
 * شبكة الخدمات
 * @package BandarFit
 */

// جلب الخدمات من Custom Post Type
$services = get_posts([
    'post_type' => 'service',
    'posts_per_page' => 4,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

if (empty($services)) {
    // خدمات افتراضية إذا لم توجد خدمات مضافة
    $default_services = [
        [
            'title' => __('التدريب الحضوري', 'bandar-fit'),
            'subtitle' => __('باقات مخصصة للنخبة', 'bandar-fit'),
            'icon' => 'dumbbell',
            'link' => '#',
        ],
        [
            'title' => __('تقييمات الأداء', 'bandar-fit'),
            'subtitle' => __('تحليل علمي متطور', 'bandar-fit'),
            'icon' => 'clipboard-list',
            'link' => '#',
        ],
        [
            'title' => __('برامج تغذية', 'bandar-fit'),
            'subtitle' => __('خطط غذائية مخصصة', 'bandar-fit'),
            'icon' => 'utensils',
            'link' => '#',
        ],
        [
            'title' => __('استشفاء رياضي', 'bandar-fit'),
            'subtitle' => __('تعافي سريع وآمن', 'bandar-fit'),
            'icon' => 'heart-pulse',
            'link' => '#',
        ],
    ];
    ?>
    <div class="services-grid">
        <?php foreach ($default_services as $service) : ?>
            <div class="service-card">
                <div class="service-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <?php if ($service['icon'] === 'dumbbell') : ?>
                            <path d="M6 4h4v16H6z M14 4h4v16h-4z M6 10h4 M14 10h4 M10 4v16"/>
                        <?php elseif ($service['icon'] === 'clipboard-list') : ?>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <line x1="9" y1="11" x2="15" y2="11"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        <?php elseif ($service['icon'] === 'utensils') : ?>
                            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2 M7 2v20 M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/>
                        <?php else : ?>
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        <?php endif; ?>
                    </svg>
                </div>
                <h3 class="service-card-title"><?php echo esc_html($service['title']); ?></h3>
                <p class="service-card-subtitle"><?php echo esc_html($service['subtitle']); ?></p>
                <a href="<?php echo esc_url($service['link']); ?>" class="service-card-link">
                    <?php _e('دخول البرنامج', 'bandar-fit'); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return;
}
?>

<div class="services-grid">
    <?php foreach ($services as $service) : 
        $icon = get_post_meta($service->ID, 'service_icon', true) ?: 'medal';
        $link = get_post_meta($service->ID, 'service_link', true) ?: get_permalink($service->ID);
    ?>
        <div class="service-card">
            <div class="service-card-icon">
                <i data-lucide="<?php echo esc_attr($icon); ?>" width="32" height="32"></i>
            </div>
            <h3 class="service-card-title"><?php echo esc_html($service->post_title); ?></h3>
            <p class="service-card-subtitle"><?php echo esc_html($service->post_excerpt); ?></p>
            <a href="<?php echo esc_url($link); ?>" class="service-card-link">
                <?php _e('دخول البرنامج', 'bandar-fit'); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"/>
                    <polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<style>
.services-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 30px;
    margin-top: 50px;
}

@media (min-width: 768px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .services-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.service-card {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 30px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    cursor: pointer;
}

.service-card:hover {
    border-color: var(--brand-primary);
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.service-card-icon {
    width: 80px;
    height: 80px;
    background: rgba(197, 168, 128, 0.1);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    border: 1px solid rgba(197, 168, 128, 0.2);
    transition: all 0.3s ease;
}

.service-card:hover .service-card-icon {
    background: var(--brand-primary);
    border-color: var(--brand-primary);
}

.service-card:hover .service-card-icon svg {
    color: var(--brand-dark);
}

.service-card-icon svg {
    width: 40px;
    height: 40px;
    color: var(--brand-primary);
    transition: all 0.3s ease;
}

.service-card-title {
    font-size: 22px;
    font-weight: 900;
    font-style: italic;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.service-card-subtitle {
    color: var(--text-muted);
    font-size: 12px;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.service-card-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--brand-primary);
    text-decoration: none;
}

.service-card-link svg {
    transition: transform 0.3s ease;
}

.service-card-link:hover svg {
    transform: translateX(-5px);
}
</style>