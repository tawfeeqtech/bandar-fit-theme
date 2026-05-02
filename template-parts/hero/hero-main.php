<section class="min-h-screen relative flex items-center justify-center text-center">
    <div class="absolute inset-0 z-0">
        <?php 
        $hero_image = get_theme_mod('hero_image', BANDAR_URI . '/assets/images/hero-default.jpg');
        echo '<img src="' . esc_url($hero_image) . '" class="w-full h-full object-cover opacity-20" alt="Football Hero">';
        ?>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-dark/95"></div>
    </div>

    <div class="relative z-10 px-6 text-center max-w-4xl mx-auto">
        <span class="text-brand font-black text-[10px] uppercase tracking-[0.6em] mb-4 block italic">
            <?php echo get_theme_mod('hero_tagline', 'Football Performance Architecture'); ?>
        </span>
        
        <h1 class="text-4xl md:text-6xl font-black italic mb-6 leading-[1.1] tracking-tighter uppercase">
            <?php echo get_theme_mod('hero_title', 'إعدادك بدنياً مع <span class="text-brand gold-glow">كوتش بندر</span>'); ?>
        </h1>
        
        <p class="text-white/40 text-base md:text-lg mb-12 max-w-xl mx-auto leading-relaxed italic">
            <?php echo get_theme_mod('hero_subtitle', '"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"'); ?>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
            <?php
            // جلب الخدمات من CPT
            $services = get_posts(['post_type' => 'service', 'posts_per_page' => 2]);
            foreach ($services as $index => $service):
                $icon = get_post_meta($service->ID, 'service_icon', true) ?: ($index === 0 ? 'medal' : 'clipboard-check');
            ?>
                <div onclick="location.href='<?php echo get_permalink($service->ID); ?>'" 
                     class="service-card p-10 rounded-[2.5rem] cursor-pointer group flex flex-col items-center bg-surface border border-white/5 hover:border-brand transition-all hover:-translate-y-2">
                    <i data-lucide="<?php echo esc_attr($icon); ?>" class="text-brand w-10 h-10 mb-6 group-hover:scale-110 transition-all"></i>
                    <h3 class="text-2xl font-black italic mb-2 uppercase"><?php echo esc_html($service->post_title); ?></h3>
                    <p class="text-white/40 text-xs mb-6 uppercase"><?php echo esc_html($service->post_excerpt); ?></p>
                    <span class="text-brand text-[10px] font-black uppercase tracking-widest flex items-center gap-2 italic">
                        دخول البرنامج <i data-lucide="arrow-left" class="w-3 h-3"></i>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>