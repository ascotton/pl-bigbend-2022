<?php if (isset($id) && $id) : ?>
    <?php
    $id_suffix = $id
        . (isset($id_suffix) && $id_suffix
            ? $id_suffix
            : '');

    $classnames = 'position-relative';

    if (isset($border) && $border) :
        $classnames .= ' ' . trim($border);
    endif;

    if (isset($col) && $col === '2') :
        $classnames .= ' mktoCols';
    endif;

    if (isset($mb) && $mb) :
        $classnames .= ' mb-' . trim($border);
    endif;

    if (isset($shadow) && $shadow) :
        $classnames .= ' ' . trim($shadow);
    endif;

    $style = '';

    if (isset($min_height) && $min_height) :
        $style .= 'min-height:' . $min_height .';';
    endif;

    $domain = isset($domain) && trim($domain)
        ? $domain
        : 'pages.presencelearning.com';
    ?>

    <div
        class="<?php echo $classnames ?>"
        style="<?php echo $style ?>"
        data-id="<?php echo $id_suffix ?>"
    >
        <div
            id="loader_<?php echo $id_suffix ?>"
            class="position-absolute h-100 w-100 justify-content-center align-items-center"
            style="z-index:101 !important; top:0px; left:0px; display:flex;"
        >
            <div
                class="spinner-border text-gray position-absolute"
                style="width: 4rem; height: 4rem;"
                role="status"
            >
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <script src="//<?php echo $domain ?>/js/forms2/js/forms2.min.js"></script>
        <script>
            MktoForms2.loadForm('//<?php echo $domain ?>',
                '845-NEW-442',
                parseInt('<?php echo $id ?>'),
                function (e) {
                    var form = (e.getFormElem() || [])[0];

                    var formParentEl = document.querySelector(
                        '[data-id="<?php echo $id_suffix ?>"]')

                    if (!form
                            || !formParentEl)
                        return

                    if (formParentEl.parentElement.classList
                            .contains('bg-lightest')) {
                        formParentEl.parentElement.classList
                            .add('mktoCardWrapper')

                        formParentEl.parentElement.classList
                            .remove('bg-lightest')

                        formParentEl.parentElement.classList
                            .remove('shadow-sm')

                        formParentEl.parentElement.style.padding = ''
                    }

                    form.id = 'mktoForm_<?php echo $id_suffix ?>'

                    form.setAttribute('data-ready', false)

                    var arrayFrom = Function.prototype
                        .call
                        .bind(Array.prototype.slice)

                    var submitBtns = arrayFrom(form
                        .querySelectorAll('button[type=submit]'))

                    submitBtns
                        .forEach(function (el) {
                            if (el.innerText.trim())
                                return

                            el.setAttribute('aria-label', 'Submit')
                        })

                    if ('<?php echo $id ?>' === '<?php echo $id_suffix ?>')
                        return formParentEl.appendChild(form)

                    function setUniqueIds () {
                        function getIdEls(el) {
                            return arrayFrom(el.querySelectorAll('[id]'))
                                || []
                        }

                        getIdEls(form)
                            .forEach(function (el) {
                                var originalId = el.getAttribute('data-og-id')

                                if (!originalId)
                                    el.setAttribute('data-og-id', el.id)

                                var uniqueId = el.getAttribute('data-og-id')
                                    + '_<?php echo $id_suffix ?>'

                                if (el.id !== uniqueId)
                                    el.id = uniqueId

                                if (el.for) {
                                    var originalFor = el
                                        .getAttribute('data-og-for')

                                    if (!originalFor)
                                        el.setAttribute('data-og-for', el.for)

                                    var uniqueFor = el
                                        .getAttribute('data-og-for')
                                            + '_<?php echo $id_suffix ?>'

                                    if (el.for !== uniqueFor)
                                        el.for = uniqueFor
                                }

                                if (el.getAttribute('aria-labelledby'))
                                    el.setAttribute('aria-labelledby',
                                        el.getAttribute('aria-labelledby')
                                            .split(/\s+/)
                                            .filter(function (str) {
                                                return str
                                                    && !str.match(
                                                        new RegExp('_<?php echo $id_suffix ?>$'))
                                            })
                                            .map(function (str) {
                                                return str
                                                    + '_<?php echo $id_suffix ?>'
                                            })
                                            .join(' '))

                                if (el.tagName === 'LABEL'
                                        || el.tagName === 'SPAN')
                                    return
                            })
                    }

                    setUniqueIds()

                    formParentEl.appendChild(form)

                    var formObserver = (new window
                        .MutationObserver(setUniqueIds))

                    formObserver.observe(form, {
                        childList: true,
                        subtree: true
                    })
                });

            MktoForms2.whenReady(function (form) {
                document.getElementById('loader_<?php echo $id_suffix ?>')
                    .style.display = 'none'
            })
        </script>

    </div>
    <p class="m-0 mt-3 text-center" style="font-size: 10px !important;line-height:12px !important;">
        <small class="text-darker" style="font-size: 10px !important;line-height:12px !important;">
            By completing this form, you are consenting to receiving marketing communications from PresenceLearning.
        </small>
    </p>
<?php endif ?>
