<?php
/**
 * بطاقة الرياضي المفردة
 * @package BandarFit
 * 
 * @param int $athlete_id معرف الرياضي
 */

function bandar_athlete_card($athlete_id = null) {
    if (!$athlete_id) {
        $athlete_id = get_the_ID();
    }
    
    $position = get_post_meta($athlete_id, 'athlete_position', true);
    $age = get_post_meta($athlete_id, 'athlete_age', true);
    $club = get_post_meta($athlete_id, 'athlete_club', true);
    $nationality = get_post_meta($athlete_id, 'athlete_nationality', true);
    $thumbnail = get_the_post_thumbnail_url($athlete_id, 'bandar-athlete');
    $title = get_the_title($athlete_id);
    $permalink = get_permalink($athlete_id);
    ?>
    
    <div class="athlete-card">
        <div class="athlete-card-image">
            <?php if ($thumbnail) : ?>
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php else : ?>
                <img src="<?php echo BANDAR_IMAGES_URI; ?>/athlete-placeholder.jpg" alt="<?php echo esc_attr($title); ?>">
            <?php endif; ?>
            
            <div class="athlete-card-overlay">
                <?php if ($position || $club) : ?>
                    <div class="athlete-card-stats">
                        <?php if ($position) : ?>
                            <span class="athlete-stat"><?php echo esc_html($position); ?></span>
                        <?php endif; ?>
                        <?php if ($club) : ?>
                            <span class="athlete-stat"><?php echo esc_html($club); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <a href="<?php echo esc_url($permalink); ?>" class="athlete-card-link">
                    <?php _e('عرض التفاصيل', 'bandar-fit'); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <div class="athlete-card-content">
            <h3 class="athlete-card-name"><?php echo esc_html($title); ?></h3>
            
            <div class="athlete-card-details">
                <?php if ($nationality) : ?>
                    <span class="athlete-detail">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <?php echo esc_html($nationality); ?>
                    </span>
                <?php endif; ?>
                
                <?php if ($age) : ?>
                    <span class="athlete-detail">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <?php echo esc_html($age); ?> <?php _e('سنة', 'bandar-fit'); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <style>
    .athlete-card {
        background: var(--bg-secondary);
        border-radius: 1.5rem;
        overflow: hidden;
        transition: all var(--transition-base);
    }
    
    .athlete-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }
    
    .athlete-card-image {
        position: relative;
        width: 100%;
        aspect-ratio: 1/1;
        overflow: hidden;
    }
    
    .athlete-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .athlete-card:hover .athlete-card-image img {
        transform: scale(1.08);
    }
    
    .athlete-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.5rem;
    }
    
    .athlete-card:hover .athlete-card-overlay {
        opacity: 1;
    }
    
    .athlete-card-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .athlete-stat {
        background: var(--brand-primary);
        color: var(--brand-dark);
        font-size: 0.6875rem;
        font-weight: 900;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        text-transform: uppercase;
    }
    
    .athlete-card-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--brand-primary);
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .athlete-card-content {
        padding: 1.25rem;
        text-align: center;
    }
    
    .athlete-card-name {
        font-size: 1.125rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    
    .athlete-card-details {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .athlete-detail {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .athlete-detail svg {
        color: var(--brand-primary);
    }
    </style>
    
    <?php
}