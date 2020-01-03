<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$postID = get_the_ID();
		$sub_title = get_post_meta($postID, 'sub_title', true);
		$linkedin_profile = get_post_meta($postID, 'linkedin_profile', true);
		
		the_title( '<h1 class="entry-title">', '</h1>' );
		echo '<div class="flex row jfs afc member_meta">';
		echo '<h3 class="sub_title">'.$sub_title.'</h3>';
		if(!empty($linkedin_profile)){ echo '<a href="'.$linkedin_profile.'" target="_blank"><i class="fab fa-linkedin"></i></a>';}
		echo '</div>';
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'build-create-nrc' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
