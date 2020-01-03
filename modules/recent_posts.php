<?php
if(!function_exists('recent_posts')) {
    function recent_posts($post_ID = false, $background_image = false, $number_of_posts = false, $button_label = false, $button_link = false, $postType = 'post') {
    
        if($post_ID) {
            $post_ID = $post_ID;
        } else {
            $post_ID = get_the_ID();
        }
        if($background_image) {
            $background_image = $background_image;
        } else {
            $background_image = get_post_meta($post_ID, 'recent_posts_background_image', true);
        }
        if($number_of_posts) {
            $number_of_posts = $number_of_posts;
        } else {
            $number_of_posts = get_post_meta($post_ID, 'number_of_posts', true);        
        }
        if(!$number_of_posts) {
            $number_of_posts = 3;
        }
        if($button_label) {
            $button_label = $button_label;        
        } else {
            $button_label = $button_label = get_post_meta($post_ID, 'button_label', true);
        }
        if($button_link) {
            $button_link = $button_link;
        } else {
            $button_link = get_post_meta($post_ID, 'button_link', true);        
        }
        $anchor_tag = get_post_meta($post_ID, 'anchor_tag', true);
        $postID = get_the_ID();
        $heading = get_post_meta($postID, 'related_posts_heading', true);
        $postType = $postType;
        if(!empty($button_label) && !empty($button_link)){$number_of_columns = $number_of_posts+1;}else{$number_of_columns = $number_of_posts;}
        ?>
        <section class="recent_posts" style="background-image:url(<?php if(!empty($background_image)){echo $background_image['url'];} ?>)" id="<?php echo $anchor_tag; ?>">
            <div class="container container-lg flex col">
                <?php if(is_single($postID)){
                    if(!empty($heading)){echo '<h4 class="posts_heading">'.$heading.'</h4>';}else{echo '<h4 class="posts_heading">Other posts you might like:</h4>';}
                } ?>
                <div class="flex row afc jfc">
                <?php
                $args = array(
                    'post_status' => 'publish',
                    'post_type' => $postType,
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => $number_of_posts,
                );
                $recents = new WP_Query($args);
                if($recents->have_posts()):
                    while($recents->have_posts()):
                        $recents->the_post();
                        $postID = get_the_ID();
                        $permalink = get_the_permalink($postID);
                        $title = get_the_title();
                        $thumb = get_the_post_thumbnail_url($postID, 'medium');
                        if($postType == 'post') {
                            $cats = get_the_category();
                            $cat_list = $cats[0]->name;
                            // foreach($cats as $cat) {
                            //     $cat_list .= $cat->name.' ';
                            // }
                        }else {
                            $cats = get_the_terms($postID, 'event_type');
                            $cat_list = $cats[0]->name;
                        }
                        $excerpt = get_excerpt($postID, 100);
                        ?>
                        <aside class="post item_1_<?php echo $number_of_columns; ?>">
                            <a href="<?php echo $permalink; ?>">
                                <div class="background flex col" style="background-image:url(<?php echo $thumb; ?>)">
                                    <div class="cats"><?php echo $cat_list; ?></div>
                                    <div class="excerpt eqheight flex afc jfc">
                                        <?php echo $title; ?>
                                    </div>
                                </div>
                            </a>
                        </aside>
                        <?php
                    endwhile;
                    if(!empty($button_label) && !empty($button_link)):
                    ?>
                    <a href="<?php echo $button_link; ?>" class="seemore"><?php echo $button_label; ?> <i class="fal fa-arrow-right"></i></a>
                    <?php
                    endif;
                endif;
                ?>
                </div>
            </div>
        </section><!-- .recent_posts -->
        <script>
            jQuery(document).ready(function($){
                function equalHeight() {
                    $('section.recent_posts').each(function(){  
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
            });
        </script>
            <?php
    }
}