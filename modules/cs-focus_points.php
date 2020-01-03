<?php
if(!function_exists('focus_points')) {
    function focus_points() {
        $postID = get_the_ID();
        $focus_heading = get_post_meta($postID, 'focus_heading', true);
        $focus_content = get_post_meta($postID, 'focus_content', true);
        $focus_image = get_post_meta($postID, 'focus_image', true);
        if(!empty($focus_heading) || !empty($focus_content) || !empty($focus_image)):
        ?>
        <section class="focus">
            <div class="container container-lg flex row afc jfc">
                <div class="item_1_2 focus_content">
                    <?php if(!empty($focus_heading)){ echo '<h2>'.$focus_heading.'</h2>';} ?>
                    <?php if(!empty($focus_content)){ echo '<div class="focus_content">'.$focus_content.'</div>';} ?>
                </div>
                <div class="item_1_2 focus_image">
                    <?php 
                    if(!empty($focus_image)){ 
                        $focus_image = wp_get_attachment_url($focus_image);
                        echo '<img src="'.$focus_image.'"/>';
                    }
                    ?>
                </div>
            </div>
        </section><!-- /.focus -->
        <?php
        endif;
    }
}
?>