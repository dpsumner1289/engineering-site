<?php
// Template Name: Product Archive
get_header();
get_template_part('template-parts/flexible_content');
$postID=false; 
$custom_cta_background_image = get_field('custom_cta_background_image');
if(!empty($custom_cta_background_image)) {
    $cta_background_image = $custom_cta_background_image;
    $left_bg_image = ''; 
}else {
    $cta_background_image = get_field('cta_background_image', 'option'); 
    $left_bg_image = get_field('left_positioned_background_image', 'option'); 
}
$heading = get_field('cta_heading', 'option'); 
$content = get_field('custom_cta_copy'); 
if(!empty($content)) {
    $content = $content;
}else {
    $content = get_field('cta_content', 'option'); 
}
$cta_button = get_field('cta_button', 'option'); 
$cta_button_label = $cta_button['label']; 
$cta_button_link = get_field('custom_cta_button_link');
if(!empty($cta_button_link)) {
    $cta_button_link = $cta_button_link;
}else {
    $cta_button_link = $cta_button['link'];
}
$cta_theme = $cta_button['theme']; 
$cta_text_theme = 'light_theme'; 

simple_cta($postID, $cta_background_image, $heading, $content, $cta_button_label, $cta_button_link, $cta_theme, $cta_text_theme, $left_bg_image);
get_footer();