<?php
/* Template Name: Index - Success Stories */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<div class="container-fluid py-3 mb-5">
    <div class="row">
        <div class="container">
            <?php the_title('<h1 class="entry-title mb-0">', '</h1>'); ?>
        </div>
    </div>
</div>

<div class="container-fluid bg-white py-5">
    <div class="row">
        <div class="container">
            <?php $wp_query = new WP_Query([
                'post_type' => 'success_stories',
                'posts_per_page' => -1
            ]); ?>

            <?php if (!have_posts()) : ?>
                <div>
                    <p>No registers found.</p>
                </div>
            <?php endif ?>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <div class="bg-lighter mb-6" style="border-radius: 8px;">
                        <div class="card-body p-5">
                            <h2><?php the_title(); ?></h2>

                            <?php $success_pullquote = get_post_meta(  $post->ID,'quote_one',  true);
                                $success_atribution = get_post_meta(  $post->ID,  'attribution_one',true);
                             ?>

                            <?php if ($success_pullquote) : ?>
                              <div class="row justify-content-center">
<div class="col-12 col-md-auto pb-5 pb-md-0">
<div style="width: 200px; margin: auto;">
<div class="bg-yellow position-relative" style="border-radius: 50%; height: 200px;"><img class="position-absolute" style="width: calc(100% - 16px); height: calc(100% - 16px); object-fit: cover; border-radius: 50%; left: 0; right: 0; bottom: 0; top: 0; margin: auto;" src="<?php the_field('image_one'); ?>" ></div>
</div>
</div>
<div class="col">
<blockquote class="blockquote blockquote-unstyled text-center text-md-left px-ti-6 px-sm-8 px-md-0">
<p class="mb-0 text-purple-darkest" style="font-size: 22px; line-height: 1.4; letter-spacing: -1px;">"<?php echo $success_pullquote; ?>"</p>
<footer class="blockquote-footer mt-5"><small><span class="d-block text-uppercase" style="font-weight: 600;"><?php echo $success_atribution; ?></small></footer>
</blockquote>
<p class="mb-0 mt-4" style="font-size: 14px;"><a class="text-purple" style="font-weight: normal; text-decoration: underline;" href="<?php the_permalink();?>">Read the success story</a></p>
</div>
</div>

                            <?php endif ?>
                        </div>

                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
