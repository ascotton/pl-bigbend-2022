<?php

/**
 * Shortcodes
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

function teammember_function($atts = [])
{

    extract(shortcode_atts([
        'name' => '',
        'title' => '',
        'pic' => 'https://www.presencelearning.com/app/uploads/2020/04/bobsmith.png',
        'description' => '',
        'twitter' => 'none',
        'linkedin' => 'none'
    ], $atts));

    $social_links = '';

    if ($twitter !== 'none') :
        $social_links .= "
            <a
                title=\"Twitter\"
                href=\"https://twitter.com/$twitter\"
                target=\"_blank\"
                rel=\"noopener noreferrer\"
                class=\"btn btn-icon-only rounded-circle bg-primary text-white\"
                data-toggle=\"tooltip\"
                data-original-title=\"Twitter\"
            >
                <i class=\"lab la-twitter m-0 p-0\"></i>
                <span class=\"d-none\">Twitter</span>
            </a>
        ";
    endif;

    if ($linkedin !== 'none') :
        $social_links .= "
            <a
                title=\"LinkedIn\"
                href=\"https://www.linkedin.com/in/$linkedin\"
                target=\"_blank\"
                rel=\"noopener noreferrer\"
                class=\"btn btn-icon-only rounded-circle bg-primary text-white\"
                data-toggle=\"tooltip\"
                data-original-title=\"Twitter\"
            >
                <i class=\"lab la-linkedin-in m-0 p-0\"></i>
                <span class=\"d-none\">LinkedIn</span>
            </a>
        ";
    endif;

    $social_links = trim($social_links);

    $top = "[raw]
        <div class=\"card bg-lightest mb-5 shadow\">
            <div class=\"square d-block d-md-none\" style=\"background-image: url('$pic');\"></div>
                <div class=\"container\"><div class=\"row\">
                    <div class=\"col-12 col-md-6 col-lg-5 col-xl-4 p-md-4 p-lg-5 p-xl-0\">
                        <div class=\"square d-none d-md-block\" style=\"background-image: url('$pic');\"></div>
                    </div>
                    <div class=\"col-12 col-md-6 col-lg-7 col-xl-8 py-4 py-lg-5 pr-4 pr-lg-5 pl-4 pl-md-0 pl-xl-5\">
                        <h2>$name</h2>
                        <h3 class=\"mb-3\">$title</h3>
                        $description
                        <div class=\"mt-4 text-center text-md-left\">
                            $social_links
                        </div>
                    </div>
                </div>
            </div>
        </div>
    [/raw]";

    return $top;
}

add_shortcode('teammember', 'teammember_function');

function utm_term_function()
{
    return '<?php echo !empty($_GET[\'utm_term\']) ?htmlspecialchars($_GET[\'utm_term\']) :\'\'; ?>';
}
add_shortcode('utm_term', 'utm_term_function');




function recent_posts_shortcode($atts = [], $content = null)
{

    global $post;

    extract(shortcode_atts([
        'displayname' => '',
        'cat' => '',
        'category' => '',
        'num' => '5',
        'order' => 'DESC',
        'orderby' => 'post_date',
    ], $atts));

    $args = [
        'category' => $cat,
        'posts_per_page' => $num,
        'order' => $order,
        'orderby' => $orderby,
    ];

    $output = '<div class="bg-lighter pt-0 pb-3 py-2 mx-0 mt-2 mb-n2" style="min-width:350px !important;">';
    $output .= '<a href="/category/'
        . $category
        . '" class="dropdown-item px-4 pb-2">'
        . $displayname
        . '</a>';

    $posts = get_posts($args);

    foreach ($posts as $post) :
        setup_postdata($post);
        $storytitle = wp_trim_words(get_the_title(), 4);
        $output .= '<a href="'
            . get_the_permalink()
            . '" class="text-dark d-block px-4 lh-md mb-2" style="font-size:14px;">'
            . $storytitle
            . ' <i class="las la-angle-right"></i></a> ';
    endforeach;

    wp_reset_postdata();

    $output .= '</div>';

    return $output;
}
add_shortcode('recent_posts', 'recent_posts_shortcode');

function lottie_shortcode($atts = [])
{
    $lottie = get_part(
        'templates/include/lottie',
        shortcode_atts([
            'id' => (isset($atts['id']) && $atts['id'])
                ?: 'lottie-' . bin2hex(random_bytes(8)),
            'renderer' => 'svg',
            'loop' => true,
            'autoplay' => true,
            'path' => null,
            'className' => '',
            'style' => ''
        ], $atts),
        false
    );

    return "[raw]${lottie}[/raw]";
}

add_shortcode('lottie', 'lottie_shortcode');

function school_services_ctas_shortcode($atts = [])
{
    $school_services_ctas = get_part(
        'templates/include/school-services-ctas',
        shortcode_atts([
            'container' => ''
        ], $atts),
        false
    );

    return "[raw]${school_services_ctas}[/raw]";
}

add_shortcode('school_services_ctas', 'school_services_ctas_shortcode');

function featured_posts_shortcode($atts = [])
{
    $featured_posts = get_part(
        'templates/include/featured-posts',
        shortcode_atts([
            'title' => 'Featured insights and resources',
            'container' => '',
            'ids' => ''
        ], $atts),
        false
    );

    return "[raw]${featured_posts}[/raw]";
}

add_shortcode('featured_posts', 'featured_posts_shortcode');

function assessmentsModule_function($atts = [], $content = null)
{
    extract(shortcode_atts([
        'title' => '',
        'icon' => 'true',
    ], $atts));

    $titleMarkup = $title ? "<p class=\"module-assessment-content-title\"><strong>{$title}</strong></p>" : "";
    $iconMarkup = $icon ? "<span class=\"module-assessment-content-icon flex-shrink-0\"></span>" : "";

    return "
        <div class=\"module-assessment\">
            <div class=\"d-flex\">
                {$iconMarkup}
                <div class=\"module-assessment-content\">{$titleMarkup}{$content}</div>
            </div>
        </div>
    ";
}

add_shortcode('assessmentsModule', 'assessmentsModule_function');

function chatcode_function()
{
    return "[raw]
        <script>window.intercomSettings = { app_id: \"f4euupp0\"};</script>
        <script>
            // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/f4euupp0'
            (function(){var w=window;var ic=w.Intercom;if(typeof ic===\"function\")
            {ic('reattach_activator');ic('update',w.intercomSettings);}
            else{var d=document;var i=function(){i.c(arguments);};i.q=[];
            i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){
            var s=d.createElement('script');s.type='text/javascript';s.async=true;
            s.src='https://widget.intercom.io/widget/f4euupp0';
            var x=d.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s,x);};if(w.attachEvent){
            w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
        </script>
    [/raw]";
}

add_shortcode('chatcode', 'chatcode_function');

function googletag_function()
{
    return "[raw]
        <!-- Start Google event tracking for button -->
        <script>
            var captureOutboundLink = function(url) {
                ga('send', 'event', 'button', 'click', url, {
                    'transport': 'beacon',
                    'hitCallback': function(){document.location = url;}
                });
            }
        </script>
        <!-- End Google event tracking for button -->
    [/raw]";
}

add_shortcode('googletag', 'googletag_function');

function marketoform2_function($atts = [])
{
    $form = get_part('templates/include/marketo-form', shortcode_atts([
        'id' => '',
        'id_suffix' => '',
        'shadow' => 'mktoShadow',
        'border' => 'mktoBorder',
        'col' => '1',
        'mb' => '4',
        'min_height' => '400px'
    ], $atts), false);

    return "[raw]${form}[/raw]";
}

add_shortcode('marketoform', 'marketoform2_function');

function marketoform3_function($atts = [])
{
    $form = get_part('templates/include/marketo-form', shortcode_atts([
        'id' => '',
        'id_suffix' => '',
        'shadow' => 'mktoShadow',
        'border' => 'mktoBorder',
        'col' => '1',
        'mb' => '4',
        'min_height' => '400px'
    ], $atts), false);

    return "${form}";
}

add_shortcode('marketoform_noraw', 'marketoform3_function');
