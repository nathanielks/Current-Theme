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
$fscb_base_dir = 'http://dev.fightthecurrent.org/wp-content/themes/DesignaStudioOptions/plugins/friendly-shortcode-buttons/';

// setup the shortcode for use
function friendly_button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'blue',
	  'size' => 'medium',
      'style' => 'round',
      'align' => 'none',
      'text' => '',
      'url' => '',
      ), $atts ) );
		
	if($url) {
      return '<div class="friendly_button friendly_button_' . $size . ' friendly_button_' . $color . ' friendly_button_' . $style . ' friendly_button_' . $align . '"><a href="' . $url . '">' . $text . $content . '</a></div>';
	} else {
		return '<div class="friendly_button friendly_button_' . $size . ' friendly_button_' . $color . ' friendly_button_' . $style . ' friendly_button_' . $align . '">' . $text . $content . '</div>';
	}
}
add_shortcode('button', 'friendly_button_shortcode');

// load button css
function friendly_buttons_css() 
{
	global $fscb_base_dir;
	wp_enqueue_style('friendly-buttons', $fscb_base_dir . 'includes/css/friendly_buttons.css');
}
add_action('wp_print_styles', 'friendly_buttons_css');


// registers the buttons for use
function register_friendly_buttons($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "|", "friendly_button");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin");
		add_filter('mce_buttons', 'register_friendly_buttons');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_buttons');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_button'] = $fscb_base_dir . 'friendly-shortcode-buttons.js';
	return $plugin_array;
}
 

?>
