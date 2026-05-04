<?php
/**
 * قالب المقالات المفردة
 * @package BandarFit
 */

get_header(); ?>

<div class="container">
    <div class="single-wrapper">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <!-- Article Header -->
                    <header class="single-header">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-thumbnail">
                                <?php the_post_thumbnail('full'); ?>
                                <div class="single-category">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) {
                                        echo '<a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="single-title"><?php the_title(); ?></h1>
                        
                        <div class="single-meta">
                            <span class="meta-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="meta-author">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <?php the_author(); ?>
                            </span>
                            <span class="meta-comments">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                                <?php comments_number('0', '1', '%'); ?>
                            </span>
                        </div>
                    </header>
                    
                    <!-- Article Content -->
                    <div class="single-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Article Footer -->
                    <footer class="single-footer">
                        <div class="single-tags">
                            <?php
                            $tags = get_the_tags();
                            if ($tags) {
                                foreach ($tags as $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '">#' . $tag->name . '</a>';
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="single-share">
                            <span><?php _e('مشاركة:', 'bandar-fit'); ?></span>
                            <div class="share-links">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-facebook">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-twitter">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="share-whatsapp">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </footer>
                    
                    <!-- Author Bio -->
                    <div class="author-bio">
                        <div class="author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                        </div>
                        <div class="author-info">
                            <h4><?php the_author(); ?></h4>
                            <p><?php echo get_the_author_meta('description'); ?></p>
                        </div>
                    </div>
                    
                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="post-comments">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Navigation -->
                    <div class="post-navigation">
                        <div class="nav-previous">
                            <?php previous_post_link('%link', __('← المقال السابق', 'bandar-fit')); ?>
                        </div>
                        <div class="nav-next">
                            <?php next_post_link('%link', __('المقال التالي →', 'bandar-fit')); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>