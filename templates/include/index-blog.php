<?php
defined('ABSPATH') || exit;

$category_name = isset($category_name)
    ? $category_name
    : null;

$sticky_post = null;

$sticky = $category_name
    ? get_option('sticky_posts')
    : [];

if (!empty($sticky)) :
    rsort($sticky);

    $sticky_query = new WP_Query([
        'post__in' => $sticky,
        'category_name' => $category_name,
        'meta_query' => [[
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS'
        ]]
    ]);

    $sticky_post = isset($sticky_query->posts[0]->ID)
        ? $sticky_query->posts[0]
        : $sticky_post;
endif;
?>

<?php the_title('<h1 class="sr-only">', '</h1>') ?>

<?php if ($sticky_post) : ?>
    <?php
    $color = $category_name === 'virtually-speaking'
        ? 'blue'
        : 'orange'
    ?>
    <div class="container">
    <section class="bg-<?php echo $color ?>-light text-<?php echo $color?>-darkest">
        <div class="container">
            <div class="row align-items-center h-100">
              <?php $url = wp_get_attachment_url( get_post_thumbnail_id($sticky_post->ID,'post-thumbnail') );
              echo '<div class="w-100 col-12 col-lg-7" style="background: url('. $url.');height:480px;background-size:cover;background-position:center center">'; ?>

              </div>
                <div class="col-lg-5 py-7 py-lg-8">
                    <p
                        class="text-white text-uppercase mb-0"
                        style="font-size: 14px; font-weight: 600;"
                    ><?php echo get_the_title() ?></p>

                    <a
                        href="<?php echo get_permalink($sticky_post->ID) ?>"
                    >
                        <h2
                            class="text-<?php echo $color?>-darkest"
                            style="font-size: 50px; line-height: 1.1;"
                        ><?php echo $sticky_post->post_title ?></h2>
                    </a>

                    <p class="text-<?php echo $color?>-darkest">
                        <time
                            datetime="<?php echo get_the_date('c', $sticky_post->ID)?>"
                        ><?php echo get_the_date('', $sticky_post->ID) ?></time>,
                        By <?php echo get_the_author_meta('display_name', $sticky_post->post_author); ?>
                    </p>


                </div>
            </div>
        </div>
    </section>
  </div>
<?php endif ?>

