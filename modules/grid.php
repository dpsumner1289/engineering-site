<?php
if(!functions_exists('grid')) {
    function grid($postID=false, $leading_content=false, $content_type=false, $square=false, $button_label=false, $button_link=false) {
        if($postID) {
            $postID = $postID;
            $leading_content = $leading_content;
            $content_type = $content_type;
            $square = $square;
            $button_label = $button_label;
            $button_link = $button_link;
        }else {
            $postID = get_the_ID();
            $leading_content = get_post_meta($postID, 'leading_content', true);
            $content_type = get_post_meta($postID, 'content_type', true);
            $square = get_post_meta($postID, 'square', true);
            $button_label = get_post_meta($postID, 'see_more_button_label', true);
            $button_link = get_post_meta($postID, 'see_more_button_link', true);
        }
        $overlap = '';
        $default_post_image = get_stylesheet_directory_uri().'/assets/images/default-post.jpg';
        ?><?php
    }
}