<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caelynx
 */

if ( ! is_active_sidebar( 'sidebar-post' ) ) {
	return;
}
?>
<aside class="widget-area item_1_3">
<?php if(is_single()): ?>	
<div class="author-section flex row">
	<?php
	echo '<div class="side-date"><span>'.get_the_date('d').'</span> '.get_the_date('M').'</div>';
	$id = get_the_author_meta( 'ID' );
	echo '<div class="author-image flex col">';
	echo get_avatar($id);
	echo get_the_author();
	echo '</div>';

	$social = get_field('social_platforms', 'user_'. $id );
	echo '<div class="author-social flex row">';
	foreach($social as $platform){
		$plat = $platform['platform'];
		$icon = $plat['icon'];
		$profile_url = $platform['profile_url'];
		echo '<a href="'.$profile_url.'" target="_blank" class="sb_social">'.$icon.'</a>';
	}
	echo '</div>';
	?>
	</div><!-- /.author-section -->
<?php else:
		$footer = get_field('footer', 'option');
		$social_icons = $footer['social_icons'];

		foreach($social_icons as $sicon) {
			echo '<a href="'.$sicon["link"].'" target="_blank" class="sb_social">'.$sicon["icon"].'</a>';
		}
	endif;
	dynamic_sidebar( 'sidebar-post' );

	$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );

	if(!empty($tags)):
	?>
	<h2 class="widget-title">TAGS</h2>
	<ul id="tags-list">
	<?php
		
		foreach ( (array) $tags as $tag ) {
			echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
		}
	?>
	</ul>
	<?php endif; ?>
</aside><!-- .widget-area -->
