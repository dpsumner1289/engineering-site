<?php
global $flex_content;
$wysiwyg = $flex_content['wysiwyg'];
$button = $flex_content['button'];
$heading = $flex_content['heading'];
$container_width = $flex_content['container_width'];
$anchor_tag = $flex_content['anchor_tag'];
?>
<section class="wysiwyg" id="<?php echo $anchor_tag; ?>">
    <div class="container <?php echo $container_width; ?>">
        <?php 
        if(!empty($heading)){echo '<h2 class="smallheading">'.$heading.'</h2>';}
        echo $wysiwyg; 
        if(!empty($button['label']) && !empty($button['link'])) {
            echo '<div class="button_row">';
            echo '<a href="'.$button['link'].'" class="button blue">'.$button['label'].'</a>';
            echo '</div>';
        }
        ?>
    </div>
</section><!-- /.wysiwyg -->