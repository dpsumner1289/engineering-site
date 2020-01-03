<?php
global $flex_content;

$column = $flex_content['column'];
$vertical_alignment = $flex_content['vertical_alignment'];
$container_width = $flex_content['container_width'];
$dark_theme = $flex_content['dark_theme'];
$anchor_tag = $flex_content['anchor_tag'];
$extend_background = $flex_content['extend_background_to_next_module'];
$background_image = $flex_content['background_image'];
?>
<section class="mixed_content flex col <?php echo $dark_theme ? 'dark_theme' : ''; ?> <?php echo $extend_background ? 'extend_background' : ''; ?>" style="background-image:url(<?php echo $background_image['url']; ?>);background-size:cover;">
    <div class="flex row container jfc <?php  ?> <?php if(!empty($vertical_alignment)){echo $vertical_alignment; }else {echo $extend_background ? 'afs' : 'afc';} ?> <?php echo $container_width; ?>" id="<?php echo $anchor_tag; ?>">
        <?php
        $colcount = 0;
        $colclasses = array();
        $do_width_calculations = true;
        $column_widths = array();
        $other_width = '';
        foreach($column as $col) {
            array_push($column_widths, $col['column_width']);
        }
        foreach($column_widths as $width) {
            if($width !== '0') {
                $other_width = 100-$width;
            }
        }
        foreach($column as $col) {
            $heading = $col['heading'];
            if($column_widths[$colcount] !== '0') {
                $do_width_calculations = false;
                $column_width = 'style="flex-basis:'.$column_widths[$colcount].'%; width:'.$column_widths[$colcount].'%;"';
            }else {
                $column_width = 'style="flex-basis:'.$other_width.'%; width:'.$other_width.'%;"';
            }
            if($col['type'] == 'wysiwyg') {
                $content = $col['wysiwyg_section'];
                $heading_theme = $col['theme'];
                $wysiwyg = $content['wysiwyg'];
                $wysiwyg = apply_filters('the_content', $wysiwyg);
                $button = $content['button'];
                $label = $button['label'];
                $link = $button['link'];
                $theme = $button['theme'];
                ?>
                <div class="content_col content_col-<?php echo $colcount; ?> wysiwyg flex col afs <?php echo $heading_theme; ?>" <?php echo $column_width; ?>>
                    <?php if(!empty($heading)){echo '<div class="heading">'.$heading.'</div>';} ?>
                    <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                    <?php if(!empty($link) && !empty($label)){echo '<a class="button '.$theme.'" href="'.$link.'">'.$label.'</a>';} ?>
                </div>
                <?php
                array_push($colclasses, 'content_col-'.$colcount);
            }elseif($col['type'] == 'image') {
                $content = $col['image'];
                $shadow = $col['image_shadow'];
                if($shadow){
                    $shadow = 'shadow';
                }else {
                    $shadow = '';
                }
                ?>
                <div class="content_col content_col-<?php echo $colcount; ?> image flex afc" <?php echo $column_width; ?>>
                    <?php if(!empty($content)){echo '<div class="img '.$shadow.'"><img src="'.$content['url'].'" /></div>';} ?>
                </div>
                <?php
                array_push($colclasses, 'content_col-'.$colcount);
            }elseif($col['type'] == 'grid') {
                $grid = $col['grid'];
                $content_type = $grid['content_type'];
                $number_of_columns = $grid['number_of_columns'];
                $total_grid_items = $grid['total_grid_items'];

                if($content_type == 'client') {
                    $args = array(
                        'post_type' => $content_type,
                        'post_status' => 'publish',
                        'orderby' => 'rand',
                        'posts_per_page'=>$total_grid_items,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'client_type',
                                'terms' => 'service',
                                'field' => 'slug',
                            )
                        ),
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
                                $icon = wp_get_attachment_image_src(get_post_thumbnail_id($postID), 'full');
                                echo '<div class="item item_1_'.$number_of_columns.'"><img src="'.$icon[0].'" /></div>';
                            endwhile;
                            ?>
                            </div>
                        </div>
                        <?php
                    endif;
                    array_push($colclasses, 'content_col-'.$colcount);
                }
            }elseif($col['type'] == 'quote') {
                $quote = $col['quote'];
                $quote_content = $quote['quote'];
                $author = $quote['author'];
                $author_title = $quote['author_title'];
                $button_link = $quote['button_link'];
                $button_label = $quote['button_label'];
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
    <script>
    jQuery(document).ready(function($) {
        var extendHeight = $('section.extend_background').next().outerHeight();
        $('section.extend_background').css('padding-bottom', extendHeight);
        $('section.extend_background').next().css({
            'margin-top': '-'+extendHeight+'px',
            'padding-top': '0'
        });
        $('section.extend_background').next().children('.container-lg').css({
            'padding-top': '0'
        });
    });
    </script>
</section><!-- /.mixed_content -->