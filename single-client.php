<?php
$postID = get_the_ID();

get_header();

// case study header
cs_header();

// abstract point section
abstract_points();

// focus section
focus_points();

// client testimonial
client_testimonial();

// dlc section
dlc();

// counting numbers/figures/statistics
counter();

// results section
cs_results();

// simple cta
simple_cta($postID);

// footer
get_footer();
?>