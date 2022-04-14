<?php
//displays the footer
defined('ABSPATH') || exit;

$social_links = [[
    'icon' => 'la-facebook-f',
    'label' => 'Facebook',
    'url' => 'https://www.facebook.com/PresenceLearning'
], [
    'icon' => 'la-twitter',
    'label' => 'Twitter',
    'url' => 'https://twitter.com/PresenceLearn'
], [
    'icon' => 'la-linkedin-in',
    'label' => 'LinkedIn',
    'url' => 'https://www.linkedin.com/company/presencelearning'
]];

$locations = get_nav_menu_locations();
$footer_nav = wp_get_nav_menu_items($locations['footer']);
$footer_nav_menu_lists = [];

foreach ($footer_nav as $key => $value) :
    if (isset($value->menu_item_parent)
            && $value->menu_item_parent) :
        continue;
    endif;

    $value->menu_items = [];
    $footer_nav_menu_lists[$value->ID] = $value;
endforeach;

foreach ($footer_nav as $key => $value) :
    if ((isset($value->menu_item_parent)
                && !$value->menu_item_parent)
            || !$footer_nav_menu_lists[$value->menu_item_parent]) :
        continue;
    endif;

    $footer_nav_menu_lists[$value->menu_item_parent]->menu_items[] = $value;
endforeach;

foreach ($footer_nav_menu_lists as $key => $value) :
    usort(
        $footer_nav_menu_lists[$key]->menu_items,
        function ($a, $b) {
            if ($a->menu_order === $b->menu_order) :
                return 0;
            endif;

            return $a->menu_order < $b->menu_order
                ? -1
                : 1;
        }
    );

    $footer_nav_menu_lists[$key]->menu_items = array_filter(
        $footer_nav_menu_lists[$key]->menu_items,
        function ($val) {
            return isset($val->title)
                && $val->title
                && isset($val->url)
                && $val->url;
        }
    );
endforeach;

$footer_nav_menu_lists = array_filter(
    $footer_nav_menu_lists,
    function ($val) {
        return isset($val->title)
            && $val->title
            && count($val->menu_items);
    }
);
?>
</main><!-- /Wrapper -->
<footer class="footer p-0 m-0">
    <div class="footer-contact container-fluid p-3 text-white text-center">
        <p>
            <span>Toll-free support | </span>
            <a
                href="+18444154592"
                rel="noopener noreferrer"
                target="_blank"
                title="Opens in default phone client"
            >844-415-4592</a>
            <span> | </span>
            <a
                href="mailto:asksupport@presencelearning.com"
                rel="noopener noreferrer"
                target="_blank"
                title="Opens in default email client"
            >asksupport@presencelearning.com</a>
        </p>
    </div>
    <div class="container">
        <div class="footer-newsletter newsletter pt-7 pb-7 m-0">
            <div class="row align-items-lg-center">
                <div class="footer-newsletter-description col-12 col-lg-4 mb-4 mb-lg-0">
                    <p>
                        <strong>Stay up to date to receive the latest insights, free resources, and more.</strong>
                    </p>
                </div>
                <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                    <div
                        class="footer-newsletter-form newsletter-form"
                    >
                        <?php
                        $newsletter_form = do_shortcode('[marketoform id="1284" id_suffix="_footer" min_height="" mb="0" shadow="" border=""]');

                        echo preg_replace(
                            '/\[\/*raw\]/',
                            '',
                            ($newsletter_form ?: '')
                        );
                        ?>
                    </div>
                </div>
                <div class="col">
                    <ul class="footer-social-links list-unstyled row justify-content-center justify-content-lg-end">
                        <?php foreach ($social_links as $key => $value) : ?>
                            <li class="col-auto">
                                <a
                                    href="<?php echo $value['url'] ?>"
                                    class="btn btn-icon-only rounded-circle btn-secondary"
                                    rel="noopener noreferrer"
                                    target="_blank"
                                    title="Opens in new tab"
                                    aria-label="<?php echo $value['label'] ?>"
                                >
                                    <i
                                        class="lab <?php echo $value['icon'] ?> m-0 p-0"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (count($footer_nav_menu_lists)) : ?>
            <nav class="footer-nav">
                <div class="row">
                    <?php foreach ($footer_nav_menu_lists as $key => $value) : ?>
                        <div class="col-12 col-lg-3">
                            <h2><?php echo $value->title ?></h2>
                            <ul class="list-unstyled">
                                <?php foreach ($value->menu_items as $k => $v) : ?>
                                    <li class="d-flex">
                                        <a
                                            href="<?php echo $v->url ?>"
                                            <?php if (isset($v->target) && $v->target) : ?>
                                                rel="noopener noreferrer"
                                                target="<?php echo $v->target ?>"
                                                title="Opens in new tab"
                                            <?php endif ?>
                                        >
                                            <?php
                                            $svg = '';

                                            preg_match(
                                                '/(<svg.*?>.+?<\/svg>)/',
                                                $v->title,
                                                $svg_matches
                                            );

                                            if ($svg_matches) :
                                                $svg = $svg_matches[0];
                                            endif;

                                            $title = strip_tags($v->title);
                                            ?>
                                            <?php echo $svg ?>
                                            <span><?php echo $title ?></span>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </nav>
        <?php endif ?>
        <div class="footer-legal d-flex flex-column flex-lg-row text-center text-lg-left pb-6 pt-5 pt-lg-4">
            <div class="footer-logo mb-4 mb-lg-0">
                <img
                    class="d-block"
                    src="<?php echo get_template_directory_uri() ?>/assets/img/brand/pl_logo_small.svg"
                    alt="PresenceLearning - 10 Years 2.5 Million Sessions"
                    width="106"
                    height="52"
                >
            </div>
            <div class="footer-legal-links d-flex flex-column flex-lg-row justify-content-center justify-content-lg-end align-items-lg-center">
                <?php wp_nav_menu([
                    'theme_location' => 'legal',
                    'container_class' => 'footer-policy'
                ]); ?>
                <p>&copy; <?php echo date('Y') ?> All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

