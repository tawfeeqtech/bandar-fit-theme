    <?php
/**
 * مكون الأكورديون Accordion Component
 * @package BandarFit
 * 
 * @param array $items مصفوفة من العناصر (كل عنصر له title و content)
 * @param string $id معرف فريد للأكورديون
 * @return string
 */

function bandar_accordion($items, $id = 'accordion') {
    if (empty($items)) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="accordion" id="<?php echo esc_attr($id); ?>">
        <?php foreach ($items as $index => $item) : 
            $is_active = $index === 0 ? 'active' : '';
        ?>
            <div class="accordion-item <?php echo esc_attr($is_active); ?>">
                <button class="accordion-header" data-target="#accordion-<?php echo esc_attr($id . '-' . $index); ?>">
                    <span class="accordion-title"><?php echo esc_html($item['title']); ?></span>
                    <span class="accordion-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </span>
                </button>
                <div class="accordion-content" id="accordion-<?php echo esc_attr($id . '-' . $index); ?>">
                    <div class="accordion-content-inner">
                        <?php echo wp_kses_post($item['content']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <style>
    .accordion {
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
    }
    
    .accordion-item {
        border-bottom: 1px solid var(--border-color);
    }
    
    .accordion-item:last-child {
        border-bottom: none;
    }
    
    .accordion-header {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 25px;
        background: var(--bg-secondary);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        text-align: right;
    }
    
    .accordion-header:hover {
        background: rgba(197, 168, 128, 0.05);
    }
    
    .accordion-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
    }
    
    .accordion-icon svg {
        transition: transform 0.3s ease;
        color: var(--brand-primary);
    }
    
    .accordion-item.active .accordion-icon svg {
        transform: rotate(180deg);
    }
    
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background: var(--bg-primary);
    }
    
    .accordion-item.active .accordion-content {
        max-height: 500px;
    }
    
    .accordion-content-inner {
        padding: 20px 25px;
        color: var(--text-secondary);
        line-height: 1.6;
    }
    </style>
    
    <script>
    (function() {
        const accordionHeaders = document.querySelectorAll('#<?php echo esc_js($id); ?> .accordion-header');
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const parent = this.closest('.accordion-item');
                const isActive = parent.classList.contains('active');
                
                // Close all items in the same accordion
                document.querySelectorAll('#<?php echo esc_js($id); ?> .accordion-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                if (!isActive) {
                    parent.classList.add('active');
                }
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}