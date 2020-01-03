<?php
if(!function_exists('simple_cta')) {
    function simple_cta($postID=false, $cta_background_image=false, $heading=false, $content=false, $cta_button_label=false, $cta_button_link=false, $cta_theme=false, $cta_text_theme=false, $left_bg_image=false) {
        if($heading) {
            $postID = $postID;
            $cta_background_image = $cta_background_image['url'];
            $heading = $heading;
            $content = $content;
            $cta_button_label = $cta_button_label;
            $cta_button_link = $cta_button_link;
            $cta_theme = $cta_theme;
            $cta_text_theme = $cta_text_theme;
            $left_bg_image = $left_bg_image;
        }else {
            $postID = $postID;
            $cta_background_image = get_post_meta($postID, 'background_image', true);
            $cta_background_image = wp_get_attachment_url($cta_background_image);
            $heading = get_post_meta($postID, 'heading', true);
            $content = get_post_meta($postID, 'content', true);
            $cta_button_label = get_post_meta($postID, 'button_label', true);
            $cta_button_link = get_post_meta($postID, 'button_link', true);
            $cta_theme = get_post_meta($postID, 'button_theme', true);
            $cta_text_theme = get_post_meta($postID, 'cta_theme', true);
            $left_bg_image = get_post_meta($postID, 'left_positioned_background_image', true);
        }
        
        if(!empty($heading) || !empty($content) || !empty($button)):
        ?>
        <section class="simple_cta <?php if(!empty($cta_text_theme)){ echo $cta_text_theme; } if($left_bg_image){echo ' left_bg';} ?>" <?php if(!empty($cta_background_image)){ echo 'style="background-image:url('.$cta_background_image.');"'; } ?>>
            <div class="container container-xs-sm flex col afc jfc">
                <?php 
                if(!empty($heading)){echo '<h2>'.$heading.'</h2>';}
                if(!empty($content)){echo '<div>'.$content.'</div>';}
                if(!empty($cta_button_label) && !empty($cta_button_link)) {
                    echo '<a href="'.$cta_button_link.'" class="button '.$cta_theme.'">'.$cta_button_label.'</a>';
                }
                ?>
            </div>
        </section><!-- /.simple_cta --> 
        <?php
        endif;
    }
}
?>