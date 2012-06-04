<?php
/*
Plugin Name: Friendly Short Code Buttons
Plugin URI: http://pippinsplugins.com
Description: Adds user-friendly short code buttons to your  WordPress site. This plugin is more of an example than anything, but does provide a few nice looking buttons
Version: 1.0.1
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
*/
 
// plugin root folder
//$fscb_base_dir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));
$fscb_base_dir = 'http://dev.fightthecurrent.org/wp-content/themes/DesignaStudioOptions/plugins/ds-shortcode-buttons/';

//load shortcodes
require_once('shortcodes.php');

// load button css
function ds_shortcode_buttons_css() {
	global $fscb_base_dir;
	wp_enqueue_style('ds-shortcode-buttons', $fscb_base_dir . 'includes/css/ds-shortcode-buttons.css');
}
add_action('wp_print_styles', 'ds_shortcode_buttons_css');


// registers the buttons for use
function register_ds_shortcode_buttons($buttons) {
	// inserts a separator between existing buttons and our new one
	// "ds_shortcode_button" is the ID of our button
	array_push($buttons, '|', 'column', 'button', 'toggle', 'warning', 'small', 'tabs', 'tab');
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function ds_shortcode_shortcode_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter('mce_external_plugins', 'add_ds_shortcode_tinymce_plugin');
		add_filter('mce_buttons', 'register_ds_shortcode_buttons');
	}
}
// init process for button control
add_action('init', 'ds_shortcode_shortcode_buttons');

// add the button to the tinyMCE bar
function add_ds_shortcode_tinymce_plugin($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['ds_shortcode_buttons'] = $fscb_base_dir . 'ds_shortcode_plugin.js';
	return $plugin_array;
}
 

?>
