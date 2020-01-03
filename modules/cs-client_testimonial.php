<?php
if(!function_exists('client_testimonial')) {
    function client_testimonial() {
        $postID = get_the_ID();
        $testimonial = get_post_meta($postID, 'testimonial', true);
        $testimonial_author = get_post_meta($postID, 'testimonial_author', true);
        $author_title = get_post_meta($postID, 'author_title', true);
        $author_subtitle = get_post_meta($postID, 'author_subtitle', true);
        $testimonial_image = get_post_meta($postID, 'testimonial_image', true);
        if(!empty($testimonial_image)) {
            $testimonial_image = wp_get_attachment_url($testimonial_image);
        }
        
        if(!empty($testimonial)):
        ?>
        <section class="client_testimonial" <?php if(!empty($testimonial_image)){echo 'style="background-image:url('.$testimonial_image.'")';} ?>>
            <div class="container container-lg flex row afe jfe">
                <div class="testimonial item_1_2">
                    <div class="quote">
                        <?php echo $testimonial; ?>
                    </div>
                    <div class="author-meta flex col">
                        <?php if(!empty($testimonial_author)){
                            echo '<div class="line-1">'.$testimonial_author;
                            if(!empty($author_title)) {
                                echo ', '.$author_title;
                            }
                            echo '</div>';
                        } 
                        if(!empty($author_subtitle)) {
                            echo '<div class="line-2">'.$author_subtitle.'</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section><!-- /.client_testimonial -->
        <?php
        endif;
    }
}