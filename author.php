<?php
/**
 * The template for displaying the author pages
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
?>

<section class="author">
    <div class="container py-5">
        <?php
        $curauth = isset($_GET['author_name'])
            ? get_user_by('slug', $author_name)
            : get_userdata(intval($author));

        $is_description = !empty($curauth->user_url)
            || !empty($curauth->user_description);
        ?>

        <h1><?php echo esc_html($curauth->display_name ?: $curauth->nickname) ?></h1>

        <?php if (!empty($curauth->ID)) :
            echo get_avatar($curauth->ID);
        endif; ?>

        <?php if ($is_description) : ?>
            <dl>
                <?php if (!empty($curauth->user_url)) : ?>
                    <dt><?php esc_html_e('Website', 'understrap'); ?></dt>
                    <dd>
                        <a
                            href="<?php echo esc_url($curauth->user_url); ?>"
                        >
                            <?php echo esc_html($curauth->user_url); ?></a>
                    </dd>
                <?php endif; ?>

                <?php if (!empty($curauth->user_description)) : ?>
                    <dt><?php esc_html_e('Profile', 'understrap'); ?></dt>
                    <dd><?php esc_html_e($curauth->user_description, 'understrap'); ?></dd>
                <?php endif; ?>
            </dl>
        <?php endif; ?>

        <h2 class="pt-5"><?php echo esc_html('Posts by', 'understrap')
            . ' '
            . esc_html($curauth->nickname);
        ?>:</h2>

        <?php if (!have_posts()) : ?>
            <p>No posts found</p>
        <?php endif ?>

        <?php if (have_posts()) : ?>
            <ul>
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>
                    <li>
                        <?php
                        printf(
                            '<a rel="bookmark" href="%1$s" title="%2$s %3$s">%3$s</a>',
                            esc_url(apply_filters('the_permalink', get_permalink($post), $post)),
                            esc_attr(__('Permanent Link:', 'understrap')),
                            the_title('', '', false)
                        );
                        ?>
                        <?php understrap_posted_on(); ?>
                        <?php esc_html_e('in', 'understrap'); ?>
                        <?php the_category('&'); ?>
                    </li>
                <?php endwhile; ?>
            </ul>

            <?php understrap_pagination(); ?>
        <?php endif ?>
    </div>
</section>

<?php get_footer(); ?>
