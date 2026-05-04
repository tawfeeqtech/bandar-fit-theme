<?php
/**
 * Template Name: Blank Template (قالب فارغ)
 * Template Post Type: page
 *
 * @package BandarFit
 */

get_header();
?>

<main class="blank-template">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<style>
.blank-template {
    min-height: 100vh;
    padding: 120px 0 80px;
}
.blank-template .page-content {
    max-width: 1200px;
    margin: 0 auto;
}
</style>

<?php get_footer(); ?>