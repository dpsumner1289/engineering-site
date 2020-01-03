<?php
if(!function_exists('secondary_product_content')) {
    function secondary_product_content($postID) {
        $scontent = get_post_meta($postID, 'secondary_content', true);
        $scontent = apply_filters('the_content', $scontent);
        $sc_image = get_post_meta($postID, 'secondary_content_image', true);
        $sc_image = wp_get_attachment_url($sc_image, 'full');
        $sc_button_heading = get_post_meta($postID, 'secondary_content_button_heading', true);
        $sc_button_label = get_post_meta($postID, 'secondary_content_button_label', true);
        $sc_button_link = get_post_meta($postID, 'secondary_content_button_link', true);
        $sc_button_theme = get_post_meta($postID, 'secondary_content_button_theme', true);
        if(empty($sc_button_theme)) {
            $sc_button_theme = 'blue';
        }
        ?>
        <section class="secondary_content">
            <div class="container container-lg flex row afe jfc">
                <div class="item_2_3 flex col afs jfs">
                    <?php echo $scontent; ?>
                    <?php echo '<h3 class="green">'.$sc_button_heading.'</h3>'; ?>
                    <?php if(!empty($sc_button_label) && !empty($sc_button_link)){echo '<a href="'.$sc_button_link.'" class="button '.$sc_button_theme.'">'.$sc_button_label.'</a>';} ?>
                </div>
                <div class="item_1_3 flex">
                    <img src="<?php echo $sc_image; ?>" class="asfe">
                </div>
            </div>
        </section><!-- /.secondary_content -->
        <?php
    }
}