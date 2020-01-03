<?php
if(!function_exists('static_cta')) {
    function static_cta($postID=false) {
        if(!$postID) {
            $postID = get_the_ID();
        }
        $label = get_post_meta($postID, 'static_button_label', true);
        $link = get_post_meta($postID, 'static_button_link', true);
        $theme = get_post_meta($postID, 'static_button_theme', true);
        $content = get_post_meta($postID, 'static_cta_content', true);
        $background_image = get_post_meta($postID, 'static_cta_background_image', true);
        $background_image = wp_get_attachment_url($background_image);
        if(!empty($content) || (!empty($label) && !empty($link))) {
            ?>
            <section class="simple_cta" <?php if(!empty($background_image)){ echo 'style="background-image:url('.$background_image.');"'; } ?>>
                <div class="container container-xs-sm flex col afc jfc">
                    <?php 
                    if(!empty($content)){echo '<div>'.$content.'</div>';}
                    if(!empty($label) && !empty($link)) {
                        echo '<a href="'.$link.'" class="button '.$theme.'">'.$label.'</a>';
                    }
                    ?>
                </div>
            </section><!-- /.simple_cta --> 
            <?php
        }
    }
}