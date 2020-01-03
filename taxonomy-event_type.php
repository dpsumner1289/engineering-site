<?php
/**
 * The template for displaying events
 */

get_header();
$page_title = get_field('page_title', 'option');
$background_image = get_field('blog_hero_background_image', 'option');
$cats = get_categories(array('hide_empty'=>0));
$facebook = get_field('facebook', 'option');
$linkedin = get_field('linkedin', 'option');
$twitter = get_field('twitter', 'option');
?>
<section class="flex-hero flex row banner-inner fs-full-screen noitalic underlap" style="background-image:url(<?php echo $background_image['url']; ?>)">
    <div class="outer-wrapper container container-lg flex col jfsb">
        <div class="container container-lg">
            <div class="inner-wrapper flex col afc">
                <div class="opening_content">
                    <h1><?php echo strtoupper(get_queried_object()->name); ?></h1>
                    <div class="social_connect flex row afc jfsa">
                        <span>Connect</span>
                        <?php if(!empty($facebook)){echo '<a href="'.$facebook.'" target="_blank"><i class="fab fa-facebook-square"></i></a>';} ?>
						<?php if(!empty($linkedin)){echo '<a href="'.$linkedin.'" target="_blank"><i class="fab fa-linkedin"></i></a>';} ?>
						<?php if(!empty($twitter)){echo '<a href="'.$twitter.'" target="_blank"><i class="fab fa-twitter-square"></i></a>';} ?>
                    </div>
                </div>
            </div> <!-- .inner-wrapper -->
        </div> <!-- .container -->
    </div> <!-- .outer-wrapper -->
</section> <!-- .flex-hero -->
<div id="primary" class="content-area">
	<main id="main" class="site-main flex row container container-lg" role="main">
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
            <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            if ( have_posts() ) { 
                ?>            
                <div class="item_2_3 articles">
                <?php
                while ( have_posts() ) { 
                    the_post();
                    ?>
                    <div class="article full flex row afc jfc">
                        <?php
                        $aID = get_the_ID();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $event_date = get_post_meta($aID, 'event_date', true);
                        $today = date('Ymd');
                        if($today > $event_date) {
                            $register = '<i class="fas fa-play-circle"></i> See Archive Recording';
                            $register_class = 'nobg';
                        }else {
                            $register = 'See Event';
                            $register_class = '';
                        }
                        $event_date = date('l, F j, Y', strtotime($event_date));
                        $focus_image = get_the_post_thumbnail_url($aID, 'bc-square-post');

                        // echo '<div class="item_1_5 flex afc jfc nobreak"><div class="event_date flex afc jfc">'.$event_date.'</div></div>';
                        echo '<div class="item_1_5 nobreak flex"><a href="'.$link.'"><img src="'.$focus_image.'" /></a></div>';
                        echo '<div class="item_4_5 flex col nobreak">';
                        echo '<a href="'.$link.'"><h4>'.$title.'</h4></a>';
                        echo '<div class="meta flex row jfsb"><div class="postedin">';
                        echo $event_date.' ';
                        $cats = get_the_terms($aID, 'event_type');
                        if(count($cats)>0) {
                            echo '| Event Type: ';
                        }
                        $posts_count = 0;
                        foreach($cats as $cat) {
                            $posts_count++;
                            if($posts_count == count($cats)) {
                                $comma = '';
                            }else {
                                $comma = ', ';
                            }
                            echo '<a href="/category/'.$cat->slug.'">'.$cat->name.'</a>'.$comma;
                        }
                        echo '</div><a href="'.$link.'" class="'.$register_class.'">'.$register.'</a></div></div>';
                        ?>
                    </div>
                    <?php
                }
                ?>
                </div>
                <?php
                echo '<div class="pagination flex row afsb jfsb">';
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_text'    => sprintf( '<i class="fal fa-arrow-left"></i> %1$s', __( 'PREVIOUS', 'text-domain' ) ),
                    'next_text'    => sprintf( '%1$s <i class="fal fa-arrow-right"></i>', __( 'NEXT', 'text-domain' ) ),
                ) );
                echo '</div>';
            } else {
                // no posts found
                ?>
                <div class="item_2_3 articles">
                    <h1>SORRY, NO POSTS FOUND</h1>
                </div>
                <?php
            }
            ?>
    </main><!-- #main -->
    <?php
        $postID=false; 
        $cta_background_image = get_field('cta_background_image', 'option'); 
        $heading = get_field('cta_heading', 'option'); 
        $content = get_field('cta_content', 'option'); 
        $cta_button = get_field('cta_button', 'option'); 
        $cta_button_label = $cta_button['label']; 
        $cta_button_link = $cta_button['link']; 
        $cta_theme = $cta_button['theme']; 
        $cta_text_theme = 'dark_theme'; 
        $left_bg_image = get_field('left_positioned_background_image', 'option'); 

        simple_cta($postID, $cta_background_image, $heading, $content, $cta_button_label, $cta_button_link, $cta_theme, $cta_text_theme, $left_bg_image);
        ?>
</div><!-- #primary -->
<script>
	function state_change(){
        var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
        $('.moreposts').prepend(loading);
    }
	jQuery(document).ready(function($){
        $('body').addClass('dark_theme');
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
get_footer();
?>