<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them CAREFULLY
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/**
 * Add field type: 'taxonomy'
 *
 * Note: The class name must be in format "RWMB_{$field_type}_Field"
 */
if ( !class_exists( 'RWMB_Taxonomy_Field' ) )
{
	class RWMB_Taxonomy_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_print_styles()
		{
			wp_enqueue_style( 'rwmb-taxonomy', RWMB_CSS_URL . 'taxonomy.css', RWMB_VER );
			wp_enqueue_script( 'rwmb-taxonomy', RWMB_JS_URL . 'taxonomy.js', array( 'jquery', 'wp-ajax-response' ), RWMB_VER, true );
		}

		/**
		 * Add default value for 'taxonomy' field
		 *
		 * @param $field
		 *
		 * @return array
		 */
		static function normalize_field( $field )
		{
			// Default query arguments for get_terms() function
			$default_args = array(
				'hide_empty' => false
			);
			if ( !isset( $field['options']['args'] ) )
				$field['options']['args'] = $default_args;
			else
				$field['options']['args'] = wp_parse_args( $field['options']['args'], $default_args );

			// Show field as checkbox list by default
			if ( !isset( $field['options']['type'] ) )
				$field['options']['type'] = 'checkbox_list';

			// If field is shown as checkbox list, add multiple value
			if ( 'checkbox_list' == $field['options']['type'] ||  'checkbox_tree' == $field['options']['type'])
				$field['multiple'] = true;

			if('checkbox_tree' == $field['options']['type'] && !isset( $field['options']['args']['parent'] ) )
				$field['options']['args']['parent'] = 0;

			return $field;
		}

		/**
		 * Get field HTML
		 *
		 * @param $html
		 * @param $field
		 * @param $meta
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			global $post;

			$options = $field['options'];

			$meta = wp_get_post_terms( $post->ID, $options['taxonomy'], array( 'fields' => 'ids' ) );
			$meta = is_array( $meta ) ? $meta : ( array ) $meta;
			$terms = get_terms( $options['taxonomy'], $options['args'] );

			$html = '';
			// Checkbox_list
			if ( 'checkbox_list' == $options['type'] )
			{
				foreach ( $terms as $term )
				{
					$html .= "<input type='checkbox' name='{$field['id']}[]' value='{$term->term_id}'" . checked( in_array( $term->term_id, $meta ), true, false ) . " /> {$term->name}<br/>";
				}
			}
			//Checkbox Tree
			elseif ( 'checkbox_tree' == $options['type'] )
			{
				$html .= self::walk_checkbox_tree($meta, $field, true);
			}
			// Select
			else
			{
				$html .= "<select name='{$field['id']}" . ( $field['multiple'] ? "[]' multiple='multiple' style='height: auto;'" : "'" ) . ">";
				foreach ( $terms as $term )
				{
					$html .= "<option value='{$term->term_id}'" . selected( in_array( $term->term_id, $meta ), true, false ) . ">{$term->name}</option>";
				}
				$html .= "</select>";
			}

			return $html;
		}

		/**
		 * Walker for displaying checkboxes in treeformat
		 *
		 * @param $meta
		 * @param $field
		 * @param bool $active
		 *
		 * @return string
		 */
		static function walk_checkbox_tree( $meta, $field, $active = false )
		{
			$options = $field['options'];
			$terms = get_terms( $options['taxonomy'], $options['args'] );
			$count = count($terms);
			$html = '';
			$hidden = ( !$active ? 'hidden' : '' );
			if ( $count > 0 )
			{
				$html = "<ul class = 'rw-taxonomy-tree {$hidden}'>";
				foreach ( $terms as $term )
				{
					$html .= "<li> <input type='checkbox' name='{$field['id']}[]' value='{$term->term_id}'" . checked( in_array( $term->term_id, $meta ), true, false ) . disabled($active,false,false) . " /> {$term->name}";
					$field['options']['args']['parent'] = $term->term_id;
					$html .= self::walk_checkbox_tree($meta, $field, (in_array( $term->term_id, $meta))) . "</li>";
				}
				$html .= "</ul>";
			}
			return $html;
		}

		/**
		 * Save post taxonomy
		 * @param $post_id
		 * @param $field
		 * @param $old
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field )
		{
			wp_set_post_terms( $post_id, $new, $field['options']['taxonomy'] );
		}
	}
}

/********************* META BOXES DEFINITION ***********************/

/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = '_';

global $meta_boxes;

$meta_boxes = array();

// First meta box
$meta_boxes[] = array(
	'id' => 'personal',                   // Meta box id, unique per meta box
	'title' => 'Personal Information',    // Meta box title
	'pages' => array( 'post', 'slider' ), // Post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',                // Where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',                 // Order of meta box: high (default), low; optional

	'fields' => array(                    // List of meta fields
		array(
			'name' => 'Full name',          // Field name
			'desc' => 'Format: First Last', // Field description, optional
			'id' => $prefix . 'fname',      // Field id, i.e. the meta key
			'type' => 'text',               // Field type: text box
			'std' => 'Anh Tran'             // Default value, optional
		),
		array(
			'name' => 'DOB',
			'id' => $prefix . 'dob',
			'type' => 'date',               // File type: date
			'format' => 'd MM, yy'          // Date format, default yy-mm-dd. Optional. See: http://goo.gl/po8vf
		),
		array(
			'name' => 'Gender',
			'id' => $prefix . 'gender',
			'type' => 'radio',              // File type: radio box
			'options' => array(             // Array of 'key' => 'value' pairs for radio options. Note: the 'key' is stored in meta field, not the 'value'
				'm' => 'Male',
				'f' => 'Female'
			),
			'std' => 'm',
			'desc' => 'Need an explaination?'
		),
		array(
			'name' => 'Bio',
			'desc' => 'What\'s your professions? What you\'ve done?',
			'id' => $prefix . 'bio',
			'type' => 'textarea',           // File type: textarea
			'std' => 'I\'m a WP developer and a freelancer from Vietnam.',
			'style' => 'width: 200px; height: 100px'
		),
		array(
			'name' => 'Where do you live?',
			'id' => $prefix . 'place',
			'type' => 'select',             // File type: select box
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'usa' => 'USA',
				'vn' => 'Vietnam'
			),
			'multiple' => true,             // Select multiple values, optional. Default is false.
			'std' => array( 'vn' ),         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => 'Select the current place, not in the past'
		),
		array(
			'name' => 'About WordPress',    // File type: checkbox
			'id' => $prefix . 'love_wp',
			'type' => 'checkbox',
			'desc' => 'I love WordPress',
			'std' => 1                      // Value can be 0 or 1
		),
		array(
			'id' => $prefix . 'invisible',
			'type' => 'hidden',             // File type: hidden
			'std' => 'no, i\m visible',     // Hidden field must have predefined value
		),
		array(
			'name' => 'Your favorite password',
			'id' => $prefix . 'pass',
			'type' => 'password',           // File type: password
		),
		array(
			'name' => 'Categories',
			'id' => $prefix . 'cats',
			'type' => 'taxonomy',           // File type: taxonomy
			'options' => array(
				'taxonomy' => 'category',   // Taxonomy name
				'type' => 'checkbox_list',  // How to show taxonomy: 'checkbox_list' (default) or 'select'. Optional
				'args' => array(),          // Additional arguments for get_terms() function
			),
			'desc' => 'Choose One Category'
		)
	)
);

