<?php
if(!function_exists('resource_header')) {
    function resource_header($postID, $resourceID) {
        $hero_background_image = get_post_meta($postID, 'hero_background_image', true);
        $hero_background_image = wp_get_attachment_url($hero_background_image);
        $hero_description = get_post_meta($postID, 'hero_description', true);
        $icon = get_post_meta($postID, 'resource_icon', true);
        $icon = wp_get_attachment_url($icon);
        $icon = '<img class="resource_icon" src="'.$icon.'"/>';
        $heading = get_the_title($postID);
        $theme = get_post_meta($postID, 'theme', true);
        ?>
        <section class="flex-hero flex row banner-inner fs-auto noitalic <?php echo $theme; ?>" style="background-image:url(<?php echo $hero_background_image; ?>)">
            <div class="outer-wrapper container container-lg flex col jfsb">
                <div class="container container-lg">
                    <div class="inner-wrapper flex col afc">
                        <div class="opening_content flex col afc jfc">
                            <?php 
                            if($icon) {
                                echo $icon;
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
            </div> <!-- .outer-wrapper -->
        </section> <!-- .flex-hero -->
        <?php
    }
}