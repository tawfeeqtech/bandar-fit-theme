<?php
/**
 * مكون علامات التبويب Tabs Component
 * @package BandarFit
 */

function bandar_tabs($tabs, $id = 'tabs') {
    if (empty($tabs)) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="bandar-tabs" id="<?php echo esc_attr($id); ?>">
        <div class="tabs-header">
            <?php foreach ($tabs as $index => $tab) : ?>
                <button class="tab-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-tab="<?php echo esc_attr($id . '-panel-' . $index); ?>">
                    <?php if (!empty($tab['icon'])) : ?>
                        <i data-lucide="<?php echo esc_attr($tab['icon']); ?>" width="18" height="18"></i>
                    <?php endif; ?>
                    <span><?php echo esc_html($tab['title']); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
        
        <div class="tabs-content">
            <?php foreach ($tabs as $index => $tab) : ?>
                <div class="tab-panel <?php echo $index === 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($id . '-panel-' . $index); ?>">
                    <div class="tab-panel-inner">
                        <?php echo wp_kses_post($tab['content']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <style>
    .bandar-tabs {
        background: var(--bg-secondary);
        border-radius: 24px;
        overflow: hidden;
    }
    
    .tabs-header {
        display: flex;
        gap: 5px;
        background: var(--bg-tertiary);
        padding: 10px;
        border-bottom: 1px solid var(--border-color);
        overflow-x: auto;
    }
    
    .tab-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: transparent;
        border: none;
        border-radius: 16px;
        font-family: inherit;
        font-weight: 700;
        font-size: 14px;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .tab-btn:hover {
        color: var(--brand-primary);
    }
    
    .tab-btn.active {
        background: var(--brand-primary);
        color: var(--brand-dark);
    }
    
    .tab-btn.active svg {
        color: var(--brand-dark);
    }
    
    .tab-panel {
        display: none;
        padding: 30px;
        animation: fadeInTab 0.3s ease;
    }
    
    .tab-panel.active {
        display: block;
    }
    
    @keyframes fadeInTab {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .tab-btn {
            padding: 10px 16px;
            font-size: 12px;
        }
        
        .tab-panel {
            padding: 20px;
        }
    }
    </style>
    
    <script>
    (function() {
        const tabsContainer = document.getElementById('<?php echo esc_js($id); ?>');
        const buttons = tabsContainer.querySelectorAll('.tab-btn');
        const panels = tabsContainer.querySelectorAll('.tab-panel');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-tab');
                
                buttons.forEach(btn => btn.classList.remove('active'));
                panels.forEach(panel => panel.classList.remove('active'));
                
                this.classList.add('active');
                document.getElementById(targetId).classList.add('active');
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}