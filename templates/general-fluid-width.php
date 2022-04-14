<?php
/*Template Name: General - Fluid Width*/
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<?php while (have_posts()) : ?>
    <?php the_post(); ?>

    <div class="container-fluid py-3 mb-5">
        <div class="row">
            <div class="container">
                <?php the_title('<h1 class="entry-title mb-0">', '</h1>'); ?>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white py-5">
        <div class="row">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile ?>

<?php get_footer(); ?>
