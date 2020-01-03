<?php
if(!function_exists('resource_feed')) {
    function resource_feed($tax, $termID) {
        $term_title = get_queried_object()->name;
        $term_slug = get_queried_object()->slug;
        $args = array(
            'post_type' => 'resource',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'terms' => $termID,
                    'include_children' => true,
                )
            ),
        );
        $resources = new WP_Query($args);
        if($resources->have_posts()): 
            $terms_query = array(
                'taxonomy' => 'resource_type',
                'include' => $termID,
            );
            $terms_list = get_terms($terms_query);
            ?>
            <section id="downloads" class="downloads">
                <div class="container container-lg flex col afc jfc">
                    <div class="flex full row jfsb afc capabilities_headline">
                        <h3><?php echo $term_title; ?> White Papers &amp; Datasheets</h3>
                        <a href="/white-papers-datasheets-brochures/?<?php echo $tax.'='.$term_slug; ?>" class="seemore">SEE MORE <i class="fal fa-arrow-right"></i></a>
                    </div>
                    <div class="flex row all_feed full">
                        <?php
                        while($resources->have_posts()): 
                            $resources->the_post();
                            $thisID = get_the_ID();
                            $title = get_the_title($thisID);
                            $terms = get_the_terms($thisID, 'resource_type');
                            $file = get_post_meta($thisID, 'downloadable_file', true);
                            $file = wp_get_attachment_url($file);
                            ?>
                            <div class="resource item_1_4">
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
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section><!-- /.downloads-->
            <?php
        endif;
    }
}