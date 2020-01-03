<?php
if(!function_exists('impact_cta')) {
    function impact_cta($version) {
        $postID = get_the_ID();
        $main_heading = get_post_meta($postID, 'main_heading', true);
        $label = get_post_meta($postID, 'cta_button_label', true);
        $link = get_post_meta($postID, 'cta_button_link', true);
        $pub_heading = get_post_meta($postID, 'publication_download_heading', true);
        $pub_link = get_post_meta($postID, 'publication_download_link_url', true);
        $embed = strip_tags(get_post_meta($postID, 'publication_download_embed', true));
        $pub_link_label = get_post_meta($postID, 'publication_download_link_label', true);
        $pub_cover = get_post_meta($postID, 'publication_download_publication_cover', true);
        $pdf_for_screen_readers = get_post_meta($postID, 'pdf_for_screen_readers', true);
        $pub_cover = wp_get_attachment_image($pub_cover, 'full');
        // var_dump($pub_cover);
        $output = '<section class="impact_cta"><div class="container container-md-lg flex row">';
    
        // parts
        if(!empty($main_heading)){$header = '<h2>'.$main_heading.'</h2>';}else {$header = '';}
        if(!empty($label)){$cta_button = '<a href="'.$link.'" class="button" target="_blank">'.$label.'</a>';}else {$cta_button = '';}
        if(!empty($pub_cover)){$pub_image = '<a href="javascript:;" class="nolink" data-fancybox data-type="iframe" data-src="'.$embed.'">'.$pub_cover.'</a>';}else {$pub_image = '';}
        if(!empty($pub_heading)){$pub_heading = '<a href="javascript:;" class="nolink" data-fancybox data-type="iframe" data-src="'.$embed.'">'.'<h3>'.$pub_heading.'</h3>'.'</a>';}else {$pub_heading = '';}
        if(!empty($pub_link_label)){$pub_button = '<a href="javascript:;" class="nolink" data-fancybox data-type="iframe" data-src="'.$embed.'">'.$pub_link_label.'</a>';}else {$pub_button = '';}
        if(!empty($pdf_for_screen_readers)){$pdf_for_screen_readers = '<a href="'.$pdf_for_screen_readers.'" class="screen-reader-text" aria-label="Download PDF" aria-hidden="true">Download PDF</a>';}else {$pdf_for_screen_readers = '';}
        // row/column parts
    
        $row_start = '<div class="flex col">';
        $col_1_start = '<div class="item_4_7 flex col vc">';
        $col_2_start = '<div class="item_3_7 flex row vc">';
        $col_2_1_start = '<div class="item_2_5">';
        $col_2_2_start = '<div class="item_3_5 flex col">';
        $el_end = '</div>';
    
        if($version === 'simple') {
            $output .= $row_start.$header.$cta_button.$el_end;
        }elseif($version === 'complex') {
            $output .= $col_1_start.$header.$cta_button.$el_end;
            $output .= $col_2_start.$col_2_1_start;
            $output .= $pub_image.$el_end;
            $output .= $col_2_2_start.$pub_heading.$pub_button.$pdf_for_screen_readers.$el_end;
        }
        $output .= '</div><!-- /.container-md --></section><!-- /.impact_cta -->';
        if(!empty($main_heading)) {
            return $output;
        }
    }
}