<?php
global $flex_content;
$heading = $flex_content['heading'];
$intro_content = $flex_content['intro_content'];
$left_image = $flex_content['left_image'];
$right_background_image = $flex_content['right_background_image'];
$features = $flex_content['features'];
$anchor_tag = $flex_content['anchor_tag'];
?>
<section class="s_and_t" id="<?php echo $anchor_tag; ?>" style="background-image:url(<?php echo $right_background_image['url']; ?>);">
    <div class="container container-lg flex row nopad">
        <div class="image_left flex afe jfe item_2_5">
            <img src="<?php echo $left_image['url']; ?>" alt="<?php echo $left_image['alt']; ?>">
        </div>
        <div class="st_content flex col jfs afc item_3_5">
            <div class="intro">
                <?php if(!empty($heading)) {echo '<h2 class="heading">'.$heading.'</h2>';} ?>
                <?php if(!empty($intro_content)) {echo '<div class="intro_content">'.$intro_content.'</div>';} ?>
            </div>
            <div class="features flex row">
                <?php foreach($features as $feature) {
                    $button = $feature['button'];
                    ?>
                    <div class="feature item_1_3">
                        <?php if(!empty($feature['title'])){echo '<h3 class="heading">'.$feature['title'].'</h3>';} ?>
                        <?php if(!empty($feature['description'])){echo '<div class="description">'.$feature['description'].'</div>';} ?>
                        <?php if(!empty($button['label']) && !empty($button['link'])) {
                            echo '<a href="'.$button["link"].'" class="seemore">'.$button['label'].' <i class="fal fa-arrow-right"></i></a>';
                        } ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</section><!-- /.s_and_t -->