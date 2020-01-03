<?php
if(!function_exists('display_gallery')) {
    function display_gallery() {
        $ID = get_the_ID();
        $gallery = get_post_meta($ID, 'gallery', true);
        $num_pics = $gallery - 10;
        $gallery_key = 'gallery_';
        $output = '<section class="gallery">';
        $is_caption = false;

        if($gallery) {
            $j = 1;
            $loadnum = 10;
            $output .= '<div class="flex row container container-lg">';
            $i = 0;
            for($i; $i < $loadnum; $i++) {  
                $gi_key = '_gallery_item';
                $link_key = '_item_link';
                $gallery_item = get_post_meta($ID, $gallery_key.$i.$gi_key, true);
                $link_type = get_post_meta($ID, $gallery_key.$i.$link_key.'_link_type', true);
                $new_tab = get_post_meta($ID, $gallery_key.$i.$link_key.'_open_in_new_tab', true);
                $linked_text = get_post_meta($ID, $gallery_key.$i.$link_key.'_link_text', true);
                $linked_link = get_post_meta($ID, $gallery_key.$i.$link_key.'_link', true);
                $linked_link_custom = get_post_meta($ID, $gallery_key.$i.$link_key.'_link_custom', true);
                if(!empty($linked_link)) {
                    if($link_type === 'post_post_type') {
                        $linked_link = get_permalink($linked_link);
                    } else {
                        $linked_link = $linked_link_custom;
                    }
                }else {
                    $linked_link = '';
                }
                if($new_tab === '1') {
                    $new_tab = ' target="_blank"';
                } else {
                    $new_tab = ' target="_self"';
                }
                if($gallery_item === 'image') {
                    $image_sub_key = '_image';
                }else {
                    $image_sub_key = '_video';
                }
                $image_key = $gallery_key.$i.$image_sub_key;
                if($gallery_item === 'image') {
                    $image_obj = get_post_meta($ID, $image_key, true);
                    $image_src = wp_get_attachment_url($image_obj);
                    $cropped_image = wp_get_attachment_image_src($image_obj, 'bc-gallery-size');
                    $cropped_image = $cropped_image[0];
                    $caption = wp_get_attachment_caption($image_obj);  
                    $cropped_image = '<a data-fancybox="gallery" data-caption="'.$caption.'" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class="nolink" href="'.$image_src.'"><img src="'.$cropped_image.'" data-src="'.$image_src.'"/></a>';  
                    $image = '<a data-fancybox="gallery" data-caption="'.$caption.'" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class ="nolink" href="'.$image_src.'"><img src="'.$image_src.'" data-caption="'.$caption.'"/></a>';
                    $figclass = '';        
                }else {
                    $image_url = get_post_meta($ID, $image_key, true);
                    $image = get_post_meta($ID, $image_key, true);
                    parse_str( parse_url( $image, PHP_URL_QUERY ), $array_of_vars );
                    $image_id = $array_of_vars['v'];    
                    $caption = '';
                    $link = ['<a data-fancybox="gallery" data-caption="'.$caption.'" data-story_text="'.$linked_text.'" data-story_link="'.$linked_link.'" class="nolink" href="'.$image_url.'?rel=0"><div class="video">','</div></a>'];
                    $image = '<img src="https://img.youtube.com/vi/'.$image_id.'/0.jpg" />';
                    $image = $link[0].$image.$link[1];
                    $cropped_image = $image;
                    $figclass = 'video';
                }
                if(!empty($caption)) {
                    $caption_markup = '<figcaption class="wp-caption-text">'.$caption.'</figcaption>';
                    $is_caption = true;
                }else {
                    $caption_markup = '';
                }
                if($j === 1) {
                    $output .= '<figure class="item_1_2 single-image flex row wp-caption '.$figclass.'">'.$image.$caption_markup.'</figure>';
                }elseif($j === 2) {
                    $output .= '<div class="item_1_2 flex row"><div class="item_1_3 '.$figclass.'">'.$cropped_image.'</div>';
                }elseif($j === 10) {
                    $output .= '<div class="item_1_3 '.$figclass.'">'.$cropped_image.'</div></div>';
                    if($num_pics > 0) {
                        $output .= '<div class="loadmore"><a name="loadmore" class="loadmore button">LOAD MORE</a></div>';
                    }
                }else {
                    $output .= '<div class="item_1_3 '.$figclass.'">'.$cropped_image.'</div>';
                }
                $j++;
            }
            $output .= '</div><!-- /.flex.row -->';
        }
        
        $output .= '</section><!-- /.gallery -->';
        $output .= "<script>
        jQuery(document).ready(function($){
            var numPics = ".$num_pics.";
            var newTab = '".$new_tab."';
            function state_change(){
                var loading = '<p class=`loading`><i class=`fas fa-spinner fa-pulse`></i> Loading</p>';
                $('.loadmore').prepend(loading);
            }
            $('[data-fancybox=\"gallery\"]').fancybox({
                thumbs : {
                    autoStart : true,
                    axis: 'x'
                },
                caption : function( instance, item ) {
                    var caption = $(this).data('caption') || '';
                    var storyLink = $(this).data('story_link');
                    var storyText = $(this).data('story_text');
                    if ( item.type === 'image' ) {
                        caption = (caption.length ? caption + '<br />' + '<a href=\"' + storyLink + '\" ' + newTab + ' >' + storyText + '</a>' : '');
                    }
                    return caption;
                }
            });
            $(document).on('click', '.loadmore', function(){
                if(numPics > 0 && numPics >= 9) {
                    var data = {
                        i : ".$i.",
                        ID : ".$ID.",
                        action : 'load_images',
                        is_caption : ".$is_caption.",
                        numLoad : 9,
                    }
                    $.post('".admin_url('admin-ajax.php')."', data, function(response){
                        state_change();
                        $('.gallery').append(response);
                        $('.loading').remove();
                        $('.loadmore').remove().appendTo('.gallery');
                        $('[data-fancybox=\"gallery\"]').fancybox({
                            thumbs : {
                                autoStart : true,
                                axis: 'x'
                            },
                            caption : function( instance, item ) {
                                var caption = $(this).data('caption') || '';
                                var storyLink = $(this).data('story_link');
                                var storyText = $(this).data('story_text');
                                if ( item.type === 'image' ) {
                                    caption = (caption.length ? caption + '<br />' + '<a href=\"' + storyLink + '\" '+ newTab +' >' + storyText + '</a>' : '');
                                }
                                return caption;
                            }
                        });
                    });
                    numPics = numPics - 9;
                }else if(numPics > 0 && numPics < 9){
                    var data = {
                        i : ".$i.",
                        ID : ".$ID.",
                        action : 'load_images',
                        is_caption : ".$is_caption.",
                        numLoad : numPics,
                    }
                    $.post('".admin_url('admin-ajax.php')."', data, function(response){
                        state_change();
                        $('.gallery').append(response);
                        $('.loading').remove();
                        $('.loadmore').remove();
                        $('[data-fancybox=\"gallery\"]').fancybox({
                            thumbs : {
                                autoStart : true,
                                axis: 'x'
                            },
                            caption : function( instance, item ) {
                                var caption = $(this).data('caption') || '';
                                var storyLink = $(this).data('story_link');
                                var storyText = $(this).data('story_text');
                                if ( item.type === 'image' ) {
                                    caption = (caption.length ? caption + '<br />' + '<a href=\"' + storyLink + '\" '+ newTab +' >' + storyText + '</a>' : '');
                                }
                                return caption;
                            }
                        });
                    });
                    numPics = numPics - numPics;
                }
                console.log(numPics);
            });
            $(document).on('click', '.gallery img', function(){
                var src = $(this).data('src');
                var caption = $(this).data('caption');
                // $('.single-image img').attr('src', src);
                $('.wp-caption-text').text(caption);
            });
        });
        </script>";

        return $output;
    }
}
?>