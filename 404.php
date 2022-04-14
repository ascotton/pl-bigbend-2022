<?php
/**
 * The template for displaying 404 pages (not found)
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
?>

<section class="error-404 not-found">
    <div class="container py-5">
        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'understrap'); ?></h1>

        <div class="widget py-5">
            <?php get_search_form(); ?>
        </div>

        <div class="widget py-5">
            <?php the_widget('WP_Widget_Recent_Posts'); ?>
        </div>

        <?php if (understrap_categorized_blog()) : ?>
            <div class="widget widget_categories py-5">
                <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'understrap'); ?></h2>
                <ul>
                    <?php
                    wp_list_categories(
                        array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'show_count' => 1,
                            'title_li' => '',
                            'number' => 10,
                        )
                    );
                    ?>
                </ul>
            </div>
        <?php endif ?>

        <?php
        /* translators: %1$s: smiley */
        $archive_content = '<p>'
            . sprintf(esc_html__(
                'Try looking in the monthly archives. %1$s',
                'understrap'
            ), convert_smilies(':)'))
            . '</p>';
        ?>

        <div class="widget py-5">
            <?php the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content"); ?>
        </div>

        <div class="widget py-5">
            <?php the_widget('WP_Widget_Tag_Cloud'); ?>
        </div>
    </div>
</section>

<?php get_footer() ?>
