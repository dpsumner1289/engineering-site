<?php
/**
 * caelynx functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package caelynx
 */


if ( ! function_exists( 'caelynx_setup' ) ) :
	add_action( 'after_setup_theme', 'caelynx_setup' );
	function caelynx_setup() {
		load_theme_textdomain( 'build-create-caelynx', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;

add_action( 'after_setup_theme', 'caelynx_content_width', 0 );
function caelynx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'caelynx_content_width', 640 );
}

/**
 * custom image sizes
 */
add_image_size('medium-thumb', 300, 300, array( 'center', 'top' ) );

/**
 * enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'caelynx_scripts' );
function caelynx_scripts() {
	
	//#- Styles
	wp_enqueue_style( 'font-style', get_stylesheet_directory_uri().'/assets/fonts/font.css' );
	wp_enqueue_style( 'font-awesome-style', get_stylesheet_directory_uri().'/node_modules/@fortawesome/fontawesome-pro/css/all.css' );
	wp_enqueue_style( 'build-create-caelynx-style', get_stylesheet_uri(), array(), filemtime() );

	//##-- Owl Carousel Styles
	wp_enqueue_style( 'owl-styles', get_stylesheet_directory_uri().'/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owl-theme-styles', get_stylesheet_directory_uri().'/owl-carousel/owl.theme.default.min.css' );
	
	//##-- mmenu styles
	wp_enqueue_style( 'mmenu-style', get_stylesheet_directory_uri().'/inc/mmenu/dist/jquery.mmenu.all.css' );
	//##-- fancybox styles
	wp_enqueue_style( 'fancybox-style', get_stylesheet_directory_uri().'/inc/fancybox-master/dist/jquery.fancybox.min.css' );

	//#- Scripts
	wp_enqueue_script( 'build-create-caelynx-counter', get_template_directory_uri() . '/js/animations/counter.js', array(), null, true );
	wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/inc/jquery-ui/jquery-ui.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'build-create-caelynx-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//##-- mmenu scripts
	wp_enqueue_script( 'mmenu', get_template_directory_uri() . '/inc/mmenu/dist/jquery.mmenu.all.js', array('jquery'), null, true );
	wp_enqueue_script( 'mmenu-custom', get_template_directory_uri() . '/js/custom-functionality/mmenu-custom.js', array('jquery'), null, true );

	//##-- fancybox scripts
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/fancybox-master/dist/jquery.fancybox.min.js', array('jquery'), null, true );

	//##-- owl carousel
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'layouts', get_template_directory_uri() . '/js/layouts.js', array('jquery'), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function admin_style() {
	if(is_admin()){	
		wp_enqueue_style('bc', get_template_directory_uri() . '/admin.css');
	}
  }
  add_action('init', 'admin_style');

add_filter( 'post_thumbnail_html', 'wpdocs_post_image_html', 10, 3 );
function wpdocs_post_image_html( $html, $post_id, $post_image_id ) {
    $html = '<a href="' . get_permalink( $post_id ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="nolink">' . $html . '</a>';
    return $html;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * add ACF config
 */
include (trailingslashit(get_template_directory()).'inc/acf-config.php');

/**
 * add custom functions
 */
include (trailingslashit(get_template_directory()).'inc/custom-functions.php');

/**
 * add menu locations
 */
add_action( 'after_setup_theme', 'menu_registration' );
function menu_registration() {
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'build-create-caelynx' ),
		'menu-footer' => esc_html__( 'Footer Menu', 'build-create-caelynx' ),
	) );
}
// generic pagination 
function pagination($current = 1, $total = 1, $ppp = 10, $klass = ''){
	$pages = ceil($total / $ppp);
		$start_page = ($current - 3) >= 1 ? $current - 3 : 1;
		$end_page = ($current + 3) <= $pages ? $current + 3 : $pages;
		$first = true;
	?>
	<div class="pagination <?php echo $klass; ?>">
		<?php if($current > 1) : ?>
			<a class="previous" data-page="<?php echo $current - 1; ?>">PREVIOUS</a>
		<?php else : ?>
			<span class="previous disabled">PREVIOUS</span>
		<?php endif; ?>

		<div class="page-wrap">	
			<?php for($i = $start_page; $i <= $end_page; $i++) : ?>

				<?php if($first && ($i != 1)) : ?>
					<a href="<?php echo $i; ?>">1 ...</a>
				<?php endif; ?>
				<?php $first = false; ?>
				
				<?php if($i != $current) : ?>
					<a data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
				<?php else : ?>	
					<span class="current"><?php echo $i; ?></span>
				<?php endif; ?>
				
				<?php if(($i == $end_page) && ($end_page < $pages)) : ?>
					<a data-page="<?php echo $i; ?>">... <?php echo $pages; ?></a>
				<?php endif; ?>
			<?php endfor;?>
		</div>

		<?php if($current < $pages) : ?>
			<a class="next" data-page="<?php echo $current + 1; ?>">NEXT</a>
		<?php else : ?>
			<span class="next disabled">NEXT</span>
		<?php endif; ?>
	</div>
	<?php
}
function embed_container_filter($value){
	$content = preg_replace('/(<iframe.*?<\/iframe>)/','<div class="embed-container">$1</div>',$value);
	return $content;
}
 if(!is_admin()){
	//  add_filter('acf/load_value', 'embed_container_filter',10,3);
	// add_filter('the_content', 'embed_container_filter',10,3);
}
/**
 * custom wrapper function for 'get_post_meta' in content rows
 */
