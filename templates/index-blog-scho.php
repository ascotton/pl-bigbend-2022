<?php
/* Template Name: Index - Blog - Schools */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/image-header-background.php';

get_part('templates/include/index-blog', [
    'category_name' => 'sped-connect'
]);

get_footer();
