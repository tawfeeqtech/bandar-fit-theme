<?php
/**
 * قالب صفحة الأرشيف
 * @package BandarFit
 */

get_header(); ?>

<div class="archive-page">
    <div class="container">
        <div class="archive-header">
            <?php
            if (is_category()) {
                echo '<h1 class="archive-title">' . single_cat_title('', false) . '</h1>';
                $category_description = category_description();
                if ($category_description) {
                    echo '<div class="archive-description">' . $category_description . '</div>';
                }
            } elseif (is_tag()) {
                echo '<h1 class="archive-title">#' . single_tag_title('', false) . '</h1>';
            } elseif (is_author()) {
                echo '<h1 class="archive-title">' . get_the_author() . '</h1>';
            } elseif (is_year()) {
                echo '<h1 class="archive-title">' . get_the_date('Y') . '</h1>';
            } elseif (is_month()) {
                echo '<h1 class="archive-title">' . get_the_date('F Y') . '</h1>';
            } elseif (is_day()) {
                echo '<h1 class="archive-title">' . get_the_date('F j, Y') . '</h1>';
            } elseif (is_post_type_archive()) {
                echo '<h1 class="archive-title">' . post_type_archive_title('', false) . '</h1>';
            } else {
                echo '<h1 class="archive-title">' . __('الأرشيف', 'bandar-fit') . '</h1>';
            }
            ?>
        </div>
        
        <?php if (have_posts()) : ?>
            <div class="archive-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('archive-post'); ?>>
                        <div class="archive-post-inner">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="archive-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('bandar-card'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="archive-post-content">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo '<a href="' . get_category_link($categories[0]->term_id) . '" class="archive-post-category">' . $categories[0]->name . '</a>';
                                }
                                ?>
                                
                                <h2 class="archive-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="archive-post-meta">
                                    <span><?php echo get_the_date(); ?></span>
                                    <span><?php _e('بواسطة', 'bandar-fit'); ?> <?php the_author(); ?></span>
                                </div>
                                
                                <p class="archive-post-excerpt"><?php echo bandar_excerpt(15); ?></p>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php _e('اقرأ المزيد', 'bandar-fit'); ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                        <polyline points="12 5 19 12 12 19"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php bandar_pagination(); ?>
        <?php else : ?>
            <p><?php _e('لا توجد مقالات لعرضها.', 'bandar-fit'); ?></p>
        <?php endif; ?>
    </div>
</div>

<style>
.archive-page {
    padding: 100px 0 80px;
}
.archive-header {
    text-align: center;
    margin-bottom: 50px;
}
.archive-title {
    font-size: 42px;
    margin-bottom: 15px;
}
.archive-grid {
    display: grid;
    gap: 30px;
}
@media (min-width: 768px) {
    .archive-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (min-width: 1024px) {
    .archive-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
.archive-post {
    background: var(--bg-secondary);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.archive-post:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}
.archive-post-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    overflow: hidden;
}
.archive-post-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.archive-post:hover .archive-post-thumb img {
    transform: scale(1.05);
}
.archive-post-content {
    padding: 20px;
}
.archive-post-category {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--brand-primary);
    text-decoration: none;
    margin-bottom: 10px;
}
.archive-post-title {
    font-size: 20px;
    margin-bottom: 10px;
}
.archive-post-title a {
    color: var(--text-primary);
    text-decoration: none;
}
.archive-post-title a:hover {
    color: var(--brand-primary);
}
.archive-post-meta {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 15px;
    display: flex;
    gap: 15px;
}
.archive-post-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 15px;
}
.read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    color: var(--brand-primary);
}
.read-more svg {
    transition: transform 0.3s ease;
}
.read-more:hover svg {
    transform: translateX(-5px);
}
</style>

<?php get_footer(); ?>