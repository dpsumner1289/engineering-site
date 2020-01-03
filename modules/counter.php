<?php
if(!function_exists('counter')) {
    function counter($postID=false, $heading=false, $content=false, $equation_figures=false, $background_image=false, $underlap_amount=false, $underlapping_content=false) {
        if($postID !== false) {
            $postID = $postID;
            $heading = $heading;
            $content = $content;
            $equation_figures = $equation_figures;
            $background_image = $background_image;
            $background_image = 'style="background-image:url('.$background_image['url'].');"';
            $underlap_amount = $underlap_amount;
            $underlapping_content = $underlapping_content;
            $underlap_above = '';
            function equation_counter($postID, $data_figures) {
                $figs = 0;
                foreach($data_figures as $figure):
                    $fig = $figure['figure'];
                    $caption = $figure['caption'];
                    $figure_formatting = $figure['figure_formatting'];
                    if($figure_formatting == 'percentage') {
                        $sup = '<sup>%</sup>'; 
                    }elseif($figure_formatting == 'ballpark') {
                        $sup = '<sup>+</sup>';
                    }elseif($figure_formatting == 'millions') {
                        $sup = ' <sup>Mil+</sup>';
                    }elseif($figure_formatting == 'standard') {
                        $sup = '';
                    }else {
                        $sup = '<sup>'.$figure_formatting.'</sup>';
                    }
                    echo '<div class="figure flex row jfc afc">';
                    echo '<div class="fig_cont flex col afc jfc">';
                    if(!empty($fig)): echo '<div><figure class="count" data-count="'.$fig.'">'.$fig.'</figure>'.$sup.'</div>'; endif;
                    if(!empty($caption)): echo '<div class="cap">'.$caption.'</div>'; endif;
                    echo '</div>';
                    echo '</div>';
                    $figs++;
                endforeach;
                echo "<script>
                    jQuery(document).ready(function($){
                        // $('.figure').addClass('item_1_".$figs."');
                        $('.figure').addClass('item_1_4');
    
                        function eqheight(){
                            $('div.fig_cont').each(function(){  
                                $('.fig_cont').height($(this).width());
                            }); 
                        }
                        eqheight();
                        $(window).resize(function(){
                            eqheight();
                        });
                    });
                </script>";
            };
    
        } else {
            $postID = get_the_ID();
            $equation_figures = count(get_post_meta($postID, 'equation_figures', true));
            $underlap_amount = get_post_meta($postID, 'underlap_amount', true);
            $background_image = '';
            $underlapping_content = get_post_meta($postID, 'underlapping_content_below', true);
            $underlap_above = '<script>
            jQuery(document).ready(function($){
                $("section.dlc").addClass("underlap-me");
                $("section.dlc").css("padding-top", "3rem");
            });
            </script>';
            function equation_counter($postID, $data_figures) {
                $figs = 0;
                for($i = 0; $i < $data_figures; $i++){
                    $fig_key = 'equation_figures_'.$i.'_figure';
                    $cap_key = 'equation_figures_'.$i.'_caption';
                    $format_key = 'equation_figures_'.$i.'_figure_formatting';
                    $fig = get_post_meta($postID, $fig_key, true);
                    $caption = get_post_meta($postID, $cap_key, true);
                    $figure_formatting = get_post_meta($postID, $format_key, true);
                    if($figure_formatting == 'percentage') {
                        $sup = '<sup>%</sup>'; 
                    }elseif($figure_formatting == 'ballpark') {
                        $sup = '<sup>+</sup>';
                    }elseif($figure_formatting == 'millions') {
                        $sup = ' <sup>Mil+</sup>';
                    }elseif($figure_formatting == 'standard') {
                        $sup = '';
                    }else {
                        $sup = '<sup>'.$figure_formatting.'</sup>';
                    }
    
                    echo '<div class="figure flex row jfc afc">';
                    echo '<div class="fig_cont flex col afc jfc">';
                    if(!empty($fig)): echo '<div><figure class="count" data-count="'.$fig.'">'.$fig.'</figure>'.$sup.'</div>'; endif;
                    if(!empty($caption)): echo '<div class="cap">'.$caption.'</div>'; endif;
                    echo '</div>';
                    echo '</div>';
                    $figs++;
                }
                echo "<script>
                    jQuery(document).ready(function($){
                        // $('.figure').addClass('item_1_".$figs."');
                        $('.figure').addClass('item_1_4');
    
                        function eqheight(){
                            $('div.fig_cont').each(function(){  
                                $('.fig_cont').height($(this).width());
                            }); 
                        }
                        eqheight();
                        $(window).resize(function(){
                            eqheight();
                        });
                    });
                </script>";
            };
        }
        $anchor_tag = get_post_meta($postID, 'anchor_tag', true);
        if($equation_figures > 1):
            ?>
            <section class="counter_row <?php if($underlapping_content): echo 'underlap'; endif; ?>" <?php echo $background_image; ?> id="<?php echo $anchor_tag; ?>">
                <div class="container container-lg flex col jfs afs">
                    <div class="left_content">
                        <?php if(!empty($heading)){
                            echo '<h2 class="white_heading">'.$heading.'</h2>';
                            echo $content;
                        } ?>
                    </div>
                    <div class="figures flex row jfse">
                        <?php 
                        equation_counter($postID, $equation_figures);
                        ?>
                    </div>
                </div>
            </section>
            <?php
            echo $underlap_above;
            if($underlapping_content): 
                $unit = $underlap_amount['units'];
                $range = $underlap_amount[$unit];
            
                $style = '<style>.underlap{padding-bottom:'.$range.$unit.'; margin-bottom:-'.$range.$unit.'}</style>';
                echo $style;
            endif;
        endif;
    }
}