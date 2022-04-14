<?php
/* Template Name: Landing - Marketo Sidebar */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <section class="my-7 my-lg-8">
        <div class="container">
            <div class="row">
                <?php
                $marketo_embed = get_field('embedcode') ?: '';

                $is_valid_embed = $marketo_embed
                    && !preg_match('/^\d+$/', $marketo_embed);

                $marketo_id = !$is_valid_embed
                    ? (get_field('marketo_id') ?: $marketo_embed)
                    : null;
                ?>
                <div
                    class="col<?php echo $marketo_id
                        ? ' pr-lg-7'
                        : '' ?>"
                    id="contentarea"
                >
                    <?php the_title('<h1 class="text-purple-darkest h2 mb-3 mb-lg-7">', '</h1>'); ?>
                    <?php the_content(); ?>
                </div>

                <?php if ($is_valid_embed || $marketo_id) : ?>
                    <?php if ($is_valid_embed) : ?>
                        <?php echo $marketo_embed; ?>
                    <?php endif ?>

                    <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                        <?php if ($marketo_id) : ?>
                            <div class="mktoCardWrapper">
                                <?php get_part('templates/include/marketo-form', [
                                    'id' => $marketo_id,
                                    'domain' => 'pages.presencelearning.com',
                                    'col' => '2',
                                    'mb' => '',
                                    'min_height' => '400px'
                                ])?>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
