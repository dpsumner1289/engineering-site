<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caelynx
 */

get_header();

$ID = get_the_ID();
$version = get_post_meta($ID, 'victor_for_mi_version', true);
$show_cta = get_post_meta($ID, 'victor_for_mi_show_cta', true);
$show_similar_posts = get_post_meta($ID, 'similar_posts_show_similar_posts', true);
?>
<main role="main">
<?php
if(have_posts()): while(have_posts()): the_post();

	// get_template_part('template-parts-resources/rex_content');
	// get_template_part('template-parts-resources/case-studies/rex-case_study');
	get_template_part('template-parts/flexible_content');
	if($show_cta) {
		echo impact_cta($version);
	}
	
	echo !empty(get_the_content()) ?  '<div class="container container-sm">'.apply_filters( 'the_content', $post->post_content ).'</div>' :  '';

endwhile; endif;
if($show_similar_posts) {
	show_similar_posts();
}
?>
</main>
<?php
get_footer();
