<?php
//single webinar cpt
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/templates/include/navbar.php';
?>

<script src="//pages.presencelearning.com/js/forms2/js/forms2.min.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<div class="container-fluid bg-light pt-sm-7 pb-5" style="padding-top:60px;">
<div class="container px-0 px-md-3">
<?php while (have_posts()) : the_post();
$date_and_time =  get_field('date_and_time');
$ready_for_replay =  get_field('ready_for_replay');
if ($ready_for_replay == true) { ?>
<script src="https://player.vimeo.com/video/<?php the_field('vidyard_id'); ?>"></script>


        <div class="row bg-white shadow">

            <?php $aspect_ratio =  get_field( "aspect_ratio_of_video" );
            if ($aspect_ratio == "wide") {
                $aspect = "16by9";
            } elseif ($aspect_ratio == "standard") {
        $aspect = "4by3";
            }; ?>

            <div class="col-12 col-lg-4 order-last order-lg-first d-flex justify-content-between flex-column px-4 pt-4 pb-3 bg-white">
                <div >
          <div class="row">
            <div class="col">
              <h3 class="mb-4 lh-md"><?php the_title(); ?></h3>
            </div>
          </div>

                <?php if (get_field("presenter_pic")) { ?>

                    <div class="row mb-2">
            <div class="col-2 col-md-1 col-lg-3"><img class="w-100 rounded-circle" src="<?php the_field('presenter_pic'); ?>" style="max-width:70px;max-height:70px;"></div>
                        <div class="col-9 col-md-10 col-lg-9 pl-0 d-flex">
                            <div class="justify-content-center align-self-center">
                            <div class="heading text-primary p-0 lh-lg">Presenter</div>
                            <h4 class="mb-0 text-default"><?php the_field('presenter_name'); ?></h4>
                            <div class="p-0 m-0 lh-xs small"><?php the_field('presenter_title'); ?></div>
                        </div></div>


                    </div>

                <?php } if (get_field("presenter_pic_2")) { ?>

                    <div class="row mb-2">
            <div class="col-2 col-md-1 col-lg-3"><img class="w-100 rounded-circle" src="<?php the_field('presenter_pic_2'); ?>" style="max-width:70px;max-height:70px;"></div>
                        <div class="col-9 col-md-10 col-lg-9 pl-0 d-flex">
                            <div class="justify-content-center align-self-center">
                            <div class="heading text-primary p-0 lh-lg">Presenter</div>
                            <h4 class="mb-0 text-default"><?php the_field('presenter_name_2'); ?></h4>
                            <div class="p-0 m-0 lh-xs small"><?php the_field('presenter_title_2'); ?></div>
                        </div></div>


                    </div>

                <?php } if (get_field("presenter_pic_3")) { ?>

                    <div class="row mb-2">
            <div class="col-2 col-md-1 col-lg-3"><img class="w-100 rounded-circle" src="<?php the_field('presenter_pic_3'); ?>" style="max-width:70px;max-height:70px;"></div>
                        <div class="col-9 col-md-10 col-lg-9 pl-0 d-flex">
                            <div class="justify-content-center align-self-center">
                            <div class="heading text-primary p-0 lh-lg">Presenter</div>
                            <h4 class="mb-0 text-default"><?php the_field('presenter_name_3'); ?></h4>
                            <div class="p-0 m-0 lh-xs small"><?php the_field('presenter_title_3'); ?></div>
                        </div></div>


                    </div>

                <?php } if (get_field('moderator_pic')) { ?>

                    <div class="row mb-0">
            <div class="col-2 col-md-1 col-lg-3"><img class="w-100 rounded-circle" src="<?php the_field('moderator_pic'); ?>" style="max-width:70px;max-height:70px;"></div>
                        <div class="col-9 col-md-10 col-lg-9 pl-0 d-flex">
                            <div class="justify-content-center align-self-center">
                                <div class="heading text-primary p-0 lh-lg">Moderator</div>
                                <h4 class="mb-0 text-default"><?php the_field('moderator_name'); ?></h4>
                                <div class="p-0 m-0 lh-xs small"><?php the_field('moderator_title'); ?></div>
                            </div></div>


                    </div>

                <?php } else { ?>

                    <div class="row mb-0">
            <div class="col-2 col-md-1 col-lg-3"><img class="w-100 rounded-circle" src="/app/uploads/2016/07/Headshot-Clay-Whitehead-1-1.jpg" style="max-width:70px;max-height:70px;"></div>
                        <div class="col-9 col-md-10 col-lg-9 pl-0 d-flex">
                            <div class="justify-content-center align-self-center">
                                <div class="heading text-primary p-0 lh-lg">Moderator</div>
                                <h4 class="mb-0 text-default">Clay Whitehead</h4>
                                <div class="p-0 m-0 lh-xs small">Founder of PresenceLearning</div>
                            </div></div>


                    </div>

                <?php } ?>

                </div>

                <div class="row mt-auto">
          <div class="col">
            <div class="heading text-primary px-0">Related Content</div>
                    <?php $resource_handout =  get_field( "resource_handout" );
                    if ($resource_handout ) { ?> <a class="btn btn-sm btn-outline-primary btn-round" href="<?php echo($resource_handout) ?>">Resources</a><?php }; ?>
                    <?php $slides_handout =  get_field( "slides_handout" );
                    if ($slides_handout ) { ?> <a class="btn btn-sm btn-outline-primary btn-round" href="<?php echo($slides_handout) ?>">Slides</a><?php }; ?>
                    <?php $qa_link =  get_field( "qa_link" );
                    if ($qa_link ) { ?> <a class="btn btn-sm btn-outline-primary btn-round" href="<?php echo($qa_link) ?>">Blog Post</a><?php }; ?>
                    <?php $content_download =  get_field( "content_download" );
                    if ($content_download ) { ?> <a class="btn btn-sm btn-outline-primary btn-round" href="<?php echo($content_download) ?>"><?php the_field('content_download_name'); ?></a><?php }; ?>
                  </div>
        </div>

            </div>

      <div class="col-12 order-first order-lg-last col-lg-8 p-0">
                <div class="embed-responsive embed-responsive-<?php echo($aspect) ?> bg-lighter">
                    <div id="loader" class="position-absolute bg-lighter h-100 w-100 p-4 overflow-auto justify-content-center align-items-center" style="z-index:101 !important;top:0px;left:0px;display:flex;">
                        <div class="spinner-border text-gray position-absolute" style="width: 4rem; height: 4rem;" role="status">
                <span class="sr-only">Loading...</span>
              </div>
                    </div>
                    <div id="adBlockerContainer" class="position-absolute bg-lighter h-100 w-100 py-3 px-4 overflow-auto" style="z-index:100 !important;display:none;top:0px;left:0px;">
                        <h3>Are you using an adblocker?</h3>
                        Please trust this site to view the video.
                    </div>
                    <div id="videoRegForm" class="position-absolute bg-lightest h-100 w-100 py-3 px-4 overflow-auto nolabel mktoCols mktoBorder" style="z-index:100 !important;display:none;top:0px;left:0px;">
                            <h3 class="pl-3 lh-md mb-1 mt-2">Please complete the information below to watch this free on-demand webinar</h3>
                          <div class="pl-3 pb-3">A certificate of attendance will be automatically emailed to you once you have completed.</div>
                        <div id="videoRegFormContainer" class="w-100"></div>
                        <small>By completing this form, you are consenting to receiving marketing communications from PresenceLearning.</small>
                    </div>
                    <div id="videoWatchedForm" class="position-absolute bg-lightest h-100 w-100 py-3 px-4 overflow-auto nolabel mktoBorder" style="z-index:100 !important;display:none;top:0px;left:0px;">

                            <h3 class="pl-3 lh-md mb-1 mt-2">To keep viewing this webinar:</h3>
                          <div class="pl-3 pb-3">Please complete this form now so we can send you a Certificate of Attendance which will be automatically emailed to you.</div>

                        <div id="videoWatchedFormContainer" class="w-100"></div>
                </div>
                    <iframe id="videoContainer"class="embed-responsive-item bg-lighter" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" src="https://player.vimeo.com/video/<?php the_field('vidyard_id'); ?>" style="border:0px;"></iframe>
                </div>
            </div>


        </div>

        <div class="row my-4">

            <?php if (get_field('registration_content')) { ?>
                <div class="col-12 col-lg mb-3">
                    <h3 >Description</h3>
                    <?php the_field('registration_content'); ?>
                </div>
            <?php } else { ?>
                <div class="col-12 col-lg mb-3">
                    <h3  >Description</h3>
                    <?php the_content(); ?>
                </div>
        <?php }; if (get_field('bio')) { ?>
                <div class="col-12 col-lg mb-3">
                  <h3 >Presenter Bio</h3>
                  <?php the_field('bio'); ?>
              </div>
          <?php }; ?>

        <div class="col-12">
                    <hr class="border-gray my-2">
          <small>Please Note: We do not offer continuing education opportunities for on-demand webinars; however, viewers will receive a certificate of attendance.</small>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php } else { ?>
    <!-- If webinar is in registration mode -->
  <?php } endwhile; ?>

