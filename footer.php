</main><!-- #main-content -->

<!-- ============================================
     Footer - الفوتر الفعلي من الموقع
     ============================================ -->
<?php get_template_part('template-parts/footer', 'main'); ?>
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