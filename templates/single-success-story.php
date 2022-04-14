<?php
/* Template Name: Single - Success Story */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
?>

<div class="pt-8 mb-3"></div>

<div class="container mb-5">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <h1 style="font-size:80px;" class="lh-sm"><?php the_field('school_district_name'); ?></h1>
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

    <div class="container-fluid bg-white py-5">
        <div class="row vcenter">

    <?php $title_pic = get_post_meta($post->ID, 'image_one', true);
    if ( $title_pic ) { ?>

      <div class="container vcenter ">
        <div class="row vcenter">
          <div class="col-xs-12 col-sm-2 center-xs margin-lg-lg"><img src="<?php the_field('image_one'); ?>">
          </div>
          <div class="col-xs-12 col-sm-10 center-xs margin-lg-lg">

          <?php } else { ?>

            <div class="container margin-lg-lg vcenter">
              <div class="row vcenter">
                <div class="col-xs-12 col-sm-2 center-xs ">
                  <h1 style="font-size: 350px; line-height: 100px; position: relative; bottom: -80px;" class="text-lighter">“</h1>
                </div>
                <div class="col-xs-12 col-sm-10 center-xs ">
                <?php } ?>
                <h2 class="font-italic pb-0 mb-0 lh-md"><?php the_field('quote_one'); ?></h2>
                - <?php the_field('attribution_one'); ?>
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
                <h3 class="display-4 text-info">The Story Of <?php the_field('school_district_name'); ?></h3>
                <?php the_field('left_col'); ?></div>
              <div class="col-xs-12 col-sm-6 center-xs"><?php the_field('right_col'); ?>
                <!-- /.row --></div>
              </div>
            </div>
            <!-- /.container -->
          </div>
        </div>
        <div class="container-fluid bg-white py-5">
          <div class="row vcenter">

            <?php $title_pic = get_post_meta($post->ID, 'image_one', true);
            if ( $title_pic ) { ?>

              <div class="container vcenter ">
                <div class="row vcenter">
                  <div class="col-xs-12 col-sm-2 center-xs margin-lg-lg"><img src="<?php the_field('image_two'); ?>">
                  </div>
                  <div class="col-xs-12 col-sm-10 center-xs margin-lg-lg">
                  <?php } else { ?>
                    <div class="container margin-lg-lg vcenter">
                      <div class="row vcenter">
                        <div class="col-xs-12 col-sm-2 center-xs ">
                          <h1 style="font-size: 350px; line-height: 100px; position: relative; bottom: -80px;color:#46b1e1;" class="text-lighter">“</h1>
                        </div>
                        <div class="col-xs-12 col-sm-10 center-xs ">

                        <?php } ?>


                        <h2 class="font-italic pb-0 mb-0 lh-md"><?php the_field('quote_two'); ?></h2>
                        - <?php the_field('attribution_two'); ?>
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
