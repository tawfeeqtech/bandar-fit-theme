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
function bandar_add_athlete_meta_boxes() {
    add_meta_box(
        'athlete_details',
        __('تفاصيل الرياضي', 'bandar-fit'),
        'bandar_athlete_meta_box_callback',
        'athlete',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bandar_add_athlete_meta_boxes');

/**
 * محتوى مربع الميتا للرياضي
 */
function bandar_athlete_meta_box_callback($post) {
    wp_nonce_field('bandar_athlete_meta_box', 'bandar_athlete_meta_box_nonce');
    
    $position = get_post_meta($post->ID, 'athlete_position', true);
    $age = get_post_meta($post->ID, 'athlete_age', true);
    $club = get_post_meta($post->ID, 'athlete_club', true);
    $nationality = get_post_meta($post->ID, 'athlete_nationality', true);
    ?>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
        <p>
            <label for="athlete_position"><strong><?php _e('المركز', 'bandar-fit'); ?></strong></label>
            <input type="text" id="athlete_position" name="athlete_position" value="<?php echo esc_attr($position); ?>" class="widefat">
        </p>
        <p>
            <label for="athlete_age"><strong><?php _e('العمر', 'bandar-fit'); ?></strong></label>
            <input type="number" id="athlete_age" name="athlete_age" value="<?php echo esc_attr($age); ?>" class="widefat">
        </p>
        <p>
            <label for="athlete_club"><strong><?php _e('النادي', 'bandar-fit'); ?></strong></label>
            <input type="text" id="athlete_club" name="athlete_club" value="<?php echo esc_attr($club); ?>" class="widefat">
        </p>
        <p>
            <label for="athlete_nationality"><strong><?php _e('الجنسية', 'bandar-fit'); ?></strong></label>
            <input type="text" id="athlete_nationality" name="athlete_nationality" value="<?php echo esc_attr($nationality); ?>" class="widefat">
        </p>
    </div>
    <?php
}

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
    
    $fields = ['athlete_position', 'athlete_age', 'athlete_club', 'athlete_nationality'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_athlete', 'bandar_save_athlete_meta');