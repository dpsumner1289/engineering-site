<?php
global $flex_content;

$categories = $flex_content['categories'];
echo '<section class="faqs flex row jfs afs container container-lg nopad-top">';
$j = 1;
foreach($categories as $category) {
    $args = array(
        'post_type'   => 'faq',
        'post_status' => 'publish',
        'posts_per_page'=> -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'faq_categories',
                'terms' => $category,
            )
        ),
    );

    // check to see if our custom query isset
    global $wp_query;
    $the_query = $wp_query->query;

    if(isset($the_query['software'])){
        $args['tax_query']['RELATION'] = 'AND';
        $args['tax_query'][] = array(
            'taxonomy' => 'software',
            'field' => 'slug',
            'terms' => $the_query['software'], 
        );
    }

    ?>
        <?php
        $faqs = new WP_Query( $args );
        $i = 1;
        if( $faqs->have_posts() ) : ?>

        <?php $cat = get_term_by('id', $category, 'faq_categories'); ?>
        <section class="accordion item_1_2" id="<?php echo $cat->slug;?>">
            <div class="container container-md">
                <h2><?php echo $cat->name; ?></h2>

                <?php while( $faqs->have_posts() ) :
                    $faqs->the_post();
                    $faqID = get_the_ID();
                    $question = get_the_title();
                    $answer = get_the_content();
                    $related_articles = get_post_meta($faqID, 'related_articles', true);
                    ?>
                    <div class="tab">
                        <input id="tab-<?php echo $j.'-'.$i; ?>" type="radio" name="tabs2">
                        <label for="tab-<?php echo $j.'-'.$i; ?>"><?php echo $question; ?></label>
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
                ?>

            </div><!-- /.container -->
        </section><!-- /.accordion -->

        <?php endif;
    $j++;
}
echo '</section>';