<?php
get_header();

$tax = 'capabilities';
$termID = get_queried_object()->term_id;
$postID=false; 
$cta_background_image = get_field('cta_background_image', 'option'); 
$heading = get_field('cta_heading', 'option'); 
$content = get_field('cta_content', 'option'); 
$cta_button = get_field('cta_button', 'option'); 
$cta_button_label = $cta_button['label']; 
$cta_button_link = $cta_button['link']; 
$cta_theme = $cta_button['theme']; 
$cta_text_theme = 'dark_theme'; 
$left_bg_image = get_field('left_positioned_background_image', 'option'); 

simple_hero();

case_study_feed($tax, $termID);

article_feed($tax, $termID);

event_feed($tax, $termID);

resource_feed($tax, $termID);

faq_feed($tax, $termID);

simple_cta($postID, $cta_background_image, $heading, $content, $cta_button_label, $cta_button_link, $cta_theme, $cta_text_theme, $left_bg_image);

get_footer();