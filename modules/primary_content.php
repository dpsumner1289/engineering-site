<?php
if(!function_exists('primary_content')) {
    function primary_content($content_type, $postID) {
        if($content_type !== 'product'):
            $wysiwyg = get_post_meta($postID, 'primary_content', true);
            $wysiwyg = apply_filters('the_content', $wysiwyg);
            $featured_image = get_post_meta($postID, 'primary_featured_image', true);
            $primary_background_image = get_post_meta($postID, 'primary_background_image', true);
            $featured_image_caption = wp_get_attachment_caption($featured_image);
            $featured_image = wp_get_attachment_url($featured_image);
            $primary_background_image = wp_get_attachment_url($primary_background_image);
            ?>
            <section class="mixed_content primary_mixed flex col" <?php if(!empty($primary_background_image)){ echo 'style="background-image:url('.$primary_background_image.');background-repeat:no-repeat;"';} ?>>
                <div class="flex row container jfc afc container-lg">
                    <div class="content_col item_1_2 wysiwyg flex col afs standard_headings">
                        <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                        <?php if(!empty($link) && !empty($label)){echo '<a class="button '.$theme.'" href="'.$link.'">'.$label.'</a>';} ?>
                    </div>
                    <div class="content_col item_1_2 image flex col afc">
                        <?php if(!empty($featured_image)){echo '<div class="img shadow"><img src="'.$featured_image.'" /></div>';} ?>
                        <?php if(!empty($featured_image_caption)){echo '<div class="image_cap" style="font-size:15px;font-style:italic;margin:25px auto 0;">'.$featured_image_caption.'</div>';} ?>
                    </div>
                </div>
            </section><!-- /.mixed_content -->
            <?php
        endif;
        if($content_type == 'product'):
            $service_points = get_post_meta($postID, 'service_point', true);
            $in_action_heading= get_post_meta($postID, 'in_action_section_heading', true);
            $in_action_list_points= get_post_meta($postID, 'in_action_section_list_points', true);
            $in_action_section_background_image= get_post_meta($postID, 'in_action_section_background_image', true);
            $in_action_section_background_image = wp_get_attachment_url($in_action_section_background_image);
            $wysiwyg = get_post_meta($postID, 'leading_content', true);
            $leading_content_background_image = get_post_meta($postID, 'leading_content_background_image', true);
            $featured_image = get_post_meta($postID, 'featured_product_image', true);
            $featured_image = wp_get_attachment_url($featured_image);
            $leading_content_background_image = wp_get_attachment_url($leading_content_background_image);
        ?>
            <section class="mixed_content multi_layout" <?php if(!empty($leading_content_background_image)){ echo 'style="background-image:url('.$leading_content_background_image.');background-repeat:no-repeat;"';} ?>>
                <div class="container container-xlg flex row afc jfc">
                    <div class="item_1_2 flex content_col col">
                        <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                        <?php if($service_points > 0): ?>
                            <div class="service_points">
                                <?php for($i = 0; $i < $service_points; $i++) {
                                    $service_key = 'service_point_'.$i.'_';
                                    $sp_heading = get_post_meta($postID, $service_key.'heading', true);
                                    $sp_description = get_post_meta($postID, $service_key.'description', true);
                                    $sp_button_label = get_post_meta($postID, $service_key.'button_label', true);
                                    $sp_button_link = get_post_meta($postID, $service_key.'button_link', true);
                                    ?>
                                    <div class="service_point">
                                        <?php if(!empty($sp_heading)){ echo '<h3>'.$sp_heading.'</h3>';} ?>
                                        <?php if(!empty($sp_description)){ echo '<div class="sp_desc">'.$sp_description.'</div>';} ?>
                                        <?php if(!empty($sp_button_link) && !empty($sp_button_label)){echo '<a class="seemore" href="'.$sp_button_link.'">'.$sp_button_label.' <i class="fal fa-arrow-right"></i></a>';} ?>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="item_1_2 flex col afs content_col image">
                        <?php if(!empty($featured_image)){echo '<div class="img shadow"><img src="'.$featured_image.'" /></div>';} ?>
                        <?php if($in_action_list_points > 0): ?>
                            <div class="action_points" <?php if(!empty($in_action_section_background_image)){ echo 'style="background-image:url('.$in_action_section_background_image.');background-size:cover;"';} ?>>
                                <?php if(!empty($in_action_heading)){echo '<h3>'.$in_action_heading.'</h3>';} ?>
                                <?php for($i = 0; $i < $in_action_list_points; $i++) {
                                    $action_key = 'in_action_section_list_points_'.$i.'_';
                                    $action_point = get_post_meta($postID, $action_key.'point', true);
                                    $action_link = get_post_meta($postID, $action_key.'link', true);
                                    ?>
                                    <div class="action_point">
                                        <?php if(!empty($action_link) && !empty($action_point)){echo '<a class="caret_link" href="'.$action_link.'"><i class="fas fa-caret-right"></i> '.$action_point.'</a>';} ?>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section><!-- /.mixed_content.multi_layout -->
        <?php
        endif;
    }
}