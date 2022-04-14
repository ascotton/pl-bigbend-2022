<?php
/* Template Name: Index - Content Download */
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
include get_template_directory() . '/templates/include/header-image.php';
?>

<div class="container-fluid py-3 mb-5">
   <div class="row">
     <div class="container">
       <?php the_title( '<h1 class="entry-title mb-0">', '</h1>' ); ?>
     </div>
   </div>
</div>

<div class="container-fluid bg-white py-5">
   <div class="row">
     <div class="container">

    <div class="d-flex">
      <ul class="nav nav-pills mb-3 mx-auto justify-content-center" id="pills-tab" role="tablist">
       	<li class="nav-item">
          <a class="nav-link active" id="pills-ebooks-tab" data-toggle="pill" href="#pills-ebooks" role="tab" aria-controls="pills-ebooks" aria-selected="true">Ebooks</a></li>
       	<li class="nav-item">
          <a class="nav-link" id="pills-papers-tab" data-toggle="pill" href="#pills-papers" role="tab" aria-controls="pills-papers" aria-selected="false">White Papers</a></li>
       	<li class="nav-item">
          <a class="nav-link" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false">Infographics</a></li>
        <li class="nav-item">
          <a class="nav-link" id="pills-kits-tab" data-toggle="pill" href="#pills-kits" role="tab" aria-controls="pills-kits" aria-selected="false">Resource Kits</a></li>
      </ul>
    </div>


      <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-ebooks" role="tabpanel" aria-labelledby="pills-ebooks-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="ebooks"></a><h1 ><i class="las la-book"></i> Ebooks</h1>
          </div>

          <?php
          $args1 = array(
            'numberposts'	=> -1,
            'post_type'		=> 'content_download',
            'meta_key'		=> 'content_type',
            'meta_value'	=> 'eBook'
          );
          $the_query = new WP_Query( $args1 );
          if( $the_query->have_posts() ):
            while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="card bg-lightest mb-5 shadow">
              <?php if (has_post_thumbnail()) { ?>
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="square position-relative" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');z-index:5"></div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-9">
                  <?php }; ?>

                  <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                    <h2><?php the_title(); ?></h2>
                    <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                  <?php the_content(); ?>
                </div>

                <?php if (has_post_thumbnail()) { ?>
                </div>
              </div>

            <?php }; ?>

            <div class="card-footer px-5 py-2 position-relative w-100 text-right"  >
              <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink();?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> Download eBook</a>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        <?php endwhile;
        endif;
           // Restore global post data stomped by the_post(). ?>
        </div>

        <div class="tab-pane fade" id="pills-papers" role="tabpanel" aria-labelledby="pills-papers-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="whitepapers"></a><h1 ><i class="las la-file-invoice"></i> White Papers</h1>
          </div>
          <?php
          $args2 = array(
            'numberposts'	=> -1,
            'post_type'		=> 'content_download',
            'meta_key'		=> 'content_type',
            'meta_value'	=> 'White Paper'
          );
          $the_query = new WP_Query( $args2 );
          if( $the_query->have_posts() ):
            while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="card bg-lightest mb-5 shadow">
              <?php if (has_post_thumbnail()) { ?>
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="square position-relative" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');z-index:5"></div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-9">
                  <?php }; ?>

                  <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                    <h2><?php the_title(); ?></h2>
                    <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                  <?php the_content(); ?>
                </div>

                <?php if (has_post_thumbnail()) { ?>
                </div>
              </div>

            <?php }; ?>

            <div class="card-footer px-5 py-2 position-relative w-100 text-right"  >
              <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink();?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> Download White Paper</a>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        <?php endwhile;
        endif;
           // Restore global post data stomped by the_post(). ?>
        </div>

        <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="infographics"></a><h1 ><i class="las la-chart-pie"></i> Infographics</h1>
          </div>
          <?php
          $args3 = array(
            'numberposts'	=> -1,
            'post_type'		=> 'content_download',
            'meta_key'		=> 'content_type',
            'meta_value'	=> 'Infographic'
          );
          $the_query = new WP_Query( $args3 );
          if( $the_query->have_posts() ):
            while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="card bg-lightest mb-5 shadow">
              <?php if (has_post_thumbnail()) { ?>
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="square position-relative" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');z-index:5"></div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-9">
                  <?php }; ?>

                  <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                    <h2><?php the_title(); ?></h2>
                    <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                  <?php the_content(); ?>
                </div>

                <?php if (has_post_thumbnail()) { ?>
                </div>
              </div>

            <?php }; ?>

            <div class="card-footer px-5 py-2 position-relative w-100 text-right"  >
              <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink();?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> Download Infographic</a>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        <?php endwhile;
        endif;
           // Restore global post data stomped by the_post(). ?>
        </div>

        <div class="tab-pane fade" id="pills-kits" role="tabpanel" aria-labelledby="pills-kits-tab">
          <div class="card bg-lightest my-5 shadow text-center p-3">
            <a class="anchor" name="resourcekits"></a><h1 ><i class="las la-project-diagram"></i> Resource Kits</h1>
          </div>
          <?php
          $args4 = array(
            'numberposts'	=> -1,
            'post_type'		=> 'content_download',
            'meta_key'		=> 'content_type',
            'meta_value'	=> 'Resource Kit'
          );
          $the_query = new WP_Query( $args4 );
          if( $the_query->have_posts() ):
            while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="card bg-lightest mb-5 shadow">
              <?php if (has_post_thumbnail()) { ?>
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
          					<div class="square position-relative" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');z-index:5"></div>
          				</div>
          				<div class="col-12 col-md-6 col-lg-9">
                  <?php }; ?>

                  <div class="card-body px-5 pt-5 pl-xl-3 pl-lg-3 pl-md-3">
                    <h2><?php the_title(); ?></h2>
                    <!--<h3 class="postmeta">
                    Put meta here
                  </h3>-->
                  <?php the_content(); ?>
                </div>

                <?php if (has_post_thumbnail()) { ?>
                </div>
              </div>

            <?php }; ?>

            <div class="card-footer px-5 py-2 position-relative w-100 text-right"  >
              <a class="btn btn-sm btn-outline-primary btn-round my-2 my-0" href="<?php the_permalink();?>"><i class="la la-arrow-circle-right" aria-hidden="true"></i> Download Resource Kit</a>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        <?php endwhile;
        endif;
           // Restore global post data stomped by the_post(). ?>
        </div>
      </div>
    </div></div></div></div>
</div>

<?php get_footer(); ?>
