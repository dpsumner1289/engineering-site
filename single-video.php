<?php
/**
 * The template for displaying all single videos
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package caelynx
 */

get_header();
$ID = get_the_ID();
$page_title = get_the_title();
$emphasis = get_post_meta($ID, 'emphasized_content', true);
$quote = get_post_meta($ID, 'block_quote_quote', true);
$quote_author = get_post_meta($ID, 'block_quote_name', true);
$quote_author_title = get_post_meta($ID, 'block_quote_title', true);
$date = get_the_date('n.j.Y');
$version = get_post_meta($ID, 'victor_for_mi_version', true);
$show_cta = get_post_meta($ID, 'victor_for_mi_show_cta', true);
$show_similar_posts = get_post_meta($ID, 'similar_posts_show_similar_posts', true);
$cats = wp_get_post_categories($ID);
if(!empty($cats)) {
    foreach($cats as $cat) {
        $c = get_category( $cat );
        $cs[] = array( 'name' => $c->name, 'slug' => $c->slug );
    }
}
?>
    <div class="blog-header" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
        <div class="container container-md-lg">
            <div class="flex row vc">
            </div><!-- /.flex-row -->
        </div><!-- /.container -->
    </div><!-- /.blog-header -->
	<div id="primary" class="content-area">
		<main role="main">
            <section class="outset-bottom">
                <div class="container container-md">
                    <div class="container block overlap-top flex col heading-block">
                        <?php
                        echo '<h3 class="categories">';
                        if(isset($cs)) {
                            $cs_count = count($cs);
                            foreach($cs as $cname) {
                                echo '<a href="/category/'.$cname['slug'].'" class="nounderline">'.$cname['name'].'</a>';
                                if(--$cs_count > 0) {
                                    echo ', ';
                                }
                            }
                        }
                        echo '</h3>';
                        echo '<h1>'.$page_title.'</h1>';
                        ?>
                        <div class="flex row vc hc sharethis">
                            SHARE THIS
                            <?php
                            echo do_shortcode('[Sassy_Social_Share]');
                            ?>
                        </div>
                    </div><!-- /.container.block -->
                    <div class="container block flex col lower_padding-bottom">
                        <?php
                        while ( have_posts() ) : the_post();
                            echo '<small><i>Published '.$date.'</i></small>';
                            echo '<div class="">';
                            the_content();
                            echo '</div>';
                        endwhile; // End of the loop.
                        if(!empty($quote)) {
                            echo '<blockquote><p>'.$quote.'</p><aside><h4 class="author">'.$quote_author.'</h4><small class="author-title"><i>'.$quote_author_title.'</i></small></aside></blockquote>';
                        }
                        echo '<div class="emphasis">'.$emphasis.'</div>'; 
                        if($show_cta) {
                            echo impact_cta($version);
                        }
                        ?>
                    </div><!-- /.container.block -->
                </div><!-- /.container-md -->
            </section>
            <?php if($show_similar_posts) {
                show_similar_posts();
                ?>
                <script>
                jQuery(document).ready(function ($) {
                    $('div.inner-wrapper').each(function(){  
                    var highestBox = 0;
                    $('.eqheight', this).each(function(){
                        if($(this).height() > highestBox) {
                        highestBox = $(this).height(); 
                        }
                    });  
                    $('.eqheight',this).height(highestBox);
                    }); 
                });
                </script>
            <?php } ?>
		</main>
	</div><!-- /#primary -->

<?php
get_footer();
