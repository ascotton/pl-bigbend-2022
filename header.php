<?php
// theme header
defined('ABSPATH') || exit; ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.removeAttribute('class')</script>
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/img/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TG678X');</script>
<!-- End Google Tag Manager -->
<?php wp_head(); ?>
<script src="https://www.presencelearning.com/app/themes/pl-bigbend/assets/js/ppc-tracking.js"></script>
<script async src="https://cdn.bttrack.com/js/15647/analytics/1.0/analytics.min.js"></script>
<style>
    .lightener {
        background-image: linear-gradient(rgba(214,224,223,0), rgba(214,224,233,1));
        position:absolute;
        bottom:0px;
        height:150px;
        z-index: 1;
        left:0px;
        right:0px;
    }

    .bs-tooltip-bottom .arrow:before {
        border-bottom-color:#ffffff !important;
    }

    .tooltip .tooltip-inner {
        background-color: #ffffff;
        color: #777777;
        box-shadow: 0 50px 100px -20px rgba(50, 50, 93, .25), 0 30px 60px -30px rgba(0, 0, 0, .3), 0 -18px 60px -10px rgba(0, 0, 0, .025);
        max-width:400px;
    }
</style>
<?php if (get_field('custom_css')) : ?>
    <style>
        <?php the_field('custom_css'); ?>
    </style>
<?php endif ?>
</head>
<body <?php body_class(); ?>>
<!-- Load All Custom Icons -->
<?php include get_template_directory() . '/assets/img/svg/icons-def.svg'; ?>
<?php do_action('wp_body_open'); ?>
