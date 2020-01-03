<?php
if(!function_exists('mixed_content')) {
    function mixed_content($postID=false, $column=false, $container_width=false) {
        if($postID) {
            $postID = $postID;
            $column = $column;
            $container_width = $container_width;
        }else {
            $postID = get_the_ID();
            $column = get_post_meta($postID, 'column', true);
            $container_width = get_post_meta($postID, 'container_width', true);
        }
        ?>
        <section class="mixed_content flex col">
            <div class="flex row container jfc afc <?php echo $container_width; ?>">
            <?php
            $colcount = 0;
            $colclasses = array();
            $do_width_calculations = true;
            $column_widths = array();
            $other_width = '';
            for($i = 0; $i < $column; $i++) {
                $colkey = 'column_'.$i.'_column_width';
                $col_width = get_post_meta($postID, $colkey, true);
                array_push($column_widths, $col_width);
            }
            foreach($column_widths as $width) {
                if($width !== '0') {
                    $other_width = 100-$width;
                }
            }
            for($i = 0; $i < $column; $i++) {
                $colkey = 'column_'.$i.'_heading';
                $typekey = 'column_'.$i.'_type';
                $heading = get_post_meta($postID, $colkey, true);
                $type = get_post_meta($postID, $typekey, true);
                if($column_widths[$colcount] !== '0') {
                    $do_width_calculations = false;
                    $column_width = 'style="flex-basis:'.$column_widths[$colcount].'%; width:'.$column_widths[$colcount].'%;"';
                }else {
                    $column_width = 'style="flex-basis:'.$other_width.'%; width:'.$other_width.'%;"';
                }
                if($type == 'wysiwyg') {
                    $heading_theme = get_post_meta($postID, 'column_'.$i.'_theme', true);
                    $wysiwyg = get_post_meta($postID, 'column_'.$i.'_wysiwyg_section_wysiwyg', true);
                    $wysiwyg = apply_filters('the_content', $wysiwyg);
                    $label = get_post_meta($postID, 'column_'.$i.'_wysiwyg_section_button_label', true);
                    $link = get_post_meta($postID, 'column_'.$i.'_wysiwyg_section_button_link', true);
                    $theme = get_post_meta($postID, 'column_'.$i.'_wysiwyg_section_button_theme', true);
                    ?>
                    <div class="content_col content_col-<?php echo $colcount; ?> wysiwyg flex col afs <?php echo $heading_theme; ?>" <?php echo $column_width; ?>>
                        <?php if(!empty($heading)){echo '<div class="heading">'.$heading.'</div>';} ?>
                        <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                        <?php if(!empty($link) && !empty($label)){echo '<a class="button '.$theme.'" href="'.$link.'">'.$label.'</a>';} ?>
                    </div>
                    <?php
                    array_push($colclasses, 'content_col-'.$colcount);
                }elseif($type == 'image') {
                    $image = get_post_meta($postID, 'column_'.$i.'_image', true);
                    $image = wp_get_attachment_url($image);
                    $shadow = get_post_meta($postID, 'column_'.$i.'_image_shadow', true);
                    if($shadow){
                        $shadow = 'shadow';
                    }else {
                        $shadow = '';
                    }
                    ?>
                    <div class="content_col content_col-<?php echo $colcount; ?> image flex afc" <?php echo $column_width; ?>>
                        <?php if(!empty($image)){echo '<div class="img '.$shadow.'"><img src="'.$image.'" /></div>';} ?>
                    </div>
                    <?php
                    array_push($colclasses, 'content_col-'.$colcount);
                }elseif($type == 'grid') {
                    $content_type = get_post_meta($postID, 'column_'.$i.'_grid_content_type', true);
                    $number_of_columns = get_post_meta($postID, 'column_'.$i.'_grid_number_of_columns', true);
                    $total_grid_items = get_post_meta($postID, 'column_'.$i.'_grid_total_grid_items', true);

                    if($content_type == 'client') {
                        $args = array(
                            'post_type' => $content_type,
                            'post_status' => 'publish',
                            'posts_per_page'=>$total_grid_items,
                        );
                        $items = new WP_Query($args);
                        if($items->have_posts()):
                            ?>
                            <div class="content_col content_col-<?php echo $colcount; ?> grid flex col <?php echo $content_type; ?>" <?php echo $column_width; ?>>
                                <?php if(!empty($heading)){echo '<h3 class="col_heading">'.$heading.'</h3>';} ?>
                                <div class="flex row afc">
                                <?php
                                while($items->have_posts()):
                                    $items->the_post();
                                    $postID = get_the_ID();
                                    $icon = get_the_post_thumbnail($postID, 'full');
                                    echo '<div class="item item_1_'.$number_of_columns.'">'.$icon.'</div>';
                                endwhile;
                                ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        array_push($colclasses, 'content_col-'.$colcount);
                    }
                }elseif($type == 'quote') {
                    $quote_content = get_post_meta($postID, 'column_'.$i.'_quote_quote', true);
                    $author = get_post_meta($postID, 'column_'.$i.'_quote_author', true);
                    $author_title = get_post_meta($postID, 'column_'.$i.'_quote_author_title', true);
                    $button_link = get_post_meta($postID, 'column_'.$i.'_quote_button_link', true);
                    $button_label = get_post_meta($postID, 'column_'.$i.'_quote_button_label', true);
                    ?>
                    <div class="content_col content_col-<?php echo $colcount; ?> quote flex col" <?php echo $column_width; ?>>
                        <div class="quote_content"><?php echo $quote_content; ?></div>
                        <div class="quote_meta">
                            <div class="author"><?php echo $author; ?></div>
                            <div class="author_title"><?php echo $author_title; ?></div>
                        </div>
                        <?php
                        if(!empty($button_label) && !empty($button_link)):
                        ?>
                        <a href="<?php echo $button_link; ?>" class="seemore"><?php echo $button_label; ?> <i class="fal fa-arrow-right"></i></a>
                        <?php
                        endif;
                        ?>
                    </div>
                    <?php
                    array_push($colclasses, 'content_col-'.$colcount);
                }
                $colcount++;
            }
            ?>
            </div>
            <?php 
            if($do_width_calculations) {
                column_widths($do_width_calculations, $colclasses, $colcount);
            }
            ?>
        </section><!-- /.mixed_content -->
        <?php
    }
}