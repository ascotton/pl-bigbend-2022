<?php
// Single - Content Download
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <div class="container mt-5 mb-7 mb-lg-8">
        <div class="row">
            <div class="col-12 col-sm-7">
                <h3
                    class="mb-0"
                ><?php
                    echo get_post_meta($post->ID, 'content_type', true);
                ?></h3>
                <h1><?php the_title(); ?></h1>
                <h2><?php echo get_post_meta($post->ID, 'subhead', true); ?></h2>
                <?php the_content(); ?>
            </div>
            <?php if (get_post_thumbnail_id()) : ?>
                <div class="col-12 col-sm-5">
                    <img
                        class="m-0 mx-auto d-block"
                        src="<?php the_post_thumbnail_url(); ?>"
                        alt=""
                    >
                </div>
            <?php endif ?>
        </div>

        <?php
        $marketo_embed = get_field('embedcode') ?: '';

        $is_valid_embed = $marketo_embed
            && !preg_match('/^\d+$/', $marketo_embed);

        $marketo_id = !$is_valid_embed
            ? (get_field('marketo_id') ?: $marketo_embed)
            : null;
        ?>

        <?php if ($is_valid_embed) : ?>
            <?php echo $marketo_embed; ?>
        <?php endif ?>

        <?php if ($marketo_id) : ?>
            <div class="mktoCardWrapper mt-7 mt-lg-8">
                <?php get_part('templates/include/marketo-form', [
                    'id' => $marketo_id,
                    'domain' => 'pages.presencelearning.com',
                    'col' => '2',
                    'mb' => ''
                ])?>
            </div>
        <?php endif ?>
    </div>
<?php endwhile ?>

<?php get_footer() ?>
