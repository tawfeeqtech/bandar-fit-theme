<?php
/**
 * قالب نتائج البحث
 * @package BandarFit
 */

get_header(); ?>

<div class="search-page">
    <div class="container">
        <div class="search-header">
            <h1 class="search-title">
                <?php printf(__('نتائج البحث عن: "%s"', 'bandar-fit'), get_search_query()); ?>
            </h1>
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </div>
        
        <?php if (have_posts()) : ?>
            <div class="search-results">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('search-result'); ?>>
                        <div class="search-result-content">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="search-result-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="search-result-details">
                                <h3 class="search-result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="search-result-meta">
                                    <span><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                                    <span><?php echo get_the_date(); ?></span>
                                </div>
                                <p class="search-result-excerpt"><?php echo bandar_excerpt(20); ?></p>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
                
                <?php bandar_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="search-no-results">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <h3><?php _e('لم نعثر على نتائج', 'bandar-fit'); ?></h3>
                <p><?php _e('جرب البحث بكلمات مختلفة.', 'bandar-fit'); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.search-page {
    padding: 100px 0 80px;
}
.search-header {
    text-align: center;
    margin-bottom: 50px;
}
.search-title {
    font-size: 32px;
    margin-bottom: 30px;
}
.search-form-wrapper {
    max-width: 500px;
    margin: 0 auto;
}
.search-result {
    background: var(--bg-secondary);
    border-radius: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}
.search-result:hover {
    transform: translateX(-5px);
    background: var(--bg-tertiary);
}
.search-result-content {
    display: flex;
    gap: 20px;
    padding: 20px;
}
.search-result-thumb {
    flex-shrink: 0;
    width: 100px;
    height: 100px;
    border-radius: 12px;
    overflow: hidden;
}
.search-result-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.search-result-details {
    flex: 1;
}
.search-result-title {
    font-size: 20px;
    margin-bottom: 10px;
}
.search-result-title a {
    color: var(--text-primary);
    text-decoration: none;
}
.search-result-title a:hover {
    color: var(--brand-primary);
}
.search-result-meta {
    display: flex;
    gap: 15px;
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 10px;
}
.search-no-results {
    text-align: center;
    padding: 80px 20px;
}
.search-no-results svg {
    margin-bottom: 20px;
    color: var(--text-muted);
}
@media (max-width: 768px) {
    .search-result-content {
        flex-direction: column;
    }
    .search-result-thumb {
        width: 100%;
        height: 150px;
    }
}
</style>

<?php get_footer(); ?>