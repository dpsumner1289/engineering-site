<?php
if(!function_exists('abstract_points')) {
    function abstract_points() {
        $postID = get_the_ID();
        $abstract_points = get_post_meta($postID, 'abstract_points', true);
        if($abstract_points > 0):
        ?>
        <section class="abstract_points">
            <div class="container container-lg flex row afs jfc">
                <?php for($i = 0; $i < $abstract_points; $i++) {
                    $headingkey = 'abstract_points_'.$i.'_abstract_heading';
                    $pointkey = 'abstract_points_'.$i.'_list_point';
                    $abstractheading = get_post_meta($postID, $headingkey, true);
                    $pointlist = get_post_meta($postID, $pointkey, true);
                    echo '<div class="point item_1_'.$abstract_points.'">';
                    if(!empty($abstractheading)) {
                        echo '<h3>'.$abstractheading.'</h3>';
                    }
                    if(count($pointlist) > 0) {
                        echo '<ul>';
                        for($j = 0; $j < $pointlist; $j++) {
                            $li_key = 'abstract_points_'.$i.'_list_point_'.$j.'_point';
                            $point = get_post_meta($postID, $li_key, true);
                            echo '<li>'.$point.'</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</div>';
                } ?>
            </div>
        </section><!-- /.abstract_points -->
        <?php
        endif;
    }
}
?>