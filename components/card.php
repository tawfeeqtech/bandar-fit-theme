// components/card.php
function bandar_card($title, $description, $icon = null, $price = null, $features = []) {
    ob_start();
    ?>
    <div class="bg-surface border border-white/5 rounded-[2rem] p-8 text-center transition-all duration-500 hover:-translate-y-2 hover:border-brand">
        <?php if ($icon): ?>
            <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center border border-brand/20 mx-auto mb-6">
                <i data-lucide="<?php echo esc_attr($icon); ?>" class="text-brand w-7 h-7"></i>
            </div>
        <?php endif; ?>
        
        <h3 class="text-xl font-black italic mb-3 uppercase"><?php echo esc_html($title); ?></h3>
        <p class="text-white/50 text-xs leading-relaxed italic mb-6"><?php echo esc_html($description); ?></p>
        
        <?php if ($price): ?>
            <div class="mb-6">
                <span class="text-4xl font-black italic text-brand"><?php echo esc_html($price); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($features)): ?>
            <ul class="space-y-2 mb-6">
                <?php foreach ($features as $feature): ?>
                    <li class="flex items-center justify-center gap-2 text-xs">
                        <i data-lucide="check" class="text-brand w-3 h-3"></i>
                        <span><?php echo esc_html($feature); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}