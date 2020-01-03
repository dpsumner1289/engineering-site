<?php
if(!function_exists('cs_header')) {
    function cs_header() {
        $postID = get_the_ID();
        $industry_list = get_the_terms($postID, 'industries');
        if($industry_list) {
            $h = 0;
            $ind_count = count($industry_list);
            $industry_output = '<div class="meta-group item_1_2 flex row jfs afs"><div class="meta-title"><span>INDUSTRY</span></div><div class="meta-list">';
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
        $service_list = get_post_meta($postID, 'services', true);
        if($service_list) {
            $service_output = '<div class="meta-group item_1_2 flex row jfs afs"><div class="meta-title"><span>SERVICES</span></div><div class="meta-list">';
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
        $capability_list = get_the_terms($postID, 'capabilities');
        if($capability_list) {
            $j = 0;
            $cap_count = count($capability_list);
            $capability_output = '<div class="meta-group item_1_2 capabilitiy-group flex row jfs afs"><div class="capabilities-title"><span>CAPABILITIES</span></div><div class="capabilities">';
            foreach($capability_list as $capability) {
                $capability_title = $capability->name;
                $capability_link = '/capabilities/'.$capability->slug;
                if($j < $cap_count-1){
                    $cap_comma = ', ';
                }else {
                    $cap_comma = '';
                }
                $capability_output .= '<a href="'.$capability_link.'">'.$capability_title.'</a>'.$cap_comma;
                $j++;
            }
            $capability_output .= '</div></div>';
        }
        $software_list = get_the_terms($postID, 'software');
        if($software_list) {
            $s = 0;
            $soft_count = count($software_list);
            $software_output = '<div class="meta-group item_1_2 capabilitiy-group flex row jfs afs"><div class="capabilities-title"><span>SOFTWARE</span></div><div class="capabilities">';
            foreach($software_list as $software) {
                $software_meta = get_term($software->term_id);
                if($software_meta->count !== 0) {
                    $software_title = $software_meta->name;
                    $software_link = '/software/'.$software_meta->slug;
                    if($s < $soft_count-1){
                        $soft_comma = ', ';
                    }else {
                        $soft_comma = '';
                    }
                    $software_output .= '<a href="'.$software_link.'">'.$software_title.'</a>'.$soft_comma;
                    $s++;
                }
            }
            $software_output .= '</div></div>';
        }
        $background_image = get_post_meta($postID, 'hero_background_image', true);
        $background_image = wp_get_attachment_url($background_image);
        
        // header and client meta
        
        ?>
        <div class="blog-header flex afe" style="background-image:url(<?php echo $background_image; ?>);">
            <div class="container container-lg flex afe jfs">
                <div class="flex col afs jfs full">
                    <a href="/case-studies" class="back"><i class="fal fa-arrow-left"></i> Back to Case Studies</a>
                    <div class="client-meta flex col item_800">
                        <h1><?php echo get_the_title(); ?></h1>
                        <div class="meta-stats flex row afs jfs">
                            <?php if($industry_output){ echo $industry_output;} ?>
                            <?php if($service_output){ echo $service_output;} ?>
                            <?php if($capability_output){ echo $capability_output;} ?>
                            <?php if($software_output){ echo $software_output;} ?>
                        </div>
                    </div>
                </div><!-- /.flex-row -->
            </div><!-- /.container -->
        </div><!-- /.blog-header -->
        <?php
    }
}
?>