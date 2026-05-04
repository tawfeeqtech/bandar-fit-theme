</main><!-- #main-content -->

<!-- ============================================
     Footer
     ============================================ -->
<footer class="site-footer">
    <div class="container">
        <!-- Footer Widgets -->
        <div class="footer-widgets">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-4')) : ?>
                <div class="footer-widget-area">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Footer Navigation -->
        <div class="footer-nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'menu_class' => 'footer-menu',
                'container' => false,
                'fallback_cb' => false,
                'depth' => 1,
            ]);
            ?>
        </div>
        
        <!-- Social Icons -->
        <div class="social-icons">
            <?php
            $social_links = bandar_get_social_links();
            foreach ($social_links as $platform => $link) {
                if ($link && $link !== '#') {
                    echo '<a href="' . esc_url($link) . '" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr($platform) . '">';
                    echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
                    switch ($platform) {
                        case 'instagram':
                            echo '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>';
                            break;
                        case 'twitter':
                            echo '<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>';
                            break;
                        case 'snapchat':
                            echo '<path d="M12 2C8 2 4 5 4 9v2c0 1-1 2-2 2h0v2c2 0 3 1 3 3v2h14v-2c0-2 1-3 3-3v-2h0c-1-1-2-2-2-2V9c0-4-4-7-8-7z"/><path d="M12 22v-4"/>';
                            break;
                        default:
                            echo '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>';
                    }
                    echo '</svg>';
                    echo '</a>';
                }
            }
            ?>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | 
               <?php _e('جميع الحقوق محفوظة', 'bandar-fit'); ?>
            </p>
            <p class="footer-credits">
                <?php _e('تصميم وتطوير', 'bandar-fit'); ?> 
                <a href="https://bandar-fit.com" target="_blank">BANDAR Performance Architecture</a>
            </p>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" aria-label="<?php esc_attr_e('العودة للأعلى', 'bandar-fit'); ?>">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>

<?php wp_footer(); ?>

<!-- Custom JS for navigation -->
<script>
(function() {
    // Header scroll effect
    const header = document.getElementById('mainHeader');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Mobile menu toggle
    const menuBtn = document.getElementById('mobileMenuBtn');
    const menuOverlay = document.getElementById('mobileMenuOverlay');
    const menuClose = document.getElementById('mobileMenuClose');
    
    if (menuBtn && menuOverlay) {
        menuBtn.addEventListener('click', function() {
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        const closeMenu = function() {
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        };
        
        if (menuClose) {
            menuClose.addEventListener('click', closeMenu);
        }
        
        menuOverlay.addEventListener('click', function(e) {
            if (e.target === menuOverlay) {
                closeMenu();
            }
        });
    }
    
    // Back to top button
    const backBtn = document.getElementById('backToTop');
    if (backBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backBtn.classList.add('visible');
            } else {
                backBtn.classList.remove('visible');
            }
        });
        
        backBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
})();
</script>

</body>
</html>