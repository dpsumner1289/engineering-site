<?php
// Template Name: Support Page
$postID = get_the_ID();

get_header();
$heading = get_the_title($postID);
$hero_background_image = get_post_meta($postID, 'hero_background_image', true);
$hero_description = get_post_meta($postID, 'hero_description', true);
$hero_description = apply_filters('the_content', $hero_description);
$hero_background_image = wp_get_attachment_url($hero_background_image, 'full');
$use_page_navigation = get_post_meta($postID, 'use_page_navigation', true);
$nav_links = get_post_meta($postID, 'nav_links', true);
$hero_icon = get_post_meta($postID, 'hero_icon', true);
$hero_icon = wp_get_attachment_url($hero_icon, 'full');
$use_page_navigation = ($use_page_navigation !=='0');
?>
 <section class="flex-hero flex row banner-inner fs-80 noitalic" style="background-image:url(<?php echo $hero_background_image; ?>)">
    <div class="outer-wrapper container container-lg flex col jfsb">
        <div class="container container-lg">
            <div class="inner-wrapper flex col afc">
                <div class="opening_content">
                    <?php 
                    if(!empty($hero_icon)) {
                        echo '<img src="'.$hero_icon.'" class="icon"/>';
                    }
                    if($heading) {
                        echo '<h1 class="underline-1">'.$heading.'</h1>';
                    }
                    if($hero_description) {
                        echo '<div class="narrow">'.$hero_description.'</div>';	
                    }	
                    ?>
                </div>
            </div> <!-- .inner-wrapper -->
        </div>
        <?php 
        if($use_page_navigation){
            echo '<div class="page_nav flex row afs jfs"><span>JUMP TO: </span>';
            for($i = 0; $i < $nav_links; $i++) {
                $link_key = 'nav_links_'.$i.'_link';
                $link_text_key = 'nav_links_'.$i.'_link_text';
                $link = get_post_meta($postID, $link_key, true);
                $link_text = get_post_meta($postID, $link_text_key, true);
                echo '<a href="#'.$link.'">'.$link_text.'</a>';
            }
            echo '</div>';
            ?>
             <script>
                jQuery(document).ready(function($) {
                    jQuery(function() {
                    jQuery('a[href*=#]:not([href=#])').on('click', function () {
                        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = jQuery(this.hash);
                        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
                        if (target.length) {  
                            $('html, body').animate({
                                scrollTop: target.offset().top
                                }, 1000);
                                clickCount++;
                        }
                        }
                    });
                    });
                });
                </script>
            <?php
        } ?>
    </div> <!-- .outer-wrapper -->
</section> <!-- .flex-hero -->
<?php

content_sidebar($postID);
$use_custom_cta_settings = get_post_meta($postID, 'use_custom_cta_settings', true);
if($use_custom_cta_settings == '1') {
    $cta_background_image = get_post_meta($postID, 'custom_cta_background_image', true);
    $cta_background_image = wp_get_attachment_url($cta_background_image);
    $heading = get_post_meta($postID, 'custom_cta_heading', true);
    $content = get_post_meta($postID, 'custom_cta_copy', true);
    $cta_button_label = $cta_button['label']; 
    $cta_button_link = get_post_meta($postID, 'button_link', true);
    $cta_theme = get_post_meta($postID, 'button_theme', true);
    $cta_text_theme = 'dark_theme'; 
    $left_bg_image = get_post_meta($postID, 'left_positioned_background_image', true);
} else {
    $postID=false;
    $cta_background_image = get_post_meta('cta_background_image', 'option'); 
    $cta_background_image = get_field('cta_background_image', 'option'); 
    $heading = get_field('cta_heading', 'option'); 
    $content = get_field('cta_content', 'option'); 
    $cta_button = get_field('cta_button', 'option'); 
    $cta_button_label = $cta_button['label']; 
    $cta_button_link = $cta_button['link']; 
    $cta_theme = $cta_button['theme']; 
    $cta_text_theme = 'dark_theme'; 
    $left_bg_image = get_field('left_positioned_background_image', 'option'); 
}
additional_content($postID);
simple_cta($postID, $cta_background_image, $cta_heading, $cta_content, $cta_button_label, $cta_button_link, $cta_theme, $cta_text_theme, $left_bg_image);

get_footer();