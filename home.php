<?php get_header(); ?>

<main id="appContainer">
    
    <!-- Hero Section -->
    <?php get_template_part('template-parts/hero/hero', 'main'); ?>
    
    <!-- Services Section -->
    <?php get_template_part('template-parts/services/services', 'grid'); ?>
    
    <!-- Methodology Steps -->
    <?php get_template_part('template-parts/steps/methodology', 'steps'); ?>
    
    <!-- Athletes Gallery -->
    <?php get_template_part('template-parts/athletes/athletes', 'gallery'); ?>
    
    <!-- Behind the Scenes -->
    <?php get_template_part('template-parts/hero/hero', 'behind-scenes'); ?>
    
    <!-- Packages Section -->
    <?php get_template_part('template-parts/packages/packages', 'grid'); ?>
    
    <!-- Evaluation Section -->
    <?php get_template_part('template-parts/evaluation/evaluation', 'grid'); ?>
    
    <!-- CTA Section -->
    <?php get_template_part('template-parts/cta/cta', 'section'); ?>
    
</main>

<?php get_footer(); ?>