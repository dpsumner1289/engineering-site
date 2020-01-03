<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package caelynx
 */

get_header();
?>
    <div class="blog-header" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
        <div class="container container-md-lg">
            <div class="flex row vc">
            </div><!-- /.flex-row -->
        </div><!-- /.container -->
    </div><!-- /.blog-header -->
	<div id="primary" class="content-area">
		<main class="container container-md-lg" role="main">
			<div class="flex row flex-page">

		<?php
		echo '<div class="flex row flex-posts item_2_3">';
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			if(function_exists('social_warfare')):
				social_warfare();
			endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			get_template_part('template-parts/fp_single_post');
			the_post_navigation(array(
				'prev_text'                  => __( 'PREVIOUS' ),
            	'next_text'                  => __( 'NEXT' ),
			));
		endwhile; // End of the loop.
		echo '</div><!-- /.flex-posts -->';
		get_sidebar();
		?>
			</div> <!-- /.flex-page -->
		</main><!-- /.container -->
	</div><!-- /#primary -->

<?php
get_footer();
