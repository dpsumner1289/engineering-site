<?php
if(!function_exists('service_header')) {
    function service_header($postType=false) {
        $postID = get_the_ID();
        $hero_background_image = get_post_meta($postID, 'hero_background_image', true);
        $hero_background_image = wp_get_attachment_url($hero_background_image);
        $hero_description = get_post_meta($postID, 'hero_description', true);
        $more_services = get_post_meta($postID, 'more_services', true);
        $icon = get_post_meta($postID, 'service_icon', true);
        $heading = get_the_title($postID);
        if($postType=='product') {
            $industry_icon = get_the_post_thumbnail_url($postID, 'full');
            $product_category = get_the_terms($postID, 'product_category');
            $product_category = strtoupper($product_category[0]->name);
            $heading = false;
            $wholeheight = '';
            $justify = 'jfc';
        }else {
            $industry_icon = get_post_meta($postID, 'industry_icon', true);
            $industry_icon = wp_get_attachment_url($industry_icon);
            $justify = 'jfsb';
            $wholeheight = 'fs-full-screen';
        }
        $industry_icon = '<img src="'.$industry_icon.'"/>';
        $underlap = get_post_meta($postID, 'underlap', true);
        if(!empty($icon)) {
            $icon = wp_get_attachment_url($icon);
            $icon = '<img src="'.$icon.'"/>';
            $heading = get_the_title($postID);
        }else {
            $icon = '';
        }
        $theme = get_post_meta($postID, 'theme', true);
        $use_page_navigation = get_post_meta($postID, 'use_page_navigation', true);
        $use_page_navigation = ($use_page_navigation !=='0');
        $nav_links = get_post_meta($postID, 'nav_links', true);
        ?>
        <section class="flex-hero flex row banner-inner <?php echo $wholeheight; ?> noitalic <?php echo $theme; ?> <?php if($underlap){echo 'underlap';} ?> <?php if(!empty($more_services)){echo 'service_nav';} ?>" style="background-image:url(<?php echo $hero_background_image; ?>)">
            <div class="outer-wrapper container container-lg flex col <?php echo $justify; ?>">
                <div class="container container-lg flex afc jfc">
                    <div class="inner-wrapper flex col afc">
                        <div class="opening_content">
                            <?php 
                            echo $icon;
                            if($industry_icon) {
                                echo '<div>'.$industry_icon.'</div>';
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
                </div> <!-- .container -->
                <?php if(!empty($more_services)) {
                    $howmanymore = count($more_services)+1;
                    ?>
                    <div class="more_services flex row afc jfsb container container-lg min-padding">
                        <div class="item_1_<?php echo $howmanymore; ?>">MORE SERVICES</div>
                        <?php foreach($more_services as $service) {
                            $title = get_the_title($service);
                            $url = get_the_permalink($service);
                            echo '<div class="item_1_'.$howmanymore.'"><a href="'.$url.'">'.$title.'</a></div>';
                        } ?>
                    </div>                            
                    <?php
                } ?>
            </div> <!-- .outer-wrapper -->
            <?php 
            if($use_page_navigation){
                $font_size = '';
                if($nav_links > 5) {
                    $font_size = 'smaller_text';
                }
                echo '<div class="page_nav container flex row afe jfc container-lg"><div class="link-wrap '.$font_size.' flex row afc jfc "><span>MORE '.$product_category.': </span>';
                for($i = 0; $i < $nav_links; $i++) {
                    $link_key = 'nav_links_'.$i.'_link';
                    $link_text_key = 'nav_links_'.$i.'_link_text';
                    $link = get_post_meta($postID, $link_key, true);
                    $link_text = get_post_meta($postID, $link_text_key, true);
                    echo '<a href="'.$link.'">'.$link_text.'</a>';
                }
                echo '</div></div>';
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
        </section> <!-- .flex-hero -->
        <?php
    }
}