/**
 * BANDAR FIT - WhatsApp Integration
 * @package BandarFit
 */

(function($) {
    'use strict';
    
    // ============================================
    // WhatsApp Configuration
    // ============================================
    const whatsappConfig = {
        number: bandarAjax?.whatsappUrl ? bandarAjax.whatsappUrl.replace('https://wa.me/', '').split('?')[0] : '966500000000',
        defaultMessage: 'مرحباً، أريد الاستفسار عن خدمات BANDAR FIT',
        isOpen: false,
        widget: null
    };
    
    // ============================================
    // DOM Ready
    // ============================================
    $(document).ready(function() {
        initWhatsAppButton();
        initWhatsAppWidget();
        initPredefinedMessages();
        initLeadCapture();
    });
    
    // ============================================
    // WhatsApp Floating Button Enhancement
    // ============================================
    function initWhatsAppButton() {
        const whatsappBtn = document.querySelector('.whatsapp-float');
        if (!whatsappBtn) return;
        
        // Track click event
        whatsappBtn.addEventListener('click', function(e) {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'WhatsApp',
                    'event_label': 'Floating Button',
                    'value': 1
                });
            }
            
            // Save to localStorage for tracking
            localStorage.setItem('bandar_whatsapp_clicked', Date.now());
        });
        
        // Show tooltip on first visit
        const hasSeenTooltip = localStorage.getItem('bandar_whatsapp_tooltip');
        if (!hasSeenTooltip) {
            setTimeout(function() {
                showTooltip(whatsappBtn, 'تواصل معنا مباشرة');
                localStorage.setItem('bandar_whatsapp_tooltip', 'true');
            }, 3000);
        }
    }
    
    // ============================================
    // WhatsApp Widget (Chat Interface)
    // ============================================
    function initWhatsAppWidget() {
        // Create widget container if enabled
        const widgetEnabled = document.body.hasAttribute('data-whatsapp-widget');
        if (!widgetEnabled) return;
        
        const widgetHTML = `
            <div class="whatsapp-widget" id="whatsappWidget">
                <div class="whatsapp-widget-header">
                    <div class="whatsapp-widget-avatar">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                        </svg>
                    </div>
                    <div class="whatsapp-widget-info">
                        <h4>كوتش بندر</h4>
                        <p>متصل الآن</p>
                    </div>
                    <button class="whatsapp-widget-close" id="whatsappWidgetClose">×</button>
                </div>
                <div class="whatsapp-widget-messages" id="whatsappMessages">
                    <div class="message received">
                        <p>مرحباً! 👋</p>
                        <span class="message-time">الآن</span>
                    </div>
                    <div class="message received">
                        <p>كيف يمكنني مساعدتك اليوم؟</p>
                        <span class="message-time">الآن</span>
                    </div>
                </div>
                <div class="whatsapp-widget-input">
                    <input type="text" placeholder="اكتب رسالتك..." id="whatsappInput">
                    <button id="whatsappSendBtn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', widgetHTML);
        
        const widget = document.getElementById('whatsappWidget');
        const closeBtn = document.getElementById('whatsappWidgetClose');
        const sendBtn = document.getElementById('whatsappSendBtn');
        const input = document.getElementById('whatsappInput');
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                widget.classList.remove('open');
                whatsappConfig.isOpen = false;
            });
        }
        
        if (sendBtn && input) {
            const sendMessage = function() {
                const message = input.value.trim();
                if (message) {
                    addMessage(message, 'sent');
                    input.value = '';
                    
                    // Open WhatsApp with the message
                    const whatsappUrl = `https://wa.me/${whatsappConfig.number}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                    
                    setTimeout(function() {
                        widget.classList.remove('open');
                        whatsappConfig.isOpen = false;
                    }, 500);
                }
            };
            
            sendBtn.addEventListener('click', sendMessage);
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') sendMessage();
            });
        }
    }
    
    // ============================================
    // Add Message to Widget
    // ============================================
    function addMessage(text, type) {
        const messagesContainer = document.getElementById('whatsappMessages');
        if (!messagesContainer) return;
        
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.innerHTML = `
            <p>${escapeHtml(text)}</p>
            <span class="message-time">الآن</span>
        `;
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    // ============================================
    // Predefined Messages
    // ============================================
    function initPredefinedMessages() {
        const quickReplies = document.querySelectorAll('.whatsapp-quick-reply');
        
        quickReplies.forEach(function(reply) {
            reply.addEventListener('click', function() {
                const message = this.getAttribute('data-message');
                if (message) {
                    const whatsappUrl = `https://wa.me/${whatsappConfig.number}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                }
            });
        });
    }
    
    // ============================================
    // Lead Capture before WhatsApp
    // ============================================
    function initLeadCapture() {
        const leadForm = document.getElementById('whatsappLeadForm');
        if (!leadForm) return;
        
        leadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('lead_name')?.value || '';
            const phone = document.getElementById('lead_phone')?.value || '';
            const message = document.getElementById('lead_message')?.value || '';
            
            let whatsappMessage = `مرحباً! أنا ${name}\n`;
            whatsappMessage += `رقمي: ${phone}\n`;
            if (message) whatsappMessage += `الاستفسار: ${message}`;
            
            const whatsappUrl = `https://wa.me/${whatsappConfig.number}?text=${encodeURIComponent(whatsappMessage)}`;
            window.open(whatsappUrl, '_blank');
            
            // Save lead data
            if (typeof bandarAjax !== 'undefined' && bandarAjax.ajaxUrl) {
                $.post(bandarAjax.ajaxUrl, {
                    action: 'save_whatsapp_lead',
                    nonce: bandarAjax.nonce,
                    name: name,
                    phone: phone,
                    message: message
                });
            }
        });
    }
    
    // ============================================
    // Helper Functions
    // ============================================
    function showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'whatsapp-tooltip';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            bottom: 100%;
            right: 0;
            background: var(--brand-primary);
            color: var(--brand-dark);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            margin-bottom: 10px;
            animation: fadeInUp 0.3s ease;
        `;
        
        element.style.position = 'relative';
        element.appendChild(tooltip);
        
        setTimeout(function() {
            tooltip.remove();
        }, 4000);
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
})(jQuery);