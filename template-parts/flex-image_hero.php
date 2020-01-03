<?php
global $flex_content;

$ID = get_the_ID();
$heading = $flex_content['heading'];
$subheading = $flex_content['subheading'];
$heading_style = $flex_content['heading_style'];
$background_image = $flex_content['background_image'];
$succeeding_icons = $flex_content['succeeding_icons'];
$overlay = $flex_content['overlay'];
$height = $flex_content['height'];
$buttons = $flex_content['buttons'];
$alignment = $flex_content['alignment'];
$theme = $flex_content['theme'];
$custom_css_class = $flex_content['custom_css_class'];
$style = '';
if($alignment == 'afc'){
	$style = 'noitalic';
}
$underlapping_content = $flex_content['underlapping_content_below'];
$postID = get_the_ID();
$use_page_navigation = get_post_meta($postID, 'use_page_navigation', true);
$use_page_navigation = ($use_page_navigation !=='0' && $use_page_navigation !== '');
$nav_links = get_post_meta($postID, 'nav_links', true);

set_post_thumbnail($ID, $background_image['ID']);
?>
<section class="flex-hero flex row banner-inner fs-<?php echo $height; ?> overlay-<?php echo $overlay; ?> <?php if($underlapping_content): echo 'underlap'; endif; ?> <?php echo $style; ?> <?php echo $theme; ?> <?php echo $heading_style; ?> <?php echo $custom_css_class; ?>" style="background-image:url(<?php echo $background_image['url']; ?>)">
	<div class="outer-wrapper container container-lg flex afc">
		<div class="container container-lg <?php if($succeeding_icons == 1){echo 'flex col afsb';} ?>" <?php if($succeeding_icons == 1){echo 'style="height:100%;"';} ?>>
			<div class="inner-wrapper flex col <?php echo $alignment; ?>">
				<div class="opening_content">
					<?php 
					if(!empty($heading['heading_text'])) {
						echo '<h1 class="underline-'.$heading["underline"].'">'.strip_single_tag($heading["heading_text"], 'p').'</h1>';
					}else {
						echo '<h1 class="underline-'.$heading["underline"].'">'.get_the_title($ID).'</h1>';
					}
					if($subheading) {
						echo '<div class="narrow">'.$subheading.'</div>';	
					}	
					?>
				</div>
				<?php 
				if(!empty($buttons)):
				echo '<div class="hero_buttons">';
				foreach($buttons as $button){
					$button_arr = $button['button'];
					$button_text = $button_arr['text'];
					$button_link = $button_arr['link_url'];
					$new_tab = $button_arr['new_tab'];
					$button_theme = $button_arr['theme']['value'];
					$tab = '';

					if($new_tab): $tab = 'target="_blank"'; endif;
					echo '<a href="'.$button_link.'" '.$tab.' class="button draw meet '.$button_theme.'">'.$button_text.'</a>';
				} 
				echo '</div>';
				endif; ?>
			</div> <!-- .inner-wrapper -->
			<?php if($succeeding_icons == 1) {
				?>
				<div class="flex row afe jfsb icon_row" style="margin-top:auto;">
					<?php
					$icons = $flex_content['icon'];
					$i = 0;
					foreach($icons as $icon) {
						$icon_image = $icon['icon_image'];
						$caption = $icon['caption'];
						$link_to = $icon['link_to'];
						?>
						<div class="icon flex col afc jfc">
							<?php if(!empty($link_to)){echo '<a href="'.$link_to.'">';} ?>
							<img src="<?php echo $icon_image['url']; ?>">
							<?php if(!empty($caption)){echo '<span>'.$caption.'</span>';} ?>
							<?php if(!empty($link_to)){echo '</a>';} ?>
						</div>
						<?php
						$i++;
					}
					?>
					<script>
						jQuery(document).ready(function($){
							$('.icon').addClass('item_1_<?php echo $i; ?>');
						});
					</script>
				</div><!-- /.icon_row -->
				<?php
				?>
				<script>
				   jQuery(document).ready(function($) {
					   jQuery(function() {
					   jQuery('a[href*=#]:not([href=#])').on('click', function () {
						   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
						   var target = jQuery(this.hash);
						   target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
						   if (target.length) {  
							   $('html, body').animate({
								   scrollTop: target.offset().top
								   }, 1000);
								   clickCount++;
						   }
						   }
					   });
					   });
				   });
				   </script>
			   <?php
			} ?>
		</div> <!-- .container -->
	</div> <!-- .outer-wrapper -->
	<?php 
	if($use_page_navigation){
		$font_size = 'jfse';
		if($nav_links > 5) {
			$font_size = 'jfse';
		}
		echo '<div class="page_nav container flex row afe jfc container-lg"><div class="link-wrap flex row afc '.$font_size.'"><span>JUMP TO: </span>';
		for($i = 0; $i < $nav_links; $i++) {
			$link_key = 'nav_links_'.$i.'_link';
			$link_text_key = 'nav_links_'.$i.'_link_text';
			$link = get_post_meta($postID, $link_key, true);
			$link_text = get_post_meta($postID, $link_text_key, true);
			echo '<a href="#'.$link.'">'.$link_text.'</a>';
		}
		echo '</div></div>';
		?>
		 <script>
			jQuery(document).ready(function($) {
				jQuery(function() {
				jQuery('a[href*=#]:not([href=#])').on('click', function () {
					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = jQuery(this.hash);
					target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
					if (target.length) {  
						$('html, body').animate({
							scrollTop: target.offset().top
							}, 1000);
							clickCount++;
					}
					}
				});
				});
			});
			</script>
		<?php
	} ?>
</section> <!-- .flex-hero -->