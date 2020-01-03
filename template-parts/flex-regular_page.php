<?php
global $flex_content;

$ID = get_the_ID();
$page_title = get_the_title($ID);
$subheading = $flex_content['subheading'];
$opening_copy = $flex_content['opening_copy'];
$emphasis = $flex_content['emphasized_content'];
$copy = $flex_content['copy'];
$page_hero = get_the_post_thumbnail_url($ID, 'full');
$drop_cap_story = $flex_content['drop_cap_story'];
if($drop_cap_story === true) {
    $drop_cap = 'dropcap';
}else {
    $drop_cap = '';
}
?>

<section class="contact_section regular_page">
    <div class="empty_hero fs-80" style="background-image:url(<?php echo $page_hero; ?>)"></div>
    <div class="container container-md">
        <div class="container block heading-block">
            <h3><?php echo !empty($subheading) ? $subheading : 'PHILANTHROPY AT MICHIGAN'; ?></h3>
            <h1><?php echo $page_title; ?></h1>
            <div class="opening_copy"><?php echo $opening_copy; ?></div>
            <div class="emphasis"><?php echo $emphasis; ?></div>
        </div><!-- /.block -->
        <div class="container block <?php echo $drop_cap; ?>">
            <?php echo $copy; ?>
        </div>
    </div>
</section><!-- /.contact_section -->
<script>
    jQuery(document).ready(function($){
        // var firstChild = $('.dropcap > :first-child');
        // if(firstChild.is('figure, img')) {
        //     firstChild.nextAll().eq(1).css({
        //         'font-size': '3.326rem',
        //         'float': 'left',
        //         'padding-top': '16px',
        //         'padding-right': '8px',
        //         'padding-left': '3px'
        //     })
        // }
    });
</script>