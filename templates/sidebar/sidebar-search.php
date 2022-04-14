<?php
// the top search sidebar
defined('ABSPATH') || exit;

if (is_active_sidebar('sidebar-search')) :
    dynamic_sidebar('sidebar-search');
endif;
