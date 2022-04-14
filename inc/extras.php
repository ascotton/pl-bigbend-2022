<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter('body_class', 'understrap_body_classes');

if (!function_exists('understrap_body_classes')) :
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     *
     * @return array
     */
    function understrap_body_classes($classes)
    {
        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author()) :
            $classes[] = 'group-blog';
        endif;

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) :
            $classes[] = 'hfeed';
        endif;

        return $classes;
    }
endif;

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter('body_class', 'understrap_adjust_body_class');

if (!function_exists('understrap_adjust_body_class')) :
    /**
     * Setup body classes.
     *
     * @param string $classes CSS classes.
     *
     * @return mixed
     */
    function understrap_adjust_body_class($classes)
    {
        foreach ($classes as $key => $value) :
            if ('tag' === $value) :
                unset($classes[$key]);
            endif;
        endforeach;

        return $classes;
    }
endif;

// Filter custom logo with correct classes.
add_filter('get_custom_logo', 'understrap_change_logo_class');

if (!function_exists('understrap_change_logo_class')) :
    /**
     * Replaces logo CSS class.
     *
     * @param string $html Markup.
     *
     * @return mixed
     */
    function understrap_change_logo_class($html)
    {

        $html = str_replace(
            'class="custom-logo"',
            'class="img-fluid"',
            $html
        );

        $html = str_replace(
            'class="custom-logo-link"',
            'class="navbar-brand custom-logo-link"',
            $html
        );

        $html = str_replace(
            'alt=""',
            'title="Home" alt="logo"',
            $html
        );

        return $html;
    }
endif;

/**
 * Display navigation to next/previous post when applicable.
 */

if (!function_exists('understrap_post_nav')) :
    function understrap_post_nav()
    {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = is_attachment()
            ? get_post(get_post()->post_parent)
            : get_adjacent_post(false, '', true);

        $next = get_adjacent_post(false, '', false);

        if (!$next && ! $previous) :
            return;
        endif;
        ?>
        <nav class="container navigation post-navigation">
            <h2 class="sr-only"><?php esc_html_e('Post navigation', 'understrap'); ?></h2>
            <div class="row nav-links justify-content-between">
                <?php
                if (get_previous_post_link()) :
                    previous_post_link(
                        '<span class="nav-previous">%link</span>',
                        _x(
                            '<i class="fa fa-angle-left"></i>&nbsp;%title',
                            'Previous post link',
                            'understrap'
                        )
                    );
                endif;
                if (get_next_post_link()) :
                    next_post_link(
                        '<span class="nav-next">%link</span>',
                        _x(
                            '%title&nbsp;<i class="fa fa-angle-right"></i>',
                            'Next post link',
                            'understrap'
                        )
                    );
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }
endif;

if (!function_exists('understrap_pingback')) :
    /**
     * Add a pingback url auto-discovery header for single posts of any post type.
     */
    function understrap_pingback()
    {
        if (is_singular() && pings_open()) :
            echo '<link rel="pingback" href="'
                . esc_url(get_bloginfo('pingback_url'))
                . '">'
                . "\n";
        endif;
    }
endif;

add_action('wp_head', 'understrap_pingback');

if (!function_exists('understrap_mobile_web_app_meta')) :
    /**
     * Add mobile-web-app meta.
     */
    function understrap_mobile_web_app_meta()
    {
        echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
        echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
        echo '<meta name="apple-mobile-web-app-title" content="'
            . esc_attr(get_bloginfo('name'))
            . ' - '
            . esc_attr(get_bloginfo('description'))
            . '">'
            . "\n";
    }
endif;

add_action('wp_head', 'understrap_mobile_web_app_meta');

if (!function_exists('understrap_default_body_attributes')) :
    /**
     * Adds schema markup to the body element.
     *
     * @param array $atts An associative array of attributes.
     * @return array
     */
    function understrap_default_body_attributes($atts)
    {
        $atts['itemscope'] = '';
        $atts['itemtype']  = 'http://schema.org/WebSite';
        return $atts;
    }
endif;

add_filter('understrap_body_attributes', 'understrap_default_body_attributes');

if (!function_exists('get_active_template')) :
    /**
     * Detect active template
     *
     * @return string
     */

    function get_active_template()
    {
        global $template;
        return basename($template);
    }
endif;

add_action('wp_head', 'get_active_template');

if (!function_exists('get_part')) :
    /**
    * Get template part from path
    *
    * @param string $fileName - fileName
    * @param array $varsArray - view variables array
    * @param boolean $render - rendering
    */
    function get_part($fileName = '', $varsArray = [], $render = true)
    {
        $filePath = get_template_directory()
            . '/'
            . $fileName
            . '.php';

        $viewHtml = '';

        if (file_exists($filePath)) :
            ob_start();
            extract($varsArray);
            include($filePath);
            $viewHtml = ob_get_clean();
        endif;

        if (!$render) :
            return $viewHtml;
        endif;

        echo $viewHtml;
    }
endif;


if (!function_exists('admin_styles')) :
    function admin_styles()
    {
        echo '<link rel="stylesheet" href="'
            . get_template_directory_uri()
            . '/assets/css/custom-admin-style.css'
            . '">';
    }
endif;

add_action('admin_head', 'admin_styles');

function my_excerpt_length($length){
return 80;
}
add_filter(‘excerpt_length’, ‘my_excerpt_length’);
