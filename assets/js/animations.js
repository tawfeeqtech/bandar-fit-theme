/**
 * BANDAR FIT - Animations JavaScript
 * @package BandarFit
 */

(function($) {
    'use strict';
    
    // ============================================
    // DOM Ready
    // ============================================
    $(document).ready(function() {
        initCounterAnimation();
        initHoverEffects();
        initCardAnimations();
        initTypingEffect();
        initParallaxEffect();
    });
    
    // ============================================
    // Counter Animation for Statistics
    // ============================================
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.stat-number[data-target]');
        
        if (!counters.length) return;
        
        const counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;
                    
                    const updateCounter = function() {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    };
                    
                    updateCounter();
                    counterObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(function(counter) {
            counterObserver.observe(counter);
        });
    }
    
    // ============================================
    // Hover Effects
    // ============================================
    function initHoverEffects() {
        // Service cards hover effect
        document.querySelectorAll('.service-card').forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Price cards hover effect
        document.querySelectorAll('.price-card').forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('featured')) {
                    this.style.transform = 'translateY(-5px)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('featured')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });
    }
    
    // ============================================
    // Card Entrance Animations
    // ============================================
    function initCardAnimations() {
        const cards = document.querySelectorAll('.service-card, .price-card, .eval-card, .step-card, .athlete-card');
        
        if (!cards.length) return;
        
        const cardObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry, index) {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        cards.forEach(function(card, index) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
            cardObserver.observe(card);
        });
    }
    
    // ============================================
    // Typing Effect for Hero
    // ============================================
    function initTypingEffect() {
        const heroElement = document.querySelector('.hero-typing');
        if (!heroElement) return;
        
        const texts = JSON.parse(heroElement.getAttribute('data-texts') || '["كوتش بندر"]');
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function typeEffect() {
            const currentText = texts[textIndex];
            
            if (isDeleting) {
                heroElement.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                heroElement.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(typeEffect, 2000);
                return;
            }
            
            if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(typeEffect, 500);
                return;
            }
            
            const speed = isDeleting ? 50 : 100;
            setTimeout(typeEffect, speed);
        }
        
        typeEffect();
    }
    
    // ============================================
    // Parallax Effect
    // ============================================
    function initParallaxEffect() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        if (!parallaxElements.length) return;
        
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(function(element) {
                const speed = element.getAttribute('data-speed') || 0.5;
                const offset = scrolled * speed;
                element.style.transform = 'translateY(' + offset + 'px)';
            });
        });
    }
    
    // ============================================
    // Page Transition Effect
    // ============================================
    window.bandarPageTransition = {
        init: function() {
            document.querySelectorAll('a:not([target="_blank"]):not([href^="#"])').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#' && !href.startsWith('javascript:')) {
                        e.preventDefault();
                        
                        document.body.classList.add('page-exit');
                        
                        setTimeout(function() {
                            window.location.href = href;
                        }, 300);
                    }
                });
            });
        }
    };
    
    // Remove transition class on load
    window.addEventListener('load', function() {
        document.body.classList.remove('page-exit');
    });
    
})(jQuery);