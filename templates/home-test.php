<?php
/* Template Name: Home Page Sandbox */
get_header();

if(have_posts()): while(have_posts()): the_post();
	get_template_part('template-parts/flexible_content');
endwhile; endif;

get_footer(); ?>