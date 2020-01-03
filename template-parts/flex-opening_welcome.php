<?php
global $flex_content;

$image = $flex_content['image'];
$content = $flex_content['content'];
?>

<section class="opening_welcome">
    <div class="container container-md flex row">
        <div class="item_200_1">
            <?php if(!empty($image)): echo '<img src="'.$image["url"].'" />'; endif; ?>
        </div><!-- /.item_1_5 -->
        <div class="item_1_200">
            <?php if(!empty($content)): echo '<div class="quote-box">'.$content.'</div>'; endif; ?>
        </div><!-- /.item_4_5 -->
    </div><!-- /.container -->
</section><!-- /.opening_welcome -->