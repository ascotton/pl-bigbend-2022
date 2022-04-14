<?php
// default page template
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<?php while (have_posts()) : ?>
    <?php the_post(); ?>

    <div class="container-fluid py-3 mb-5">
        <div class="row">
            <div class="container d-flex align-items-center justify-content-between">
                <div>
                    <?php the_title('<h1 class="entry-title mb-0">', '</h1>'); ?>
                    <?php if (get_field('page_subhead')) : ?>
                        <h4 class="text-default"><?php the_field('page_subhead') ?></h4>
                    <?php endif ?>
                </div>
                <?php if (get_field('page_cta_button_link')) : ?>
                    <div class="float-right d-none d-md-block">
                        <a
                            href="<?php the_field('page_cta_button_link') ?>"
                            class="btn btn-sm btn-primary btn-round"
                        ><?php the_field('page_cta_button_text'); ?></a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white py-5">
        <div class="row">
            <div class="container">
                <?php the_content() ?>
            </div>
        </div>
    </div>
<?php endwhile ?>

<?php get_footer() ?>