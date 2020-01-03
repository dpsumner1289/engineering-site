<?php

// Register FAQs
function create_faqs() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'FAQs', 'text_domain' ),
		'name_admin_bar'        => __( 'FAQ', 'text_domain' ),
		'archives'              => __( 'FAQ Archives', 'text_domain' ),
		'attributes'            => __( 'FAQ Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent FAQ:', 'text_domain' ),
		'all_items'             => __( 'All FAQs', 'text_domain' ),
		'add_new_item'          => __( 'Add New FAQ', 'text_domain' ),
		'add_new'               => __( 'Add New FAQ', 'text_domain' ),
		'new_item'              => __( 'New FAQ', 'text_domain' ),
		'edit_item'             => __( 'Edit FAQ', 'text_domain' ),
		'update_item'           => __( 'Update FAQ', 'text_domain' ),
		'view_item'             => __( 'View FAQ', 'text_domain' ),
		'view_items'            => __( 'View FAQs', 'text_domain' ),
		'search_items'          => __( 'Search FAQs', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into FAQ', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'text_domain' ),
		'items_list'            => __( 'FAQs list', 'text_domain' ),
		'items_list_navigation' => __( 'FAQs list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter FAQs list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'FAQ', 'text_domain' ),
		'description'           => __( 'FAQs can be added via the [faq] shortcode, or by add the "FAQ Accordion" row via the "Content Rows" available in all pages.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'create_faqs', 0 );

// add metabox below editing pane
function faq_metabox_after_title() {
	$screen = get_current_screen();
    add_meta_box( 'after-title-help', 'How to use FAQs', 'faq_after_title_help_metabox_content', $screen, 'advanced', 'high' );
}
add_action( 'add_meta_boxes', 'faq_metabox_after_title' );

// callback function to populate metabox
function faq_after_title_help_metabox_content() { 
	echo "<p>You can add an FAQ accordion to any page or post in two ways:</p>
	<ol>
		<li><b>Via shortcode.</b> Just drop in the <code>[faqs]</code> into any page or post, and it'll automatically show an accordion with all of your FAQs.</li>
		<li><b>Via Content Rows.</b> Add an <b>FAQ Categories</b> row into any page with Content Rows enabled (most pages) and you'll get to choose which categories of FAQs you'd like to display.</li>
	</ol>";
 }