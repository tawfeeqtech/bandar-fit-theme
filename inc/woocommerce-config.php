<?php
/**
 * تهيئة WooCommerce للثيم
 * @package BandarFit
 */

/**
 * إزالة أنماط WooCommerce الافتراضية وإضافة أنماط الثيم
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * عدد المنتجات في الصف الواحد
 */
function bandar_woocommerce_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'bandar_woocommerce_loop_columns');

/**
 * عدد المنتجات في الصفحة الواحدة
 */
function bandar_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'bandar_woocommerce_products_per_page');

/**
 * إعادة ترتيب عناصر المنتج المفرد
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**
 * إضافة فئة مخصصة لـ body في صفحات WooCommerce
 */
function bandar_woocommerce_body_classes($classes) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        $classes[] = 'bandar-woocommerce-page';
    }
    if (is_product()) {
        $classes[] = 'bandar-product-page';
    }
    if (is_product_category()) {
        $classes[] = 'bandar-product-category';
    }
    return $classes;
}
add_filter('body_class', 'bandar_woocommerce_body_classes');

/**
 * تخصيص رسالة السلة الفارغة
 */
function bandar_empty_cart_message() {
    echo '<div class="empty-cart-message">';
    echo '<svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>';
    echo '<h3>' . __('سلتك فارغة', 'bandar-fit') . '</h3>';
    echo '<p>' . __('لم تقم بإضافة أي منتجات إلى سلتك بعد.', 'bandar-fit') . '</p>';
    if (wc_get_page_id('shop')) {
        echo '<a href="' . get_permalink(wc_get_page_id('shop')) . '" class="btn btn-primary">' . __('تسوق الآن', 'bandar-fit') . '</a>';
    } else {
        echo '<a href="' . home_url('/') . '" class="btn btn-primary">' . __('تسوق الآن', 'bandar-fit') . '</a>';
    }
    echo '</div>';
}
add_action('woocommerce_cart_is_empty', 'bandar_empty_cart_message');

/**
 * إضافة حقل مخصص لطلب المنتج
 */
function bandar_add_custom_product_field() {
    woocommerce_wp_text_input([
        'id' => '_custom_product_field',
        'label' => __('حقل مخصص', 'bandar-fit'),
        'description' => __('هذا حقل مخصص للمنتج', 'bandar-fit'),
        'desc_tip' => true,
    ]);
}
add_action('woocommerce_product_options_general_product_data', 'bandar_add_custom_product_field');

/**
 * حفظ الحقل المخصص
 */
function bandar_save_custom_product_field($post_id) {
    $custom_field = isset($_POST['_custom_product_field']) ? sanitize_text_field($_POST['_custom_product_field']) : '';
    update_post_meta($post_id, '_custom_product_field', $custom_field);
}
add_action('woocommerce_process_product_meta', 'bandar_save_custom_product_field');

/**
 * إضافة فئات منتجات مخصصة
 */
function bandar_add_product_categories() {
    $categories = [
        'packages' => __('باقات تدريبية', 'bandar-fit'),
        'nutrition' => __('مكملات غذائية', 'bandar-fit'),
        'equipment' => __('معدات رياضية', 'bandar-fit'),
        'apparel' => __('ملابس رياضية', 'bandar-fit'),
    ];
    
    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'product_cat')) {
            wp_insert_term($name, 'product_cat', ['slug' => $slug]);
        }
    }
}
add_action('init', 'bandar_add_product_categories');

/**
 * تخصيص سلة الشراء
 */
function bandar_customize_cart_item($item_name, $cart_item, $cart_item_key) {
    return $item_name;
}
add_filter('woocommerce_cart_item_name', 'bandar_customize_cart_item', 10, 3);

/**
 * إضافة أيقونات للدفع
 */
function bandar_payment_icons() {
    echo '<div class="payment-icons">';
    echo '<img src="' . BANDAR_IMAGES_URI . '/visa.svg" alt="Visa">';
    echo '<img src="' . BANDAR_IMAGES_URI . '/mastercard.svg" alt="Mastercard">';
    echo '<img src="' . BANDAR_IMAGES_URI . '/mada.svg" alt="Mada">';
    echo '</div>';
}
add_action('woocommerce_cart_totals_after_order_total', 'bandar_payment_icons');
add_action('woocommerce_review_order_after_order_total', 'bandar_payment_icons');


// inc/woocommerce-config.php - إضافة تحسينات
function bandar_woocommerce_checkout_fields_order($fields) {
    // إعادة ترتيب الحقول للعربية
    $ordered_fields = [];
    
    if (isset($fields['billing']['billing_first_name'])) {
        $ordered_fields['billing_first_name'] = $fields['billing']['billing_first_name'];
    }
    if (isset($fields['billing']['billing_last_name'])) {
        $ordered_fields['billing_last_name'] = $fields['billing']['billing_last_name'];
    }
    if (isset($fields['billing']['billing_phone'])) {
        $ordered_fields['billing_phone'] = $fields['billing']['billing_phone'];
    }
    if (isset($fields['billing']['billing_email'])) {
        $ordered_fields['billing_email'] = $fields['billing']['billing_email'];
    }
    
    $fields['billing'] = $ordered_fields;
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'bandar_woocommerce_checkout_fields_order');

// إضافة placeholder للحقول
function bandar_woocommerce_checkout_field_placeholders($fields) {
    $fields['billing']['billing_first_name']['placeholder'] = __('الاسم الأول', 'bandar-fit');
    $fields['billing']['billing_last_name']['placeholder'] = __('الاسم الأخير', 'bandar-fit');
    $fields['billing']['billing_phone']['placeholder'] = __('رقم الجوال', 'bandar-fit');
    $fields['billing']['billing_email']['placeholder'] = __('البريد الإلكتروني', 'bandar-fit');
    $fields['billing']['billing_address_1']['placeholder'] = __('العنوان', 'bandar-fit');
    $fields['billing']['billing_city']['placeholder'] = __('المدينة', 'bandar-fit');
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'bandar_woocommerce_checkout_field_placeholders');