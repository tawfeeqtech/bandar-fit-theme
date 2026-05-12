<?php
/**
 * مكون الزر Button Component
 * @package BandarFit
 * 
 * @param string $text      نص الزر
 * @param string $type      نوع الزر (primary, secondary, outline, whatsapp)
 * @param string $link      رابط الزر
 * @param string $icon      اسم الأيقونة (من Lucide)
 * @param array  $attrs     سمات إضافية
 * @return string
 */

function bandar_button($text, $type = 'primary', $link = '#', $icon = null, $attrs = []) {
    $classes = ['btn', 'btn-' . $type];
    
    if (isset($attrs['class'])) {
        $classes[] = $attrs['class'];
        unset($attrs['class']);
    }
    
    if (isset($attrs['size']) && $attrs['size'] === 'large') {
        $classes[] = 'btn-large';
    } elseif (isset($attrs['size']) && $attrs['size'] === 'small') {
        $classes[] = 'btn-small';
    }
    
    if (isset($attrs['block']) && $attrs['block'] === true) {
        $classes[] = 'btn-block';
    }
    
    $class_string = implode(' ', $classes);
    
    $attributes = '';
    foreach ($attrs as $key => $value) {
        if (!in_array($key, ['size', 'block', 'class'])) {
            $attributes .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
    }
    
    $icon_html = '';
    if ($icon) {
        $icon_html = '<i data-lucide="' . esc_attr($icon) . '" class="btn-icon"></i>';
    }
    
    return sprintf(
        '<a href="%s" class="%s"%s>%s%s<span class="btn-text">%s</span></a>',
        esc_url($link),
        esc_attr($class_string),
        $attributes,
        $type === 'whatsapp' ? '' : $icon_html,
        $type === 'whatsapp' ? '<i data-lucide="message-circle" class="btn-icon"></i>' : '',
        esc_html($text)
    );
}

/**
 * زر واتساب سريع
 */
function bandar_whatsapp_button($text = null, $size = 'default') {
    $text = $text ?: __('تواصل عبر واتساب', 'bandar-fit');
    return bandar_button($text, 'whatsapp', bandar_get_whatsapp_url(), 'message-circle', ['size' => $size]);
}