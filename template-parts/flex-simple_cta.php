<?php
global $flex_content;

$postID = get_the_ID();
$background_image = $flex_content['background_image'];
$heading = $flex_content['heading'];
$content = $flex_content['content'];
$cta_text_theme = $flex_content['cta_theme'];
$left_bg_image = $flex_content['left_positioned_background_image'];

$button = $flex_content['button'];
    $label = $button['label'];
    $link = $button['link'];
    $theme = $button['theme'];
    simple_cta($postID, $background_image, $heading, $content, $label, $link, $theme, $cta_text_theme, $left_bg_image);
?>