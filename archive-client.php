<?php
get_header();
$heading = 'CASE STUDIES';
$hero_background_image = get_field('cs_hero_background_image', 'option');
$hero_description = get_field('cs_hero_description', 'option');
$hero_icon = get_field('cs_hero_icon', 'option');
?>
 <section class="flex-hero flex row banner-inner fs-auto noitalic" style="background-image:url(<?php echo $hero_background_image['url']; ?>)">
    <div class="outer-wrapper container container-lg flex col jfsb">
        <div class="">
            <div class="inner-wrapper flex col afc">
                <div class="opening_content">
                    <?php 
                    if(!empty($hero_icon)) {
                        echo '<img src="'.$hero_icon['url'].'" class="icon"/>';
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
    </div> <!-- .outer-wrapper -->
</section> <!-- .flex-hero -->
<section class="case_studies">
    <div class="container container-md flex col afc jfc">
        <?php
        if ( have_posts() ) { 
            while ( have_posts() ) { 
                the_post();
                $csID = get_the_ID();
                $title = get_the_title();
                $link = get_the_permalink();
                $focus_image = get_post_meta($csID, 'focus_image', true);
                if(!empty($focus_image)) {
                    $focus_image = wp_get_attachment_url($focus_image);
                }else {
                    $focus_image = get_the_post_thumbnail_url($csID, 'full');
                }
                $focus_heading = get_post_meta($csID, 'focus_heading', true);
                $industry_list = get_the_terms($csID, 'industries');
                if($industry_list) {
                    $h = 0;
                    $ind_count = count($industry_list);
                    $industry_output = '<div class="meta-group item_1_2 flex row jfs afs"><div class="item_1_4"><span>INDUSTRY</span></div><div class="item_3_4">';
                    foreach($industry_list as $industry) {
                        $industry_title = $industry->name;
                        $industry_link = $industry->slug;
                        if($h < $ind_count-1){
                            $ind_comma = ', ';
                        }else {
                            $ind_comma = '';
                        }
                        $industry_output .= '<a href="/industries/'.$industry_link.'">'.$industry_title.'</a>'.$ind_comma;
                        $h++;
                    }
                    $industry_output .= '</div></div>';
                }
                $service_list = get_post_meta($csID, 'services', true);
                if($service_list) {
                    $service_output = '<div class="meta-group item_1_2 flex row jfs afs"><div class="item_1_4"><span>SERVICES</span></div><div class="item_3_4">';
                    $i = 0;
                    $service_count = count($service_list);
                    foreach($service_list as $service) {
                        $service_title = get_the_title($service);
                        $service_link = get_the_permalink($service);
                        if($i < $service_count-1){
                            $service_comma = ', ';
                        }else {
                            $service_comma = '';
                        }
                        $service_output .= '<a href="'.$service_link.'">'.$service_title.'</a>'.$service_comma;
                        $i++;
                    }
                    $service_output .= '</div></div>';
                }
                // if($focus_image):
                ?>
                <div class="flex row afc jfc full client">
                    <div class="image item_2_5 flex row">
                        <?php echo '<img src="'.$focus_image.'" />'; ?>
                    </div>
                    <div class="client_info item_3_5 flex col afs jfc">
                        <?php
                        echo '<h4>'.$title.'</h4>';
                        echo '<div class="focus_heading">'.$focus_heading.'</div>';
                        echo '<div class="flex row afs jfs" style="width:100%;">';
                        if($industry_output){ echo $industry_output;}
                        if($service_output){ echo $service_output;}
                        echo '</div>';
                        echo '<a href="'.$link.'" class="seemore">READ CASE STUDY <i class="fal fa-arrow-right"></i></a>';
                        ?>
                    </div>
                </div>
                <?php
                // endif;
            }
        }
        ?>
    </div>
</section>
<section class="trusted_by">
    <div class="flex col afc jfc container container-md">
        <?php
        $tbs_heading = get_field('tbs_heading', 'option');
        if(!empty($tbs_heading)) {
            echo '<h4 class="tbs_heading">'.$tbs_heading.'</h4>';
        }else {
            echo '<h4 class="tbs_heading">TRUSTED BY INDUSTRY LEADERS</h4>';
        }
        ?>
        <div class="leaders flex row afc jfc">
            <?php
            // $clients = get_field('tbs_client', 'option');
            // foreach($clients as $client) {
            //     echo '<div class="item_1_6"><a href="'.$client['client_url'].'"><img src="'.$client['tbs_client_logo']['url'].'"/></a></div>';
            // }
            $args = array(
                'post_type' => 'client',
                'post_status' => 'publish',
                'orderby' => 'rand',
                'posts_per_page'=>'9',
            );
            $items = new WP_Query($args);
            if($items->have_posts()):
                while($items->have_posts()):
                    $items->the_post();
                    $post_ID = get_the_ID();
                    $icon = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), 'full');
                    echo '<div class="item item_1_6"><img src="'.$icon[0].'" /></div>';
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>
<?php
$postID=false; 
$cta_background_image = get_field('cs_cta_background_image', 'option'); 
$heading = get_field('cs_cta_heading', 'option'); 
$content = get_field('cs_cta_content', 'option'); 
$cta_button = get_field('cs_cta_button', 'option'); 
$cta_button_label = $cta_button['label']; 
$cta_button_link = $cta_button['link']; 
$cta_theme = $cta_button['theme']; 
$cta_text_theme = get_field('cs_cta_theme', 'option');
$left_bg_image = false; 
simple_cta($postID, $cta_background_image, $heading, $content, $cta_button_label, $cta_button_link, $cta_theme, $cta_text_theme, $left_bg_image);

get_footer();