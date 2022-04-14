<?php
// displays the image header
defined('ABSPATH') || exit;

include get_template_directory() . '/templates/include/image-header-background.php';

$active_template = get_active_template();

$is_text = $active_template === 'general-text-header.php';

$is_short = $active_template === 'search.php'
    || $active_template === 'single-content_download.php'
    || $active_template === 'general-short-image-header.php'
    || $active_template === 'landing-marketo.php'
    || $active_template === 'special-map.php'
    || preg_match('/^index-/', $active_template);

$is_headroom = $active_template !== 'single.php'
    && $active_template !== 'page.php'
    && $active_template !== 'general-text-header.php'
    && $active_template !== 'general-nav-only-no-headroom.php'
    && $active_template !== 'single-sped_ahead_webinar.php'
    && $active_template !== 'single-success-story.php';

$style = $background_image
    ? 'background-image: url(' . $background_image .');'
    : null;

if ($style && !$is_text) :
    $style .= $is_headroom
        ? ' opacity: 0.4; filter: brightness(1.1);'
        : ' margin-top: calc(var(--header-nav-height) * -1); padding-top: calc(var(--header-nav-height) + 6rem); background-position-y: 40%;';
endif
?>

<div
    class="section background-cover<?php
        echo get_field('header_position')
            ? ' ' . trim(get_field('header_position'))
            : '';
    ?><?php
        echo $is_headroom
            ? ' pt-9 mt-0'
            : '' ?>"
    <?php if ($style) : ?>
        style="<?php echo $style ?>"
    <?php endif ?>
>
    <?php if (!$is_text && $style) : ?>
        <div class="py-<?php echo $is_short ? '3' : '8' ?>"></div>
    <?php endif ?>

    <?php if ($is_text && $style) : ?>
        <div class="container text-center py-9">
            <?php the_title(
                '<h1 class="display-1 entry-title position-relative text-white" style="font-size:70px;">',
                '</h1>'
            ); ?>
        </div>
    <?php endif ?>
</div>