<?php if (get_the_ID() !== url_to_postid('/schools/get-a-consultation')) : ?>
    <?php
    $ctaDefault = [
        'placement' => 'right',
        'icon'  => '',
        'copy' => 'Improve your delivery of special education related services.',
        'link' => 'Get a consultation',
        'href' => '/schools/get-a-consultation',
        'smooth_scroll' => false,
        'bg_img' => true,
        'expand' => true,
    ];

    $ctaPlatform = [
        'placement' => 'right',
        'icon'  => '',
        'copy' => 'Improve your delivery of special education related services.',
        'link' => 'Get a consultation',
        'href' => '/te-groups-consultation',
        'smooth_scroll' => false,
        'bg_img' => true,
        'expand' => true,
    ];

    $ctaEcommerce = [
        'placement' => 'right',
        'icon' => '',
        'copy' => 'Three distinct plans so you can find the one that fits your needs.',
        'link' => 'Learn more about pricing',
        'href' => '#pricing',
        'smooth_scroll' => 10,
        'bg_img' => false,
        'expand' => false,
    ];

    $ctaClinician = [
        'placement' => 'right',
        'icon' => '',
        'copy' => 'Looking for a career in teletherapy?',
        'link' => 'Apply now!',
        'href' => '/clinicians/join',
        'smooth_scroll' => false,
        'bg_img' => true,
        'expand' => true,
    ];

    $ctaHome = [
        'placement' => 'right',
        'icon' => '',
        'copy' => 'Join our network of clinicians. Full time schedules available.',
        'link' => 'Apply now',
        'href' => '/clinicians/join',
        'smooth_scroll' => false,
        'bg_img' => true,
        'expand' => true,
    ];

    if (get_the_ID() === url_to_postid('/therapy-essentials') || get_the_ID() === url_to_postid('/e-com')) :
      $ctaFixed = $ctaEcommerce ;
    elseif (get_the_ID() === url_to_postid('/therapy-essentials-groups')) :
      $ctaFixed = $ctaPlatform ;
    elseif (get_the_ID() === url_to_postid('/clinicians/join') || get_the_ID() === url_to_postid('/clinicians/faqs') || get_the_ID() === url_to_postid('/clinicians/clinician-testimonials-2022') || get_the_ID() === url_to_postid('/for-clinicians')) :
      $ctaFixed = $ctaClinician ;
    elseif (is_front_page()) :
      $ctaFixed = $ctaHome ;
    else :
      $ctaFixed = $ctaDefault ;
    endif ;


    ?>
    <div
        id="global-cta-fixed"
        class="cta-fixed cta-fixed-<?php echo $ctaFixed['placement']; ?>"
        data-revealed="false"
    >
        <a
            id="cta_fixed_link"
            href="<?= $ctaFixed['href']; ?>"
            <?php if (!$ctaFixed['bg_img']) : ?>
                class="cta-fixed-no-bg"
            <?php endif ?>
            <?php if ($ctaFixed['smooth_scroll']) : ?>
                data-smooth-scroll="<?php echo $ctaFixed['smooth_scroll'] ?>"
            <?php endif ?>
        >
            <span>
                <span
                    class="d-none d-md-block mb-2"
                    style="font-size: 13px; font-weight: normal; line-height: normal;"
                >
                    <?php echo $ctaFixed['copy']; ?>
                </span>
                <span
                    class="cta-fixed-title d-flex text-purple"
                    style="font-size: 14px; font-weight: 600;"
                >
                    <span><?php echo $ctaFixed['link']; ?></span>
                    <?php if ($ctaFixed['expand']) : ?>
                        <svg
                            width="24"
                            height="24"
                            style="transform: rotate(-90deg)"
                        >
                            <use xlink:href="#pl-icon-expand-more"></use>
                        </svg>
                    <?php endif; ?>
                </span>
            </span>
        </a>
        <script>
            (function () {
                if (window.intercomSettings)
                    return

                var ctaFixed = document.getElementById('global-cta-fixed')

                if (!ctaFixed)
                    return

                var revealCtaFixed = function () {
                    var isRevealed = ctaFixed.getAttribute('data-revealed')
                        === 'true'

                    if (isRevealed)
                        return window.removeEventListener('scroll',
                            revealCtaFixed)

                    ctaFixed.setAttribute('data-revealed', true);
                }

                window.addEventListener('load', function () {
                    window.addEventListener('scroll', revealCtaFixed)
                })
            })()
        </script>
    </div>
