<?php
if(!function_exists('cs_results')) {
    function cs_results() {
        $postID = get_the_ID();
        $results_heading = get_post_meta($postID, 'results_heading', true);
        $results_subheading = get_post_meta($postID, 'results_subheading', true);
        $results_summary = get_post_meta($postID, 'results_summary', true);
        $moving_forward = get_post_meta($postID, 'moving_forward', true);
        $results_media = get_post_meta($postID, 'results_media', true);
        $results_graph = get_post_meta($postID, 'results_graph', true);
        $results_video = get_field('results_video');
        
        if(!empty($results_summary) || !empty($results_graph) || !empty($moving_forward)):
        ?>
        <section class="results_section">
            <div class="container container-lg flex row afc jfc">
                <div class="item_1_2 flex col afs">
                    <?php if(!empty($results_heading)){echo '<h3 class="results-heading">'.$results_heading.'</h3>';} ?>
                    <?php if(!empty($results_summary)){echo '<div class="results-summary">'.$results_summary.'</div>';} ?>
                    <?php if(!empty($moving_forward)){echo '<div class="moving-forward">'.$moving_forward.'</div>';} ?>
                </div>
                <div class="item_1_2 results_summary">
                    <?php
                    if($results_media == 'video'){
                        if(!empty($results_video)) {
                            echo $results_video;
                        }
                    }else {
                        if(!empty($results_graph)){ 
                            $results_graph = wp_get_attachment_url($results_graph);
                            if(!empty($results_subheading)) {
                                echo '<h4>'.$results_subheading.'</h4>';
                            }
                            echo '<img src="'.$results_graph.'"/>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section><!-- /.results_section -->
        <?php
        endif;
    }
}
?>