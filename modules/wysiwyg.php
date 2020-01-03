<?php
if(!function_exists('wysiwyg')) {
    function wysiwyg($postID) {
        $wysiwyg = get_post_meta($postID, 'wysiwyg', true);
        $wysiwyg = apply_filters('the_content', $wysiwyg);
        $container_width = get_post_meta($postID, 'container_width', true);
        if(!empty($wysiwyg)):
        ?>
        <section class="wysiwyg">
            <div class="container <?php echo $container_width; ?>">
                <?php echo $wysiwyg; ?>
            </div>
        </section><!-- /.wysiwyg -->
        <?php
        endif;
    }
}