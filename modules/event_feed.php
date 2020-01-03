<?php
if(!function_exists('event_feed')) {
    function event_feed($tax, $termID) {
        $term_title = get_queried_object()->name;
        $term_slug = get_queried_object()->slug;
        $args = array(
            'post_type' => 'event',
            'status' => 'publish',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'terms' => $termID,
                )
            ),
        );
        $events = new WP_Query($args);
        if( $events->have_posts() ) :
            ?>
            <section id="events_feed" class="events_feed">
                <div class="container container-lg flex col afc jfc">
                    <div class="flex full row jfsb afc capabilities_headline">
                        <h3><?php echo $term_title; ?> Event Announcements</h3>
                        <a href="/events/?<?php echo $tax.'='.$term_slug; ?>" class="seemore">SEE MORE <i class="fal fa-arrow-right"></i></a>
                    </div>
                    <div class="flex row afe jfs all_feed full">
                    <?php
                    while( $events->have_posts() ) :
                        $events->the_post();
                        ?>
                        <aside class="item_1_2 flex row afs jfs event">
                        <?php
                        $eventID = get_the_ID();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $event_date = get_post_meta($eventID, 'event_date', true);
                        $event_date = date('n/j', strtotime($event_date));
                        $event_image_url = get_the_post_thumbnail_url($eventID);

                        echo '<div class="item_1_5 nobreak flex"><div class="event_date" style="background:url('.$event_image_url.') center no-repeat;background-size:cover;">'.$event_image.'</div></div>';
                        echo '<div class="item_4_5 nobreak flex col">';
                        echo '<h4>'.$title.'</h4>';
                        echo '<div class="meta flex row jfe">';
                        echo '<a href="'.$link.'">See Event</a></div></div>';
                        ?>
                        </aside>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </section><!-- /.events -->
            <?php
        endif;
    }
}