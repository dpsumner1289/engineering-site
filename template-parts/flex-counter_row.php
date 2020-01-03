<?php

global $flex_content;

$postID = get_the_ID();
$heading = $flex_content['heading'];
$content = $flex_content['content'];
$equation_figures = $flex_content['equation_figures'];
$background_image = $flex_content['background_image'];
$underlap_amount = $flex_content['underlap_amount'];
$underlapping_content = $flex_content['underlapping_content_below'];

counter($postID, $heading, $content, $equation_figures, $background_image, $underlap_amount, $underlapping_content);
?>