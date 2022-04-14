<?php
// decides what the header background image will be
defined('ABSPATH') || exit;

$background_image = null;

if (get_field('header_background')) :
    $background_image = get_field('header_background');
endif;

if (!$background_image && is_category('5')) :
    $background_image = 'https://www.presencelearning.com/app/uploads/2020/08/biggie.jpg';
endif;

if (!$background_image && is_category('8')) :
    $background_image = 'https://www.presencelearning.com/app/uploads/2020/09/big2.jpg';
endif;

if (!$background_image && is_category('230')) :
    $background_image = '/app/uploads/2016/09/newspapers-bw.jpg';
endif;

if (!$background_image && in_category('blog')) :
    $background_image = 'https://www.presencelearning.com/app/uploads/2020/08/biggie.jpg';
endif;


if (!$background_image && has_post_thumbnail() && !is_archive()) :
    $background_image = get_the_post_thumbnail_url();
endif;



if (!is_category('486') && (in_category('news') || in_category('press-release'))) :
    $background_image = '/app/uploads/2016/09/newspapers-bw.jpg';
endif;

if (!$background_image && is_page('press')) :
    $background_image = '/app/uploads/2016/09/newspapers-bw.jpg';
endif;

if (!$background_image && is_page('press-releases')) :
    $background_image = '/app/uploads/2016/09/newspapers-bw.jpg';
endif;

if (is_single() && has_post_thumbnail()) :
    $background_image = get_the_post_thumbnail_url();
endif;

$background_image = $background_image ?: '/app/uploads/hero/1032.jpg';