<section class="index-blog-content my-7 my-lg-8">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg mb-7 mb-lg-0">
              <?php $latest_query = new WP_Query([
                    'posts_per_page' =>  2,
                    'ignore_sticky_posts' => 1,
                    'post__not_in'=>get_option('sticky_posts'),
                    'category_name' => $category_name,
                    'meta_query' => [[
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ]]
                ]); ?>
                <?php if ($latest_query->have_posts()) : ?>
                    <h2 class="text-purple-light">Latest Posts</h2>
                    <ul class="row list-unstyled mt-4 mb-n7 mb-sm-0">
                        <?php foreach ($latest_query->posts as $key => $value) : ?>
                            <li class="col-12 col-sm mb-7 mb-sm-0">
                                <a
                                    class="text-purple-darkest"
                                    href="<?php echo get_permalink($value->ID)?>"
                                >
                                    <span
                                        class="d-block position-relative overflow-hidden mb-4"
                                        style="border-radius: 8px;"
                                        role="presentation"
                                    >
                                        <span class="d-block w-100" style="padding-bottom: 66.6667%;">
                                            <?php echo get_the_post_thumbnail(
                                                $value->ID,
                                                'post-thumbnail',
                                                [
                                                    'class' => 'position-absolute w-100 h-100',
                                                    'style' => 'object-fit: cover;'
                                                ]
                                            ) ?>
                                        </span>
                                    </span>
                                    <span>
                                        <span
                                            class="d-block mb-2 h3 post-title"
                                            style="font-size: 26px; line-height: 1.15"
                                        ><?php echo $value->post_title ?></span>
                                        <span
                                            class="d-block text-darker"
                                            style="font-size: 14px; font-weight: 600; line-height: 1.1"
                                        >
                                            <time
                                                datetime="<?php echo get_the_date('c', $value->ID)?>"
                                            ><?php echo get_the_date('', $value->ID) ?></time>,
                                            By <?php echo get_the_author_meta('display_name', $value->post_author); ?>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <?php $news_query = new WP_Query([
                    'posts_per_page' =>  3,
                    'ignore_sticky_posts' => 1,
                    'category_name' => 'in-the-news',
                    'meta_query' => [[
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ]]
                ]); ?>
                <?php if ($news_query->have_posts()) : ?>
                    <h2
                        class="text-purple-light<?php
                            echo $latest_query->have_posts()
                                ? ' mt-7'
                                : '' ?>"
                    >In the News</h2>
                    <ul class="row list-unstyled mt-4 mb-n7 mb-sm-0">
                        <?php foreach ($news_query->posts as $key => $value) : ?>
                            <li class="col-12 col-sm mb-7 mb-sm-0">
                                <a
                                    class="text-purple-darkest"
                                    href="<?php echo get_field('the_actual_link', $value->ID)?>"
                                    target="_blank"
                                >
                                    <span
                                        class="d-block position-relative overflow-hidden mb-4"
                                        style="border-radius: 8px;"
                                        role="presentation"
                                    >
                                        <span class="d-block w-100" style="padding-bottom: 66.6667%;">
                                            <?php echo get_the_post_thumbnail(
                                                $value->ID,
                                                'post-thumbnail',
                                                [
                                                    'class' => 'position-absolute w-100 h-100',
                                                    'style' => 'object-fit: cover;'
                                                ]
                                            ) ?>
                                        </span>
                                    </span>
                                    <span>
                                        <span
                                            class="d-block mb-2 post-title"
                                            style="font-size: 14px; font-weight: bold; line-height: 1.43"
                                        ><?php echo $value->post_title ?></span>
                                        <time
                                            class="d-block text-uppercase text-darkest"
                                            style="font-size: 13px; font-weight: 600; letter-spacing: normal; line-height: 1.1"
                                            datetime="<?php echo get_the_date('c', $value->ID)?>"
                                        ><?php echo get_the_date('', $value->ID) ?></time>
                                    </span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
            <aside class="col-lg-3">
                <div class="newsletter single-post-newsletter mb-7">
                    <h2 class="text-purple-light">Stay connected</h2>
                    <p class="text-purple-dark mb-5">Receive News about PresenceLearning resources</p>
                    <div class="single-post-newsletter-form newsletter-form">
                        <?php get_part('templates/include/marketo-form', [
                            'id' => '1284',
                            'id_suffix' => '_aside-index-blog',
                            'min_height' => '40px',
                            'mb' => '0',
                            'shadow' => '',
                            'border' => ''
                        ]) ?>
                    </div>
                </div>
                <div class="mb-7">
                    <h2 class="text-orange-light">Our Blogs</h2>
                    <ul class="list-unstyled m-0">
                        <li class="mb-1">
                            <a href="/sped-connect/" class="text-orange-dark">For Schools</a>
                        </li>
                        <li class="mb-1">
                            <a href="/virtually-speaking/" class="text-orange-dark">For Clinicians</a>
                        </li>
                        <li class="mb-1">
                            <a href="/in-the-news/" class="text-orange-dark">In The News</a>
                        </li>
                        <li>
                            <a href="/press-release/" class="text-orange-dark">Press Releases</a>
                        </li>
                    </ul>
                </div>
                <?php $recent_query = new WP_Query([
                    'posts_per_page' => 4,
                    'post__not_in' => [get_the_ID()]
                ]); ?>
                <?php if ($recent_query->have_posts()) : ?>
                    <div class="mb-7">
                        <h2 class="text-blue-light">Recent articles</h2>
                        <ul class="list-unstyled m-0">
                            <?php foreach ($recent_query->posts as $key => $value) : ?>
                                <?php
                                if ($key > 3) :
                                    break;
                                endif;
                                ?>
                                <li class="mb-1">
                                    <a
                                        href="<?php echo get_permalink($value->ID)?>"
                                        class="text-blue-dark"
                                    >
                                        <?php echo $value->post_title ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                    <div>
                        <h2 class="text-pink-light">Tags</h2>
                        <ul class="list-unstyled m-0">

<li class="mb-1"><a href="/tag/clinician-careers-online/"class="text-pink-dark">Clinician Careers Online</a></li>
<li class="mb-1"><a href="/tag/special-education/"class="text-pink-dark">Special Education </a></li>
<li class="mb-1"><a href="/tag/therapy-platform/"class="text-pink-dark">Therapy Platform</a></li>
<li class="mb-1"><a href="/tag/psychoeducational-services/"class="text-pink-dark">Psychoeducational Services</a></li>
<li class="mb-1"><a href="/tag/individualized-education-program-iep/"class="text-pink-dark">Individualized Education Program</a></li>
<li class="mb-1"><a href="/tag/individual-and-group-practice/"class="text-pink-dark">Individual & Group Practice</a></li>
<li class="mb-1"><a href="/tag/online-assessment/"class="text-pink-dark">Online Assessment</a></li>
<li class="mb-1"><a href="/tag/virtual-services/"class="text-pink-dark">Virtual Services</a></li>
<li class="mb-1"><a href="/tag/hybrid-services/"class="text-pink-dark">Hybrid Services</a></li>
<li class="mb-1"><a href="/tag/online-occupational-therapy/"class="text-pink-dark">Online Occupational Therapy</a></li>
<li class="mb-1"><a href="/tag/online-speech-therapy/"class="text-pink-dark">Online Speech Therapy</a></li>
<li class="mb-1"><a href="/tag/kate-eberle-walker/"class="text-pink-dark">Our CEO: Kate Eberle Walker</a></li>
                        </ul>
                    </div>
            </aside>
        </div>
    </div>
</section>
