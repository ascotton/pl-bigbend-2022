<?php
/**
 * UnderStrap enqueue scripts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('understrap_scripts')) :
    /**
     * Load theme's JavaScript and CSS sources.
     */
    function understrap_scripts()
    {
        // Cache busting via ENV variables
        $deploy_timestamp = getenv('DEPLOY_TIMESTAMP');

        $version_suffix = $deploy_timestamp
            ? "_${deploy_timestamp}"
            : '';

        $css_version = "1.1.4${version_suffix}";

        wp_enqueue_style('Theme Styles', get_template_directory_uri() . '/assets/css/theme.min.css?id=145645', [], $css_version);
        wp_enqueue_style('Theme 2021 Styles', get_template_directory_uri() . '/assets/css/theme-2021.min.css?id=145645', [], $css_version);
        wp_enqueue_style('Roboto Google Font', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,500;1,700&display=swap', [], $css_version);
        wp_enqueue_style('Open Sans Google Font', 'https://fonts.googleapis.com/css?family=Open+Sans:ital,wght@0,400;0,600,0,700;1,400;1,600;1,700', [], $css_version);
        wp_enqueue_style('Line Awesome Icon Font', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css', [], $css_version);
        wp_enqueue_style('aos', get_template_directory_uri() . '/assets/css/aos.css', [], $css_version);

        $js_version = "1.1.4${version_suffix}";

        wp_enqueue_script('bigbend-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', [], $js_version, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', [], $js_version, true);
        wp_enqueue_script('perfect-scrollbar', get_template_directory_uri() . '/assets/js/perfect-scrollbar.jquery.min.js', [], $js_version, true);
        wp_enqueue_script('nouislider', get_template_directory_uri() . '/assets/js/nouislider.min.js', [], $js_version, true);
        wp_enqueue_script('aos', get_template_directory_uri() . '/assets/js/aos.js', [], $js_version, true);
        wp_enqueue_script('tabbable', get_template_directory_uri() . '/assets/js/index.umd.min.js', [], $js_version, true);
        wp_enqueue_script('theme-js', get_template_directory_uri() . '/assets/js/theme.min.js', [], $js_version, true);
        wp_enqueue_script('theme-nav', get_template_directory_uri() . '/assets/js/main-min.js', [], $js_version, true);
        wp_enqueue_script('validator', get_template_directory_uri() . '/assets/js/js-form-validator.min.js', [], $js_version, true);
        wp_enqueue_script('lottie', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.8.1/lottie.min.js', [], $js_version, true);

    }
endif;

add_action('wp_enqueue_scripts', 'understrap_scripts');
