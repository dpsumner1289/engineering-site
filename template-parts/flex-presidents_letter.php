<?php
global $flex_content;

$ID = get_the_ID();
$presidents_photo = $flex_content['presidents_photo'];
$quote = $flex_content['quote'];
$name_title = $flex_content['name_title'];
    $name = $name_title['name'];
    $title = $name_title['title'];
$letter_content = $flex_content['letter_content'];
$page_hero = $flex_content['page_hero'];
$victor_for_mi_cta = $flex_content['victor_for_mi_cta'];
$page_title = get_the_title($ID);
$drop_cap_story = $flex_content['drop_cap_story'];
if($drop_cap_story === true) {
    $drop_cap = 'dropcap';
}else {
    $drop_cap = '';
}

set_post_thumbnail($ID, $page_hero['ID']);
?>

<section class="presidents_letter">
    <div class="empty_hero fs-80" style="background-image:url(<?php echo $page_hero['url']; ?>)"></div>
    <div class="container container-md">
        <div class="container block heading-block">
            <h3>PHILANTHROPY AT MICHIGAN</h3>
            <h1><?php echo $page_title; ?></h1>
        </div><!-- /.block -->
        <div class="container block flex row">
            <div class="item_3_7 flex col pad">
                <img src="<?php echo $presidents_photo['url']; ?>" alt="<?php echo $presidents_photo['alt']; ?>">
                <aside class="flex row stretch">
                    <div class="open_quote">&ldquo;</div>
                    <div class="quote"><?php echo $quote; ?></div>
                </aside>
                <div class="identity">
                    <h3><?php echo $name; ?></h3>
                    <i><?php echo $title; ?></i>
                </div>
            </div>
            <div class="item_4_7 pad <?php echo $drop_cap; ?>">
                <?php echo $letter_content; ?>
            </div>
        </div><!-- /.block -->
    </div><!-- /.container -->
</section><!-- /.presidents_letter -->