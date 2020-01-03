<?php
get_header();

service_header($postID);

$postID = get_the_ID();

mixed_content();

case_study($postID);

single_secondary_content($postID);

simple_cta($postID);

get_footer();