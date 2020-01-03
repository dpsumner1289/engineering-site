<?php
// Template Name: Contact Page
get_header();
$postID = get_the_ID();
$hero_background_image = get_post_meta($postID, 'hero_background_image', true);
$hero_background_image = wp_get_attachment_image_url($hero_background_image, 'full');
$heading = get_the_title($postID);
?>
<section class="flex-hero flex row banner-inner fs-full-screen noitalic underlap" style="background-image:url(<?php echo $hero_background_image; ?>)">
    <div class="outer-wrapper container container-lg flex col jfsb">
        <div class="container container-lg">
            <div class="inner-wrapper flex col afc">
                <div class="opening_content">
                    <?php 
                    if($heading) {
                        echo '<h1 class="underline-1">'.$heading.'</h1>';
                    }
                    ?>
                </div>
            </div> <!-- .inner-wrapper -->
        </div> <!-- .container -->
    </div> <!-- .outer-wrapper -->
</section> <!-- .flex-hero -->
<?php
$map = get_post_meta($postID, 'map', true);
$form = get_post_meta($postID, 'form', true);
$ml_name = get_post_meta($postID, 'main_location_location_name', true);
$ml_address = get_post_meta($postID, 'main_location_address', true);
$ml_address = apply_filters('the_content', $ml_address);
$ml_contact_methods = get_post_meta($postID, 'main_location_contact_methods', true);
$additional_locations = get_post_meta($postID, 'additional_locations', true);
?>
<section class="contact_content">
    <div class="container container-md-lg flex row nopad-top">
        <div class="item_1_2 content_form">
            <div class="content">
                <?php
                if(have_posts()): while(have_posts()): the_post();
                    echo !empty(get_the_content()) ?  apply_filters( 'the_content', $post->post_content ) :  '';
                endwhile; endif;
                ?>
            </div>
            <div class="form">
                <?php if(!empty($form)):
                    gravity_form($form, false, true, false, '', true, 1);
                endif; ?>
            </div>
        </div>
        <div class="item_1_2 map_locations">
            <?php if(!empty($map)): ?>
            <div class="map">
                <div class="acf-map">
                    <div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
                </div>
            </div>
            <?php endif; ?>
            <div class="locations flex col">
                <?php if(!empty($ml_address)) {
                    echo '<div class="ml-info">';
                    echo '<h4>'.$ml_name.'</h4>';
                    echo $ml_address;
                    echo '<div class="contact_methods">';
                    echo '<ul class="flex row afs jfs">';
                    for($i = 0; $i < $ml_contact_methods; $i++) {
                        $key = 'main_location_contact_methods_'.$i.'_';
                        $contact_type = get_post_meta($postID, $key.'contact_type', true);
                        if($contact_type == '<i class="fas fa-envelope"></I>' || $contact_type == '<i class="fas fa-envelope"></i>') {
                            $email = get_post_meta($postID, $key.'number', true);
                            $c_output = '<li class="item_1_2"><a href="mailto:'.$email.'">'.$contact_type.' '.$email.'</a></li>';
                        }else {
                            $c_output = '<li class="item_1_2">'.$contact_type.' '.get_post_meta($postID, $key.'number', true).'</li>';
                        }
                        echo $c_output;
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                } ?>
                <?php if(!empty($additional_locations)): ?>
                <div class="additional_locations flex row">
                    <?php for($j = 0; $j < $additional_locations; $j++) {
                        $al_key = 'additional_locations_'.$j.'_';
                        $al_contact_methods = get_post_meta($postID, $al_key.'contact_methods', true);
                        $al_name = get_post_meta($postID, $al_key.'location_name', true);
                        $al_address = get_post_meta($postID, $al_key.'address', true);
                        $al_address = apply_filters('the_content', $al_address);
                        echo '<div class="a_location item_1_2">';
                        echo '<h4>'.$al_name.'</h4>';
                        echo '<div class="al_address">'.$al_address.'</div>';
                        echo '<ul class="flex col afs jfs">';
                        for($k = 0; $k < $al_contact_methods; $k++) {
                            $akey = 'additional_locations_'.$j.'_contact_methods_'.$k.'_';
                            $al_contact_type = get_post_meta($postID, $akey.'contact_type', true);
                            if($al_contact_type == '<i class="fas fa-envelope"></I>' || $al_contact_type == '<i class="fas fa-envelope"></i>') {
                                $al_email = get_post_meta($postID, $akey.'number', true);
                                $al_output = '<li><a href="mailto:'.$al_email.'">'.$al_contact_type.' '.$al_email.'</a></li>';
                            }else {
                                $al_output = '<li>'.$al_contact_type.' '.get_post_meta($postID, $akey.'number', true).'</li>';
                            }
                            echo $al_output;
                        }
                        echo '</ul>';
                        echo '</div>';
                    } ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!-- /.contact_content -->
<style type="text/css">
    .acf-map {
        width: 100%;
        height: 400px;
        border: #ccc solid 1px;
        margin: 20px 0;
    }
    .acf-map img {
    max-width: inherit !important;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-JRlk8pXJrbidzUya0rn3HFxvJrEqJas"></script>
<script type="text/javascript">
    (function($) {
    function new_map( $el ) {
        var $markers = $el.find('.marker');
        var args = {
            zoom		: 16,
            center		: new google.maps.LatLng(0, 0),
            mapTypeId	: google.maps.MapTypeId.ROADMAP
        };        	
        var map = new google.maps.Map( $el[0], args);
        map.markers = [];
        $markers.each(function(){
            add_marker( $(this), map );
        });
        center_map( map );
        return map;
    }
    function add_marker( $marker, map ) {
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        var marker = new google.maps.Marker({
            position	: latlng,
            map			: map
        });
        map.markers.push( marker );
        if( $marker.html() )
        {
            var infowindow = new google.maps.InfoWindow({
                content		: $marker.html()
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    function center_map( map ) {
        var bounds = new google.maps.LatLngBounds();
        $.each( map.markers, function( i, marker ){
            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
            bounds.extend( latlng );
        });
        if( map.markers.length == 1 )
        {
            map.setCenter( bounds.getCenter() );
            map.setZoom( 16 );
        }
        else
        {
            map.fitBounds( bounds );
        }
    }
    var map = null;
    $(document).ready(function(){
        $('.acf-map').each(function(){
            map = new_map( $(this) );
        });
    });
    })(jQuery);
</script>
<?php
get_footer();