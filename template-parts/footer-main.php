<?php
/**
 * Main Footer Template Part
 */
?>
<footer class="py-20 border-t border-white/5 text-center bg-dark/50">
    <!-- Brand Name -->
    <span class="text-2xl font-black italic uppercase text-brand gold-glow block mb-10">
        <?php echo esc_html(get_theme_mod('footer_brand_name', 'BANDAR FIT')); ?>
    </span>
    
    <!-- WhatsApp Button -->
    <div class="mb-10">
        <a href="<?php echo bandar_get_whatsapp_url(); ?>" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-brand/10 border border-brand/30 rounded-2xl text-brand font-black italic hover:bg-brand hover:text-dark transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="message-circle" aria-hidden="true" class="lucide lucide-message-circle w-6 h-6"><path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"></path></svg>
            تواصل مباشر عبر واتساب
        </a>
    </div>
    
    <!-- Social Icons -->
    <div class="flex gap-6 justify-center mb-10">
        <?php 
        $social_platforms = [
            'instagram' => [
                'url' => get_theme_mod('footer_instagram_url', '#'),
                'svg' => get_theme_mod('footer_instagram_svg', '<i data-lucide="instagram" class="w-5 h-5"></i>')
            ],
            'tiktok' => [
                'url' => get_theme_mod('footer_tiktok_url', '#'),
                'svg' => get_theme_mod('footer_tiktok_svg', '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="music-2" aria-hidden="true" class="lucide lucide-music-2 w-5 h-5"><circle cx="8" cy="18" r="4"></circle><path d="M12 18V2l7 4"></path></svg>')
            ],
            'twitter' => [
                'url' => get_theme_mod('footer_twitter_url', '#'),
                'svg' => get_theme_mod('footer_twitter_svg', '<i data-lucide="twitter" class="w-5 h-5"></i>')
            ]
        ];

        foreach ($social_platforms as $platform) :
            if (!empty($platform['url']) && $platform['url'] !== '#') :
        ?>
            <a href="<?php echo esc_url($platform['url']); ?>" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center border border-white/10 hover:border-brand transition-all group" target="_blank" rel="noopener noreferrer">
                <div class="w-5 h-5 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full [&>svg]:fill-current [&>i]:w-full [&>i]:h-full">
                    <?php echo $platform['svg']; ?>
                </div>
            </a>
        <?php 
            endif;
        endforeach; 
        ?>
    </div>
    
    <!-- Copyright -->
    <p class="text-white/20 text-[10px] font-black uppercase italic">
        <?php echo wp_kses_post(get_theme_mod('footer_copyright_text', '2026 BANDAR FIT | جميع الحقوق محفوظة © 2026 كوتش بندر')); ?>
    </p>
</footer>
