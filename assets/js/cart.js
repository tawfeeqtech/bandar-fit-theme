/**
 * BANDAR FIT - WooCommerce Cart Enhancements
 * @package BandarFit
 */

(function($) {
    'use strict';
    
    // ============================================
    // DOM Ready
    // ============================================
    $(document).ready(function() {
        initCartQuantityButtons();
        initCartRemoveConfirmation();
        initCartTotalsUpdate();
        initCouponCode();
        initCartSuggestions();
        initMiniCart();
    });
    
    // ============================================
    // Cart Quantity Buttons (+ / -)
    // ============================================
    function initCartQuantityButtons() {
        $('.cart-item-quantity').each(function() {
            const container = $(this);
            const input = container.find('input.qty');
            const minusBtn = container.find('.quantity-minus');
            const plusBtn = container.find('.quantity-plus');
            
            if (minusBtn.length && plusBtn.length) {
                minusBtn.on('click', function(e) {
                    e.preventDefault();
                    let val = parseInt(input.val());
                    if (!isNaN(val) && val > 1) {
                        input.val(val - 1).trigger('change');
                    }
                });
                
                plusBtn.on('click', function(e) {
                    e.preventDefault();
                    let val = parseInt(input.val());
                    if (!isNaN(val)) {
                        input.val(val + 1).trigger('change');
                    }
                });
                
                input.on('change', function() {
                    $(this).closest('form').trigger('submit');
                });
            }
        });
    }
    
    // ============================================
    // Remove Item Confirmation
    // ============================================
    function initCartRemoveConfirmation() {
        $('.remove-from-cart').on('click', function(e) {
            e.preventDefault();
            const itemName = $(this).closest('tr').find('.product-name').text();
            
            if (confirm('هل أنت متأكد من إزالة "' + itemName.trim() + '" من السلة؟')) {
                window.location.href = $(this).attr('href');
            }
        });
    }
    
    // ============================================
    // Update Cart Totals on Quantity Change
    // ============================================
    function initCartTotalsUpdate() {
        let updateTimer;
        
        $('.woocommerce-cart-form input.qty').on('change', function() {
            clearTimeout(updateTimer);
            updateTimer = setTimeout(function() {
                $('.woocommerce-cart-form').trigger('submit');
                showLoadingOverlay();
            }, 800);
        });
        
        function showLoadingOverlay() {
            const overlay = '<div class="cart-loading-overlay"><div class="cart-spinner"></div></div>';
            if (!$('.cart-loading-overlay').length) {
                $('.woocommerce-cart-form').append(overlay);
            }
            $('.cart-loading-overlay').fadeIn();
            
            setTimeout(function() {
                $('.cart-loading-overlay').fadeOut();
            }, 1000);
        }
    }
    
    // ============================================
    // Apply Coupon Code Animation
    // ============================================
    function initCouponCode() {
        $('.coupon button').on('click', function(e) {
            const couponCode = $('.coupon input').val();
            if (!couponCode) {
                e.preventDefault();
                showNotice('الرجاء إدخال رمز الخصم', 'error');
            }
        });
        
        function showNotice(message, type) {
            const notice = $('<div class="woocommerce-notice"></div>')
                .addClass(type === 'error' ? 'woocommerce-error' : 'woocommerce-message')
                .text(message);
            
            $('.woocommerce-notices-wrapper').html(notice);
            
            setTimeout(function() {
                notice.fadeOut();
            }, 3000);
        }
    }
    
    // ============================================
    // Cart Suggestions (Upsells)
    // ============================================
    function initCartSuggestions() {
        $('.cart-suggestion-item .add-to-cart').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            const button = $(this);
            
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_add_to_cart',
                    product_id: productId,
                    quantity: 1,
                    security: wc_add_to_cart_params.add_to_cart_nonce
                },
                beforeSend: function() {
                    button.text('جاري الإضافة...').prop('disabled', true);
                },
                success: function(response) {
                    if (response.error) {
                        button.text('أضف إلى السلة').prop('disabled', false);
                        alert('حدث خطأ، الرجاء المحاولة مرة أخرى');
                    } else {
                        button.text('تم الإضافة ✓').addClass('added');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });
    }
    
    // ============================================
    // Mini Cart Dropdown
    // ============================================
    function initMiniCart() {
        $('.mini-cart-toggle').on('click', function(e) {
            e.preventDefault();
            $('.mini-cart-dropdown').toggleClass('open');
        });
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.mini-cart').length) {
                $('.mini-cart-dropdown').removeClass('open');
            }
        });
    }
    
    // ============================================
    // Add to Cart Ajax (Product Page)
    // ============================================
    $(document).on('click', '.single-product .add_to_cart_button', function(e) {
        const button = $(this);
        
        if (button.hasClass('ajax_add_to_cart')) {
            e.preventDefault();
            
            const form = button.closest('form.cart');
            const productId = form.find('input[name="product_id"]').val();
            const quantity = form.find('input[name="quantity"]').val();
            
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_add_to_cart',
                    product_id: productId,
                    quantity: quantity,
                    security: wc_add_to_cart_params.add_to_cart_nonce
                },
                beforeSend: function() {
                    button.text('جاري الإضافة...').prop('disabled', true);
                },
                success: function(response) {
                    if (response.error) {
                        button.text('أضف إلى السلة').prop('disabled', false);
                    } else {
                        button.text('تم الإضافة ✓').addClass('added');
                        
                        // Update mini cart count
                        $('.cart-count').text(response.fragments.cart_count);
                        
                        setTimeout(function() {
                            button.text('أضف إلى السلة').prop('disabled', false);
                        }, 2000);
                    }
                }
            });
        }
    });
    
})(jQuery);