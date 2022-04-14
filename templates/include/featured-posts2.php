<?php
$title = isset($title) && $title
    ? $title
    : 'Featured';

$container = isset($container)
    && $container
    && $container !== 'false'
    && $container !== '0';

$ids = isset($ids) && $ids
    ? trim(preg_replace(
        '/\D/',
        ' ',
        $ids
    ))
    : '';

$post_type_labels = [
    'page' => 'Page',
    'post' => 'Blog',
    'sped_ahead_webinar' => 'Webinar',
    'sped-connect' => 'Blog for Schools',
    'success_stories' => 'Success Stories',
    'virtually-speaking' => 'Blog for Clinicians'
];

$featured_posts = array_filter(
    array_map(function ($v) use ($post_type_labels) {
        if (!$v) :
            return null;
        endif;

        $post = get_post($v);

        if (!isset($post->ID)) :
            return null;
        endif;

        $post->post_type_label = '';
        $post->post_content = '';

        if ($post->post_type === 'post') :
            $categories = get_the_category($post->ID);

            foreach ($categories as $key => $value) :
                if ($post->post_type_label) :
                    break;
                endif;

                $post->post_type_label = isset($value->slug)
                        && $value->slug
                        && isset($post_type_labels[$value->slug])
                    ? $post_type_labels[$value->slug]
                    : $post->post_type_label;
            endforeach;
        endif;

        if ($post->post_type === 'page') :
            if (get_post_meta($post->ID, '_wp_page_template', true)
                    === 'templates/single-success-story.php') :
                $post->post_type_label = $post_type_labels['success_stories'];
            endif;
        endif;

        $post->post_type_label = !$post->post_type_label
                && isset($post_type_labels[$post->post_type])
            ? $post_type_labels[$post->post_type]
            : $post->post_type_label;

        if (!$post->post_type_label && $post->post_type !== 'post') :
            $post->post_type_label = get_field('content_type', $post->ID);
        endif;

        return $post;
    }, array_slice((preg_split('/\s+/', $ids) ?: []), 0, 8)),
    function ($v) {
        return isset($v->ID)
            && (get_the_post_thumbnail($v->ID)
                || get_field('header_background', $v->ID)
                || get_field('cropped_banner', $v->ID));
    }
);

$meta_query_thumbnail_arg = [
    'relation' => 'OR',
    [
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS'
    ], [
        'key' => 'header_background',
        'compare' => 'EXISTS'
    ], [
        'key' => 'cropped_banner',
        'compare' => 'EXISTS'
    ]
];

if (count($featured_posts) < 4) :
    $resources = [];

    $resources_query_1 = new WP_Query([
        'post_type' => 'content_download',
        'posts_per_page' => 1,
        'meta_query' => $meta_query_thumbnail_arg
    ]);

    if (isset($resources_query_1->posts[0]->ID)) :
        $post = $resources_query_1->posts[0];
        $post->post_type_label = get_field(
            'content_type',
            $resources_query_1->posts[0]->ID
        );
        $resources[] = $post;
        $featured_posts[] = $post;
    endif;

    $blogs_query_1 = new WP_Query([
        'category_name' => 'sped-connect',
        'posts_per_page' => 1,
        'meta_query' => $meta_query_thumbnail_arg
    ]);

    if (isset($blogs_query_1->posts[0]->ID)) :
        $post = $blogs_query_1->posts[0];
        $post->post_type_label = $post_type_labels['sped-connect'];
        $featured_posts[] = $post;
    endif;

    $resources_type_1 = isset($resources[0]->post_type_label)
        ? $resources[0]->post_type_label
        : null;

    $resources_query_2 = new WP_Query([
        'post_type' => 'content_download',
        'posts_per_page' => 1,
        'meta_query' => $resources_type_1
            ? [[
                'key' => 'content_type',
                'value' => $resources_type_1,
                'compare' => '!='
            ], $meta_query_thumbnail_arg]
            : $meta_query_thumbnail_arg
    ]);

    if (isset($resources_query_2->posts[0]->ID)) :
        $post = $resources_query_2->posts[0];
        $post->post_type_label = get_field(
            'content_type',
            $resources_query_2->posts[0]->ID
        );
        $resources[] = $post;
        $featured_posts[] = $post;
    endif;

    $blogs_query_2 = new WP_Query([
        'category_name' => 'virtually-speaking',
        'posts_per_page' => 1,
        'meta_query' => $meta_query_thumbnail_arg
    ]);

    if (isset($blogs_query_2->posts[0]->ID)) :
        $post = $blogs_query_2->posts[0];
        $post->post_type_label = $post_type_labels['virtually-speaking'];
        $featured_posts[] = $post;
    endif;
endif;

$featured_posts = array_slice($featured_posts, 0, 4);
?>

<?php if (count($featured_posts)) : ?>
    <?php if ($container) : ?>
        <section class="featured-posts my-7 my-lg-8">
            <div class="container">
    <?php endif ?>

    <h2
        class="h3 text-purple-darkest mb-5"
        style="font-weight: bold; letter-spacing: -0.3px;"
    ><?php echo $title ?></h2>

    <ul class="row list-unstyled featured-posts-list mb-n5">
        <?php foreach ($featured_posts as $key => $value) : ?>
            <li class="col-6 col-md mb-5">
                <a class="d-block text-purple-darkest" href="<?php echo get_permalink($value->ID) ?>">
                    <span
                        class="d-block position-relative overflow-hidden w-100 mb-4"
                        role="presentation"
                        style="border-radius: 8px; padding-bottom: 66.6667%;"
                    >
                        <?php
                        $class = 'position-absolute w-100 h-100';
                        $style = 'object-fit: cover; '
                            . ($value->post_type !== 'post'
                                ? 'object-position: center top; min-width: 125%; min-height: 125%; left: -12.5%'
                                : 'min-width: 115%; min-height: 115%; top: -7.5%; left: -7.5%;');

                        $thumbnail = get_the_post_thumbnail(
                            $value->ID,
                            'post-thumbnail',
                            [
                                'class' => $class,
                                'style' => $style
                            ]
                        );

                        if (!$thumbnail) :
                            $thumbnail = get_field('header_background', $value->ID)
                                ?: get_field('cropped_banner', $value->ID);

                            $thumbnail = $thumbnail
                                ? "<img src=\"$thumbnail\" class=\"$class\" style=\"$style\" alt=\"\">"
                                : '';
                        endif;

                        echo $thumbnail;
                        ?>
                    </span>
                    <span
                        class="d-block text-uppercase text-darkest mb-2"
                        style="font-size: 13px; font-weight: 600; letter-spacing: normal; line-height: 1.1"
                    ><?php echo $value->post_type_label ?></span>
                    <span
                        class="d-block"
                        style="font-size: 14px; font-weight: bold; line-height: 1.43"
                    ><?php echo $value->post_title ?></span>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

    <?php if ($container) : ?>
            </div>
        </section>
    <?php endif ?>
<?php endif ?>
