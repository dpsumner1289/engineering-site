<?php
get_header();
$postID = get_the_ID();
$background_image = get_post_meta($postID, 'background_image', true);
$background_image = wp_get_attachment_url($background_image);
$logo = get_field('site_logo_dark', 'option');
?>
    <div class="blog-header" style="background-image:url(<?php echo $background_image; ?>);">
        <div class="container container-md-lg">
            <div class="flex row vc">
            </div><!-- /.flex-row -->
        </div><!-- /.container -->
    </div><!-- /.blog-header -->
	<div id="primary" class="content-area">
		<main class="container container-md" role="main">
			<div class="flex row flex-page">

		<?php		
		while ( have_posts() ) :
			the_post();
			echo '<div class="item_1_2 flex col jfs afe member_image"><a href="/our-team" class="back"><i class="fas fa-arrow-left"></i> Back to Team</a>'.get_the_post_thumbnail($postID, 'full').'</div>';
			echo '<div class="flex row flex-posts item_1_2">';
			get_template_part( 'template-parts/content', get_post_type() );
			echo '</div><!-- /.flex-posts -->';
		endwhile; // End of the loop.
		?>
			</div> <!-- /.flex-page -->
		</main><!-- /.container -->
		<?php recent_posts(); ?>
	</div><!-- /#primary -->
	<?php if(!$background_image): ?>
		<script>
			jQuery(document).ready(function($) {
				$('body').removeClass('light_theme');
				$('body').addClass('dark_theme');
				$('body.single-team_members .flex-page .flex-posts .entry-header .entry-title').css('color', '#333');
				$('body.single-team_members .flex-page .flex-posts .entry-header .member_meta .sub_title').css('color', '#333');
				$('.site-header .logo img').attr('src', '<?php echo $logo["url"]; ?>');
			});
		</script>
	<?php endif; ?>
<?php
get_footer();
