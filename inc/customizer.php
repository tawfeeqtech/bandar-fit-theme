<?php
function bandar_customize_register($wp_customize) {
    
    // قسم البراند
    $wp_customize->add_section('bandar_brand', [
        'title' => __('العلامة التجارية', 'bandar-fit'),
        'priority' => 30,
    ]);
    
    // الألوان
    $wp_customize->add_setting('brand_primary', [
        'default' => '#C5A880',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_primary', [
        'label' => __('اللون الأساسي', 'bandar-fit'),
        'section' => 'bandar_brand',
    ]));
    
    // معلومات التواصل
    $wp_customize->add_section('bandar_contact', [
        'title' => __('معلومات التواصل', 'bandar-fit'),
        'priority' => 40,
    ]);
    
    $wp_customize->add_setting('whatsapp_number', [
        'default' => '966XXXXXXXXX',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('whatsapp_number', [
        'label' => __('رقم واتساب', 'bandar-fit'),
        'section' => 'bandar_contact',
        'type' => 'text',
    ]);
    
    // روابط التواصل الاجتماعي
    $socials = ['instagram', 'twitter', 'snapchat', 'tiktok'];
    foreach ($socials as $social) {
        $wp_customize->add_setting("social_{$social}", [
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        
        $wp_customize->add_control("social_{$social}", [
            'label' => sprintf(__('رابط %s', 'bandar-fit'), ucfirst($social)),
            'section' => 'bandar_contact',
            'type' => 'url',
        ]);
    }
}
add_action('customize_register', 'bandar_customize_register');