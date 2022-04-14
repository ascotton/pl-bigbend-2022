<?php
//the navbar that includes headroom classes
defined('ABSPATH') || exit;

// TODO: This should go where?
$alert = getenv('PL_ALERT');

$alert_cookie = $alert
    ? 'alert_' . md5($alert)
    : null;

$active_template = get_active_template();

$is_headroom = $active_template !== 'page.php'
    && $active_template !== 'general-text-header.php'
    && $active_template !== 'general-nav-only-no-headroom.php'
    && $active_template !== 'single-sped_ahead_webinar.php'
    && $active_template !== 'single-success-story.php'
    && $active_template !== 'single.php'
    && $active_template !== 'index-blog-clin.php'
    && $active_template !== 'index-blog-scho.php';

$is_nav = $active_template !== 'general-no-nav.php'
    && $active_template !== 'general-no-nav2.php';

$logo = @file_get_contents(
    get_template_directory() . '/assets/img/svg/logo_pl.svg'
);

$logo_condensed = @file_get_contents(
    get_template_directory() . '/assets/img/svg/logo_pl_condensed.svg'
);
?>

<a
    class="sr-only sr-only-focusable bg-purple text-white text-center p-2"
    href="#content"
>
    <span class="text-white">Skip to main content</span>
</a>

<header
    id="globalNav"
    class="globalNav navbar navbar-expand-lg navbar-dark<?php
        echo $is_headroom
            ? ' navbar-headroom'
            : '' ?>"
    data-sticky="false"
