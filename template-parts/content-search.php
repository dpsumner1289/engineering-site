<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caelynx
 */

$posttitle = get_the_title();
$thumb = get_the_post_thumbnail('bc-custom-thumbnail-size');
$url = get_the_permalink();
$date = get_the_date('n.j.Y');
$default_thumb = '<img src="'.get_stylesheet_directory_uri().'/assets/images/default-thumb.jpg" />';
if(has_excerpt()) {
	$excerpt = get_the_excerpt();
}else {
	$excerpt = get_excerpt();   
}
?>
<div class="post_1_3 post item item_1_3 flex vc col">
	<div class="post_wrap">
		<figure class="inner_post flex row vc nolink" style="display:block;text-decoration:none;">
			<?php 
			if(has_post_thumbnail()) {
				the_post_thumbnail('bc-custom-thumbnail-size', array('class'=>'nolink'));
			}else {
				echo '<a href="" class="nolink">'.$default_thumb.'</a>';
			}
			?>
		</figure>
		<div class="post_content clearfix">
			<div class="eqheight">
				<h4><a href="<?php echo $url; ?>" class="nolink"><?php echo $posttitle; ?></a></h4>
				<div class="excerpt"><?php echo $excerpt; ?></div>
			</div><!-- /.eqheight -->
			<div class="flex row meta">
				<div><i>Published <?php echo $date; ?></i></div>
				<div><a href="<?php echo $url; ?>"><i>Read the Story</i></a></div>
			</div>
		</div><!-- /.post_content -->
	</div><!-- /.post_wrap -->
</div><!-- /.post -->