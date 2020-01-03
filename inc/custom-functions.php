<?php
/* 
## Custom functions built during dev 
*/

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyAMTPBPsVC0sYA8xjZ6ukXaqLvtr7xywcg';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Limit post feed archive

function post_query( $query ){
    if( ! is_admin()
        && $query->is_post_type_archive( 'post' )
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', 4 );
    }
}
add_action( 'pre_get_posts', 'post_query' );