>
    <?php if (isset($alert) && $alert && !isset($_COOKIE[$alert_cookie])) : ?>
        <div class="alert alert-dismissible fade show" role="alert">
            <div class="container">
                <div class="row flex-grow-1">
                    <p class="col mb-0 text-md-center">
                        <?php echo $alert ?>
                    </p>
                    <div class="col-auto d-inline-flex">
                        <button
                            class="alert-btn-close"
                            type="button"
                            data-dismiss="alert"
                            aria-label="Close"
                        >
                            <i class="las la-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            (function () {
                var alertCookie = '<?php echo $alert_cookie ?>'

                var alertToggle = document
                    .querySelector('.alert .alert-btn-close')


                if (!alertToggle)
                    return

                alertToggle.addEventListener('click', function (e) {
                    document.cookie = alertCookie + "=1"
                })
            })()
        </script>
    <?php endif ?>

    <nav class="navRoot position-relative" aria-label="Primary">
        <div class="navRoot-container">
            <div
                class="container d-flex justify-content-<?php
                    echo $is_nav
                        ? 'between'
                        : 'center' ?>"
            >
                <?php if ($logo) : ?>
                    <div class="navbar-brand">
                        <a
                            href="<?php echo get_home_url(); ?>"
                            aria-label="PresenceLearning Home"
                        >
                            <span class="navbar-brand-full d-flex" role="presentation">
                                <?php echo $logo ?>
                            </span>
                            <?php if ($logo_condensed) : ?>
                                <span class="navbar-brand-condensed d-none d-lg-flex" role="presentation">
                                    <?php echo $logo_condensed ?>
                                </span>
                            <?php endif ?>
                        </a>
                    </div>
                <?php endif ?>

                <?php if ($is_nav) : ?>
                    <div class="navSection primary-sticky d-none">
                        <?php get_part('templates/include/navbar-menu-primary', [
                            'id_prefix' => 'navSection-primary-sticky-'
                        ]) ?>
                    </div>

                    <button
                        id="navSection-mobile-menu-toggle"
                        class="btn-burger btn-unstyled d-inline-flex d-lg-none"
                        aria-label="Toggle Menu"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="navSection-mobile-menu"
                    >
                        <span class="btn-burger-bar"></span>
                        <span class="btn-burger-bar"></span>
                        <span class="btn-burger-bar"></span>
                    </button>

                    <div
                        id="navSection-mobile-menu"
                        class="navSection-container navSection-mobile-menu d-flex d-lg-inline-flex flex-column align-items-end"
                    >
                        <div class="navSection secondary d-none d-lg-flex align-items-center" style="z-index: 1">
                            <a href="https://login.presencelearning.com/" class="mr-4">Login</a>
                            <a href="/clinicians/join/" class="mr-4">Apply as a Clinician</a>
                            <a href="/schools/get-a-consultation/" class="consultation-btn btn btn-sm btn-primary btn-round px-4 mr-4">Get Consultation</a>
                            <div class="d-inline-flex align-items-center">
                                <a
                                    id="search_toggle"
                                    class="d-inline-flex flex-none dropdown-toggle"
                                    role="button"
                                    tabindex="0"
                                    aria-label="Toggle search form"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    aria-controls="search_popup"
                                >
                                    <svg width="20" height="20">
                                        <use xlink:href="#pl-icon-search"></use>
                                    </svg>
                                </a>
                                <div id="search_popup" class="dropdown-menu">
                                    <?php get_search_form() ?>
                                </div>
                            </div>
                        </div>
                        <div class="navSection search d-block d-lg-none mb-0">
                            <?php get_search_form() ?>
                        </div>
                        <div class="navSection primary d-flex" style="z-index: 0">
                            <?php get_part('templates/include/navbar-menu-primary', [
                                'collapse_mobile' => true
                            ]) ?>
                        </div>
                        <div class="navSection secondary d-block d-lg-none text-center mt-0">
                            <div>
                                <a href="https://login.presencelearning.com/">Login</a>
                            </div>
                            <div class="my-4">
                                <a href="/clinicians/join/">Apply as a Clinician</a>
                            </div>
                            <div>
                                <a href="/schools/get-a-consultation/" class="btn btn-sm btn-primary btn-round">Get Consultation</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <script>
        (function () {
            // Shared
            var arrayFrom = Function.prototype.call.bind(Array.prototype.slice);

            var navbar = document.getElementById('globalNav')

            var mobileToggle = navbar
                ? navbar.querySelector('#navSection-mobile-menu-toggle')
                : null

            function isMobileMenuExpanded () {
                return mobileToggle
                    && mobileToggle.getAttribute('aria-expanded')
                        === 'true'
            }

            // Toggle sticky class on scroll
            function onNavbarScroll (e) {
                if (!navbar)
                    return null

                var attribute = 'data-sticky'

                var isSticky = navbar.getAttribute(attribute) === 'true'

                var scrollY = window.scrollY || window.pageYOffset

                var stickyOffsetY = 1

                if ((scrollY >= stickyOffsetY && isSticky)
                        || (scrollY < stickyOffsetY && !isSticky))
                    return

                navbar.setAttribute(attribute, !isSticky)
            }

            onNavbarScroll()

            window.addEventListener('scroll', onNavbarScroll)

            // Set css var of sticky nav height
            function getCssVar (name, el) {
                return name
                    && (window.getComputedStyle(el || document.documentElement)
                        .getPropertyValue(name) || '').trim()
            }

            function setCssVar (name, val, el) {
                return name
                    && (el || document.documentElement).style
                        .setProperty(name, val || '')
            }

            function setHeaderCssVars () {
                var headerNav = navbar.querySelector('nav')

                var headerNavHeight
                    = (String((headerNav || {}).clientHeight || 0)) + 'px'

                var headerNavHeightVar = '--header-nav-height'

                if (!isMobileMenuExpanded()
                        && getCssVar(headerNavHeightVar) !== headerNavHeight)
                    setCssVar(headerNavHeightVar, headerNavHeight)

                var headerAlert = navbar.querySelector('.alert')

                var headerAlertHeight
                    = (String((headerAlert || {}).clientHeight || 0)) + 'px'

                var headerAlertHeightVar = '--header-alert-height'

                if (getCssVar(headerAlertHeightVar) !== headerAlertHeight)
                    setCssVar(headerAlertHeightVar, headerAlertHeight)
            }

            setHeaderCssVars()

            window.addEventListener('resize', setHeaderCssVars)

            // Scroll-lock on btn-burger toggle
            function toggleScrollLock () {
                var restoreYAttr = 'data-scroll-lock-restore-y'

                var isLock = !document.documentElement.classList
                    .contains('overflow-hidden')

                if (isLock)
                    document.documentElement
                        .setAttribute(restoreYAttr,
                            window.scrollY || window.pageYOffset || 0)

                document.documentElement
                    .classList[isLock ? 'add' : 'remove']('overflow-hidden')

                var scrollY = parseInt(document.documentElement
                    .getAttribute(restoreYAttr) || '0')

                if (!scrollY
                        || isLock)
                    return

                document.documentElement.removeAttribute(restoreYAttr)

                window.scrollTo(0, scrollY)
            }

            // Mobile menu toggling
            if (mobileToggle)
                mobileToggle
                    .addEventListener('click', function () {
                        toggleScrollLock()

                        var isExpand = !isMobileMenuExpanded()

                        var mobileExpandedDocAttr = 'data-expanded-mobile-menu'

                        if (isExpand)
                            document.documentElement
                                .setAttribute(mobileExpandedDocAttr, true)

                        if (!isExpand)
                            document.documentElement
                                .removeAttribute(mobileExpandedDocAttr, true)

                        mobileToggle.setAttribute('aria-expanded', !!isExpand)

                        var toplevelEls = arrayFrom(document.body.children)
                            .filter(function (el) {
                                return el.tagName !== 'STYLE'
                                    && el.tagName !== 'SCRIPT'
                                    && el.tagName !== 'NOSCRIPT'
                            })

                        toplevelEls
                            .forEach(function (el) {
                                if (el === navbar)
                                    return el
                                        .setAttribute('data-expanded', isExpand)

                                if (isExpand) {
                                    el.setAttribute('aria-hidden', true)
                                    el.setAttribute('inert', true)
                                }

                                if (!isExpand
                                        && el.getAttribute('inert')) {
                                    el.removeAttribute('aria-hidden')
                                    el.removeAttribute('inhert')
                                }
                            })
                    })

            window
                .addEventListener('resize', function (e) {
                    if (window.innerWidth >= 1150
                            && isMobileMenuExpanded())
                        mobileToggle.click()
                })

            document
                .addEventListener('keydown', function (e) {
                    if (!mobileToggle)
                        return

                    var key = e.key || e.keyIdentifier || ''

                    var isExpanded = isMobileMenuExpanded()

                    var isEscape = key.match(/escape/i)
                        && isExpanded

                    if (isEscape)
                        return mobileToggle.click()

                    if (!isExpanded
                            || !key.match(/tab/i))
                        return

                    var els = window.tabbable.tabbable(navbar || [])

                    var focusEl

                    if (e.shiftKey
                            && els.indexOf(e.target) === 0)
                        focusEl = els[els.length - 1]

                    if (!e.shiftKey
                            && els.indexOf(e.target) === els.length - 1)
                        focusEl = els[0]

                    if (!focusEl)
                        return

                    e.preventDefault()
                    e.stopPropagation()

                    focusEl.focus()
                })

            // Dropdown-menu extra functionality
            var primaryDropdownToggles = arrayFrom(navbar
                .querySelectorAll('.navSection:not(.secondary):not(.mobile) .dropdown-toggle'))

            if (!primaryDropdownToggles)
                return

            var navbarExpandedAttribute = 'data-dropdown-expanded'

            primaryDropdownToggles
                .forEach(function (el) {
                    var dropdownMenu = el.nextElementSibling
                        && el.nextElementSibling.classList.contains('dropdown-menu')
                        && el.nextElementSibling

                    function setDropdownMenuBounds (e) {
                        if (!dropdownMenu)
                            return

                        if (dropdownMenu.style.marginLeft)
                            dropdownMenu.style.marginLeft = ''

                        var bounds = dropdownMenu.getBoundingClientRect()

                        if (window.innerWidth < 1150
                                || (!bounds.width
                                    && !bounds.height))
                            return

                        var rightPad = dropdownMenu.parentElement.nextElementSibling
                            ? 15
                            : 8

                        var x2 = Math.floor(bounds.right + rightPad)

                        var isOffScreenX = x2 > window.innerWidth

                        if (!isOffScreenX)
                            return

                        dropdownMenu.style.marginLeft = 'calc(50% - '
                            +  (x2 - window.innerWidth)
                            + 'px)'
                    }

                    el.addEventListener('mouseover', function (e) {
                        if (window.innerWidth < 1150)
                            return

                        setDropdownMenuBounds()

                        if (el.getAttribute('aria-expanded') === 'true')
                            return

                        if (navbar.getAttribute(navbarExpandedAttribute)
                                !== 'true')
                            navbar.setAttribute(navbarExpandedAttribute, true)

                        el.setAttribute('aria-expanded', true)

                        if (dropdownMenu)
                            dropdownMenu.classList.add('show')
                    })

                    el.parentElement
                        .addEventListener('mouseout', function (e) {
                            if (window.innerWidth < 1150)
                                return

                            if (el.getAttribute('aria-expanded') === 'false'
                                    || el.parentElement.contains(e.toElement
                                        || e.relatedTarget))
                                return

                            if (navbar.getAttribute(navbarExpandedAttribute)
                                    === 'true')
                                navbar.setAttribute(navbarExpandedAttribute, false)

                            el.setAttribute('aria-expanded', false)

                            if (dropdownMenu)
                                dropdownMenu.classList.remove('show')

                            if (el === document.activeElement
                                    || el.parentElement === document.activeElement
                                    || el.parentElement.contains(document.activeElement))
                                document.activeElement.blur()
                        })

                    setDropdownMenuBounds()

                    window.addEventListener('resize', function () {
                        setDropdownMenuBounds()

                        if (!dropdownMenu.classList.contains('collapse')
                                || window.innerWidth < 1150)
                            return

                        var collapseToggle = dropdownMenu.previousElementSibling
                                && dropdownMenu.previousElementSibling.previousElementSibling
                            ? dropdownMenu.previousElementSibling.previousElementSibling
                            : null


                        if (!collapseToggle
                                || collapseToggle.getAttribute('aria-expanded')
                                    === 'false')
                            return

                        dropdownMenu.classList.remove('show')

                        collapseToggle.setAttribute('aria-expanded', false)
                    })
                })
        })();
    </script>
</header>

<main id="content" class="wrapper p-0" tabindex="-1">
