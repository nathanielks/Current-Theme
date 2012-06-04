<?php

//Register Post Types

add_action('init', 'hu_posttypes_register');
 
function hu_posttypes_register() {
	$post_types = array('Slide', 'Slider', 'Media', 'Five for Ten');

	foreach( $post_types as $pt ){

		$labels = array(
			'name' => _x($pt.'s', 'post type general name'),
			'singular_name' => _x($pt, 'post type singular name'),
			'add_new' => __('Add New '.$pt),
			'add_new_item' => __('Add New '.$pt),
			'edit_item' => __('Edit '.$pt),
			'new_item' => __('New '.$pt),
			'view_item' => __('View '.$pt.' Item'),
			'search_items' => __('Search '.$pt.'s'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
	 
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','thumbnail', 'comments'),
			'has_archive' => false,
		  ); 
	 
		register_post_type( title_to_class($pt) , $args );
			
	}

	/**
	 * Register a taxonomy for Media Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_media_category_labels = array(
		'name' => _x( 'Media Categories', 'hope' ),
		'singular_name' => _x( 'Media Category', 'hope' ),
		'search_items' => _x( 'Search Media Categories', 'hope' ),
		'popular_items' => _x( 'Popular Media Categories', 'hope' ),
		'all_items' => _x( 'All Media Categories', 'hope' ),
		'parent_item' => _x( 'Parent Media Category', 'hope' ),
		'parent_item_colon' => _x( 'Parent Media Category:', 'hope' ),
		'edit_item' => _x( 'Edit Media Category', 'hope' ),
		'update_item' => _x( 'Update Media Category', 'hope' ),
		'add_new_item' => _x( 'Add New Media Category', 'hope' ),
		'new_item_name' => _x( 'New Media Category Name', 'hope' ),
		'separate_items_with_commas' => _x( 'Separate media categories with commas', 'hope' ),
		'add_or_remove_items' => _x( 'Add or remove media categories', 'hope' ),
		'choose_from_most_used' => _x( 'Choose from the most used media categories', 'hope' ),
		'menu_name' => _x( 'Media Categories', 'hope' ),
    );
	
    $taxonomy_media_category_args = array(
		'labels' => $taxonomy_media_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => array(
			'slug' => 'media/%media_category%', 
			'has_front' => false
		),
		'query_var' => true
    );
	
    register_taxonomy( 'media_category', array( 'media' ), $taxonomy_media_category_args );

	/**
	 * Register a taxonomy for Media Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	 
	
	$taxonomy_media_tag_labels = array(
		'name' => _x( 'Media Tags', 'hope' ),
		'singular_name' => _x( 'Media Tag', 'hope' ),
		'search_items' => _x( 'Search Media Tags', 'hope' ),
		'popular_items' => _x( 'Popular Media Tags', 'hope' ),
		'all_items' => _x( 'All Media Tags', 'hope' ),
		'parent_item' => _x( 'Parent Media Tag', 'hope' ),
		'parent_item_colon' => _x( 'Parent Media Tag:', 'hope' ),
		'edit_item' => _x( 'Edit Media Tag', 'hope' ),
		'update_item' => _x( 'Update Media Tag', 'hope' ),
		'add_new_item' => _x( 'Add New Media Tag', 'hope' ),
		'new_item_name' => _x( 'New Media Tag Name', 'hope' ),
		'separate_items_with_commas' => _x( 'Separate media tags with commas', 'hope' ),
		'add_or_remove_items' => _x( 'Add or remove media tags', 'hope' ),
		'choose_from_most_used' => _x( 'Choose from the most used media tags', 'hope' ),
		'menu_name' => _x( 'Media Tags', 'hope' )
	);
	
	$taxonomy_media_tag_args = array(
		'labels' => $taxonomy_media_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'media-tag' ),
		'query_var' => true
	);
	
	register_taxonomy( 'media_tag', array( 'media' ), $taxonomy_media_tag_args );
}

?>
