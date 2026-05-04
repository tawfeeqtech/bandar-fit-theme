/**
 * BANDAR FIT - Main JavaScript
 * @package BandarFit
 */

(function () {
    'use strict';

    // ============================================
    // DOM Ready
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        initHeaderScroll();
        initMobileMenu();
        initBackToTop();
        initSmoothScroll();
        initLazyLoad();
        initKeyboardNavigation();
    });


    // ============================================
    // Header Scroll Effect
    // ============================================
    function initHeaderScroll() {
        const header = document.getElementById('mainHeader');
        if (!header) return;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // assets/js/main.js - إضافة التنقل عبر لوحة المفاتيح
    function initKeyboardNavigation() {
        // Focus management for mobile menu
        const menuBtn = document.getElementById('mobileMenuBtn');
        const menuOverlay = document.getElementById('mobileMenuOverlay');
        const focusableElements = menuOverlay ? menuOverlay.querySelectorAll('a, button, [tabindex="0"]') : [];
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        if (menuBtn) {
            menuBtn.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    menuOverlay.classList.add('active');
                    if (firstFocusable) firstFocusable.focus();
                }
            });
        }

        if (menuOverlay) {
            menuOverlay.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    menuOverlay.classList.remove('active');
                    menuBtn.focus();
                }

                if (e.key === 'Tab') {
                    if (e.shiftKey && document.activeElement === firstFocusable) {
                        e.preventDefault();
                        lastFocusable.focus();
                    } else if (!e.shiftKey && document.activeElement === lastFocusable) {
                        e.preventDefault();
                        firstFocusable.focus();
                    }
                }
            });
        }

        // Skip to content link
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.className = 'skip-link';
        skipLink.textContent = 'تخطي إلى المحتوى الرئيسي';
        skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 0;
        background: var(--brand-primary);
        color: var(--brand-dark);
        padding: 8px 16px;
        z-index: 9999;
        text-decoration: none;
        font-weight: bold;
    `;
        skipLink.addEventListener('focus', () => skipLink.style.top = '0');
        skipLink.addEventListener('blur', () => skipLink.style.top = '-40px');
        document.body.prepend(skipLink);
    }

    // ============================================
    // Mobile Menu
    // ============================================
    function initMobileMenu() {
        const menuBtn = document.getElementById('mobileMenuBtn');
        const menuOverlay = document.getElementById('mobileMenuOverlay');
        const menuClose = document.getElementById('mobileMenuClose');

        if (!menuBtn || !menuOverlay) return;

        function openMenu() {
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);

        if (menuClose) {
            menuClose.addEventListener('click', closeMenu);
        }

        menuOverlay.addEventListener('click', function (e) {
            if (e.target === menuOverlay) {
                closeMenu();
            }
        });

        // Close on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && menuOverlay.classList.contains('active')) {
                closeMenu();
            }
        });
    }

    // ============================================
    // Back to Top Button
    // ============================================
    function initBackToTop() {
        const backBtn = document.getElementById('backToTop');
        if (!backBtn) return;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                backBtn.classList.add('visible');
            } else {
                backBtn.classList.remove('visible');
            }
        });

        backBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ============================================
    // Smooth Scroll for Anchor Links
    // ============================================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (anchor) {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    const headerOffset = 100;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ============================================
    // Lazy Load Images
    // ============================================
    function initLazyLoad() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.loading = 'lazy';
            });
        } else {
            // Fallback with Intersection Observer
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.dataset.src;
                        if (src) {
                            img.src = src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // ============================================
    // Scroll Animations (Fade In)
    // ============================================
    function initAnimations() {
        const animatedElements = document.querySelectorAll('.fade-in-on-scroll');

        if ('IntersectionObserver' in window && animatedElements.length) {
            const animationObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            animatedElements.forEach(function (element) {
                animationObserver.observe(element);
            });
        } else {
            animatedElements.forEach(function (element) {
                element.classList.add('animated');
            });
        }
    }

    // ============================================
    // Lucide Icons Initialization
    // ============================================
    function initLucideIcons() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // ============================================
    // Form Validation
    // ============================================
    window.bandarValidateForm = function (formId) {
        const form = document.getElementById(formId);
        if (!form) return true;

        let isValid = true;
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

        inputs.forEach(function (input) {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('error');

                // Show error message
                let errorMsg = input.parentElement.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('span');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'هذا الحقل مطلوب';
                    input.parentElement.appendChild(errorMsg);
                }
            } else {
                input.classList.remove('error');
                const errorMsg = input.parentElement.querySelector('.error-message');
                if (errorMsg) errorMsg.remove();
            }
        });

        return isValid;
    };

})();
