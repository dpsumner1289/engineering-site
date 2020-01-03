<?php
global $flex_content;
$heading = $flex_content['heading'];
$intro_content = $flex_content['intro_content'];
$intro_content_heading = $flex_content['intro_content_heading'];
$industries = $flex_content['industries'];
$anchor_tag = $flex_content['anchor_tag'];
?>
<section class="industries" id="<?php echo $anchor_tag; ?>">
    <div class="container container-lg flex col afs">
        <div class="intro">
            <?php if(!empty($heading)) {echo '<h2 class="heading">'.$heading.'</h2>';} ?>
            <?php if(!empty($intro_content)) {echo '<div class="intro_content_heading">'.$intro_content_heading.'</div>';} ?>
            <?php if(!empty($intro_content)) {echo '<div class="intro_content item_4_5">'.$intro_content.'</div>';} ?>
        </div>
        <div class="industry_grid container container-lg flex row afc jfsb">
            <?php foreach($industries as $industry) {
                $button = $industry['button'];
                ?>
                <div class="industry item_1_4-gutter">
                    <div class="image_wrap flex afc <?php if(empty($industry['description'])){ echo 'no_js'; } ?>" style="background-image:url();">
                        <?php
                        $cropped =  wp_get_attachment_image_src($industry['image']['id'], 'bc-industries-tile');
                        $cropped = $cropped[0];
                        ?>
                        <img src="<?php echo $cropped; ?>">
                        <div class="meta flex col afs jfs">
                            <?php echo '<h4>'.$industry['title'].'</h4>'; ?>
                            <?php echo '<div class="description">'.$industry['description'].'</div>'; ?>
                            <?php if(!empty($button['label']) && !empty($button['link'])) {
                                echo '<a href="'.$button["link"]["url"].'" class="seemore">'.$button['label'].' <i class="fal fa-arrow-right"></i></a>';
                            } ?>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($){
            function equalHeight() {
                $('div.industry_grid').each(function(){  
                    var highestBox = 0;
                    $('.industry .meta', this).each(function(){
                        if($(this).outerHeight() > highestBox) {
                            highestBox = $(this).outerHeight(); 
                        }
                        title = $(this).find('h4');
                        titleHeight = title.height();
                        newHeight = 'calc(100% - (1.618rem + '+titleHeight+'px)';
                        $(this).css('top', newHeight);
                        console.log(titleHeight);
                    });  
                    // $('.industry .image_wrap',this).height(highestBox);
                }); 
            }

            equalHeight();
        });
    </script>
</section><!-- /.industries -->