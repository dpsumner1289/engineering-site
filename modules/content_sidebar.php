<?php
if(!function_exists('content_sidebar')) {
    function content_sidebar($postID) {
        $wysiwyg = get_post_meta($postID, 'primary_content', true);
        $wysiwyg = apply_filters('the_content', $wysiwyg);
        $anchor = get_post_meta($postID, 'primary_anchor_tag', true);
        $related_articles = get_post_meta($postID, 'related_articles_primary_article_category', true);
        ?>
        <div class="primary_content flex row container container-lg afs jfs nopad-top">
            <div class="item_2_3">
                <section class="mixed_content flex col" id="<?php echo $anchor; ?>">
                    <div class="content_col wysiwyg flex col afs standard_headings">
                        <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                    </div>
                </section><!-- /.mixed_content -->
            </div>
            <div class="item_1_3 sidebar">
            <section class="recent_posts" style="background-image:url(<?php if(!empty($background_image)){echo $background_image['url'];} ?>)">
                <div class="container container-lg flex col afs jfs">
                    <?php
                    if(!empty($related_articles)) {
                        $cat_name = get_term($related_articles, 'software')->name;
                        $cat_link = get_term($related_articles, 'software')->slug;
                        echo '<h4>You might find these <a href="/blog/?software='.$cat_link.'">'.$cat_name.'</a> posts helpful:</h4>';
                    }else {
                        echo '<h4>You might find these <a href="/blog">blog posts</a> posts helpful:</h4>';
                    }
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => 2,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'software',
                                'terms' => $related_articles,
                            )
                        ),
                    );
                    $recents = new WP_Query($args);
                    if($recents->have_posts()):
                        while($recents->have_posts()):
                            $recents->the_post();
                            $post_ID = get_the_ID();
                            $permalink = get_the_permalink($post_ID);
                            $title = get_the_title();
                            $thumb = get_the_post_thumbnail_url($post_ID, 'medium');
                            $cats = get_the_category();
                                $cat_list = '';
                                foreach($cats as $cat) {
                                    $cat_list .= $cat->name.' ';
                                }
                            $excerpt = get_excerpt($post_ID, 100);
                            ?>
                                <aside class="post item_full">
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
                    endif;
                    ?>
                </div>
            </section><!-- .recent_posts -->
            </div>
        </div>
        <?php
        $s_wysiwyg = get_post_meta($postID, 'secondary_content', true);
        $s_anchor = get_post_meta($postID, 'secondary_anchor_tag', true);
        $s_wysiwyg = apply_filters('the_content', $s_wysiwyg);
        $s_related_articles = get_post_meta($postID, 'related_articles_article_category', true);
        ?>
        <div class="secondary_content flex row container container-lg afs jfs" id="<?php echo $s_anchor; ?>">
            <div class="item_2_3">
                <section class="mixed_content flex col">
                    <div class="content_col wysiwyg flex col afs standard_headings">
                        <?php if(!empty($s_wysiwyg)){echo '<div class="wizzy">'.$s_wysiwyg.'</div>';} ?>
                    </div>
                </section><!-- /.mixed_content -->
            </div>
            <div class="item_1_3 sidebar">
                <section class="recent_posts" style="background-image:url(<?php if(!empty($background_image)){echo $background_image['url'];} ?>)">
                    <div class="container container-lg flex col afs jfs">
                        <?php
                        if(!empty($s_related_articles)) {
                            $cat_name = get_cat_name($s_related_articles);
                            $cat_link = get_category_link($s_related_articles);
                            echo '<h4>You might find these <a href="'.$cat_link.'">'.$cat_name.'</a> posts helpful:</h4>';
                        }else {
                            echo '<h4>You might find these <a href="/blog">blog posts</a> posts helpful:</h4>';
                        }
                        $args = array(
                            'post_status' => 'publish',
                            'post_type' => 'post',
                            'ignore_sticky_posts' => true,
                            'posts_per_page' => 2,
                            'cat' => $s_related_articles,
                        );
                        $recents = new WP_Query($args);
                        if($recents->have_posts()):
                            while($recents->have_posts()):
                                $recents->the_post();
                                $post_ID = get_the_ID();
                                $permalink = get_the_permalink($post_ID);
                                $title = get_the_title();
                                $thumb = get_the_post_thumbnail_url($post_ID, 'medium');
                                $cats = get_the_category();
                                    $cat_list = '';
                                    foreach($cats as $cat) {
                                        $cat_list .= $cat->name.' ';
                                    }
                                $excerpt = get_excerpt($post_ID, 100);
                                ?>
                                    <aside class="post item_full">
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
                        endif;
                        ?>
                    </div>
                </section><!-- .recent_posts -->
            </div>
        </div>
        <?php
         $t_wysiwyg = get_post_meta($postID, 'tertiary_content', true);
         $t_anchor = get_post_meta($postID, 'tertiary_anchor_tag', true);
         $t_wysiwyg = apply_filters('the_content', $t_wysiwyg);
         ?>
         <div class="tertiary_content flex row container container-lg afc jfs" id="<?php echo $t_anchor; ?>">
             <div class="item_2_3">
                 <section class="mixed_content flex col">
                     <div class="content_col wysiwyg flex col afs standard_headings">
                         <?php if(!empty($t_wysiwyg)){echo '<div class="wizzy">'.$t_wysiwyg.'</div>';} ?>
                     </div>
                 </section><!-- /.mixed_content -->
             </div>
             <div class="item_1_3 sidebar">
             </div>
         </div>
         <?php
    }
}