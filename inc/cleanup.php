<?php
/**
 * Rest in peace
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil-clean-up');
add_theme_support('soil-js-to-footer');
add_theme_support('soil-nav-walker');
add_theme_support('soil-nice-search');
//add_theme_support('soil-disable-rest-api');
//add_theme_support('soil-disable-asset-versioning');
//add_theme_support('soil-disable-trackbacks');
//add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
//add_theme_support('soil-relative-urls');

remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version


// REMOVE ADMIN CODE
add_filter('show_admin_bar', '__return_false');

function my_formatter($content)
{
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($pieces as $piece) {
        if (preg_match($pattern_contents, $piece, $matches)) {
               $new_content .= $matches[1];
        } else {
                  $new_content .= wptexturize(wpautop($piece));
        }
    }

    return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);
add_filter('the_content', 'shortcode_unautop', 100);

add_theme_support('editor-styles');
add_editor_style('css/custom-editor-style.min.css');


add_theme_support('disable-custom-colors');
add_theme_support('disable-custom-font-sizes');
add_theme_support('disable-custom-gradients');

add_filter('body_class', 'grey_body_class');

function grey_body_class($classes)
{

    if (is_page_template('defaultpage.php')) {
        $classes[] = 'bg-lightest';
    }

    return $classes;
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);

function my_myme_types($mime_types)
{
    $mime_types['pdf'] = 'application/pdf'; //Adding pdf
    return $mime_types;
}
