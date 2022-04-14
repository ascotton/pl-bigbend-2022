<?php
//search forms
defined('ABSPATH') || exit; ?>

<form
    class="search-form"
    action="<?php echo esc_url(home_url('/')); ?>"
    role="search"
>
    <input
        class="form-control"
        name="s"
        type="search"
        placeholder="<?php esc_attr_e('Search', 'understrap'); ?>"
        value="<?php the_search_query(); ?>"
        aria-label="<?php esc_html_e('Search', 'understrap'); ?>"
    >
    <button
        class="btn-unstyled d-flex justify-content-center align-items-center"
        type="submit"
        aria-label="<?php esc_attr_e('Submit')?>"
    >
        <svg width="20" height="20">
            <use xlink:href="#pl-icon-search"></use>
        </svg>
    </button>
</form>
