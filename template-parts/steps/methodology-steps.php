<?php
/**
 * خطوات المنهجية
 * @package BandarFit
 */

$steps = [
    [
        'icon' => 'microscope',
        'title' => __('التحليل الأولي', 'bandar-fit'),
        'description' => __('تحديد الأهداف الرياضية بناءً على مركزك ومستواك الحالي', 'bandar-fit'),
    ],
    [
        'icon' => 'dumbbell',
        'title' => __('التدريب الميداني', 'bandar-fit'),
        'description' => __('جلسات ميدانية تحاكي المباراة الواقعية', 'bandar-fit'),
    ],
    [
        'icon' => 'activity',
        'title' => __('تحليل الأحمال', 'bandar-fit'),
        'description' => __('موازنة شدة التمرين مع مستوى التعب والإجهاد', 'bandar-fit'),
    ],
    [
        'icon' => 'utensils',
        'title' => __('جدول غذائي', 'bandar-fit'),
        'description' => __('خطة تغذية مخصصة لطاقة كافية وأداء أفضل', 'bandar-fit'),
    ],
    [
        'icon' => 'heart-pulse',
        'title' => __('الوقاية والاستشفاء', 'bandar-fit'),
        'description' => __('بروتوكول وقائي وتقوية المفاصل والعضلات', 'bandar-fit'),
    ],
];
?>

<div class="methodology-steps">
    <div class="section-header text-center">
        <span class="section-tag"><?php _e('5 خطوات علمية', 'bandar-fit'); ?></span>
        <h2 class="section-title"><?php _e('هندسة الأداء البدني', 'bandar-fit'); ?></h2>
        <p class="section-subtitle"><?php _e('نقل مستواك من الهاوي إلى المحترف', 'bandar-fit'); ?></p>
    </div>

    <div class="steps-grid">
        <?php foreach ($steps as $index => $step) : ?>
            <div class="step-card">
                <div class="step-number">0<?php echo $index + 1; ?></div>
                <div class="step-icon">
                    <i data-lucide="<?php echo esc_attr($step['icon']); ?>" width="32" height="32"></i>
                </div>
                <h3 class="step-title"><?php echo esc_html($step['title']); ?></h3>
                <p class="step-description"><?php echo esc_html($step['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.methodology-steps {
    padding: 60px 0;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 20px;
    margin-top: 50px;
}

@media (min-width: 768px) {
    .steps-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 1024px) {
    .steps-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

.step-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border-color);
    border-radius: 30px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.4s ease;
}

.step-card:hover {
    border-color: var(--brand-primary);
    background: rgba(197, 168, 128, 0.05);
    transform: translateY(-5px);
}

.step-number {
    font-size: 12px;
    font-weight: 900;
    color: var(--brand-primary);
    margin-bottom: 15px;
    letter-spacing: 2px;
}

.step-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-icon svg {
    width: 32px;
    height: 32px;
    color: var(--brand-primary);
}

.step-title {
    font-size: 16px;
    font-weight: 900;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.step-description {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.5;
}
</style>