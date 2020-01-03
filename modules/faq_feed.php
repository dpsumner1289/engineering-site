<?php
if(!function_exists('faq_feed')) {
    function faq_feed($tax, $termID) {
        $term_title = get_queried_object()->name;
        $term_slug = get_queried_object()->slug;
        $args = array(
            'post_type'   => 'faq',
            'post_status' => 'publish',
            'posts_per_page'=> 8,
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'terms' => $termID,
                )
            ),
        );
        ?>
        <section id="faq_feed" class="accordion">
            <div class="container container-lg flex col afc jfc">
                <div class="flex full row jfsb afc capabilities_headline">
                    <h3><?php echo $term_title; ?> FAQs</h3>
                    <a href="/faqs/?<?php echo $tax.'='.$term_slug; ?>" class="seemore">SEE MORE <i class="fal fa-arrow-right"></i></a>
                </div>
                <div class="flex row afs jfc all_feed full">
                    <?php
                    $faqs = new WP_Query( $args );
                    $i = 1;
                    if( $faqs->have_posts() ) :
                        while( $faqs->have_posts() ) :
                            $faqs->the_post();
                            $faqID = get_the_ID();
                            $question = get_the_title();
                            $answer = get_the_content();
                            $related_articles = get_post_meta($faqID, 'related_articles', true);
                            ?>
                            <div class="tab item_1_2-gutter-right">
                                <input id="tab-<?php echo $i; ?>" type="radio" name="tabs2">
                                <label for="tab-<?php echo $i; ?>"><?php echo $question; ?></label>
                                <div class="tab-content">
                                    <div class="content-pad">
                                    <?php the_content(); ?>
                                    </div>
                                    <div class="related">
                                        <?php
                                        if(!empty($related_articles)) {
                                            echo '<h4>You might find these articles helpful:</h4>';
                                            echo '<div class="links">';
                                            foreach($related_articles as $article) {
                                                echo '<a class="caret_link" href="'.get_the_permalink($article).'"><i class="fas fa-caret-right"></i> '.get_the_title($article).'</a>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div><!-- /.container -->
        </section><!-- /.accordion -->
        <?php
    }
}