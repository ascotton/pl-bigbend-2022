<?php
//the navbar that includes headroom classes
defined('ABSPATH') || exit;

$id_prefix = isset($id_prefix)
    ? $id_prefix
    : 'navSection-primary-';

$is_collapse_mobile = isset($collapse_mobile)
    && $collapse_mobile;

$success_stories_query = new WP_Query([
    'posts_per_page' => '2',
    'post_type' => 'success_stories'
]);

$sped_connect_query = new WP_Query([
    'posts_per_page' => '2',
    'category_name' => 'sped-connect'
]);

$virtually_speaking_query = new WP_Query([
    'posts_per_page' => '2',
    'category_name' => 'virtually-speaking'
]);

$webinars_query = new WP_Query([
    'posts_per_page' => '2',
    'post_type' => 'sped_ahead_webinar'
]);
?>

<ul class="display-flex list-unstyled m-0">
    <li class="dropdown d-inline-flex mr-5">
        <?php if ($is_collapse_mobile) : ?>
            <button
                class="btn-unstyled collapse-toggle d-flex d-lg-none"
                type="button"
                data-toggle="collapse"
                data-target="#<?php echo $id_prefix; ?>0-submenu"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo $id_prefix; ?>0-submenu"
            >
                <span>Our Platform</span>
                <svg class="ml-auto" width="24" height="24">
                    <use xlink:href="#pl-icon-expand-more"></use>
                </svg>
            </button>
        <?php endif ?>
        <button
            class="btn-unstyled dropdown-toggle <?php
                echo $is_collapse_mobile
                    ? ' d-none d-lg-inline-flex'
                    : ' d-inline-flex'?>"
            id="<?php echo $id_prefix; ?>0"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            aria-controls="<?php echo $id_prefix; ?>0-submenu"
        >
            Our Platform
        </button>
        <div
            id="<?php echo $id_prefix; ?>0-submenu"
            class="dropdown-menu collapse"
            aria-labelledby="<?php echo $id_prefix; ?>0"
        >
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li>
                            <a href="/therapy-essentials-schools">
                                <svg width="25" height="19">
                                    <use xlink:href="#pl-icon-desktop"></use>
                                </svg>
                                <span>Therapy Essentials for Schools</span>
                            </a>
                        </li>
                        <li>
                            <a href="/therapy-essentials">
                                <svg width="25" height="19">
                                    <use xlink:href="#pl-icon-desktop"></use>
                                </svg>
                                <span>Therapy Essentials for Individuals</span>
                            </a>
                        </li>
                        <li>
                            <a href="/therapy-essentials-groups">
                                <svg width="25" height="19">
                                    <use xlink:href="#pl-icon-desktop"></use>
                                </svg>
                                <span>Therapy Essentials for Groups & Agencies</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="dropdown d-inline-flex mr-5">
        <?php if ($is_collapse_mobile) : ?>
            <button
                class="btn-unstyled collapse-toggle d-flex d-lg-none"
                type="button"
                data-toggle="collapse"
                data-target="#<?php echo $id_prefix; ?>1-submenu"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo $id_prefix; ?>1-submenu"
            >
                <span>For Schools</span>
                <svg class="ml-auto" width="24" height="24">
                    <use xlink:href="#pl-icon-expand-more"></use>
                </svg>
            </button>
        <?php endif ?>
        <button
            class="btn-unstyled dropdown-toggle <?php
                echo $is_collapse_mobile
                    ? ' d-none d-lg-inline-flex'
                    : ' d-inline-flex'?>"
            id="<?php echo $id_prefix; ?>1"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            aria-controls="<?php echo $id_prefix; ?>1-submenu"
        >
            For Schools
        </button>
        <div
            id="<?php echo $id_prefix; ?>1-submenu"
            class="dropdown-menu collapse"
            aria-labelledby="<?php echo $id_prefix; ?>1"
        >
            <div class="row">
                <div class="col">
                    <h2>Live Online Services</h2>
                    <ul class="list-unstyled text-uppercase">
                        <li class="mb-2">
                            <a href="/schools/online-speech-therapy">
                                <svg width="23" height="24">
                                    <use xlink:href="#pl-icon-comments"></use>
                                </svg>
                                <span>Speech-Language Therapy</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/schools/online-occupational-therapy-ot">
                                <svg width="23" height="27">
                                    <use xlink:href="#pl-icon-draw"></use>
                                </svg>
                                <span>Occupational Therapy</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/schools/online-behavior-interventions-and-mental-health-services">
                                <svg width="22" height="23">
                                    <use xlink:href="#pl-icon-behavior-mental-health"></use>
                                </svg>
                                <span>Mental Health Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="/schools/psychoeducational-assessments/">
                                <svg width="25" height="28">
                                    <use xlink:href="#pl-icon-clipboard-check"></use>
                                </svg>
                                <span>Psychoeducational Assessments</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-unstyled mt-7">
                        <li>
                            <a href="/therapy-essentials-schools">
                                <span>Teletherapy Platform</span>
                            </a>
                        </li>
                        <li>
                            <a href="/how-it-works/">
                                <span>How it works</span>
                            </a>
                        </li>
                        <li>
                            <a href="/resources/online-special-education-services-faqs">
                                <span>FAQs for Schools</span>
                            </a>
                        </li>
                        <li>
                            <a href="/schools/get-a-consultation">
                                <span>Get a Consultation</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <h2>Success Stories</h2>
                    <?php if ($success_stories_query->have_posts()) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($success_stories_query->posts as $key => $value) : ?>
                                <li style="max-width: 340px">
                                    <a href="<?php echo get_permalink($value->ID)?>">
                                        <span><?php echo $value->post_title ?></span>
                                        <?php if (!$key) : ?>
                                            <span class="new-badge text-uppercase">New</span>
                                        <?php endif ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <div>
                        <a
                            href="/resources/success-stories"
                            class="dropdown-subheadinglink mt-4"
                        >
                            <i class="las la-caret-right" aria-hidden="true"></i>
                            More Success Stories
                        </a>
                    </div>
                    <h2 class="mt-7">Blog for Schools</h2>
                    <?php if ($sped_connect_query->have_posts()) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($sped_connect_query->posts as $key => $value) : ?>
                                <li style="max-width: 340px">
                                    <a href="<?php echo get_permalink($value->ID)?>">
                                        <span><?php echo $value->post_title ?></span>
                                        <?php if (!$key) : ?>
                                            <span class="new-badge text-uppercase">New</span>
                                        <?php endif ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <div>
                        <a
                            href="/for-schools"
                            class="dropdown-subheadinglink mt-4"
                        >
                            <i class="las la-caret-right" aria-hidden="true"></i>
                            More Blog Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="dropdown d-inline-flex mr-5">
        <?php if ($is_collapse_mobile) : ?>
            <button
                class="btn-unstyled collapse-toggle d-flex d-lg-none"
                type="button"
                data-toggle="collapse"
                data-target="#<?php echo $id_prefix; ?>2-submenu"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo $id_prefix; ?>2-submenu"
            >
                <span>For Clinicians</span>
                <svg class="ml-auto" width="24" height="24">
                    <use xlink:href="#pl-icon-expand-more"></use>
                </svg>
            </button>
        <?php endif ?>
        <button
            class="btn-unstyled dropdown-toggle <?php
                echo $is_collapse_mobile
                    ? ' d-none d-lg-inline-flex'
                    : ' d-inline-flex'?>"
            id="<?php echo $id_prefix; ?>2"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            aria-controls="<?php echo $id_prefix; ?>2-submenu"
        >
            For Clinicians
        </button>
        <div
            id="<?php echo $id_prefix; ?>2-submenu"
            class="dropdown-menu collapse"
            aria-labelledby="<?php echo $id_prefix; ?>2"
        >
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li>
                            <a href="/clinicians/join">
                                <span>Apply as a Clinician</span>
                            </a>
                        </li>
                        <li>
                            <a href="/teletherapy-essentials">
                                <span>Teletherapy Resources for Your School</span>
                            </a>
                        </li>
                        <li>
                            <a href="/clinicians/faqs">
                                <span>FAQs for Clinicians</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <h2>Blog for clinicians</h2>
                    <?php if ($virtually_speaking_query->have_posts()) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($virtually_speaking_query->posts as $key => $value) : ?>
                                <li style="max-width: 300px">
                                    <a href="<?php echo get_permalink($value->ID)?>">
                                        <span><?php echo $value->post_title ?></span>
                                        <?php if (!$key) : ?>
                                            <span class="new-badge text-uppercase">New</span>
                                        <?php endif ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <div>
                        <a
                            href="/for-clinicians"
                            class="dropdown-subheadinglink mt-4"
                        >
                            <i class="las la-caret-right" aria-hidden="true"></i>
                            More Blog Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="dropdown d-inline-flex mr-5">
        <?php if ($is_collapse_mobile) : ?>
            <button
                class="btn-unstyled collapse-toggle d-flex d-lg-none"
                type="button"
                data-toggle="collapse"
                data-target="#<?php echo $id_prefix; ?>3-submenu"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo $id_prefix; ?>3-submenu"
            >
                <span>Resources</span>
                <svg class="ml-auto" width="24" height="24">
                    <use xlink:href="#pl-icon-expand-more"></use>
                </svg>
            </button>
        <?php endif ?>
        <button
            class="btn-unstyled dropdown-toggle <?php
                echo $is_collapse_mobile
                    ? ' d-none d-lg-inline-flex'
                    : ' d-inline-flex'?>"
            id="<?php echo $id_prefix; ?>3"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            Resources
        </button>
        <div
            id="<?php echo $id_prefix; ?>3-submenu"
            class="dropdown-menu collapse"
            aria-labelledby="<?php echo $id_prefix; ?>3"
        >
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li>
                            <h2>Content Library</h2>
                            <a href="/resources/content-library">
                                <span>Ebooks, White Papers, Infographics, Resource Kits</span>
                            </a>
                        </li>
                        <li class="mt-7">
                            <h2>Videos</h2>
                            <a href="/videos">
                                <span>Success Stories, For Clinicians, Live Online Services</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <h2>Blogs</h2>
                    <ul class="list-unstyled">
                        <li>
                            <a href="/for-schools">
                                <span>Blog for Schools</span>
                            </a>
                        </li>
                        <li>
                            <a href="/for-clinicians">
                                <span>Blog for Clinicians</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <h2>Webinars</h2>
                    <?php if ($webinars_query->have_posts()) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($webinars_query->posts as $key => $value) : ?>
                                <li style="max-width: 300px">
                                    <a href="<?php echo get_permalink($value->ID)?>">
                                        <span><?php echo $value->post_title ?></span>
                                        <?php if (!$key) : ?>
                                            <span class="new-badge text-uppercase">New</span>
                                        <?php endif ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <div>
                        <a
                            href="/resources/sped-ahead-special-education-resources-webinars"
                            class="dropdown-subheadinglink mt-4"
                        >
                            <i class="las la-caret-right" aria-hidden="true"></i>
                            More Webinars
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="dropdown d-inline-flex">
        <?php if ($is_collapse_mobile) : ?>
            <button
                class="btn-unstyled collapse-toggle d-flex d-lg-none"
                type="button"
                data-toggle="collapse"
                data-target="#<?php echo $id_prefix; ?>4-submenu"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo $id_prefix; ?>4-submenu"
            >
                <span>About</span>
                <svg class="ml-auto" width="24" height="24">
                    <use xlink:href="#pl-icon-expand-more"></use>
                </svg>
            </button>
        <?php endif ?>
        <button
            class="btn-unstyled dropdown-toggle <?php
                echo $is_collapse_mobile
                    ? ' d-none d-lg-inline-flex'
                    : ' d-inline-flex'?>"
            id="<?php echo $id_prefix; ?>4"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            aria-controls="<?php echo $id_prefix; ?>4-submenu"
        >
            About
        </button>
        <div
            id="<?php echo $id_prefix; ?>4-submenu"
            class="dropdown-menu collapse"
            aria-labelledby="<?php echo $id_prefix; ?>4"
        >
            <div class="row">
                <div class="col">
                    <ul class="list-unstyled">
                        <li>
                            <a href="/about">
                                <span>About</span>
                            </a>
                        </li>
                        <li>
                            <a href="/about/team">
                                <span>Team</span>
                            </a>
                        </li>
                        <li>
                            <a href="/about/careers">
                                <span>Careers</span>
                            </a>
                        </li>
                        <li>
                            <a href="/about/contact">
                                <span>Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="/in-the-news">
                                <span>In The News</span>
                            </a>
                        </li>
                        <li>
                            <a href="/about/policy-agenda/">
                                <span>Our Policies</span>
                            </a>
                        </li>
                        <li>
                            <a href="/press-release">
                                <span>Press Releases</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
</ul>
