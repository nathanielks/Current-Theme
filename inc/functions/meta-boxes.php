<?php
/********************* META BOXES DEFINITION ***********************/

/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = 'cur_';
global $meta_boxes;
$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'subcontent',
	'title' => __('Additional Content', 'current'),
	'pages' => array( 'page' ),

	'fields' => array(
		array(
			'name' => __( 'Subcontent', 'current' ),
			'id' => $prefix . 'page_subcontent',
			'type' => 'wysiwyg',
		),
	)
);


// Hook to 'admin_init' to make sure the meta box class is loaded before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'cur_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function cur_register_meta_boxes()
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