// Second meta box
$meta_boxes[] = array(
	'id' => 'additional',
	'title' => 'Additional Information',
	'pages' => array( 'post', 'film', 'slider' ),

	'fields' => array(
		array(
			'name' => 'Your thoughts about Deluxe Blog Tips',
			'id' => $prefix . 'thoughts',
			'type' => 'wysiwyg',             // Field type: WYSIWYG editor
			'std' => '<b>It\'s great!</b>',
			'desc' => 'Do you think so?',
		),
		array(
			'name' => 'Upload your source code',
			'desc' => 'Any modified code, or extending code',
			'id' => $prefix . 'code',
			'type' => 'file'                 // Field type: file upload
		),
		array(
			'name' => 'Screenshots',
			'desc' => 'Screenshots of problems, warnings, etc.',
			'id' => $prefix . 'screenshot',
			'type' => 'image'                // Field type: image upload
		),
		array(
			'name' => 'Screenshots (plupload)',
			'desc' => 'Screenshots of problems, warnings, etc.',
			'id' => $prefix . 'screenshot2',
			'type' => 'plupload_image'       // Field type: plupload image upload
		)
	)
);

// Third meta box
$meta_boxes[] = array(
	'id' => 'survey',
	'title' => 'Survey',
	'pages' => array( 'post', 'slider', 'page' ),

	'fields' => array(
		array(
			'name' => 'Your favorite color',
			'id' => $prefix . 'color',
			'type' => 'color'                // Field type: color
		),
		array(
			'name' => 'Your hobby',
			'id' => $prefix . 'hobby',
			'type' => 'checkbox_list',       // Field type: checkbox list
			'options' => array(              // Options of checkboxes, in format 'key' => 'value'
				'reading' => 'Books',
				'sport' => 'Gym, Boxing'
			),
			'desc' => 'What do you do in free time?'
		),
		array(
			'name' => 'When do you get up?',
			'id' => $prefix . 'getdown',
			'type' => 'time',                // Field type: time
			'format' => 'hh:mm:ss'           // Time format, default hh:mm. Optional. See: http://goo.gl/hXHWz
		),
		array(
			'name' => 'When were you born?',
			'id' => $prefix . 'born_time',
			'type' => 'datetime',            // Field type: datetime
			'format' => 'hh:mm:ss'           // Time format, default hh:mm. Optional. See: http://goo.gl/hXHWz
		)
	)
);

// Hook to 'admin_init' to make sure the meta box class is loaded before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'your_prefix_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function your_prefix_register_meta_boxes()
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