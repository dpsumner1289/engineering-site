<?php
if ( ! function_exists('stories') ) {

// Register Custom Post Type
function stories() {

	$labels = array(
		'name'                  => _x( 'Stories', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Story', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Stories', 'text_domain' ),
		'name_admin_bar'        => __( 'Stories', 'text_domain' ),
		'archives'              => __( 'Story Archives', 'text_domain' ),
		'attributes'            => __( 'Story Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Story:', 'text_domain' ),
		'all_items'             => __( 'All Stories', 'text_domain' ),
		'add_new_item'          => __( 'Add New Story', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Story', 'text_domain' ),
		'edit_item'             => __( 'Edit Story', 'text_domain' ),
		'update_item'           => __( 'Update Story', 'text_domain' ),
		'view_item'             => __( 'View Story', 'text_domain' ),
		'view_items'            => __( 'View Stories', 'text_domain' ),
		'search_items'          => __( 'Search Stories', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Story Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Story image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Story image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Story image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Story', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Story', 'text_domain' ),
		'items_list'            => __( 'Story list', 'text_domain' ),
		'items_list_navigation' => __( 'Story list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Story list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Story', 'text_domain' ),
		'description'           => __( 'Impact Stories', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( 'category'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'story', $args );
}
add_action( 'init', 'stories', 0 );
add_post_type_support( 'story', 'excerpt' );

}