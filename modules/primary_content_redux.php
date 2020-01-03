<?php
if(!function_exists('primary_content_redux')) {
    function primary_content_redux($postID) {
        $use_content = get_post_meta($postID, 'use_content_2', true);
        $wysiwyg = get_post_meta($postID, 'primary_content_redux', true);
        $wysiwyg = apply_filters('the_content', $wysiwyg);
        $featured_image = get_post_meta($postID, 'primary_featured_image_redux', true);
        $primary_background_image_redux = get_post_meta($postID, 'primary_background_image_redux', true);
        $featured_image_caption = wp_get_attachment_caption($featured_image);
        $featured_image = wp_get_attachment_url($featured_image);
        $primary_background_image_redux = wp_get_attachment_url($primary_background_image_redux);
        if($use_content == '1') {
            ?>
            <section class="mixed_content mixed_content_redux flex col" <?php if(!empty($primary_background_image_redux)){ echo 'style="background-image:url('.$primary_background_image_redux.');background-repeat:no-repeat;"';} ?>>
                <div class="flex row container jfc afc container-lg">
                    <div class="content_col item_1_2 image flex afc col">
                        <?php if(!empty($featured_image)){echo '<div class="img shadow"><img src="'.$featured_image.'" /></div>';} ?>
                        <?php if(!empty($featured_image_caption)){echo '<div class="image_cap" style="font-size:15px;font-style:italic;margin:25px auto 0;">'.$featured_image_caption.'</div>';} ?>
                    </div>    
                    <div class="content_col item_1_2 wysiwyg flex col afs standard_headings">
                        <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                        <?php if(!empty($link) && !empty($label)){echo '<a class="button '.$theme.'" href="'.$link.'">'.$label.'</a>';} ?>
                    </div>
                </div>
            </section><!-- /.mixed_content -->
            <?php
        }
    }
}