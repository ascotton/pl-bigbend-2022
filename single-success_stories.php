<?php
// Single - Success Stories
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
?>

<div class="pt-8 mb-3"></div>

<div class="container mb-5">
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      <h1 style="font-size:80px;" class="lh-sm"><?php the_title(); ?></h1>
      <p class="lead"><?php the_field('top_description'); ?></p>
    </div>
    <div class="col-xs-12 col-sm-6 ">
      <img src="<?php echo get_post_meta($post->ID, 'cropped_banner', true); ?>" >
    </div>
  </div>
</div>

<?php while (have_posts()) : ?>
  <?php the_post(); ?>

  <div class="container-fluid bg-lightest">
    <div class="container">
      <div class="row py-5">
        <div class="col-xs-12 col-sm-4">
          <div class="border-top border-info py-3" style="border-top-width:4px !important;">
            <h3 class="display-4 text-info">The Challenge</h3>
            <?php the_field('the_challenge'); ?>
          </div>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-4">
          <div class="border-top border-secondary py-3" style="border-top-width:4px !important;">
            <h3 class="display-4 text-secondary">The Solution</h3>
            <?php the_field('the_solution'); ?>
          </div><!-- /.col -->
        </div>

        <div class="col-xs-12 col-sm-4">
          <div class="border-top border-success py-3" style="border-top-width:4px !important;">
            <h3 class="display-4 text-success">The Results</h3>
            <?php the_field('the_results'); ?>
          </div><!-- /.col -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.row -->
  </div>

  <div class="container bg-white py-5">
    <div class="row vcenter">

      <div class="row justify-content-center">
        <div class="col-12 col-md-auto pb-5 pb-md-0">
          <div style="width: 200px; margin: auto;">
            <div class="bg-yellow position-relative" style="border-radius: 50%; height: 200px;"><img class="position-absolute" style="width: calc(100% - 16px); height: calc(100% - 16px); object-fit: cover; border-radius: 50%; left: 0; right: 0; bottom: 0; top: 0; margin: auto;" src="<?php the_field('image_one'); ?>" ></div>
          </div>
        </div>
        <div class="col">
          <blockquote class="blockquote blockquote-unstyled text-center text-md-left px-ti-6 px-sm-8 px-md-0">
            <p class="mb-0 text-purple-darkest" style="font-size: 22px; line-height: 1.4; letter-spacing: -1px;">"<?php the_field('quote_one'); ?>"</p>
            <footer class="blockquote-footer mt-5"><small><span class="d-block text-uppercase" style="font-weight: 600;"><?php the_field('attribution_one'); ?></small></footer>
            </blockquote>
          </div>
        </div>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
<div class="container-fluid bg-lightest">
  <div class="row py-5">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 pull-left center-xs">
          <h3 class="display-4 text-info">The Story Of <?php the_title(); ?></h3>
          <?php the_field('left_col'); ?></div>
          <div class="col-xs-12 col-sm-6 center-xs"><?php the_field('right_col'); ?>
            <!-- /.row --></div>
          </div>
        </div>
        <!-- /.container -->
      </div>
    </div>
    <div class="container bg-white py-5">
      <div class="row vcenter">

    <div class="row justify-content-center">
                <div class="col-12 col-md-auto pb-5 pb-md-0">
                  <div style="width: 200px; margin: auto;">
                    <div class="bg-yellow position-relative" style="border-radius: 50%; height: 200px;"><img class="position-absolute" style="width: calc(100% - 16px); height: calc(100% - 16px); object-fit: cover; border-radius: 50%; left: 0; right: 0; bottom: 0; top: 0; margin: auto;" src="<?php the_field('image_two'); ?>" ></div>
                  </div>
                </div>
                <div class="col">
                  <blockquote class="blockquote blockquote-unstyled text-center text-md-left px-ti-6 px-sm-8 px-md-0">
                    <p class="mb-0 text-purple-darkest" style="font-size: 22px; line-height: 1.4; letter-spacing: -1px;">"<?php the_field('quote_two'); ?>"</p>
                    <footer class="blockquote-footer mt-5"><small><span class="d-block text-uppercase" style="font-weight: 600;"><?php the_field('attribution_two'); ?></small></footer>
                    </blockquote>
                  </div>
                </div>


                <!-- /.row -->
              </div>
              <!-- /.container -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container -->
        <?php endwhile; ?>

        <?php get_footer(); ?>