function gpm($key, $wysiwyg = false){
	global $post, $prefix;
	if(!$post) return false;
	if($wysiwyg){
		return apply_filters('the_content', get_post_meta($post->ID, $prefix.$key, true));
	}else{
		return get_post_meta($post->ID, $prefix.$key, true);
	}
}
add_filter( 'gform_tabindex_4', 'change_tabindex' , 10, 2 );
function change_tabindex( $tabindex, $form ) {
    return 3;
}
function add_author_support_to_posts() {
	add_post_type_support( 'story', 'author' ); 
	add_post_type_support( 'event', 'author' ); 
	add_post_type_support( 'video', 'author' ); 
	add_post_type_support( 'press_release', 'author' ); 
}
add_action( 'init', 'add_author_support_to_posts' );

function add_ex_support_to_posts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_ex_support_to_posts' );

function post_types_admin_order( $wp_query ) {
	if (is_admin()) {
	  $post_type = $wp_query->query['post_type'];
	  if ($post_type == 'event') {
		$wp_query->set('orderby', 'date');
		$wp_query->set('order', 'DESC');
	  }
	}
}
add_filter('pre_get_posts', 'post_types_admin_order');

/**
 * add new image sizes
 */
if( function_exists('add_image_size') ){
	add_image_size('bc-custom-thumbnail-size', 425, 235, true);
	add_image_size('bc-large-thumbnail-size', 1000, 400, true);
	add_image_size('bc-industries-tile', 500, 333, true);
	add_image_size('bc-gallery-size', 300, 211, true);
	add_image_size('bc-square-post', 120, 120, true);
}
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'bc-custom-thumbnail-size' => __( 'b/c custom thumbnail size' ),
	));
}

/**
 * add modular functions
 */
include (trailingslashit(get_template_directory()).'modules/gallery.php');
include (trailingslashit(get_template_directory()).'modules/filtering.php');
include (trailingslashit(get_template_directory()).'modules/recent_posts.php');
include (trailingslashit(get_template_directory()).'modules/counter.php');
include (trailingslashit(get_template_directory()).'modules/dlc.php');
include (trailingslashit(get_template_directory()).'modules/cs-client_testimonial.php');
include (trailingslashit(get_template_directory()).'modules/cs-focus_points.php');
include (trailingslashit(get_template_directory()).'modules/cs-abstract_points.php');
include (trailingslashit(get_template_directory()).'modules/cs-header.php');
include (trailingslashit(get_template_directory()).'modules/simple_cta.php');
include (trailingslashit(get_template_directory()).'modules/cs-results.php');
include (trailingslashit(get_template_directory()).'modules/case_study.php');
include (trailingslashit(get_template_directory()).'modules/service_header.php');
include (trailingslashit(get_template_directory()).'modules/resource_header.php');
include (trailingslashit(get_template_directory()).'modules/primary_content.php');
include (trailingslashit(get_template_directory()).'modules/primary_content_redux.php');
include (trailingslashit(get_template_directory()).'modules/secondary_content.php');
include (trailingslashit(get_template_directory()).'modules/mixed_content.php');
include (trailingslashit(get_template_directory()).'modules/client_quote.php');
include (trailingslashit(get_template_directory()).'modules/case_study_feed.php');
include (trailingslashit(get_template_directory()).'modules/article_feed.php');
include (trailingslashit(get_template_directory()).'modules/event_feed.php');
include (trailingslashit(get_template_directory()).'modules/resource_feed.php');
include (trailingslashit(get_template_directory()).'modules/faq_feed.php');
include (trailingslashit(get_template_directory()).'modules/simple_hero.php');
include (trailingslashit(get_template_directory()).'modules/grid_points.php');
include (trailingslashit(get_template_directory()).'modules/secondary_product_content.php');
include (trailingslashit(get_template_directory()).'modules/content_sidebar.php');
include (trailingslashit(get_template_directory()).'modules/wysiwyg.php');
include (trailingslashit(get_template_directory()).'modules/additional_content.php');
include (trailingslashit(get_template_directory()).'modules/static_cta.php');

