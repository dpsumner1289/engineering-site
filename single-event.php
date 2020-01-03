<?php
/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caelynx
 */

get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
while ( have_posts() ) { 
the_post();
$postID = get_the_ID();
$page_title = get_field('page_title', 'option');
$background_image = get_field('blog_hero_background_image', 'option');
$cats = get_categories(array('hide_empty'=>0));
$facebook = get_field('facebook', 'option');
$linkedin = get_field('linkedin', 'option');
$twitter = get_field('twitter', 'option');
$author = get_the_author_meta('display_name');
$authorID = get_the_author_meta('ID');
$postDate = get_the_date('n.j.y');
$postLink = get_the_permalink();
?>
<section class="flex-hero flex row banner-inner fs-auto noitalic underlap" style="background-image:url(<?php echo $background_image['url']; ?>)">
    <div class="outer-wrapper container container-lg flex col jfsb">
        <div class="">
            <div class="inner-wrapper flex col afc">
                <div class="opening_content">
                    <h1>EVENTS</h1>
                    <div class="social_connect flex row afc jfsa">
                        <span>Connect</span>
                        <?php if(!empty($facebook)){echo '<a href="'.$facebook.'" target="_blank"><i class="fab fa-facebook-square"></i></a>';} ?>
						<?php if(!empty($linkedin)){echo '<a href="'.$linkedin.'" target="_blank"><i class="fab fa-linkedin"></i></a>';} ?>
						<?php if(!empty($twitter)){echo '<a href="'.$twitter.'" target="_blank"><i class="fab fa-twitter-square"></i></a>';} ?>
                    </div>
                    <h2 class="underlined"><?php echo get_the_title(); ?></h2>
                </div>
            </div> <!-- .inner-wrapper -->
        </div> <!-- .container -->


    </div> <!-- .outer-wrapper -->

</section> <!-- .flex-hero -->
<div id="primary" class="content-area">
	<main id="main" class="site-main flex row container container-lg nopad-top" role="main">
        <div class="sidebar item_1_3">
            <?php
            $sidebar_form = get_field('sidebar_form', 'option');
            $form_options = get_field('form_options', 'option');
            $form_bg_image = $form_options['background_image'];
            $form_heading = $form_options['sidebar_form_heading'];
            $form_content = $form_options['sidebar_form_content'];
            ?>
            <form action="" class="search-form search-post-ajax item_2_1">
                <input class="keywords" type="text" placeholder="Search" />
                <button class="post-search" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <?php
            $etypes = get_terms(
                array(
                    'taxonomy' => 'event_type',
                    'hide_empty' => false,
                )
            );
            ?>
            <div class="tax_terms">
                <span>EVENTS</span>
                <?php 
                foreach($etypes as $etype) {
                    echo '<a href="'.get_term_link($etype->term_id).'" class="tax_term">'.$etype->name.'</a>';
                }
                ?>
            </div>
            <?php
            $stypes = get_terms(
                array(
                    'taxonomy' => 'software',
                    'hide_empty' => false,
                )
            );
            ?>
            <div class="tax_terms">
                <span>FILTER BY SOFTWARE</span>
                <?php 
                foreach($stypes as $stype) {
                    echo '<a href="/events/?software='.$stype->slug.'" class="tax_term">'.$stype->name.'</a>';
                }
                ?>
            </div>
            <?php
            $itypes = get_terms(
                array(
                    'taxonomy' => 'industries',
                    'hide_empty' => false,
                )
            );
            ?>
            <div class="tax_terms">
                <span>FILTER BY INDUSTRY</span>
                <?php 
                foreach($itypes as $itype) {
                    echo '<a href="/events/?industries='.$itype->slug.'" class="tax_term">'.$itype->name.'</a>';
                }
                ?>
            </div>
            <div class="blog_form" style="background-image:url(<?php echo $form_bg_image['url']; ?>)">
                <?php if(!empty($form_heading)){echo '<h4>'.$form_heading.'</h4>';} ?>
                <?php if(!empty($form_content)){echo '<div class="form_content">'.$form_content.'</div>';} ?>
                <?php if(!empty($sidebar_form)):
                    gravity_form($sidebar_form, false, true, false, '', true, 1);
                endif; ?>
            </div>
        </div>
        <div class="item_2_3 articles">
            <?php 
            $registration_link = get_post_meta($postID, 'registration_link', true);

            $event_date = get_post_meta($postID, 'event_date', true);
            $event_end_date = get_post_meta($postID, 'event_end_date', true);

            $today = date('Ymd');

            // check for end date
            $registration_end = $event_end_date ? $event_end_date : $event_date;

            if($today > $registration_end && has_term('webinars', 'event_type')) {
                $register = 'WATCH NOW';
            }elseif($today <= $registration_end){
                $register = 'REGISTER';
            }else {
                $register = '';
            }

            // maybe tack on the date end range
            $event_date_str = date('F jS, Y', strtotime($event_date));
            if($event_end_date){
                $event_date_str .= ' - ' . date('F jS, Y', strtotime($event_end_date));
            }
            $time = get_post_meta($postID, 'event_time_start_time', true);
            $time_zone = get_post_meta($postID, 'event_time_time_zone', true);
            if(empty($time_zone)){
                $time_zone = 'EST';
            }
            $time = date('g:i a', strtotime($time));
            $featured_image = get_the_post_thumbnail($postID, 'full');
            $teaching_points = get_post_meta($postID, 'teaching_points_point', true);
            $teaching_points_heading = get_post_meta($postID, 'teaching_points_heading', true);
            ?>
            <div class="flex row event_details afc">
                <div class="item_3_5 flex jfe">
                    <?php echo $featured_image; ?>
                </div>
                <div class="item_2_5">
                    <h4>EVENT DETAILS</h4>
                    <ul>
                        <li>Date: <?php echo $event_date_str; ?></li>
                        <li>Time: <?php echo $time.' '.$time_zone; ?></li>
                        <?php if($location = get_post_meta($post->ID, 'event_location', true)) : ?>
                            <li>Location: <?php echo $location; ?></li>
                        <?php endif; ?>
                    </ul>
                    <?php if(!empty($registration_link) && $register) {
                        echo '<a href="'.$registration_link.'" target="_blank" class="button blue">'.$register.'</a>';
                    } ?>
                </div>
            </div>
            <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
            <div class="teaching_points flex row afs jfs">
                <div class="item_3_4">
                    <?php 
                    if(!empty($teaching_points_heading)){echo '<h3>'.$teaching_points_heading.'</h3>';} 
                    echo '<ul>';
                    for($i = 0; $i<$teaching_points; $i++) {
                        $pointkey = 'teaching_points_point_'.$i.'_point_description';
                        $point = get_post_meta($postID, $pointkey, true);
                        echo '<li>'.$point.'</li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
            </div>
            <?php
            $dlc = get_field('dlc_form', 'option');
            $dlc_heading = $dlc['heading'];
            $dlc_content = $dlc['content'];
            $dlc_download_type = $dlc['download_type'];
            $dlc_bg = $dlc['background_image'];
            $dlc_form = $dlc['form'];
            ?>
            <section class="dlc_posts">
                <div class="dlc_form flex row afs jfc" style="background-image:url(<?php echo $dlc_bg['url']; ?>);">
                    <div class="form_content item_1_2">
                        <?php echo '<h3>'.$dlc_heading.'</h3>'; ?>
                        <?php echo '<div class="content">'.$dlc_content.'</div>'; ?>
                    </div>
                    <div class="form_form item_1_2">
                        <?php gravity_form($dlc_form, false, true, false, '', true, 1); ?>
                    </div>
                </div>
            </section>
            <div class="shareit flex row afc jfs">
                <span>Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postLink; ?>"><i class="fab fa-facebook-square"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $postLink; ?>&title=&summary=&source="><i class="fab fa-linkedin"></i></a>
                <a href="https://twitter.com/home?status=<?php echo $postLink; ?>"><i class="fab fa-twitter-square"></i></a>
            </div>
            <?php recent_posts($post_ID = true, $background_image = '', $number_of_posts = 3, $button_label = '', $button_link = '', $postType = 'event'); ?>
            <style>
            .form_content:before{
                content:'<?php echo $dlc_download_type; ?>';
            }
            </style>
            <?php
            if(function_exists('social_warfare')):
                social_warfare();
            endif;
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<script>
	function state_change(){
        var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
        $('.moreposts').prepend(loading);
    }
	jQuery(document).ready(function($){
		$.ajaxSetup({ cache: false });
        function postSearch() {
            var datasearch = {
                    action : 'post_search',
                    page : $(this).data('page'),
                    keywords : $('.keywords').val(),
                    post_type : '<?php echo get_post_type(); ?>',
                    postsnum : 12
                };
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", datasearch, function(response){
                $('.articles').html(response);
            });
        }

        $(document).on('click', 'a.moreposts', function(e){
			e.preventDefault();
			readMore();
		});
        $(document).on('click', '.post-search', function(e){
            e.preventDefault();
            postSearch();
        });
	});
</script>
<?php
}
get_footer();
?>