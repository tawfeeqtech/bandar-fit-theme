<?php
function bandar_register_post_types() {
    
    // CPT: Athletes (رياضيون)
    register_post_type('athlete', [
        'labels' => [
            'name' => __('الرياضيون', 'bandar-fit'),
            'singular_name' => __('رياضي', 'bandar-fit'),
            'add_new' => __('إضافة رياضي', 'bandar-fit'),
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
    ]);
    
    // CPT: Evaluations (تقييمات)
    register_post_type('evaluation', [
        'labels' => [
            'name' => __('التقييمات', 'bandar-fit'),
            'singular_name' => __('تقييم', 'bandar-fit'),
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-chart-area',
        'show_in_rest' => true,
    ]);
    
    // CPT: Services (خدمات)
    register_post_type('service', [
        'labels' => [
            'name' => __('الخدمات', 'bandar-fit'),
            'singular_name' => __('خدمة', 'bandar-fit'),
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-hammer',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'bandar_register_post_types');