<?php
if(!function_exists('case_study_feed')) {
    function case_study_feed($tax, $termID) {
        $term_title = get_queried_object()->name;
        $term_slug = get_queried_object()->slug;
        $args = array(
            'post_type' => 'client',
            'status' => 'publish',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'terms' => $termID,
                )
            ),
        );
        $case_studies = new WP_Query($args);
        if( $case_studies->have_posts() ) :
            ?>
            <section id="case_studies" class="case_studies">
                <div class="container container-lg flex col afc jfc">
                    <div class="flex full row jfsb afc capabilities_headline">
                        <h3><?php echo $term_title; ?> Case Studies</h3>
                        <a href="/case-study-listing/?<?php echo $tax.'='.$term_slug; ?>" class="seemore">SEE MORE <i class="fal fa-arrow-right"></i></a>
                    </div>
                    <div class="flex row afe jfc full">
                    <?php
                    while( $case_studies->have_posts() ) :
                        $case_studies->the_post();
                        ?>
                        <aside class="item_1_3 flex col afs jfs case_study">
                        <?php
                        $csID = get_the_ID();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $focus_image = get_post_meta($csID, 'focus_image', true);
                        $focus_image = wp_get_attachment_url($focus_image);

                        echo '<img src="'.$focus_image.'" />';
                        echo '<h4>'.$title.'</h4>';
                        echo '<a href="'.$link.'" class="seemore">READ CASE STUDY <i class="fal fa-arrow-right"></i></a>';
                        ?>
                        </aside>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </section><!-- /.case_studies -->
            <?php
        endif;
    }
}