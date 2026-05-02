// components/button.php
function bandar_button($label, $type = 'primary', $link = '#', $icon = null) {
$classes = 'inline-flex items-center justify-center gap-2 font-black italic uppercase transition-all duration-300';

if ($type === 'primary') {
$classes .= ' gold-gradient text-dark rounded-xl px-8 py-4 hover:scale-105';
} elseif ($type === 'secondary') {
$classes .= ' border border-brand/20 text-brand rounded-xl px-8 py-4 hover:bg-brand hover:text-dark';
} elseif ($type === 'whatsapp') {
$classes .= ' bg-[#25d366] text-white rounded-full p-4 shadow-lg hover:scale-110';
}

return sprintf('<a href="%s" class="%s">%s%s</a>',
esc_url($link), $classes, $icon ? '<i data-lucide="'.$icon.'" class="w-5 h-5 ml-2"></i>' : '',
esc_html($label)
);
}