<?php
//search results
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>
<section class="search-results">
    <div class="bg-lighter py-2">
        <div class="container">
            <h1 class="page-title m-0">
                <?php
                printf(
                    /* translators: %s: query term */
                    esc_html__('Search Results for: %s', 'understrap'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </div>
    </div>
    <div class="container py-5">
        <?php if (!have_posts()) : ?>
            <p>No results found</p>
        <?php endif ?>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php
                the_post();

                $thumbnail = has_post_thumbnail()
                    ? get_the_post_thumbnail_url(null, 'large')
                    : null;

                $excerpt = preg_replace(
                    '/<br\s*\/*>/',
                    '</p><p>',
                    (apply_filters('the_excerpt', get_the_excerpt()) ?: '')
                );

                $excerpt = preg_replace(
                    '/&nbsp;/',
                    ' ',
                    $excerpt
                );

                $excerpt = preg_replace(
                    '/\s+/',
                    ' ',
                    $excerpt
                );

                $excerpt = trim($excerpt);
                ?>
                <div class="card bg-lightest mb-5 shadow">
                    <div class="container">
                        <div class="row">
                            <?php if ($thumbnail) : ?>
                                <div class="col-12 col-md-3 p-0">
                                    <div 
                                        class="square w-100 h-100 p-md-0 bg-fill"
                                        style="background: url('<?php echo $thumbnail ?>')"
                                    ></div>
                                </div>
                            <?php endif ?>

                            <div class="col">
                                <div class="card-body pb-2 pt-4 px-4 pt-lg-5 px-5">
                                    <h2><?php the_title(); ?></h2>
                                    <?php echo $excerpt ?>
                                </div>

                                <div class="card-footer p-4 p-lg-5 position-relative w-100 text-right">
                                    <a
                                        class="btn btn-sm btn-secondary btn-round my-2 my-0" 
                                        href="<?php the_permalink() ?>"
                                    >
                                        <i class="la la-arrow-circle-right" aria-hidden="true"></i>
                                        More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>

            <?php understrap_pagination(); ?>
        <?php endif ?>
    </div>
</section>

<?php get_footer() ?>
