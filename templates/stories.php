<?php
/* Template Name: Stories */

get_header();
$page_title = get_field('page_title', 'option');
$background_image = get_field('blog_hero_hero_background_image', 'option');
$cats = get_categories(array('hide_empty'=>0));
?>
<section class="search_hero flex vc hc" style="background-image:url(<?php echo $background_image['url']; ?>);">
    <div class="container container-xsm flex row hc vc">
        <?php if($page_title):
                echo '<h1 class="archive_title">'.$page_title.'</h1>';
            else: 
                echo '<h1 class="archive_title"style="font-size: 50px;font-weight: 400;">STORIES OF IMPACT</h1>';
            endif;
		?>
        <div class="filter_fill"></div>
    </div><!-- /.container -->
</section><!-- /.search_hero -->
<div class="container container-lg flex row nopad category_heading">
    <div class="item_1_5"><a class="filter_show hide button">SHOW FILTERS</a></div>
    <?php
        echo sidebar_filters('story');
    ?>
    <div class="item_4_5"></div>
</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main flex row">
<?php 
$args = array(
    'post_type'			=> array('story', 'video', 'press_release'),
    'posts_per_page'	=> '12',
    'post_status'		=> 'publish',
    'order' 			=>  'DESC',
);
$recents = new WP_Query($args);
if( $recents->have_posts() ) : 
    $post_count = $recents->found_posts;
    $post_count = $post_count - 12;
?>
    <section class="grid story-grid">
        <div class="container container-lg">
            <div class="outer-wrapper post-wrap">
                <div class="inner-wrapper flex row vc">
                <?php
                while( $recents->have_posts() ) :
                    $recents->the_post();
                    $ID = get_the_ID();
                    $ptype = get_post_type($ID);
                    $posttitle = get_the_title();
                    $thumb = get_the_post_thumbnail_url($ID,'bc-custom-thumbnail-size');
                    $url = get_the_permalink();
                    if(has_excerpt()) {
                        $excerpt = get_the_excerpt();
                    }else {
                        $excerpt = get_excerpt();   
                    }
                    $date = get_the_date('n.j.Y');
                    $default_thumb = '<img src="'.get_stylesheet_directory_uri().'/assets/images/default-thumb.jpg" />';
                    ?>
                    <div class="post_1_3 post item item_1_3 flex vc col <?php echo $ptype; ?>">
                        <div class="post_wrap">
                            <a href="<?php echo $url; ?>" class="nolink">
                                <figure class="inner_post flex row vc nolink" style="display:block;text-decoration:none;">
                                    <?php
                                    if(has_post_thumbnail()) {
                                        echo '<img src="'.$thumb.'">';
                                    }else {
                                        echo $default_thumb;
                                    }
                                    ?>
                                </figure>
                            </a>
                            <div class="post_content clearfix">
                                <div class="eqheight">
                                    <h4><a href="<?php echo $url; ?>" class="nolink"><?php echo $posttitle; ?></a></h4>
                                    <div class="excerpt"><?php echo $excerpt; ?></div>
                                </div><!-- /.eqheight -->
                                <div class="flex row meta">
                                    <div><i>Published <?php echo $date; ?></i></div>
                                    <div><a href="<?php echo $url; ?>"><i><?php echo $ptype === 'press_release' ? 'Latest News' : 'Read the Story'; ?></i></a></div>
                                </div>
                            </div><!-- /.post_content -->
                        </div><!-- /.post_wrap -->
                    </div><!-- /.post -->
                    <?php
                endwhile; ?>
                </div><!-- /.inner-wrapper-->
            </div><!-- /.outer-wrapper-->
            <?php if($post_count > 12) {
                echo '<div class="flex row vc hc clickmore"><a class="moreposts slidedown button" name="moreposts">LOAD MORE</a></div>';
            } ?>
        </div><!-- /.container-->
    </section><!-- /.story-grid -->
    <?php
endif;
?>
	</main><!-- #main -->
</div><!-- #primary -->
<script>
	function state_change(){
        var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
        $('.story-grid').append(loading);
    }
	jQuery(document).ready(function($){
        function equalHeight() {
            $('div.inner-wrapper').each(function(){  
                var highestBox = 0;
                $('.eqheight', this).each(function(){
                    if($(this).height() > highestBox) {
                    highestBox = $(this).height(); 
                    }
                });  
                $('.eqheight',this).height(highestBox);
            }); 
        }

        equalHeight();

        function resetFilters(){
            $('input[type=text], input[type=date]').val('');
            $('select').prop('selectedIndex',0);
            $('input[type=\"radio\"]').prop('checked', false);
        }

		$.ajaxSetup({ cache: false });
        var page = 2;
        var postsNum = <?php echo $post_count; ?>;
        function readMore() {
            var data = {
				action : 'readmore_posts',
				page : page,
				post_type : '<?php echo get_post_type(); ?>',
				cache: false,
				headers: {
				"cache-control": "no-cache"
				},
			}
			$.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response){
                state_change();
                $('#main').append(response);
                $('.loading').remove();
                if(postsNum <= 0) {
                    $('.clickmore').remove()
                }else {
                    $('.clickmore').remove().appendTo('#main');
                }
            });
            page++;
            postsNum = postsNum - 12;
        }

        function postSearch(cat, catName) {
            var postType = '';
            var selected = false;
            if($("input.post-type:checked").val()) {
                postType = $("input.post-type:checked").val();
                selected = true;
            } else {
                postType = ['story', 'video'];
            }
            var datasearch = {
                action : 'post_search',
                category : cat,
                page : $(this).data('page'),
                keywords : $('.keywords').val(),
                month : $('.month_select').val(),
                year : $('.year_select').val(),
                city : $('#city').val(),
                post_type : postType,
                postsnum : 12
            };
            var cat_name = '';
            var type = '';
            if(catName !== undefined) {
                cat_name += ' FROM CATEGORY '+catName.toUpperCase();
            }
            if(postType.length && selected) {
                if(postType === 'press_release') {
                    type = 'PRESS RELEASES';
                }else if(postType === 'story') {
                    type = 'STORIES';
                }else if(postType === 'event') {
                    type = 'EVENTS';
                }else if(postType === 'video') {
                    type = 'VIDEOS';
                }
            }else {
                type = 'ALL';
            }
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", datasearch, function(response){
                $('#main').html(response);
                $('.filter_fill').html('<h2>SHOWING ' + type.toUpperCase() + cat_name + '</h2>');
                equalHeight();
                resetFilters();
            });
        }

        $(document).on('click', 'a.moreposts', function(e){
			e.preventDefault();
			readMore();
        });
        $('.search-post-ajax').submit(function(e){
            e.preventDefault();
            postSearch();
        });
        // $(document).on('click', '.post-search', function(e){
        //     e.preventDefault();
        //     postSearch();
        // });
        $(document).on('click', '.cat_filter', function(e){
            var thisCat = $(this).data('value');
            var thisCatName = $(this).data('name');
            e.preventDefault();
            postSearch(thisCat, thisCatName);
            equalHeight();
        });
        $(window).resize(function(){
            equalHeight();
        });
	});
</script>
<?php
get_footer();
?>