<?php
//The template for displaying archive pages
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<div class="container-fluid py-3 mb-5">
    <div class="row">
        <div class="container">
            <h1 class="mb-0"><?php single_cat_title(); ?></h1>
        </div>
    </div>
</div>

<div class="container-fluid bg-white py-5">
    <div class="row">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg mb-7 mb-lg-0">
            <?php while (have_posts()) : ?>
                <?php
                the_post();

                $external_url = get_field('the_actual_link');

                $link = $external_url ?: get_permalink();

                $button_text = $external_url
                    ? 'View'
                    : 'More';

                $thumbnail = has_post_thumbnail()
                    ? get_the_post_thumbnail_url(null, 'large')
                    : null;

                $excerpt = preg_replace(
                    '/<br\s*\/*>/',
                    '</p><p>',
                    (apply_filters('the_excerpt', get_the_excerpt()) ?: '')
                );

                $excerpt = preg_replace(
                    '/&nbsp;/',
                    ' ',
                    $excerpt
                );

                $excerpt = preg_replace(
                    '/\s+/',
                    ' ',
                    $excerpt
                );

                $excerpt = trim($excerpt);
                $new_excerpt =  mb_strimwidth($excerpt, 0, 250, "...");
                ?>

                <div class="card bg-lightest mb-5 shadow">
                    <div class="container">
                        <div class="row">
                            <?php if ($thumbnail) : ?>
                                <div class="col-12 col-md-6 col-lg-5 col-xl-4 p-0">
                                    <div
                                        class="square w-100 h-100 p-md-0 bg-fill"
                                        style="background: url('<?php echo $thumbnail ?>');min-height:226px"
                                    ></div>
                                </div>
                            <?php endif ?>
                            <div class="col p-4 p-lg-5">
                                <a
                                    class="text-default"
                                    href="<?php echo $link ?>"
                                    <?php if ($external_url) : ?>
                                        rel="noopener noreferrer"
                                        target="_blank"
                                        title="Opens in a new tab"
                                    <?php endif ?>
                                >
                                    <h3 class="mb-0 pb-0"><?php the_title(); ?></h3>
                                </a>
                                <span
                                    class="d-block text-darker mb-4"
                                    style="font-size: 14px; font-weight: 600; line-height: 1.1"
                                >
                                    <time
                                        datetime="<?php echo get_the_date('c', $value->ID)?>"
                                    ><?php echo get_the_date('', $value->ID) ?></time>,
                                    By <?php echo get_the_author_meta('display_name', $value->post_author); ?>
                                </span>

                                <?php echo $new_excerpt ?>

                                <div class="mt-4 text-center text-md-left">
                                    <a
                                        class="btn btn-sm btn-outline-primary btn-round"
                                        href="<?php echo $link ?>"
                                        <?php if ($external_url) : ?>
                                            rel="noopener noreferrer"
                                            target="_blank"
                                            title="Opens in a new tab"
                                        <?php endif ?>
                                    >
                                        <i class="la la-arrow-circle-right" aria-hidden="true"></i>
                                        <?php echo $button_text ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
          </div>
          <aside class="col-lg-3">
              <div class="newsletter single-post-newsletter mb-7">
                  <h2 class="sectionheader text-purple-light">Stay connected</h2>
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
                  <h2 class="sectionheader text-orange-light">Our Blogs</h2>
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
                      <h2 class="sectionheader text-blue-light">Recent articles</h2>
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
                      <h2 class="sectionheader text-pink-light">Tags</h2>
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

            <?php understrap_pagination(); ?>
        </div>
    </div>
</div>

<?php get_footer() ?>
