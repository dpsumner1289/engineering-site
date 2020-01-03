<?php
$postID = get_the_ID();

get_header();

service_header('product');

primary_content('product', $postID);

$dlc_button_theme = get_post_meta($postID, 'dlc_button_theme', true);
dlc();
?>
<script>
    jQuery(document).ready(function($){
        $('section.dlc .gform_footer > .gform_button.button').addClass('<?php echo $dlc_button_theme; ?>');
    });
</script>
<?php

grid_points($postID);

case_study();

static_cta($postID);

secondary_product_content($postID);

recent_posts($post_ID = false, $background_image = false, $number_of_posts = 3, $button_label = 'SEE MORE', $button_link = '/blog/', $postType = 'post');

$hide_cta = get_post_meta($postID, 'hide_cta', true);
if($hide_cta != '1') {
    simple_cta($postID);
}

get_footer();