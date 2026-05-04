<?php
/**
 * مكون الشبكة Grid Component
 * @package BandarFit
 */

/**
 * إنشاء شبكة مرنة
 */
function bandar_grid($items, $columns = 3, $gap = 'normal', $type = 'default') {
    if (empty($items)) {
        return '';
    }
    
    $gap_class = '';
    switch ($gap) {
        case 'small':
            $gap_class = 'grid-gap-sm';
            break;
        case 'large':
            $gap_class = 'grid-gap-lg';
            break;
        default:
            $gap_class = 'grid-gap-normal';
    }
    
    $columns_class = 'grid-cols-' . $columns;
    
    ob_start();
    ?>
    <div class="bandar-grid <?php echo esc_attr($gap_class . ' ' . $columns_class . ' grid-type-' . $type); ?>">
        <?php foreach ($items as $item) : ?>
            <div class="grid-item">
                <?php echo $item; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <style>
    .bandar-grid {
        display: grid;
        gap: 30px;
    }
    
    .bandar-grid.grid-gap-sm {
        gap: 15px;
    }
    
    .bandar-grid.grid-gap-lg {
        gap: 50px;
    }
    
    .bandar-grid.grid-cols-1 {
        grid-template-columns: repeat(1, 1fr);
    }
    
    .bandar-grid.grid-cols-2 {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bandar-grid.grid-cols-3 {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .bandar-grid.grid-cols-4 {
        grid-template-columns: repeat(4, 1fr);
    }
    
    .bandar-grid.grid-cols-5 {
        grid-template-columns: repeat(5, 1fr);
    }
    
    @media (max-width: 992px) {
        .bandar-grid.grid-cols-4,
        .bandar-grid.grid-cols-5 {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .bandar-grid.grid-cols-3,
        .bandar-grid.grid-cols-4,
        .bandar-grid.grid-cols-5 {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .bandar-grid {
            grid-template-columns: repeat(1, 1fr) !important;
        }
    }
    
    /* Grid type variations */
    .grid-type-masonry {
        display: grid;
        grid-template-rows: masonry;
    }
    
    .grid-type-featured .grid-item:first-child {
        grid-column: span 2;
        grid-row: span 2;
    }
    </style>
    <?php
    return ob_get_clean();
}

/**
 * شبكة صور بسيطة
 */
function bandar_image_grid($images, $columns = 3) {
    if (empty($images)) {
        return '';
    }
    
    $items = [];
    foreach ($images as $image) {
        $img_url = is_array($image) ? $image['url'] : $image;
        $img_alt = is_array($image) && isset($image['alt']) ? $image['alt'] : '';
        $items[] = '<div class="grid-image-item"><img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '" loading="lazy"></div>';
    }
    
    return bandar_grid($items, $columns);
}