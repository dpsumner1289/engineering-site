<?php
global $flex_content;
$leading_content = $flex_content['leading_content'];
$content_type = $flex_content['content_type'];
$square = $flex_content['square'];
$see_more_button = $flex_content['see_more_button'];
$label = $see_more_button['label'];
$link = $see_more_button['link'];
$basic_title = $leading_content['basic_title'];
$overlap = '';
$default_post_image = get_stylesheet_directory_uri().'/assets/images/default-post.jpg';
$anchor_tag = $flex_content['anchor_tag'];
$background_image = $flex_content['background_image'];
?>
<section class="grid <?php echo $content_type; ?>-grid" id="<?php echo $anchor_tag; ?>" <?php if(!empty($background_image)){echo 'style="background-image:url('.$background_image['url'].');"';} ?>>
<?php
if(!empty($basic_title)){echo '<h2 class="basic_title">'.$basic_title.'</h2>';}
if(!empty($leading_content['heading']) || !empty($leading_content['content'])) {
    $overlap = 'overlap';
    ?>
    <div class="leading_content">
        <div class="container container-md flex row">
            <div class="item_1_2"><?php echo '<h2>'.$leading_content['heading'].'</h2>'; ?></div>
            <div class="item_1_2"><?php echo $leading_content['content']; ?></div>
        </div><!-- /.container -->
    </div><!-- /.leading_content -->
    <?php
}
if($content_type === 'tiled_cta') {
    ?>
    <div class="flex row afc jfse">
    <?php
    $i = 0;
    foreach($square as $sq) {
        $i++;
        $cta = $sq['cta'];
        $filter_color = $sq['filter_color'];
        $bgimage = $cta['background_image'];
        $bgimage = $bgimage['url'];
        $sqtitle = $cta['title'];
        $sqlink = $cta['link'];
        $sqicon = $cta['icon'];
        $popup_content = $cta['popup_content'];
        ?>
        <div class="tile flex col afc jfc filter_<?php echo $filter_color; ?>" <?php echo !empty($bgimage) ? 'style="background-image:url('.$bgimage.')";' : ''; ?>>
            <?php echo !empty($sqicon['url']) ? '<img src="'.$sqicon['url'].'" />' : null; ?>
            <?php echo !empty($sqtitle) ? '<h3>'.$sqtitle.'</h3>' : null; ?>
            <div class="popup_info flex jfc afc col">
                <?php echo !empty($sqlink) ? '<a href="'.$sqlink.'" class="whole_tile flex afe jfc">' : null; ?>
                <?php echo !empty($popup_content) ? '<p>'.$popup_content.'</p>' : null; ?>
                <?php echo !empty($sqlink) ? '</a>' : null; ?>
                <?php echo !empty($sqlink) ? '<a href="'.$sqlink.'" class="tile_link">Learn More <i class="fal fa-arrow-right"></i></a>' : null; ?>
            </div><!-- .popup_window -->
        </div><!-- .tile -->
        <?php
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('.tile').addClass('item_1_<?php echo $i; ?>');
    }); 
    </script>
    </div>
    <?php
}elseif($content_type === 'basic_cta') {
    $alignment = $flex_content['alignment'];
    ?>
    <div class="flex row afs jfse <?php echo $alignment; ?> container container-lg">
    <?php
    $ctas = $flex_content['cta'];
    foreach($ctas as $cta) {
        ?>
        <div class="item_1_3 cta flex col jfc afc">
            <?php if(!empty($cta['iconimage']['url'])){echo '<div class="resource_icon"><img src="'.$cta['iconimage']['url'].'" /></div>';} ?>
            <?php if(!empty($cta['heading'])){echo '<h3>'.$cta['heading'].'</h3>';} ?>
            <?php if(!empty($cta['content'])){echo '<div class="cta_content">'.$cta['content'].'</div>';} ?>
            <?php if(!empty($cta['button_url']) && !empty($cta['button_label'])){echo '<a class="seemore" href="'.$cta['button_url'].'">'.$cta['button_label'].' <i class="fal fa-arrow-right"></i></a>';} ?>
        </div>
        <?php
    }
    ?>
    </div>
    <?php

}elseif($content_type === 'team_members') {
    $select_category = $flex_content['select_category'];

    foreach($select_category as $cat) {
        $member_term = get_term($cat, 'member_category');
        $args = array(
            'post_type' => 'team_members',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'member_category',
                    'terms' => $cat,
                )
            ),
        );
        $member_category = new WP_Query($args);

        if($member_category->have_posts()):
            ?>
            <div class="member_category flex col afc jfc">
                <h2><?php echo $member_term->name; ?></h2>
                <div class="members container container-lg flex row jfs">
                <?php
                while($member_category->have_posts()):
                    $member_category->the_post();
                    $postID = get_the_ID();
                    $thumb = get_the_post_thumbnail_url($postID, 'full');
                    $title = get_the_title();
                    $subtitle = get_post_meta($postID, 'sub_title', true);
                    $member_page = get_the_permalink();
                    ?>
                    <aside class="member flex afc jfc item_1_4">
                        <img src="<?php echo $thumb; ?>">
                        <div class="member_meta flex col jfc afc">
                            <a href="<?php echo $member_page; ?>" class="member-info flex col afc jfe">
                                <h4><?php echo $title; ?></h4>
                                <span><?php echo $subtitle; ?></span>
                            </a>
                            <a href="<?php echo $member_page; ?>" class="bounce flex afc jfc">Read Bio <i class="fal fa-arrow-right"></i></a>
                        </div>
                    </aside>
                    <?php
                endwhile;
                ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
}
if(!empty($label) && !empty($link)) {
    echo '<a href="'.$link.'" class="button surround">'.$label.'</a>';
}
?>
</section><!-- /.grid -->
<script>
jQuery(document).ready(function ($) {
    function eqheight(){
        $('div.inner-wrapper').each(function(){  
        var highestBox = 0;
        $('.eqheight', this).each(function(){
            if($(this).height() > highestBox) {
            highestBox = $(this).height(); 
            }
        });  
        $('.eqheight',this).height(highestBox);
        }); 
    }
    eqheight();
    $(window).resize(function(){
        eqheight();
    });
});
</script>