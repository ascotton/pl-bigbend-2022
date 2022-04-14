<?php
if (!isset($path)
        || !$path
        || !isset($id)
        || !$id) :
    return;
endif;
?>

<div
    id="<?php echo $id ?>"
    class="lottie<?php echo
        isset($className) && $className
            ? " $className"
            : '' ?>"
    <?php if (isset($style) && $style) : ?>
        style="<?php echo $style ?>"
    <?php endif ?>
></div>

<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        if (!window.lottie)
            return

        var animation = window.lottie.loadAnimation({
            container: document.getElementById('<?php echo $id ?>'),
            renderer: '<?php echo $renderer ?>',
            loop: <?php echo $loop ? 'true' : 'false' ?>,
            autoplay: <?php echo $loop ? 'true' : 'false' ?>,
            path: "<?php echo $path ?>"
        })
    })
</script>