<script>
    var REG_FORM_ID = "<?php the_field('marketo_id'); ?>";
    var WATCHED_FORM_ID = "<?php the_field('marketo_id_cert'); ?>";
    var email;
    var regForm;
    var watchedForm;
    var count = 0;

    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);
    var certsent = false;
    var regsent = false;

    function createMktoForm(id, container) {
        var f = document.createElement("form");
        f.id = 'mktoForm_' + id;
        document.getElementById(container).appendChild(f);
        MktoForms2.loadForm("//pages.presencelearning.com", "845-NEW-442", id);
    }

    function loadMkto() {
        if (typeof(MktoForms2) == 'undefined') {
            if (count == 20) {
                document.getElementById('adBlockerContainer').style.display = 'block';
                return;
            }
            setTimeout(loadMkto, 250);
            count++;
            return;
        }
        createMktoForm(REG_FORM_ID, 'videoRegFormContainer');
        createMktoForm(WATCHED_FORM_ID, 'videoWatchedFormContainer');
        MktoForms2.whenReady(function (form) {
            document.getElementById('loader').style.display = "none";
            if (form.getId() == REG_FORM_ID) {
                regForm = form;
                form.onSubmit(function() {
                    var vals = form.vals();
                    email = vals.Email;
                });
                form.onSuccess(function(vals, page) {
                    player.play();
                    document.getElementById('videoRegForm').style.display = 'none';
                    document.getElementById('videoContainer').style.display = 'block';
                    console.log('reg success');
                    return false;
                });
            }
            else if (form.getId() == WATCHED_FORM_ID) {
                watchedForm = form;
                form.onSuccess(function(vals, page) {
                player.play();
                 document.getElementById('videoWatchedForm').style.display = 'none';
                 document.getElementById('videoContainer').style.display = 'block';
                 console.log('watched success');
                return false;
                });
            }
        });
    }

    player.getVideoTitle().then(function(title) {
        console.log('title:', title);
    });

    player.on('play', function() {
             if (regsent == false) {
                 player.pause();
                 regsent = true;
               document.getElementById('videoRegForm').style.display = 'block';
               document.getElementById('videoContainer').style.display = 'none';
             }
    });

    player.on('timeupdate', function(data) {
        if (certsent == false && data.percent >= 0.75) {
             certsent = true;
             console.log('75% of video watched');
             player.pause();
             document.getElementById('videoWatchedForm').style.display = 'block';
             document.getElementById('videoContainer').style.display = 'none';
        }
    });

    loadMkto();
</script>

<?php get_footer() ?>
