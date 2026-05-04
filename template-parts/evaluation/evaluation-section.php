<?php
/**
 * قسم التقييمات
 * @package BandarFit
 */

$evaluations = get_posts([
    'post_type' => 'evaluation',
    'posts_per_page' => 3,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$default_evaluations = [
    [
        'title' => __('VO2 Max (التحمل)', 'bandar-fit'),
        'description' => __('قياس كفاءة القلب والرئتين للحفاظ على شدة اللعب طوال المباراة.', 'bandar-fit'),
        'icon' => 'lungs'
    ],
    [
        'title' => __('التسارع والسرعة', 'bandar-fit'),
        'description' => __('تحليل بروفايل السرعة والقوة الانفجارية في الانطلاقة الأولى.', 'bandar-fit'),
        'icon' => 'timer'
    ],
    [
        'title' => __('الرشاقة وتغيير الاتجاه', 'bandar-fit'),
        'description' => __('قياس قدرتك على المناورة والتحكم في مركز ثقل الجسم.', 'bandar-fit'),
        'icon' => 'move'
    ]
];
?>

<div class="evaluation-section">
    <div class="section-header text-center">
        <span class="section-tag"><?php _e('تقييمات احترافية', 'bandar-fit'); ?></span>
        <h2 class="section-title"><?php _e('تقييمات الأداء الرياضي', 'bandar-fit'); ?></h2>
        <p class="section-subtitle"><?php _e('تحليل علمي متطور باستخدام أحدث التقنيات', 'bandar-fit'); ?></p>
    </div>

    <div class="evaluations-grid">
        <?php if (!empty($evaluations)) : ?>
            <?php foreach ($evaluations as $evaluation) : 
                $icon = get_post_meta($evaluation->ID, 'eval_icon', true) ?: 'clipboard-list';
            ?>
                <div class="eval-card">
                    <div class="eval-icon">
                        <i data-lucide="<?php echo esc_attr($icon); ?>" width="32" height="32"></i>
                    </div>
                    <h3 class="eval-title"><?php echo esc_html($evaluation->post_title); ?></h3>
                    <p class="eval-description"><?php echo esc_html($evaluation->post_excerpt); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($default_evaluations as $eval) : ?>
                <div class="eval-card">
                    <div class="eval-icon">
                        <i data-lucide="<?php echo esc_attr($eval['icon']); ?>" width="32" height="32"></i>
                    </div>
                    <h3 class="eval-title"><?php echo esc_html($eval['title']); ?></h3>
                    <p class="eval-description"><?php echo esc_html($eval['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- باقة الاختبارات -->
    <div class="evaluation-offer">
        <div class="evaluation-offer-content">
            <h3 class="offer-title"><?php _e('باقة الاختبارات الاحترافية', 'bandar-fit'); ?></h3>
            <div class="offer-price">
                <span class="price-number">499</span>
                <span class="price-currency"><?php _e('ريال', 'bandar-fit'); ?></span>
                <span class="price-period"><?php _e('/ تقييم', 'bandar-fit'); ?></span>
            </div>
            <ul class="offer-features">
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <?php _e('التقييمات البدنية الشاملة لجميع الوظائف الحركية', 'bandar-fit'); ?>
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <?php _e('تقرير تقني مفصل (PDF) جاهز للتقديم للأندية', 'bandar-fit'); ?>
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <?php _e('مقارنة مستواك الفعلي مع معايير اللاعبين النخبة', 'bandar-fit'); ?>
                </li>
                <li>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <?php _e('جلسة استشارية خاصة لتحليل نقاط الضعف', 'bandar-fit'); ?>
                </li>
            </ul>
            <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="btn btn-primary btn-large">
                <?php _e('احجز موعد التقييم الآن', 'bandar-fit'); ?>
            </a>
        </div>
    </div>
</div>

<style>
.evaluations-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 30px;
    margin-bottom: 60px;
}

@media (min-width: 768px) {
    .evaluations-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.eval-card {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 32px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s ease;
}

.eval-card:hover {
    border-color: var(--brand-primary);
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.eval-icon {
    width: 70px;
    height: 70px;
    background: rgba(197, 168, 128, 0.1);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    border: 1px solid rgba(197, 168, 128, 0.2);
}

.eval-icon svg {
    color: var(--brand-primary);
}

.eval-title {
    font-size: 20px;
    font-weight: 900;
    font-style: italic;
    margin-bottom: 15px;
    text-transform: uppercase;
}

.eval-description {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.6;
}

.evaluation-offer {
    max-width: 700px;
    margin: 0 auto;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, rgba(197, 168, 128, 0.1) 100%);
    border: 1px solid rgba(197, 168, 128, 0.3);
    border-radius: 50px;
    padding: 50px;
    text-align: center;
}

@media (max-width: 768px) {
    .evaluation-offer {
        padding: 30px 20px;
        border-radius: 30px;
    }
}

.offer-title {
    font-size: 28px;
    font-weight: 900;
    font-style: italic;
    margin-bottom: 20px;
}

.offer-price {
    margin-bottom: 30px;
}

.offer-price .price-number {
    font-size: 64px;
    font-weight: 900;
    color: var(--brand-primary);
}

.offer-price .price-currency {
    font-size: 20px;
    color: var(--text-muted);
}

.offer-price .price-period {
    font-size: 14px;
    color: var(--text-muted);
}

.offer-features {
    list-style: none;
    text-align: right;
    margin-bottom: 40px;
}

.offer-features li {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    font-size: 14px;
}

.offer-features svg {
    color: var(--brand-primary);
    flex-shrink: 0;
}
</style>