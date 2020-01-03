<?php
if(!function_exists('simple_hero')) {
    function simple_hero() {
        $postID = get_queried_object()->term_id;
        $term_meta = get_term_meta($postID);
        $customize_hero = get_term_meta($postID, 'customize_hero', true);
        if($customize_hero !== '0') {
            $hero_description = get_term_meta($postID, 'hero_description', true);
            $hero_background_image = get_term_meta($postID, 'hero_background_image', true);
            $hero_background_image = wp_get_attachment_image_url($hero_background_image, 'full');
        }else {
            $hero_description = get_field('hero_description', 'option');
            $hero_background_image = get_field('hero_background_image', 'option');
            $hero_background_image = $hero_background_image['url'];
        }
        $use_page_navigation = get_term_meta($postID, 'use_page_navigation', true);
        $use_page_navigation = ($use_page_navigation !=='0');
        $nav_links = get_term_meta($postID, 'nav_links', true);
        $heading = get_queried_object()->name;
        ?>
        <section class="flex-hero flex row banner-inner fs-80 noitalic dark" style="background-image:url(<?php echo $hero_background_image; ?>)">
            <div class="outer-wrapper container container-lg flex col jfsb">
                <div class="container container-lg">
                    <div class="inner-wrapper flex col afc">
                        <div class="opening_content">
                            <?php 
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
            </div> <!-- .outer-wrapper -->
            <?php 
            if($use_page_navigation){
                echo '<div class="page_nav container flex row afe jfc container-lg"><div class="link-wrap flex row afc jfsb" style="border-bottom:none;"><span>JUMP TO: </span>';
                for($i = 0; $i < $nav_links; $i++) {
                    $link_key = 'nav_links_'.$i.'_link';
                    $link_text_key = 'nav_links_'.$i.'_link_text';
                    $link = get_term_meta($postID, $link_key, true);
                    $link_text = get_term_meta($postID, $link_text_key, true);
                    echo '<a href="#'.$link.'">'.$link_text.'</a>';
                }
                echo '</div></div>';
            } ?>
        </section> <!-- .flex-hero -->
        <?php
    }
}