/**
 * add Gravity Forms functionality
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'gform_confirmation_anchor', '__return_true' );

/**
 * shorten excerpt length
 */
function get_excerpt($postID=false, $numletters){
	if($postID) {
		$content_post = get_post($postID);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$excerpt = $content;
	}else {
		$excerpt = get_the_content();
	}
	
	$excerpt = preg_replace(" ([*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $numletters);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	// $excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
	$excerpt = $excerpt.'...';
	return $excerpt;
}
function column_widths($doit, $colclasses, $col_count) {
	if($doit) {
		?>
		<script>
			jQuery(document).ready(function($){
		<?php
		foreach($colclasses as $colclass) {
			echo '$(".'.$colclass.'").addClass("item_1_'.$col_count.'");';
		}
		?>
		});
		</script>
		<?php
	}
}

function my_change_sort_order($query){
	if(is_post_type_archive('event') && $query->is_main_query() && !is_admin()) :
		$query->set( 'order', 'DESC' );
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'orderby', 'meta_value_num' );
	elseif(is_tax('event_type') && $query->is_main_query() && !is_admin()):
		$query->set( 'order', 'DESC' );
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'orderby', 'meta_value_num' );
	endif;
};
add_action( 'pre_get_posts', 'my_change_sort_order'); 


function strip_single_tag($str,$tag){

    $str1=preg_replace('/<\/'.$tag.'>/i', '', $str);

    if($str1 != $str){

        $str=preg_replace('/<'.$tag.'[^>]*>/i', '', $str1);
    }

    return $str;
}

function bc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'bc_mime_types');

/**
 * ajax resource filter
 */
