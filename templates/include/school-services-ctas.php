<?php
$container = isset($container)
    && $container
    && $container !== 'false'
    && $container !== '0';

$services = [[
    'id' => url_to_postid('/schools/online-speech-therapy'),
    'title' => 'Speech-Language Therapy <br class="d-none d-md-inline">&amp; Assessments',
    'svg' => [
        'id' => 'pl-icon-comments',
        'width' => 35,
        'height' => 37
    ]
], [
    'id' => url_to_postid('/schools/online-occupational-therapy-ot/'),
    'title' => 'Occupational Therapy <br class="d-none d-md-inline">&amp; Assessments',
    'svg' => [
        'id' => 'pl-icon-draw',
        'width' => 30,
        'height' => 35
    ]
], [
    'id' => url_to_postid('/schools/online-behavior-interventions-and-mental-health-services/'),
    'title' => 'Behavioral &amp; Mental <br class="d-none d-md-inline">Health Services',
    'svg' => [
        'id' => 'pl-icon-behavior-mental-health',
        'width' => 34,
        'height' => 36
    ]
], [
    'id' => url_to_postid('/schools/psychoeducational-assessments'),
    'title' => 'Psychoeducational <br class="d-none d-md-inline">&amp; Assessments',
    'svg' => [
        'id' => 'pl-icon-clipboard-check',
        'width' => 33,
        'height' => 36
    ]
]];

$is_service_page = count(array_filter($services, function ($v) {
    return $v['id'] === get_the_ID();
}));
?>

<?php if ($container) : ?>
<section class="my-7 my-lg-8">
    <div class="container py-3">
        <h2
            class="sr-only"
            style="font-weight: bold"
        >Schools services</h2>
        <?php if ($is_service_page) : ?>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
        <?php endif ?>
<?php endif ?>

<ul
    class="row list-unstyled justify-content-center mb-n5 text-center text-md-left"
    style="font-size: 14px;"
>
    <?php foreach ($services as $key => $value) : ?>
        <?php $is_current = get_the_ID() === $value['id'] ?>
        <li
            class="col-6 col-md mb-5 d-flex<?php
                echo $is_current
                    ? ' d-md-none'
                    : ''
            ?>"
        >
            <a
                class="d-flex w-100 text-darkest text-decoration-hover px-5 px-md-6 pb-4 pt-6 pt-md-4"
                href="<?php echo get_permalink($value['id']) ?>"
                style="background: var(--white); border-radius: 8px; box-shadow: 0px 6px 20px rgba(10, 10, 10, 0.15); outline-offset: -0.625rem;"
                <?php if ($is_current) : ?>
                    aria-current="page"
                <?php endif ?>
            >
                <span class="d-flex w-100 flex-column flex-md-row">
                    <span
                        class="col-12 col-md-auto p-0 pb-2 pb-md-0 d-md-flex align-items-center"
                        style="flex-basis: auto"
                    >
                        <svg
                            width="<?php echo $value['svg']['width'] ?>"
                            height="<?php echo $value['svg']['height'] ?>"
                            class="d-block mx-auto"
                        >
                            <use xlink:href="#<?php echo $value['svg']['id'] ?>"></use>
                        </svg>
                    </span>
                    <span class="col-12 col-md p-0 pl-md-5 pr-md-2 flex-shrink-1 flex-grow-1 align-self-md-center">
                        <span class="d-inline-flex col-ti-8 col-sm-7 col-md p-0">
                            <?php echo $value['title'] ?>
                        </span>
                    </span>
                    <span
                        class="col-12 col-md-auto p-0 pt-2 pt-md-0 d-md-flex align-items-center"
                        style="flex-basis: auto;"
                    >
                        <span class="icon-expand-more d-inline-flex" aria-hidden="true"></span>
                    </span>
                </span>
            </a>
        </li>
    <?php endforeach ?>
</ul>

<?php if ($container) : ?>
    <?php if ($is_service_page) : ?>
            </div>
        </div>
    <?php endif ?>
    </div>
</section>
<?php endif ?>
