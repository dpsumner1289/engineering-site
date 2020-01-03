<?php
global $flex_content;
$background_image = $flex_content['background_image'];
$heading = $flex_content['heading'];
$intro_content = $flex_content['intro_content'];
$steps = $flex_content['step'];
$anchor_tag = $flex_content['anchor_tag'];
?>
<section class="our_process" style="background-image:url(<?php echo $background_image['url']; ?>)" id="<?php echo $anchor_tag; ?>">
    <div class="container container-lg flex col">
        <div class="intro">
            <?php if(!empty($heading)) {echo '<h2 class="heading">'.$heading.'</h2>';} ?>
            <?php if(!empty($intro_content)) {echo '<div class="intro_content">'.$intro_content.'</div>';} ?>
        </div>
        <div class="process flex row afc jfc">
            <?php foreach($steps as $step) {
                ?>
                <div class="step" id="order-<?php echo $step['order']; ?>" style="max-width:<?php echo $step['width']; ?>%; flex-basis:<?php echo $step['width']; ?>%;">
                    <div class="step_wrapper flex row afs jfs">
                        <div class="step_icon item_1_5 nobreak"><?php echo $step['icon']; ?></div>
                        <div class="step_content item_4_5 nobreak flex col afs jfs">
                            <?php echo '<h3>'.$step['title'].'</h3>'; ?>
                            <?php echo '<div class="copy">'.$step['description'].'</div>'; ?>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
</section><!-- /.our_process-->