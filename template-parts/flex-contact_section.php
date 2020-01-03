<?php
global $flex_content;

$ID = get_the_ID();
$page_title = get_the_title($ID);
$subheading = $flex_content['subheading'];
$opening_copy = $flex_content['opening_copy'];
$form = $flex_content['form'];
$content = $flex_content['content'];
$page_hero = get_the_post_thumbnail_url($ID, 'full');
?>

<section class="contact_section">
    <div class="empty_hero fs-80" style="background-image:url(<?php echo $page_hero; ?>)"></div>
    <div class="container container-md">
        <div class="container block heading-block">
            <h3><?php echo !empty($subheading) ? $subheading : 'PHILANTHROPY AT MICHIGAN'; ?></h3>
            <h1><?php echo $page_title; ?></h1>
            <div><?php echo $opening_copy; ?></div>
        </div><!-- /.block -->
        <div class="container block flex row">
            <div class="item_3_5 pad">
            <?php
            gravity_form($form['id'], false, true, false, '', true, 1); 
            ?>
            </div>
            <div class="item_2_5">
                <div class="pad">
                <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.contact_section -->