add_action("wp_ajax_resource_filter", "resource_filter");
add_action("wp_ajax_nopriv_resource_filter", "resource_filter");
function resource_filter() {
	$ID = get_the_ID();
	ob_start();
	$page = $_POST['page'];
	$resourceID = $_POST['resourceID'];
	$term_id = $_POST['termID'];
	$tax = $_POST['tax'];
	$args = array(
		'paged' => $page,
		'post_type' => 'resource',
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'tax_query' => array(
			array(
				'taxonomy' => $tax,
				'terms' => array($resourceID, $term_id),
				'include_children' => true,
			)
		),
	);
	$resources = new WP_Query($args);

	if($resources->found_posts) {
		foreach($resources->posts as $resource){
			$thisID = $resource->ID;
			$title = get_the_title($thisID);
			$terms = get_the_terms($thisID, 'resource_type');
			$file = get_post_meta($thisID, 'downloadable_file', true);
			$file = wp_get_attachment_url($file);
			?>
			<div class="resource item_1_3">
				<div class="resource_wrapper flex col afc jfc">
					<div class="resource_type">
						<?php foreach($terms as $term) {
							$file_icon = get_term_meta($term->term_id, 'font_awesome_icon', true);
							echo '<a>'.$file_icon.$term->name.'</a>';
						} ?>
					</div>
					<div class="download_title">
						<?php echo $title; ?>
					</div>
					<div class="download_file">
						<?php echo '<a href="'.$file.'" target="_blank"><i class="far fa-download"></i> DOWNLOAD</a>'; ?>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		echo '<h1 style="width:100%; text-align:center;margin-bottom:1.618rem;">SORRY, NOTHING WAS FOUND.</h1>';
		echo '<h3 style="width:100%; text-align:center;margin-bottom:3.326rem;">TRY ANOTHER SEARCH?</h3>';
	}
	echo ob_get_clean();
	die();
}

/**
 * add ajax searches
 */
add_action("wp_ajax_post_search", "post_search");
add_action("wp_ajax_nopriv_post_search", "post_search");
function post_search() {
	$ID = get_the_ID();
	ob_start();
	$page = $_POST['page'];
	$keywords = $_POST['keywords'];
	$post_type = $_POST['post_type'];
	$args = array(
		'paged' => $page,
		's' => $keywords,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'order' => 'DESC'
	);
	$articles = new WP_Query($args);

	if($articles->found_posts) {
		foreach($articles->posts as $article){
			?>
			<div class="article full flex row afc jfc">
				<?php
				$aID = get_the_ID();
				$title = get_the_title($article->ID);
				$link = get_the_permalink($article->ID);
				$date = get_the_date('n.j.y', $article->ID);
				$focus_image = get_the_post_thumbnail_url($article->ID, 'bc-square-post');
				$cats = get_the_category();

				echo '<div class="item_1_5 nobreak flex"><img src="'.$focus_image.'" /></div>';
				echo '<div class="item_4_5 nobreak flex col">';
				echo '<h4>'.$title.'</h4>';
				echo '<div class="meta flex row jfsb"><div class="postedin">Posted <span>'.$date.'</span> in ';
				foreach($cats as $cat) {
					echo '<a href="/'.$cat->slug.'">'.$cat->name.'</a>';
				}
				echo '</div><a href="'.$link.'">Read Article</a></div></div>';
				?>
			</div>
			<?php
		}
	} else {
		echo '<h1 style="width:100%; text-align:center;margin-bottom:1.618rem;">SORRY, NOTHING WAS FOUND.</h1>';
		echo '<h3 style="width:100%; text-align:center;margin-bottom:3.326rem;">TRY ANOTHER SEARCH?</h3>';
	}
	echo ob_get_clean();
	die();
}

/**
 * ajax gallery
 */
add_action("wp_ajax_load_images", "load_images");
add_action("wp_ajax_nopriv_load_images", "load_images");
function load_images() {
	$ID = $_POST['ID'];
	$gallery = get_post_meta($ID, 'gallery', true);
	$gallery_key = 'gallery_';
	$image_sub_key = '_image';
	$i = $_POST['i'];
	$numLoad = $_POST['numLoad'];
	$is_caption = $_POST['is_caption'];
	$j = 1;
	$loadnum = $i+$numLoad;
	$output = '';
	if($is_caption === true){$padstyle = 'style="padding:0 2.405rem;"';}else{$padstyle = 'style="padding-top:0;"';}
	for($i; $i < $loadnum; $i++) {  
		$image_key = $gallery_key.$i.$image_sub_key;
		// $caption_key = $gallery_key.$i.$caption_sub_key;
		$image = get_post_meta($ID, $image_key, true);
		$cropped_image = wp_get_attachment_image_src($image, 'bc-gallery-size');
		$caption = wp_get_attachment_caption($image);
		$image = wp_get_attachment_url($image);
		$link_key = '_item_link';
		$linked_text = get_post_meta($ID, $gallery_key.$i.$link_key.'_link_text', true);
		$linked_link = get_post_meta($ID, $gallery_key.$i.$link_key.'_link', true);
		if(!empty($linked_link)) {
			$linked_link = get_permalink($linked_link);
		}else {
			$linked_link = '';
		}

		if($j === 1) {
			$output .= '<div class="flex row natural container container-lg" '.$padstyle.'>';
			$output .= '<div class="flex vc hc item_1_6 loaded"><a data-fancybox="gallery" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class="nolink" href="'.$image.'"><img src="'.$cropped_image[0].'" data-src="'.$image.'" data-caption="'.$caption.'"/></a></div>';
		}elseif($j === ($loadnum - 1)) {
			$output .= '<div class="flex vc hc item_1_6 loaded"><a data-fancybox="gallery" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class ="nolink" href="'.$image.'"><img src="'.$cropped_image[0].'" data-src="'.$image.'" data-caption="'.$caption.'"/></a></div></div>';
		}else {
			$output .= '<div class="flex vc hc item_1_6 loaded"><a data-fancybox="gallery" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class ="nolink" href="'.$image.'"><img src="'.$cropped_image[0].'" data-src="'.$image.'" data-caption="'.$caption.'"/></a></div>';
		}
		$j++;
	}
	echo $output;
	die();
}

/**
 * readmore ajax load
 */
add_action("wp_ajax_readmore_posts", "readmore_posts");
add_action("wp_ajax_nopriv_readmore_posts", "readmore_posts");
function readmore_posts() {
	$ID = get_the_ID();
	ob_start();
	$page = $_POST['page'];
	$category = $_POST['category'];
	$post_type = $_POST['post_type'];
	$args = array(
		'paged' => $page,
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'order' => 'DESC'
	);
	if(!empty($category)) {
		$args['category_name'] = $category;
	}

	$articles = new WP_Query($args);

	if($articles->found_posts) {
		?>
	<section class="grid story-grid">
	<div class="container container-lg">
		<div class="outer-wrapper post-wrap">
			<div class="inner-wrapper flex row vc">
		<?php
		foreach($articles->posts as $article){
			if(get_the_post_thumbnail($article->ID)) {
				$background = get_the_post_thumbnail($article->ID, 'bc-custom-thumbnail-size', array('class'=>'nolink'));
			} else {
				$background = '<img src="'.get_stylesheet_directory_uri().'/assets/images/default-post.jpg" />';
			}
			$posttitle = get_the_title($article->ID);
			$thumb = get_the_post_thumbnail($article->ID, 'bc-custom-thumbnail-size');
			$url = get_the_permalink($article->ID);
			$excerpt = get_excerpt($article->ID);
			$date = get_the_date('n.j.Y', $article->ID);
			?>
			<div class="post_1_3 post item item_1_3 flex vc col">
				<div class="post_wrap">
					<figure class="inner_post flex row vc nolink" style="display:block;text-decoration:none;">
						<?php echo $background; ?>
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
			<?php
		}
		?>
			</div><!-- /.inner-wrapper-->
		</div><!-- /.outer-wrapper-->
	</div><!-- /.container-->
    </section><!-- /.story-grid -->
		<?php
	}
	echo ob_get_clean();
	die();
}

/**
 * register color schemes.
 */
add_action('admin_init', 'add_colors');
function add_colors() {
	$suffix = is_rtl() ? '-rtl' : '';

	wp_admin_css_color(
		'caelynx', __( 'Caelynx', 'admin_schemes' ),
		get_stylesheet_directory_uri().'/admin-colors/caelynx/colors.css',
		array( '#00C2FF', '#52BA56', '#26211E', '#fff' ),
		array( 'base' => '#00C2FF', 'focus' => '#fff', 'current' => '#fff' )
	);
}

add_filter('use_block_editor_for_post_type', '__return_false');

/**
 * SharpSpring code for form submissions
 */
 
 add_action( 'gform_after_submission', 'post_to_third_party', 10, 2 );
function post_to_third_party( $entry, $form ){

$body = [];

function dupeCheck($fieldName, $bodyData) {
 $cleanLabel = preg_replace("/[^a-zA-Z0-9]+/", "", $fieldName);
 for ($x = 0; $x <= 20; $x++) {
 if(array_key_exists($cleanLabel, $bodyData)) {
 $cleanLabel = $cleanLabel . $x;
 } else { break; }
 } 
 return $cleanLabel;
 }
 
 $formFields = $form['fields'];

foreach($formFields as $formField):
 if($formField['label'] == 'sharpspring_base_uri') {
 $base_uri = rgar( $entry, $formField['id']);
 $sendToSharpSpring = true;

} elseif($formField['label'] == 'sharpspring_endpoint') {

$post_endpoint = rgar( $entry, $formField['id']);
 } elseif($formField['inputs']) {

if($formField['type'] == 'checkbox') {

$fieldNumber = $formField['id'];
 $fieldLabel = dupeCheck($formField['label'], $body);
 $checkBoxField = GFFormsModel::get_field( $form, $fieldNumber );
 $tempValue = is_object( $checkBoxField ) ? $checkBoxField->get_value_export( $entry ) : '';
 $trimmedValue = str_replace(', ', ',', $tempValue);
 $body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = $trimmedValue;
 
 } elseif($formField['inputs']) {

foreach($formField['inputs'] as $subField):
 $fieldLabel = dupeCheck($subField['label'], $body);
 $fieldNumber = $subField['id'];
 $body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, $fieldNumber);
 endforeach;
 }
 } else {

$fieldNumber = $formField['id'];
 $fieldLabel = dupeCheck($formField['label'], $body);
 $body[preg_replace("/[^a-zA-Z0-9]+/", "", $fieldLabel)] = rgar( $entry, $fieldNumber);
 };

endforeach;
 
 $body['form_source_url'] = $entry['source_url'];
 $body['trackingid__sb'] = $_COOKIE['__ss_tk']; //DO NOT CHANGE THIS LINE... it collects the tracking cookie to establish tracking

$post_url = $base_uri . $post_endpoint;

if($sendToSharpSpring) {
 $request = new WP_Http();
 $response = $request->post( $post_url, array( 'body' => $body ) );
 }
}
