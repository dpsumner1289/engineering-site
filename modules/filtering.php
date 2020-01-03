<?php
if(!function_exists('sidebar_filters')) {
    function sidebar_filters($post_type = 'event') {
        $ID = get_the_ID();

        if($post_type === 'event') {
            // $form_ops = '<select name="city" id="city" placeholder="City"><option value="">Select location</option>';
            // $cats = get_terms(array('taxonomy' => array('event_category'), 'hide_empty' => false,));
            // $locs = get_terms(array('taxonomy' => array('event_location'), 'hide_empty' => false,));
            // foreach($locs as $loc) {
            //     $form_ops .= '<option value="'.$loc->term_id.'">'.$loc->name.'</option>';
            // }
            // $form_ops .= '</select>';
            $form_ops = '';
            // year select
            $already_selected_value = date('Y');
            $earliest_year = 2018;
            $form_ops .= '<h4>DATE:</h4><select name="year" class="year_select"><option value="" selected="selected">Select year</option>';
            foreach (range(date('Y'), $earliest_year) as $x) {
                $form_ops.= '<option value="'.$x.'">'.$x.'</option>';
            }
            $form_ops .= '</select>';
            // month select
            $form_ops .= '<select name="month" class="month_select"><option value="" selected="selected">Select month</option>';
            $month = strtotime(date('Y').'-'.date('m').'-'.date('j').' - 12 months');
            $end = strtotime(date('Y').'-'.date('m').'-'.date('j').' + 0 months');
            while($month < $end){
                $form_ops .= '<option value="'.date('n', $month).'">'.date('F', $month).'</option>'."\n";
                $month = strtotime("+1 month", $month);
            }
            $form_ops .= '</select>';
            $reqd = '';
        } else {
            $form_ops = '<div class="martop marbottom"><h4>CONTENT TYPE<sup>*</sup>:</h4>';
            $cats = get_terms(array('taxonomy' => array('category'), 'hide_empty' => false,));
            $post_type_selects = array(
                array('story', 'Stories'), 
                array('video', 'Videos'),
                array('press_release', 'News Releases'),
            );
            $i = 0;
            foreach($post_type_selects as $select) {
                $i++;
                if($i === 1){
                    $req = 'required';
                }else{
                    $req = '';
                }
                $form_ops .= '<input type="radio" class="post-type" data-name="'.$select[1].'" value="'.$select[0].'" name="post_type" '.$req.'> '.$select[1].'<br>';
            }
            $form_ops .= '<h4>DATE:</h4><select name="year" class="year_select"><option value="" selected="selected">Select year</option>';
            // year select
            $earliest_year = 2018;
            foreach (range(date('Y'), $earliest_year) as $x) {
                $form_ops.= '<option value="'.$x.'">'.$x.'</option>';
            }
            $form_ops.= '</select>';
            // month select
            $form_ops .= '<select name="month" class="month_select"><option value="" selected="selected">Select month</option>';
            $month = strtotime('January');
            $end = strtotime('December + 1 month');
            while($month < $end){
                $form_ops .= '<option value="'.date('n', $month).'">'.date('F', $month).'</option>'."\n";
                $month = strtotime("+1 month", $month);
            }
            $form_ops .= '</select>';
            $form_ops .= '</div>';
            $reqd = '<small>Fields marked with <sup>*</sup> are required</small>';
        }

        // parts
        $open_section = '<aside class="filtering flex col">';
        $heading = '<div class="flex row vc filter_heading stretch">
                        <h4>FILTER</h4>
                        <a class="reset nolink"><i class="fas fa-times"></i> Reset</a>
                        <a class="hide nolink"><i class="fas fa-angle-left"></i></i> Hide</a>
                    </div>';
        $form = '<div class="filter_options flex row"><form action="" class="search-form search-post-ajax item_2_1">
                    <h3 class="padleft nopad-bottom marbottom-half" style="text-align:center;">— OPTIONS —</h3>
                    '.$reqd.$form_ops.'
                    <h4>KEYWORDS:</h4>
                    <input class="keywords" type="text" placeholder="enter search term" />
                    <button class="post-search" type="submit">Search <i class="fas fa-search"></i></button>
                </form>';
        $cat_heading = '<div class="item_2_1 flex col"><h3 class="padleft nopad-bottom marbottom-half" style="text-align:center;">— OR —</h3><h4 class="cat_heading">FILTER BY CATEGORY</h4>';
        $close_section = '</div></div></aside><!-- /.filtering -->';
        $output = '';

        $output .= $open_section;
        $output .= $heading;
        $output .= $form;
        $output .= $cat_heading;
        foreach( $cats as $category ) {
            $category_link = sprintf( 
                '<a class="cat_filter" name="category" data-value="%1$s" data-name="%3$s" alt="%2$s">%3$s</a>',
                $category->name,
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
            $output.= sprintf( esc_html__( '%s'), $category_link );
        }
        $output .= $close_section;
        $output .= "<script>
                    jQuery(document).ready(function(){
                        var filterHeight = $('.filtering').height();
                        $('#primary').css('min-height', filterHeight+'px');
                        $('#dateinput').datepicker();
                        var initWwidth = $(window).width();
                        if(initWwidth <= 800) {
                            $('aside.filtering').hide();
                        }
                        var postType = '".$post_type."';
                        function show_filter(el) {
                            var windowWidth = $(window).width();
                            $(el).text('HIDE FILTERS');
                            $(el).addClass('active');
                            $(el).addClass('slideleft');
                            $('#page').css('overflow','hidden');
                            $('.filter_heading a').addClass('active');
                            if(windowWidth > 1024) {
                                $('aside.filtering').animate({
                                    left:'+=100%'
                                }, 400);
                                $('#content').animate({
                                    marginLeft:'+=300',
                                    marginRight:'-=300'
                                }, 400);
                            }else{
                                $('aside.filtering').show('slide',{direction: 'up'},400);
                            }
                        }
                        function hideFilter() {
                            var windowWidth = $(window).width();
                            $('.filter_show').text('SHOW FILTERS');
                            $('.filter_show').removeClass('active');
                            $('.filter_show').removeClass('slideleft');
                            $('#page').css('overflow','initial');
                            $('.filter_heading a').addClass('active');
                            if(windowWidth > 1024) {
                                $('aside.filtering').animate({
                                    left:'-=100%'
                                }, 400);
                                $('#content').animate({
                                    marginLeft:'-=300',
                                    marginRight:'+=300'
                                }, 400);
                            } else {
                                $('aside.filtering').hide('slide',{direction: 'up'},400);
                            }
                        }
                        function resetFilters(){
                            $('input[type=text], input[type=date]').val('');
                            $('select').prop('selectedIndex',0);
                            $('input[type=\"radio\"]').prop('checked', false);
                        }
                        $(document).on('click', 'a.reset', function(){resetFilters()});
                        $(document).on('click', '.filter_show:not(\".active\")', function(){show_filter(this)});
                        $(document).on('click', '.filter_heading a.hide.active, .filter_show.active, a.cat_filter', function(){
                            hideFilter();
                        });
                        $(document).on('click', 'button.post-search', function(){
                            if(postType === 'story'){
                                if($('.post-type:checked').length > 0) {
                                    hideFilter();
                                }
                            }else {
                                hideFilter();
                            }
                        });
                        $(document).on('click', '.menu-bars', function(e){
                            if($('.filter_show').hasClass('active')){
                                hideFilter();
                            }
                        });
                    });
                    </script>";

        return $output;
    }
}