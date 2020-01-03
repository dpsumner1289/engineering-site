<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package caelynx
 */

if(is_home()) {
	$postID = get_option( 'page_for_posts' );
}else {
	$postID = get_the_ID();
}
$color_theme = get_post_meta($postID, 'color_theme', true);
$logo = get_field('site_logo', 'option');
if($color_theme == 'light_theme') {
	$logo = $logo;
}elseif($color_theme == 'dark_theme') {
	$logo = get_field('site_logo_dark', 'option');
}


$header = get_field('header', 'option');

$page_options = get_field('page_options');
$base_background_color = $page_options['base_background_color'];

if($base_background_color !== 'null') {
	$background_color = ' style="background-color:';
	$background_color .= $base_background_color;
	$background_color .= ';"';
} else {
	$background_color = 'title=""';
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="2EmFv3YhiPZ37R4s0skH8Hrp19H2Ib0XYvxWGtsXefs" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<?php wp_head(); ?>
	<script>
		var $ = jQuery;
		function headerOffset() {
			var headerHeight = $('#masthead').outerHeight();
			$('.flex-hero').css('padding-top', headerHeight + 'px');
		}
		function showButton(){
			$('#scrollTop').css({'right':'0'});
			$('body.dark_theme #masthead').css({'background-color':'#fff'});
			$('body.light_theme #masthead').css({'background-color':'#1D1E1F'});
		}

		function hideButton(){
			$('#scrollTop').css({'right':'-100%'});
			$('body.dark_theme #masthead').css({'background-color':'transparent'});
			$('body.light_theme #masthead').css({'background-color':'transparent'});
		}
		$(window).on('scroll', function(){
			var y = $(this).scrollTop();
			if(y > 100){
				showButton();
			}else {
				hideButton();
			}
		})
		$(document).ready(function($){
			headerOffset();	
			$('body').addClass('<?php echo $color_theme; ?>');
			$('#scrollTop').click(function() {
				$('html, body').animate({
				scrollTop: 0
				}, 500);
				return false;
			});

			// toggle header background if scrolled down the page on load
			if($(window).scrollTop() > 100){
				showButton();
			}
		});
		$(window).load(function(){
			headerOffset();
		});
		$(window).resize(function(){
			headerOffset();
		});
	</script>
	
	<script type="text/javascript">
	   var _ss = _ss || [];
	   _ss.push(['_setDomain', 'https://koi-3QNHIVO4KA.marketingautomation.services/net']);
	   _ss.push(['_setAccount', 'KOI-42NXECMN4Y']);
	   _ss.push(['_trackPageView']);
	(function() {
	   var ss = document.createElement('script');
	   ss.type = 'text/javascript'; ss.async = true;
	   ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-3QNHIVO4KA.marketingautomation.services/client/ss.js?ver=2.2.1';
	   var scr = document.getElementsByTagName('script')[0];
	   scr.parentNode.insertBefore(ss, scr);
	})();
	</script>
	
	<!-- Begin WebTrax -->
	<script type="text/javascript">
	var wto = wto || [];
	wto.push(['setWTID', 'caelynx']);
	wto.push(['webTraxs']);
	(function() {
	var wt = document.createElement('script');
	wt.src = document.location.protocol + '//www.webtraxs.com/wt.php';
	wt.type = 'text/javascript';
	wt.async = true;
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wt, s);
	})();
	</script>
	<noscript><img src="https://www.webtraxs.com/webtraxs.php?id=caelynx&st=img" alt="" /></noscript>
	<!-- End WebTrax -->
</head>

<body <?php body_class(); ?> <?php echo $background_color; ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'build-create-nrc' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container container-md-lg flex row afc jfsb">
			<div class="logo">
				<a href="/"><img src="<?php echo $logo['url'];?>"></a>
			</div>
			<div class="flex col afe right_side">
				<div class="nav-section flex row afc full">
					<a href="#site-navigation" class="menu-bars flex row afc jfc"><i class="fas fa-bars"></i> MENU</a>
					<nav id="site-navigation" class="main-navigation flex jfe" role="navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container_class'	 => 'flex flexend',
						) );
						$menu = wp_get_nav_menu_object('main-menu');	
						// var_dump($menu);
						?>
					</nav><!-- #site-navigation -->
				</div><!-- /.nav-section -->
			</div>
		</div><!-- /.container -->
	</header><!-- /#masthead -->
	<div id="scrollTop"><i class="fas fa-angle-up"></i></div>
	<div id="content" class="site-content">
