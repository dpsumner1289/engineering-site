<?php
if(!function_exists('additional_content')) {
    function additional_content($postID=false) {
        if(!$postID) {
            $postID = get_the_ID();
        }
        $content_blocks = get_post_meta($postID, 'additional_content_block', true);
        for($i=0; $i < $content_blocks; $i++) {
            $cb_key = 'additional_content_block_'.$i.'_';
            $anchor = get_post_meta($postID, $cb_key.'additional_anchor_tag', true);
            $add_content = get_post_meta($postID, $cb_key.'additional_content', true);
            $add_content = apply_filters('the_content', $add_content);
            ?>
            <div class="tertiary_content flex row container container-lg afc jfs" id="<?php echo $anchor; ?>">
             <div class="item_2_3">
                 <section class="mixed_content flex col">
                     <div class="content_col wysiwyg flex col afs standard_headings">
                         <?php if(!empty($add_content)){echo '<div class="wizzy">'.$add_content.'</div>';} ?>
                     </div>
                 </section><!-- /.mixed_content -->
             </div>
             <div class="item_1_3 sidebar">
             </div>
            </div>
            <?php
        }
    }
}