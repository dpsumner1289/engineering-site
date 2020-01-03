<?php
if(!function_exists('grid_points')) {
    function grid_points($postID) {
        $grid_heading = get_post_meta($postID, 'grid_points_heading', true);
        $grid_points = get_post_meta($postID, 'grid_point', true);
        $bg_image = get_post_meta($postID, 'grid_points_background', true);
        $bg_image = wp_get_attachment_image_url($bg_image, 'full');
        $client = get_post_meta($postID, 'featured_client', true);
        $neg_marg = true;
        if($client == null) {
            $neg_marg = false;
        }
        ?>
        <section class="grid_points <?php echo $neg_marg ? 'neg_marg' : ''; ?>" style="background-image:url(<?php echo $bg_image; ?>);">
            <div class="container container-lg flex col afc jfc">
                <h2><?php echo $grid_heading; ?></h2>
                <div class="all-points flex row afs jfsb">
                    <?php
                    for($i = 0; $i < $grid_points; $i++) {
                        $hkey = 'grid_point_'.$i.'_heading';
                        $ckey = 'grid_point_'.$i.'_content';
                        $pheading = get_post_meta($postID, $hkey, true);
                        $pcontent = get_post_meta($postID, $ckey, true);
                        ?>
                        <div class="item_1_3 point">
                            <h4><?php echo $pheading; ?></h4>
                            <div class="point-content"><?php echo $pcontent; ?></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section><!-- /.grid_points -->
        <?php
    }
}