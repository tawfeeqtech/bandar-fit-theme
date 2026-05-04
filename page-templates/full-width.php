<?php
/**
 * Template Name: Full Width (عرض كامل)
 * Template Post Type: page
 *
 * @package BandarFit
 */

get_header();
?>

<main class="full-width-template">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="page-hero">
                <?php the_post_thumbnail('full', ['class' => 'page-hero-image']); ?>
                <div class="page-hero-overlay"></div>
                <div class="page-hero-content container">
                    <h1 class="page-hero-title"><?php the_title(); ?></h1>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="page-content-wrapper">
            <div class="container">
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
                
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </div>
        </div>
        
    <?php endwhile; ?>
</main>

<style>
.full-width-template .page-hero {
    position: relative;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.full-width-template .page-hero-image {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.4);
}

.full-width-template .page-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 0%, var(--brand-dark) 95%);
}

.full-width-template .page-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.full-width-template .page-hero-title {
    font-size: 48px;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
}

@media (min-width: 768px) {
    .full-width-template .page-hero-title {
        font-size: 64px;
    }
}

.full-width-template .page-content-wrapper {
    padding: 80px 0;
}
</style>

<?php get_footer(); ?>