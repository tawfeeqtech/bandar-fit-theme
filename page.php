<?php
/**
 * قالب الصفحات العادية
 * @package BandarFit
 */

get_header(); ?>

<div class="container">
    <div class="page-wrapper">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class('page'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-hero">
                            <?php the_post_thumbnail('bandar-hero'); ?>
                            <div class="page-hero-overlay"></div>
                            <div class="page-hero-content">
                                <h1 class="page-title"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="page-header">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </div>
                    <?php endif; ?>
                    
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <?php
                    // عرض التعليقات إذا كانت مفتوحة
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>