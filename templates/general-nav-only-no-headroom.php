<?php
/*Template Name: General - Navigation Only without Hide*/
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';

while (have_posts()) :
    the_post();
    the_content();
endwhile;

get_footer();
