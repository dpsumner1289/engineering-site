<?php
if(!function_exists('dlc')) {
    // function dlc($postID=false, $dlc_heading=false, $dlc_form=false, $dlcbgimage=false, $dlc_theme=false) {
    function dlc($flex_content = false) {
        $anchor_tag = '';

        if($flex_content){
            $dlc_heading = $flex_content['dlc_heading'];
            $dlcbgimage = $flex_content['dlc_background_image']['url'];
            $dlc_theme = $flex_content['dlc_theme'];            
            $dlc_form = $flex_content['dlc_form'];
            $dlc_file = $flex_content['dlc_file'];
            $dlc_url = $flex_content['dlc_url'];
            $anchor_tag = $flex_content['anchor_tag'];

        }else {
            $postID = get_the_ID();
            $dlc_heading = get_post_meta($postID, 'dlc_heading', true);
            $dlc_form = get_post_meta($postID, 'dlc_form', true);
            $dlcbgimage = wp_get_attachment_url(get_post_meta($postID, 'dlc_background_image', true));
            $dlc_theme = get_post_meta($postID, 'dlc_theme', true);
            $dlc_file = get_post_meta($postID, 'dlc_file', true);
            $dlc_url = get_post_meta($postID, 'dlc_url', true);
        }


        // check if this form has the 'dlc' class meaning it has a field with the dlc
        // as opposed to having the dlc in a manually entered confirmation or redirect
        $dlc = false;
        $gform = GFAPI::get_form($dlc_form);

        if($gform['cssClass']){
            $gform_classes = explode(' ', $gform['cssClass']);
            if(in_array('dlc', $gform_classes)){      

                // check for file or dlc url
                $dlc = $dlc_file ? wp_get_attachment_url($dlc_file) : $dlc_url;
            }
        }
    ?>
        <section class="dlc <?php echo $dlc_theme; ?>" style="background-image:url('<?php echo $dlcbgimage; ?>');" id="<?php echo $anchor_tag; ?>">
            <div class="container container-md-lg flex row afc jfc">
                <?php if($dlc_heading) : ?>
                    <div class="item_3_5 dlc-heading">
                        <?php echo $dlc_heading; ?>
                    </div>
                <?php endif; ?>

                <?php if(!empty($dlc_form)) : ?>
                    <div class="item_2_5">
                        <?php if($dlc) : ?>
                            <div class="dlc-form new-tab">
                                <?php echo do_shortcode("[gravityforms id=".$dlc_form." field_values='dlc=".$dlc."']"); ?>
                            </div>
                            <script>
                                jQuery(document).ready(function($){
                                    $('.dlc-form.new-tab form').attr('target', '_blank');
                                });
                            </script>                      
                        <?php else : ?>
                            <div class="dlc-form">
                                <?php echo do_shortcode("[gravityforms id=".$dlc_form."]"); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    <?php
    }
}