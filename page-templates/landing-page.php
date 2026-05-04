<?php
/**
 * Template Name: Landing Page (صفحة هبوط)
 * Template Post Type: page
 *
 * @package BandarFit
 */

// No header, no footer for landing page
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('landing-page'); ?>>
<?php wp_body_open(); ?>

<main class="landing-page-main">
    <div class="landing-container">
        <?php while (have_posts()) : the_post(); ?>
            <div class="landing-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php wp_footer(); ?>
</body>
</html>

<style>
.landing-page {
    background: var(--bg-primary, #0F0F0F);
    color: var(--text-primary, #E2E8F0);
    font-family: 'Cairo', sans-serif;
    overflow-x: hidden;
}

.landing-page-main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.landing-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.landing-content {
    text-align: center;
}

/* Landing page specific button styles */
.landing-page .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 40px;
    font-weight: 900;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.landing-page .btn-primary {
    background: linear-gradient(135deg, var(--brand-primary, #C5A880) 0%, #A68B63 100%);
    color: #0F0F0F;
}

.landing-page .btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(197, 168, 128, 0.4);
}
</style>