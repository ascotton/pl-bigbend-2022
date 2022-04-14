<?php
// the right hand sidebar
defined('ABSPATH') || exit;

if (is_active_sidebar('sidebar-right')) :
    dynamic_sidebar('sidebar-right');
endif;
