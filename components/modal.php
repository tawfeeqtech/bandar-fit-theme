<?php
/**
 * مكون النافذة المنبثقة Modal Component
 * @package BandarFit
 */

/**
 * إنشاء نافذة منبثقة
 */
function bandar_modal($id, $title, $content, $trigger_text = null, $trigger_type = 'button') {
    $trigger_html = '';
    
    if ($trigger_text) {
        if ($trigger_type === 'button') {
            $trigger_html = '<button class="btn btn-primary modal-trigger" data-modal="' . esc_attr($id) . '">' . esc_html($trigger_text) . '</button>';
        } else {
            $trigger_html = '<a href="#" class="modal-trigger" data-modal="' . esc_attr($id) . '">' . esc_html($trigger_text) . '</a>';
        }
    }
    
    ob_start();
    ?>
    <div class="modal-overlay" id="modal-<?php echo esc_attr($id); ?>">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title"><?php echo esc_html($title); ?></h3>
                <button class="modal-close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <?php echo wp_kses_post($content); ?>
            </div>
        </div>
    </div>
    
    <?php if ($trigger_html) : ?>
        <?php echo $trigger_html; ?>
    <?php endif; ?>
    
    <style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-container {
        background: var(--bg-secondary);
        border-radius: 30px;
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    
    .modal-overlay.active .modal-container {
        transform: scale(1);
    }
    
    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .modal-title {
        font-size: 22px;
        font-weight: 900;
        font-style: italic;
        margin: 0;
    }
    
    .modal-close {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
    }
    
    .modal-close svg {
        stroke: var(--text-secondary);
        transition: stroke 0.3s ease;
    }
    
    .modal-close:hover svg {
        stroke: var(--brand-primary);
    }
    
    .modal-body {
        padding: 25px;
    }
    </style>
    
    <script>
    (function() {
        const modal = document.getElementById('modal-<?php echo esc_js($id); ?>');
        const triggers = document.querySelectorAll('[data-modal="<?php echo esc_js($id); ?>"]');
        const closeBtn = modal.querySelector('.modal-close');
        
        function openModal() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        triggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
        });
        
        closeBtn.addEventListener('click', closeModal);
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}