<?php endif ?>

<script>
    (function () {
        var isTouch = ('ontouchstart' in window
                && !window.navigator.userAgent.match(/X11/))
            || ('DocumentTouch' in window
                && document instanceof window.DocumentTouch)
            || (window.navigator.maxTouchPoints || 0) > 0

        document.body.classList
            .add(isTouch
                ? 'touch'
                : 'no-touch')
    })()
</script>

<?php wp_footer(); ?>

<script>
    (function() {
        // Bootstrap init
        $('.alert').alert();
        $('.carousel').carousel();
        $('[data-toggle=dropdown]').dropdown();
        $('[data-toggle=tooltip]').tooltip();

        // AOS init
        if (window.AOS)
            window.AOS.init({
                offset: 0
            });
    })();
</script>

<script>
    (function() {
        var didInit = false;
        function initMunchkin() {
            if (didInit === false) {
                didInit = true;
                Munchkin.init('845-NEW-442');
            }
        }
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//munchkin.marketo.net/munchkin.js';
        s.onreadystatechange = function() {
            if (this.readyState == 'complete' || this.readyState == 'loaded') {
                initMunchkin();
            }
        };
        s.onload = initMunchkin;
        document.getElementsByTagName('head')[0].appendChild(s);
    })();
</script>

<script>
    var arrayFrom = Function.prototype.call.bind(Array.prototype.slice);

    function destyleMktoForm(mktoForm, options) {
        var formEl = mktoForm.getFormElem()[0];
        var options = options || {};

        // remove element styles from <form> iand children
        if (!options.keepInline) {
            var styledEls = arrayFrom(formEl.querySelectorAll("[style]")).concat(formEl);
            styledEls.forEach(function(el) {
                el.removeAttribute("style");
            });
        }

        // disable remote stylesheets and local <style>s
        if (!options.keepSheets) {
            var styleSheets = arrayFrom(document.styleSheets);
            styleSheets.forEach(function(ss) {
                if ([mktoForms2BaseStyle, mktoForms2ThemeStyle].indexOf(ss.ownerNode) != -1 ||
                    formEl.contains(ss.ownerNode)
                ) {
                    ss.disabled = true;
                }
            });
        }

        if (!options.moreStyles) {
            formEl.setAttribute("data-styles-ready", "true");
        }
    }

    function modifyElementClass(nodes,action,priClass,secClass,thiClass,fouClass){
        if (typeof nodes === 'string')
            nodes = document.querySelectorAll(nodes)

        for (let i = 0, j = nodes.length; i < j; i++) {
            if (priClass
                    && (action === 'add'
                        || action === 'replace'))
                priClass.split(/\s+/g)
                    .filter(function (str) {
                        return (str || '').trim()
                            && !nodes[i].classList.contains(str)
                    })
                    .forEach(function (str) {
                        nodes[i].classList.add(str)
                    })

            if (action === 'replace')
                nodes[i].classList.remove(secClass)

            if (action === 'remove')
                nodes[i].classList.remove(priClass)

            if (action === 'delete')
                nodes[i].remove()

            if (action === 'wrap'
                    && !nodes[i].classList.contains('styled')) {
                var div = document.createElement(priClass);
                nodes[i].className += ' styled';
                nodes[i].parentNode.insertBefore(div, nodes[i]);
                next = nodes[i].nextElementSibling
                div.appendChild(nodes[i]);
                div.appendChild(next);
                div.classList.add(secClass);
                div.classList.add(thiClass);
                div.classList.add(fouClass);
            }
        }
    }

    if (window.MktoForms2)
        MktoForms2.whenRendered(function(form) {
            destyleMktoForm(form);

            var formEl = form.getFormElem()[0];

            formEl.classList.add('row')

            modifyElementClass(formEl.querySelectorAll('.mktoClear'),
                'delete');
            modifyElementClass(formEl.querySelectorAll('.mktoOffset'),
                'delete');
            modifyElementClass(formEl.querySelectorAll('.mktoGutter'),
                'delete');
            modifyElementClass(formEl.querySelectorAll('.mktoAsterix'),
                'delete');
            modifyElementClass(formEl.querySelectorAll('.mktoForm > style'),
                'delete');

            modifyElementClass(formEl.querySelectorAll('.mktoCheckboxList'),
                'add', 'p-0 m-0');

            modifyElementClass(formEl.querySelectorAll('.mktoFormRow'),
                'add', 'form-group col-12 mb-0');
            modifyElementClass(formEl.querySelectorAll('.mktoCols .mktoFormRow'),
                'add', 'col-md-6');
            modifyElementClass(formEl.querySelectorAll('.mktoButtonRow'),
                'add', 'py-3 pl-4 pr-0 border-top bg-lightest border-light col-12 mt-3');

            modifyElementClass(formEl.querySelectorAll('.mktoField'),
                'add', 'form-control form-control-alternative  mb-3');
            modifyElementClass(formEl.querySelectorAll('.mktoButton'),
                'add', 'btn btn-sm btn-primary btn-round mx-2');
            modifyElementClass(formEl.querySelectorAll('.mktoLabel'),
                'add', 'mb-2');
            modifyElementClass(formEl.querySelectorAll('.mktoForm  input[type=checkbox]'),
                'add', 'custom-control-input');
            modifyElementClass(formEl.querySelectorAll('.mktoCheckboxList > label'),
                'add', 'custom-control-label');
            modifyElementClass(formEl.querySelectorAll('.mktoForm  input[type=checkbox]:not(.styled)'),
                'wrap','div', 'custom-control', 'custom-checkbox', 'mb-1');

            if (formEl) {
                arrayFrom(formEl.querySelectorAll("label"))
                    .forEach(el => !el.textContent.trim()
                        && el.parentNode.removeChild(el))

                var formRows = arrayFrom(formEl.querySelectorAll('.mktoFormRow'))
                    .filter(function (el) {
                        var isHidden = el.children.length === 1
                            && el.children[0].type === 'hidden'

                        if (isHidden)
                            el.classList.add('mktoFormRowHidden')

                        return !isHidden
                    })

                formRows
                    .forEach(function(el, idx) {
                        var checkboxList = el.querySelector('.mktoCheckboxList')

                        if (!checkboxList)
                            return

                        el.className = el.className
                            .replace(/col-(?!12).\S*/g, '')

                        var prevRow = el.previousElementSibling

                        if (prevRow) {
                            prevRow.style.maxWidth = '100%'
                            prevRow.classList.add('flex-grow-1')
                        }

                        var isLastRow = idx + 1 === formRows.length

                        var nextRow = !isLastRow
                            && el.nextElementSibling

                        if (nextRow) {
                            nextRow.style.maxWidth = '100%'
                            nextRow.classList.add('flex-grow-1')
                            nextRow.classList.add('flex-shrink-1')
                       }
                    })

                setTimeout(function () {
                    // Hacky async workaround to avoid flashes of unstyled form elements
                    formEl.setAttribute('data-ready', true)
                }, 17);
            }

            // Newsletter-form specific
            if (!((formEl || {}).parentElement || {}).parentElement
                    || !formEl.parentElement.parentElement
                        .classList.contains('newsletter-form'))
                return

            var inputEmail = formEl.querySelector('input[name=Email')

            if (inputEmail && inputEmail.placeholder !== 'Email address')
                inputEmail.placeholder = 'Email address'
        });

    window.addEventListener('load', function () {
        modifyElementClass('.sharedaddy','add',' container');
        modifyElementClass('.footnotes_reference_container','add',' container');
    });
</script>

<script>
    function resizeIFrameToFitContent (iFrame) {
        if (!iFrame || !iFrame.contentWindow)
            return

        try {
            iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
            iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
        }
        catch (err) {
            console.warn(err)
        }
    }

    window.addEventListener('DOMContentLoaded', function(e) {
        // Get form handle
        var formHandle = document.querySelector('form[name="demo-form"]');

        // Got to validation
        new Validator(formHandle, function (err, res) {
            // some code of success of validation
            return res;
        });

        var iFrame = document.getElementById('iFrame1');
        resizeIFrameToFitContent(iFrame);

        // or, to resize all iframes:
        var iframes = document.querySelectorAll('iframe');
        for (var i = 0; i < iframes.length; i++)
            resizeIFrameToFitContent(iframes[i]);
    });
</script>
