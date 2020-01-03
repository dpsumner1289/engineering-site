<?php
global $flex_content;

$width = $flex_content['width'];
$horizontal_alignment = $flex_content['horizontal_alignment'];
$heading = $flex_content['heading'];
$copy = $flex_content['copy'];
$background_image = $flex_content['background_image'];
$anchor_tag = $flex_content['anchor_tag'];
?>
<section class="variable_width_content" <?php if(!empty($background_image)){echo 'style="background-image:url('.$background_image['url'].'"';} ?> id="<?php echo $anchor_tag; ?>">
    <div class="container container-lg flex row <?php echo $horizontal_alignment; ?>">
        <div class="variable_row" style="flex-basis:<?php echo $width; ?>%; width:<?php echo $width; ?>%;">
            <?php if(!empty($heading)){echo '<div class="heading">'.$heading.'</div>';} ?>
            <?php echo $copy; ?>
        </div>
    </div>
</section><!-- /.variable_width_content -->