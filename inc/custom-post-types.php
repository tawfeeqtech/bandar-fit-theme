<?php
/**
 * أنواع المحتوى المخصصة (Custom Post Types)
 * @package BandarFit
 */

/**
 * تسجيل جميع أنواع المحتوى المخصصة
 */
function bandar_register_post_types() {
    
    // ============================================
    // 1. CPT: Athletes (الرياضيون)
    // ============================================
    register_post_type('athlete', [
        'labels' => [
            'name'               => __('الرياضيون', 'bandar-fit'),
            'singular_name'      => __('رياضي', 'bandar-fit'),
            'add_new'            => __('إضافة رياضي', 'bandar-fit'),
            'add_new_item'       => __('إضافة رياضي جديد', 'bandar-fit'),
            'edit_item'          => __('تعديل رياضي', 'bandar-fit'),
            'new_item'           => __('رياضي جديد', 'bandar-fit'),
            'view_item'          => __('عرض رياضي', 'bandar-fit'),
            'search_items'       => __('بحث عن رياضي', 'bandar-fit'),
            'not_found'          => __('لا يوجد رياضيون', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد رياضيون في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('الرياضيون', 'bandar-fit'),
        ],
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true, // Gutenberg support
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'               => ['slug' => 'athlete', 'with_front' => true],
        'query_var'             => true,
    ]);
    
    // ============================================
    // 6. CPT: Methodology Steps (خطوات المنهجية)
    // ============================================
    register_post_type('methodology_step', [
        'labels' => [
            'name'               => __('خطوات المنهجية', 'bandar-fit'),
            'singular_name'      => __('خطوة منهجية', 'bandar-fit'),
            'add_new'            => __('إضافة خطوة', 'bandar-fit'),
            'add_new_item'       => __('إضافة خطوة جديدة', 'bandar-fit'),
            'edit_item'          => __('تعديل خطوة', 'bandar-fit'),
            'new_item'           => __('خطوة جديدة', 'bandar-fit'),
            'view_item'          => __('عرض خطوة', 'bandar-fit'),
            'search_items'       => __('بحث عن خطوة', 'bandar-fit'),
            'not_found'          => __('لا يوجد خطوات', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد خطوات في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('خطوات المنهجية', 'bandar-fit'),
        ],
        'public'                => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-list-ol',
        'supports'              => ['title', 'custom-fields'],
        'rewrite'               => false,
        'query_var'             => false,
    ]);
    
    // ============================================
    // Add Meta Boxes for Methodology Steps
    // ============================================
    function bandar_add_methodology_meta_boxes() {
        add_meta_box(
            'methodology_step_details',
            __('تفاصيل الخطوة', 'bandar-fit'),
            'bandar_methodology_callback',
            'methodology_step',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'bandar_add_methodology_meta_boxes');
    
    function bandar_methodology_callback($post) {
        wp_nonce_field('methodology_step_meta_box', 'methodology_step_meta_box_nonce');
        
        $step_number = get_post_meta($post->ID, '_step_number', true);
        $step_icon = get_post_meta($post->ID, '_step_icon', true);
        $step_description = get_post_meta($post->ID, '_step_description', true);
        
        echo '<div class="methodology-meta-field" style="margin-bottom: 15px;">';
        echo '<label for="step_number" style="display: block; font-weight: bold; margin-bottom: 5px;">' . __('رقم الخطوة', 'bandar-fit') . '</label>';
        echo '<input type="number" id="step_number" name="step_number" value="' . esc_attr($step_number) . '" style="width: 100%; padding: 8px;" min="1" max="99">';
        echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">' . __('رقم الخطوة للترتيب (1, 2, 3, ...)', 'bandar-fit') . '</p>';
        echo '</div>';
        
        echo '<div class="methodology-meta-field" style="margin-bottom: 15px;">';
        echo '<label for="step_icon" style="display: block; font-weight: bold; margin-bottom: 5px;">' . __('اسم الأيقونة (Lucide)', 'bandar-fit') . '</label>';
        echo '<input type="text" id="step_icon" name="step_icon" value="' . esc_attr($step_icon) . '" style="width: 100%; padding: 8px;">';
        echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">' . __('مثال: microscope, dumbbell, activity, utensils, heart-pulse', 'bandar-fit') . '</p>';
        echo '</div>';
        
        echo '<div class="methodology-meta-field">';
        echo '<label for="step_description" style="display: block; font-weight: bold; margin-bottom: 5px;">' . __('وصف الخطوة', 'bandar-fit') . '</label>';
        echo '<textarea id="step_description" name="step_description" style="width: 100%; padding: 8px; min-height: 80px;">' . esc_textarea($step_description) . '</textarea>';
        echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">' . __('وصف قصير للخطوة', 'bandar-fit') . '</p>';
        echo '</div>';
    }
    
    function bandar_save_methodology_meta($post_id) {
        if (!isset($_POST['methodology_step_meta_box_nonce']) || !wp_verify_nonce($_POST['methodology_step_meta_box_nonce'], 'methodology_step_meta_box')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['step_number'])) {
            update_post_meta($post_id, '_step_number', intval($_POST['step_number']));
        }
        
        if (isset($_POST['step_icon'])) {
            update_post_meta($post_id, '_step_icon', sanitize_text_field($_POST['step_icon']));
        }
        
        if (isset($_POST['step_description'])) {
            update_post_meta($post_id, '_step_description', sanitize_textarea_field($_POST['step_description']));
        }
    }
    add_action('save_post', 'bandar_save_methodology_meta');
    
    // ============================================
    // Add Meta Boxes for Athletes
    // ============================================
    function bandar_add_athlete_meta_boxes() {
        add_meta_box(
            'bandar_athlete_video_details',
            __('تفاصيل فيديو الرياضي', 'bandar-fit'),
            'bandar_athlete_video_callback',
            'athlete',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'bandar_add_athlete_meta_boxes');
    
    function bandar_athlete_video_callback($post) {
        wp_nonce_field('bandar_athlete_meta_box', 'bandar_athlete_meta_box_nonce');
        
        $video_url = get_post_meta($post->ID, '_athlete_video_url', true);
        $video_thumbnail = get_post_meta($post->ID, '_athlete_video_thumbnail', true);
        
        echo '<div class="bandar-meta-field" style="margin-bottom: 15px;">';
        echo '<label for="athlete_video_url" style="display: block; font-weight: bold; margin-bottom: 5px;">' . __('رابط الفيديو (YouTube/Vimeo/MP4)', 'bandar-fit') . '</label>';
        echo '<input type="url" id="athlete_video_url" name="athlete_video_url" value="' . esc_attr($video_url) . '" style="width: 100%; padding: 8px;">';
        echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">' . __('أدخل رابط الفيديو الكامل', 'bandar-fit') . '</p>';
        echo '</div>';
        
        echo '<div class="bandar-meta-field">';
        echo '<label for="athlete_video_thumbnail" style="display: block; font-weight: bold; margin-bottom: 5px;">' . __('لقطة الفيديو (رابط الصورة)', 'bandar-fit') . '</label>';
        echo '<input type="url" id="athlete_video_thumbnail" name="athlete_video_thumbnail" value="' . esc_attr($video_thumbnail) . '" style="width: 100%; padding: 8px;">';
        echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">' . __('رابط صورة اللقطة التي تظهر كغلاف للفيديو', 'bandar-fit') . '</p>';
        echo '</div>';
    }
    
        
    // ============================================
    // 2. CPT: Evaluations (التقييمات)
    // ============================================
    register_post_type('evaluation', [
        'labels' => [
            'name'               => __('التقييمات', 'bandar-fit'),
            'singular_name'      => __('تقييم', 'bandar-fit'),
            'add_new'            => __('إضافة تقييم', 'bandar-fit'),
            'add_new_item'       => __('إضافة تقييم جديد', 'bandar-fit'),
            'edit_item'          => __('تعديل تقييم', 'bandar-fit'),
            'new_item'           => __('تقييم جديد', 'bandar-fit'),
            'view_item'          => __('عرض تقييم', 'bandar-fit'),
            'search_items'       => __('بحث عن تقييم', 'bandar-fit'),
            'not_found'          => __('لا يوجد تقييمات', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد تقييمات في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('التقييمات', 'bandar-fit'),
        ],
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-chart-area',
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'               => ['slug' => 'evaluation', 'with_front' => true],
        'query_var'             => true,
    ]);
    
    // ============================================
    // 3. CPT: Services (الخدمات)
    // ============================================
    register_post_type('service', [
        'labels' => [
            'name'               => __('الخدمات', 'bandar-fit'),
            'singular_name'      => __('خدمة', 'bandar-fit'),
            'add_new'            => __('إضافة خدمة', 'bandar-fit'),
            'add_new_item'       => __('إضافة خدمة جديدة', 'bandar-fit'),
            'edit_item'          => __('تعديل خدمة', 'bandar-fit'),
            'new_item'           => __('خدمة جديدة', 'bandar-fit'),
            'view_item'          => __('عرض خدمة', 'bandar-fit'),
            'search_items'       => __('بحث عن خدمة', 'bandar-fit'),
            'not_found'          => __('لا يوجد خدمات', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد خدمات في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('الخدمات', 'bandar-fit'),
        ],
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-hammer',
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'               => ['slug' => 'service', 'with_front' => true],
        'query_var'             => true,
    ]);
    
    // ============================================
    // 4. CPT: Testimonials (شهادات العملاء)
    // ============================================
    register_post_type('testimonial', [
        'labels' => [
            'name'               => __('شهادات العملاء', 'bandar-fit'),
            'singular_name'      => __('شهادة', 'bandar-fit'),
            'add_new'            => __('إضافة شهادة', 'bandar-fit'),
            'add_new_item'       => __('إضافة شهادة جديدة', 'bandar-fit'),
            'edit_item'          => __('تعديل شهادة', 'bandar-fit'),
            'new_item'           => __('شهادة جديدة', 'bandar-fit'),
            'view_item'          => __('عرض شهادة', 'bandar-fit'),
            'search_items'       => __('بحث عن شهادة', 'bandar-fit'),
            'not_found'          => __('لا يوجد شهادات', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد شهادات في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('شهادات العملاء', 'bandar-fit'),
        ],
        'public'                => true,
        'publicly_queryable'    => false, // لا يحتاج صفحة مفردة
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 8,
        'menu_icon'             => 'dashicons-testimonial',
        'supports'              => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite'               => false,
        'query_var'             => false,
    ]);
    
    // ============================================
    // 5. CPT: FAQ (الأسئلة الشائعة)
    // ============================================
    register_post_type('faq', [
        'labels' => [
            'name'               => __('الأسئلة الشائعة', 'bandar-fit'),
            'singular_name'      => __('سؤال', 'bandar-fit'),
            'add_new'            => __('إضافة سؤال', 'bandar-fit'),
            'add_new_item'       => __('إضافة سؤال جديد', 'bandar-fit'),
            'edit_item'          => __('تعديل سؤال', 'bandar-fit'),
            'new_item'           => __('سؤال جديد', 'bandar-fit'),
            'view_item'          => __('عرض سؤال', 'bandar-fit'),
            'search_items'       => __('بحث عن سؤال', 'bandar-fit'),
            'not_found'          => __('لا يوجد أسئلة', 'bandar-fit'),
            'not_found_in_trash' => __('لا يوجد أسئلة في سلة المحذوفات', 'bandar-fit'),
            'menu_name'          => __('الأسئلة الشائعة', 'bandar-fit'),
        ],
        'public'                => true,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-editor-help',
        'supports'              => ['title', 'editor', 'custom-fields'],
        'rewrite'               => false,
        'query_var'             => false,
    ]);
    
    // Flush rewrite rules on activation
    flush_rewrite_rules();
}
add_action('init', 'bandar_register_post_types');

/**
 * إضافة أعمدة مخصصة لـ CPT الرياضيون
 */
function bandar_athlete_columns($columns) {
    $new_columns = [];
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns['thumbnail'] = __('الصورة', 'bandar-fit');
        }
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['position'] = __('المركز', 'bandar-fit');
        }
    }
    return $new_columns;
}
add_filter('manage_athlete_posts_columns', 'bandar_athlete_columns');

/**
 * عرض محتوى الأعمدة المخصصة
 */
function bandar_athlete_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, [50, 50]);
            }
            break;
        case 'position':
            echo get_post_meta($post_id, 'athlete_position', true);
            break;
    }
}
add_action('manage_athlete_posts_custom_column', 'bandar_athlete_column_content', 10, 2);

/**
 * إضافة مربعات ميتا لـ CPT الرياضيون
 */
add_action('add_meta_boxes', 'bandar_add_athlete_meta_boxes');


/**
 * حفظ بيانات الميتا للرياضي
 */
function bandar_save_athlete_meta($post_id) {
    if (!isset($_POST['bandar_athlete_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['bandar_athlete_meta_box_nonce'], 'bandar_athlete_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // حفظ حقول الفيديو فقط
    if (isset($_POST['athlete_video_url'])) {
        update_post_meta($post_id, '_athlete_video_url', sanitize_url($_POST['athlete_video_url']));
    }
    
    if (isset($_POST['athlete_video_thumbnail'])) {
        update_post_meta($post_id, '_athlete_video_thumbnail', sanitize_url($_POST['athlete_video_thumbnail']));
    }
}
add_action('save_post_athlete', 'bandar_save_athlete_meta');