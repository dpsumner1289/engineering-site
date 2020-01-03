<?php
// Template Name: Resources
$postID = get_the_ID();
$downloads_to_display = get_post_meta($postID, 'downloads_to_display', true);
$resourceID = get_post_meta($postID, 'resource_type', true);
get_header();
resource_header($postID, $resourceID);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'resource',
    'post_status' => 'publish',
    'posts_per_page' => $downloads_to_display,
    'tax_query' => array(
        array(
            'taxonomy' => 'resource_type',
            'terms' => $resourceID,
            'include_children' => true,
        )
    ),
    'paged' => $paged,
);

// check to see if our custom query isset
global $wp_query;
$the_query = $wp_query->query;

if(isset($the_query['software'])){
    $args['posts_per_page'] = -1;
    $args['tax_query']['RELATION'] = 'AND';
    $args['tax_query'][] = array(
        'taxonomy' => 'software',
        'field' => 'slug',
        'terms' => $the_query['software'], 
    );
}

$resources = new WP_Query($args);
if($resources->have_posts()): 
    $terms_query = array(
        'taxonomy' => 'resource_type',
        'include' => $resourceID,
    );
    $terms_list = get_terms($terms_query);
    $total_posts = $resources->found_posts;
    $total_pages = ceil($total_posts/$downloads_to_display);
    ?>
    <section class="downloads">
        <div class="container container-lg flex row">
            <?php
            if($paged > 1) {
                echo '<div class="flex full jfc afc">';
                echo '<h2 class="browsing">BROWSING ';
                foreach($terms_list as $term){echo '<a href="/resource_type/'.$term->slug.'">'.strtoupper($term->name).'</a>';}
                echo ' PAGE '.$paged.' OF '.$total_pages;
                echo '</h2>';
                echo '</div>';
            }
            ?>
            <div class="sidebar item_1_4">
                <?php
                $sidebar_form = get_field('sidebar_form', 'option');
                $form_options = get_field('form_options', 'option');
                $form_bg_image = $form_options['background_image'];
                $form_heading = $form_options['sidebar_form_heading'];
                $form_content = $form_options['sidebar_form_content'];
                ?>
                <!-- <form action="" class="search-form search-post-ajax item_2_1">
                    <input class="keywords" type="text" placeholder="Search" />
                    <button class="post-search" type="submit"><i class="fas fa-search"></i></button>
                </form> -->
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
                        echo '<a href="#" class="tax_term" data-term="'.$stype->term_id.'" data-tax="software">'.$stype->name.'</a>';
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
                        echo '<a href="#" class="tax_term" data-term="'.$itype->term_id.'" data-tax="industries">'.$itype->name.'</a>';
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
            echo '<div class="flex row item_3_4 acfs rlist">';
            while($resources->have_posts()): 
                $resources->the_post();
                $thisID = get_the_ID();
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
                                echo '<span>'.$file_icon.$term->name.'</span>';
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
            endwhile;
            echo '</div>';
            echo '<div class="pagination flex row afsb jfsb">';
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $resources->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_text'    => sprintf( '<i class="fal fa-arrow-left"></i> %1$s', __( 'PREVIOUS', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i class="fal fa-arrow-right"></i>', __( 'NEXT', 'text-domain' ) ),
            ) );
            echo '</div>';
            wp_reset_postdata();
            ?>
        </div>
    </section><!-- /.downloads-->
    <?php
endif;

client_quote($postID);
?>
<script>
	function state_change(){
        var loading = '<p class="loading"><i class="fas fa-spinner fa-pulse"></i> Loading</p>';
        jQuery('.moreposts').prepend(loading);
    }
	jQuery(document).ready(function($){
		$.ajaxSetup({ cache: false });
        function resource_filter(tax, term) {
            var datasearch = {
                    action : 'resource_filter',
                    page : $(this).data('page'),
                    termID : term,
                    tax : tax,
                    resourceID : '<?php echo $resourceID; ?>',
                    postsnum : 12
                };
            $.post("<?php echo admin_url('admin-ajax.php'); ?>", datasearch, function(response){
                $('.rlist').html(response);
            });
        }
        $(document).on('click', 'a.tax_term', function(e){
            e.preventDefault();
            var term = $(this).data('term');
            var tax = $(this).data('tax');
            resource_filter(tax, term);
            console.log($(this).data('term'));
        });
        $(document).on('click', '.post-search', function(e){
            e.preventDefault();
            postSearch();
        });
	});
</script>
<?php
get_footer();