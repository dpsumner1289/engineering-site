<?php

get_header();
?>
<main role="main">
<?php
if(have_posts()): while(have_posts()): the_post();
	get_template_part('template-parts/flexible_content');
endwhile; endif;
?>
</main>
<?php
get_footer(); ?>