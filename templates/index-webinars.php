<?php
/* Template Name: Index - Webinars */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<div class="container-fluid py-3 mb-5">
  <div class="row">
    <div class="container">
      <?php the_title('<h1 class="entry-title mb-0">', '</h1>'); ?>
    </div>
  </div>
</div>
<div class="container-fluid bg-white py-5">
  <div class="row">
    <div class="container">
      <div class="d-flex">
        <ul class="nav nav-pills mb-3 mx-auto justify-content-center" id="pills-tab" role="tablist">
          <li class="nav-item mt-2">
            <a class="nav-link active" id="pills-BMH-tab" data-toggle="pill" href="#pills-BMH" role="tab" aria-controls="pills-BMH" aria-selected="true">Behavior & Mental Health</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link" id="pills-speech-tab" data-toggle="pill" href="#pills-speech" role="tab" aria-controls="pills-speech" aria-selected="false">Speech-Language & Occupational Therapy</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link" id="pills-SII-tab" data-toggle="pill" href="#pills-SII" role="tab" aria-controls="pills-SII" aria-selected="false">Strategies, Innovations, & Interventions</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link" id="pills-SE-tab" data-toggle="pill" href="#pills-SE" role="tab" aria-controls="pills-SE" aria-selected="false">Topics in Special Education</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link" id="pills-funding-tab" data-toggle="pill" href="#pills-funding" role="tab" aria-controls="pills-funding" aria-selected="false">Funding Resources</a>
          </li>
        </ul>
      </div>

      <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-BMH" role="tabpanel" aria-labelledby="pills-BMH-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="BMH"></a>
            <h1>Behavior & Mental Health</h1>
          </div>



          <?php
          $args2 = array(
            'numberposts'  => -1,
            'post_type'    => 'sped_ahead_webinar',
            'meta_key'    => 'trackname',
            'meta_value'  => 'Behavior and Mental Health'
          );
          $the_query = new WP_Query($args2);
          if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <div class="card bg-lightest mb-5 shadow">
                <?php if (has_post_thumbnail()) { ?>
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                      <?php if (get_field('title_pic')) { ?>
                        <img src="<?php the_field('title_pic'); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php } else { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php }; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                    <?php }; ?>

                    <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                      <h2><?php the_title(); ?></h2>
                      <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                      <?php the_excerpt(); ?>
                    </div>

                    <?php if (has_post_thumbnail()) { ?>
                    </div>
                  </div>

                <?php }; ?>

                <div class="card-footer px-5 py-2 position-relative w-100 text-right">
                  <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink(); ?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i>View Webinar</a>
                </div><!-- /.card-footer -->
              </div><!-- /.card -->


          <?php endwhile;
          endif;
          wp_reset_query();   // Restore global post data stomped by the_post().
          ?>
        </div>
        <div class="tab-pane fade" id="pills-speech" role="tabpanel" aria-labelledby="pills-speech-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="speech"></a>
            <h1> Speech-Language & Occupational Therapy</h1>
          </div>
          <?php
          $args2 = array(
            'numberposts'  => -1,
            'post_type'    => 'sped_ahead_webinar',
            'meta_key'    => 'trackname',
            'meta_value'  => 'Speech-Language Therapy and Occupational Therapy'
          );
          $the_query = new WP_Query($args2);
          if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <div class="card bg-lightest mb-5 shadow">
                <?php if (has_post_thumbnail()) { ?>
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                      <?php if (get_field('title_pic')) { ?>
                        <img src="<?php the_field('title_pic'); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php } else { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php }; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                    <?php }; ?>

                    <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                      <h2><?php the_title(); ?></h2>
                      <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                      <?php the_excerpt(); ?>
                    </div>

                    <?php if (has_post_thumbnail()) { ?>
                    </div>
                  </div>

                <?php }; ?>

                <div class="card-footer px-5 py-2 position-relative w-100 text-right">
                  <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink(); ?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> View Webinar</a>
                </div><!-- /.card-footer -->
              </div><!-- /.card -->
          <?php endwhile;
          endif;
          // Restore global post data stomped by the_post().
          ?>
        </div>
        <div class="tab-pane fade" id="pills-SII" role="tabpanel" aria-labelledby="pills-SII-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="SII"></a>
            <h1>Strategies, Innovations, & Interventions</h1>
          </div>
          <?php
          $args2 = array(
            'numberposts'  => -1,
            'post_type'    => 'sped_ahead_webinar',
            'meta_key'    => 'trackname',
            'meta_value'  => 'Strategies, Innovations, and Interventions'
          );
          $the_query = new WP_Query($args2);
          if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <div class="card bg-lightest mb-5 shadow">
                <?php if (has_post_thumbnail()) { ?>
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                      <?php if (get_field('title_pic')) { ?>
                        <img src="<?php the_field('title_pic'); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php } else { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php }; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                    <?php }; ?>

                    <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                      <h2><?php the_title(); ?></h2>
                      <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                      <?php the_excerpt(); ?>
                    </div>

                    <?php if (has_post_thumbnail()) { ?>
                    </div>
                  </div>

                <?php }; ?>

                <div class="card-footer px-5 py-2 position-relative w-100 text-right">
                  <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink(); ?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> View Webinar</a>
                </div><!-- /.card-footer -->
              </div><!-- /.card -->
          <?php endwhile;
          endif;
          // Restore global post data stomped by the_post().
          ?>
        </div>
        <div class="tab-pane fade" id="pills-SE" role="tabpanel" aria-labelledby="pills-SE-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="SE"></a>
            <h1>Topics in Special Education</h1>
          </div>
          <?php
          $args2 = array(
            'numberposts'  => -1,
            'post_type'    => 'sped_ahead_webinar',
            'meta_key'    => 'trackname',
            'meta_value'  => 'Topics in Special Education'
          );
          $the_query = new WP_Query($args2);
          if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <div class="card bg-lightest mb-5 shadow">
                <?php if (has_post_thumbnail()) { ?>
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                      <?php if (get_field('title_pic')) { ?>
                        <img src="<?php the_field('title_pic'); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php } else { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php }; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                    <?php }; ?>

                    <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                      <h2><?php the_title(); ?></h2>
                      <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                      <?php the_excerpt(); ?>
                    </div>

                    <?php if (has_post_thumbnail()) { ?>
                    </div>
                  </div>

                <?php }; ?>

                <div class="card-footer px-5 py-2 position-relative w-100 text-right">
                  <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink(); ?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> View Webinar</a>
                </div><!-- /.card-footer -->
              </div><!-- /.card -->
          <?php endwhile;
          endif;
          // Restore global post data stomped by the_post().
          ?>
        </div>
        <div class="tab-pane fade" id="pills-funding" role="tabpanel" aria-labelledby="pills-funding-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="funding"></a>
            <h1> Funding Resources</h1>
          </div>
          <?php
          $args2 = array(
            'numberposts'  => -1,
            'post_type'    => 'sped_ahead_webinar',
            'meta_key'    => 'trackname',
            'meta_value'  => 'Funding Resources'
          );
          $the_query = new WP_Query($args2);
          if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <div class="card bg-lightest mb-5 shadow">
                <?php if (has_post_thumbnail()) { ?>
                  <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                      <?php if (get_field('title_pic')) { ?>
                        <img src="<?php the_field('title_pic'); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php } else { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" style="position:relative;z-index:5;" class="w-100">
                      <?php }; ?>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                    <?php }; ?>

                    <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                      <h2><?php the_title(); ?></h2>
                      <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                      <?php the_excerpt(); ?>
                    </div>

                    <?php if (has_post_thumbnail()) { ?>
                    </div>
                  </div>

                <?php }; ?>

                <div class="card-footer px-5 py-2 position-relative w-100 text-right">
                  <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink(); ?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> View Webinar</a>
                </div><!-- /.card-footer -->
              </div><!-- /.card -->
          <?php endwhile;
          endif;
          // Restore global post data stomped by the_post().
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
