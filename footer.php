<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caelynx
 */
$logo = get_field('site_logo', 'option');
$address_1 = get_field('address_1', 'option');
$address_2 = get_field('address_2', 'option');
$menu_1_heading = get_field('menu_1_heading', 'option');
$menu_1_links = get_field('menu_1_links', 'option');
$menu_2_heading = get_field('menu_2_heading', 'option');
$menu_2_links = get_field('menu_2_links', 'option');
$menu_3_heading = get_field('menu_3_heading', 'option');
$menu_3_links = get_field('menu_3_links', 'option');
$facebook = get_field('facebook', 'option');
$linkedin = get_field('linkedin', 'option');
$twitter = get_field('twitter', 'option');
?>

	</div><!-- /#content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container container-lg" >
			<div class="top-footer flex row vc">
				<div id="branding" class="item_1_3 flex col afs jfs">
					<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
					<div class="flex row p_address">
						<div class="address item_1_2 nobreak"><?php echo $address_1; ?></div>
						<div class="address item_1_2 nobreak"><?php echo $address_2; ?></div>
					</div>
				</div>
				<div class="item_1_6 custom_menu flex col">
					<?php if(!empty($menu_1_heading)){echo '<h4>'.$menu_1_heading.'</h4>';} ?>
					<?php
					if(!empty($menu_1_links)) {
						echo '<ul>';
						foreach($menu_1_links as $m1_link) {
							$m1_link = $m1_link['link'];
							if(!empty($m1_link['target'])) {
								$target = 'target="'.$m1_link['target'].'"';
							}else {
								$target = '';
							}
							echo '<li><a href="'.$m1_link["url"].'" '.$target.'>'.$m1_link["title"].'</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<div class="item_1_6 custom_menu">
					<?php if(!empty($menu_2_heading)){echo '<h4>'.$menu_2_heading.'</h4>';} ?>
					<?php
					if(!empty($menu_2_links)) {
						echo '<ul>';
						foreach($menu_2_links as $m2_link) {
							$m2_link = $m2_link['link'];
							if(!empty($m2_link['target'])) {
								$target = 'target="'.$m2_link['target'].'"';
							}else {
								$target = '';
							}
							echo '<li><a href="'.$m2_link["url"].'" '.$target.'>'.$m2_link["title"].'</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<div class="item_1_6 custom_menu">
					<?php if(!empty($menu_3_heading)){echo '<h4>'.$menu_3_heading.'</h4>';} ?>
					<?php
					if(!empty($menu_3_links)) {
						echo '<ul>';
						foreach($menu_3_links as $m3_link) {
							$m3_link = $m3_link['link'];
							if(!empty($m3_link['target'])) {
								$target = 'target="'.$m3_link['target'].'"';
							}else {
								$target = '';
							}
							echo '<li><a href="'.$m3_link["url"].'" '.$target.'>'.$m3_link["title"].'</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<div class="item_1_6 footer_menu flex col">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-footer',
						'menu_id'        => 'footer-menu',
						'container_class'	 => 'flex col',
					) );
					?>
					<div class="social flex row afc jfs">
						<?php if(!empty($facebook)){echo '<a href="'.$facebook.'"><i class="fab fa-facebook-square"></i></a>';} ?>
						<?php if(!empty($linkedin)){echo '<a href="'.$linkedin.'"><i class="fab fa-linkedin"></i></a>';} ?>
						<?php if(!empty($twitter)){echo '<a href="'.$twitter.'"><i class="fab fa-twitter"></i></a>';} ?>
					</div>
				</div>
			</div> <!-- /.top-footer -->
		</div>
		<div class="container container-lg meta-info">
			<div class="inner-container flex row jfsb afc full">
				<div class="credits foot-mod">
					Copyright &copy; <?php echo date('Y'); ?> Caelynx
				</div>
				<div class="bc-credit foot-mod">
					Web Design by <a href="https://buildcreate.com/" target="_blank">build/create</a>
				</div>
			</div> <!-- /.inner-container -->
		</div> <!-- /.container -->
	</footer><!-- /#colophon -->
</div><!-- /#page -->

<?php wp_footer(); ?>

</body>
</html>
