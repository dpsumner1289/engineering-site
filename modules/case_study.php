<?php
if(!function_exists('case_study')) {
    function case_study($postID = false) {
        if($postID) {
            $postID = $postID;
        }else {
            $postID = get_the_ID();
        }
        $post_type = get_post_type($postID);
        $post_title = get_the_title($postID);
        $client = get_post_meta($postID, 'featured_client', true);
        $client_heading = get_post_meta($postID, 'featured_client_heading', true);
        $args = array(
            'post_type'=>'client',
            'p'=>$client,
        );
        $client_object = new WP_Query($args);
        if($client != null && $client_object->have_posts()):
            while($client_object->have_posts()):
                $client_object->the_post();
                $clientID = get_the_ID();
                $client_name = get_the_title();
                $testimonial = get_post_meta($clientID, 'testimonial', true);
                $author = get_post_meta($clientID, 'testimonial_author', true);
                $author_title = get_post_meta($clientID, 'author_title', true);
                $author_subtitle = get_post_meta($clientID, 'author_subtitle', true);
                $focus_image = get_post_meta($clientID, 'focus_image', true);
                $focus_image = wp_get_attachment_url($focus_image);
                $link = get_the_permalink();
                ?>
                <section class="mixed_content featured_client flex col">
                    <div class="container container-lg flex row afc jfc">
                        <div class="content_col item_1_2 image flex afc">
                            <?php if(!empty($focus_image)){echo '<div class="img"><img src="'.$focus_image.'" /></div>';} ?>
                        </div>
                        <div class="content_col item_1_2 wysiwyg flex col afs">
                            <?php if(!empty($client_heading)){echo '<h2 class="blue regweight">'.$client_heading.'</h2>';} ?>
                            <?php if(!empty($testimonial)){echo '<div class="wizzy">"<i>'.$testimonial.'</i>"</div>';} ?>
                            <?php
                            echo '<div class="author-meta">';
                            echo '<div class="line-1"><b>'.$author.', '.$author_title.'</b></div>';
                            echo '<div class="line-2">'.$author_subtitle.'</div>';
                            echo '</div>'; 
                            ?>
                            <?php if($post_type == 'industry'){ echo '<div class="flex row full afe jfsb">';} ?>
                            <?php echo '<a class="button blue" href="'.$link.'">SEE CASE STUDY</a>'; ?>
                            <?php echo '<a class="seemore" style="font-size:15px;" href="/case-studies">More '.$post_title.' Case Studies <i class="fal fa-arrow-right"></i></a>'; ?>
                            <?php if($post_type == 'industry'){ echo '</div>';} ?>
                        </div>
                    </div>
                </section>
                <?php
            endwhile;
        endif;
    }
}