<?php
$postID = get_the_ID();

get_header();

service_header();

wysiwyg($postID);

primary_content('',$postID);

primary_content_redux($postID);

case_study();

single_secondary_content($postID);

simple_cta($postID);

get_footer();