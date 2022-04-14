<?php
//single post
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/image-header-background.php';
?>

<?php while (have_posts()) : ?>
    <?php
    the_post();

    $category = isset(get_the_category()[0]->name)
        ? get_the_category()[0]
        : null;
    ?>

    <article class="pt-4 pb-7 pb-lg-8">
        <header class="container entry-header pt-4 d-flex flex-column">
            <?php the_title('<h1 class="entry-title order-2 text-purple-dark mb-0" style="font-weight: 500" aria-describedby="entry-category entry-meta">', '</h1>'); ?>
            <?php if ($category && $category->name !== 'Uncategorized') : ?>
              <?php if ($category->slug === 'in-the-news') : ?>
                <?php $external_url = get_field('the_actual_link'); ?>
                <script>
                window.onload = function() {
                    window.location.href = "<?php echo $external_url ?>";
                }
                </script>

              <?php endif ?>
                <p
                    id="entry-category"
                    class="mb-2 order-1 text-uppercase text-purple"
                    style="font-size: 14px; font-weight: 600; letter-spacing: normal; line-height: 1.1;"
                >
                    <?php echo $category->slug === 'sped-connect'
                            || $category->slug === 'virtually-speaking'
                        ? 'For ' . ($category->slug === 'sped-connect'
                            ? 'Schools'
                            : 'Clinicians')
                        : $category->name
                    ?>
                </p>
            <?php endif ?>
            <p id="entry-meta" class="order-2">
                <time datetime="<?php echo get_the_date('c') ?>"><?php the_date() ?></time>,
                By <?php echo get_the_author_meta('display_name'); ?>
            </p>
            <?php
                echo get_the_tag_list(
                    '<small class="order-2">',
                    ' , ',
                    '</small>',
                    get_queried_object_id()
                );
            ?>
            <?php if ($background_image) : ?>
                <figure
                    class="order-2 position-relative w-100 overflow-hidden mt-1 mb-5"
                    style="border-radius: 8px;"
                >
                    <?php /* TODO: Use attachment for srcset and alt. Change max-height to be ratio based*/ ?>


                    <img
                        class="position-relative w-100"
                        src="                    <?php if( get_field('header_background') ): ?>
                          	                   <?php the_field('header_background'); ?>
                                             <?php else: ?>
                                               <?php echo $background_image ; ?>
                                             <?php endif; ?>"
                        style="object-fit: cover; max-height: 450px;"
                        alt=""
                    >
                </figure>
            <?php endif ?>
        </header>
        <div class="container pt-0">
            <div class="row pt-4">
                <div class="col testing">
                    <?php the_content(); ?>
                </div>
                <aside class="col-12 col-lg-3 mt-7 mt-lg-0">
                    <div class="newsletter single-post-newsletter mb-7">
                        <h2 class=" text-purple-light">Stay connected</h2>
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
                        <h2 class=" text-orange-light">Our Blogs</h2>
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
                            <h2 class=" text-blue-light">Recent articles</h2>
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
    </article>
<?php endwhile ?>

<?php get_footer() ?>
