<?php
if(!function_exists('article_feed')) {
    function article_feed($tax, $termID) {
        $term_title = get_queried_object()->name;
        $term_slug = get_queried_object()->slug;
        $args = array(
            'post_type' => 'post',
            'status' => 'publish',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'terms' => $termID,
                )
            ),
        );
        $articles = new WP_Query($args);
        if( $articles->have_posts() ) :
            ?>
            <section id="articles" class="articles">
                <div class="container container-lg flex col afc jfc">
                    <div class="flex full row jfsb afc capabilities_headline">
                        <h3><?php echo $term_title; ?> Articles</h3>
                        <a href="/blog/?<?php echo $tax.'='.$term_slug; ?>" class="seemore">SEE MORE <i class="fal fa-arrow-right"></i></a>
                    </div>
                    <div class="flex row afe jfc all_feed full">
                    <?php
                    while( $articles->have_posts() ) :
                        $articles->the_post();
                        ?>
                        <aside class="item_1_2 flex row afc jfc article">
                        <?php
                        $aID = get_the_ID();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $date = get_the_date('j.n.y', $aID);
                        $focus_image = get_the_post_thumbnail_url($aID, 'bc-square-post');
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
                        </aside>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </section><!-- /.articles -->
            <?php
        endif;
    }
}