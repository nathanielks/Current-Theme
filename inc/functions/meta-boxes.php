<?php
/********************* META BOXES DEFINITION ***********************/

/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = 'hu_';
global $meta_boxes;
$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'slide_details',
	'title' => 'Slide Details',
	'pages' => array( 'slide' ),

	'fields' => array(
		array(
			'name' => 'Slide Content',
			'id' => $prefix . 'slide_content',
			'type' => 'wysiwyg'
		),
		array(
			'name' => 'Slide Classes',
			'id' => $prefix . 'slide_classes',
			'type' => 'text'                 
		),
		array(
			'name' => 'Extra Markup',
			'id' => $prefix . 'extra_markup',
			'type' => 'textarea',
		),
	)
);

$meta_boxes[] = array(
	'id' => 'slide_details',
	'title' => 'Slide Details',
	'pages' => array( 'five-for-ten' ),

	'fields' => array(
		array(
			'name' => 'Five for Ten Content',
			'id' => $prefix . 'f4f_content',
			'type' => 'wysiwyg'
		),
		array(
			'name' => 'Donate link',
			'id' => $prefix . 'donate_link',
			'type' => 'text'                 
		),
	)
);

$meta_boxes[] = array(
	'id' => 'slides',
	'title' => 'Slides',
	'pages' => array( 'page' ),

	'fields' => array(
		array(
			'name' => 'Slides',
			'id' => $prefix . 'slides',
			'type' => 'text' 
		),
	)
);

$meta_boxes[] = array(
	'id' => 'media_details',
	'title' => 'Media Details',
	'pages' => array( 'media' ),

	'fields' => array(
		array(
			'name' => 'Media HTML',
			'id' => $prefix . 'media_html',
			'type' => 'wysiwyg' 
		),
		array(
			'name' => 'Media Description',
			'id' => $prefix . 'media_desc',
			'type' => 'wysiwyg' 
		),
	)
);
// Hook to 'admin_init' to make sure the meta box class is loaded before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'ds_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function ds_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
