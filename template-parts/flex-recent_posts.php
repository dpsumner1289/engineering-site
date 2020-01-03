<?php
global $flex_content;

$background_image = $flex_content['recent_posts_background_image'];
$number_of_posts = $flex_content['number_of_posts'];
$button_label = $flex_content['button_label'];
$button_link = $flex_content['button_link'];
if(!empty($button_label) && !empty($button_link)){$number_of_columns = $number_of_posts+1;}else{$number_of_columns = $number_of_posts;}

recent_posts($post_ID = false, $background_image, $number_of_posts, $button_label, $button_link);
?>