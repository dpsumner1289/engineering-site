<?php
global $flex_content;

$ID = get_the_ID();
$deans_photo = $flex_content['deans_photo'];
$logo = $flex_content['logo'];
$name_title = $flex_content['name_title'];
    $name = $name_title['name'];
    $title = $name_title['title'];
    $location = $name_title['location'];
$opening_paragraph = $flex_content['opening_paragraph'];
$letter_title = $flex_content['letter_title'];
$letter_content = $flex_content['letter_content'];
$page_hero = $flex_content['page_hero'];
$victor_for_mi_cta = $flex_content['victor_for_mi_cta'];
$bullet_styles = $flex_content['bullet_styles'];
$page_title = get_the_title($ID);
$drop_cap_story = $flex_content['drop_cap_story'];
if($drop_cap_story === true) {
    $drop_cap = 'dropcap';
}else {
    $drop_cap = '';
}
set_post_thumbnail($ID, $page_hero['ID']);
?>

<section class="deans_letter">
    <div class="empty_hero fs-80" style="background-image:url(<?php echo $page_hero['url']; ?>)"></div>
    <div class="container container-md">
        <div class="container block flex row nopad-all">
            <div class="item_2_7 flex col pad">
                <img src="<?php echo $deans_photo['url']; ?>" alt="<?php echo $deans_photo['alt']; ?>">
                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="martop">
            </div>
            <div class="item_5_7 pad bullets-<?php echo $bullet_styles; ?>">
                <div class="identity">
                    <h4><?php echo $name; ?></h4>
                    <i><b><?php echo $title; ?></b></i><br />
                    <i><?php echo $location; ?></i>
                </div>
                <div class="opening_paragraph"><?php echo $opening_paragraph; ?></div>
                <div class="letter_desktop <?php echo $drop_cap; ?>">
                    <?php
                    if(!empty($letter_title)) {
                        echo '<h2>'.$letter_title.'</h2>';
                    } 
                    echo $letter_content;
                    ?>
                </div>
            </div>
        </div><!-- /.block -->
        <div class="container block nopad-all mobile">
            <div class="letter_mobile <?php echo $drop_cap; ?>">
                <?php 
                if(!empty($letter_title)) {
                    echo '<h2>'.$letter_title.'</h2>';
                }
                echo $letter_content; 
                ?>
            </div>
        </div>
    </div><!-- /.container -->
</section><!-- /.presidents_letter -->