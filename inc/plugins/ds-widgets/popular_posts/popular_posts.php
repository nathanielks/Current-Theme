<?php
/*
Popular Posts: TODO
Plugin URI: TODO
Description: TODO
Version: 1.0
Author: TODO
Author URI: TODO
Author Email: TODO
License:

  Copyright 2011 TODO (email@domain.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class ds_Popular_Posts_Widget extends WP_Widget {


	const name = 'Popular Posts';
	const locale = 'popular-posts-locale';
	const slug = 'popular_posts';
	

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function ds_Popular_Posts_Widget() {

		load_plugin_textdomain( self::locale, false, plugin_dir_path( __FILE__ ) . '/lang/' );

		$widget_opts = array(
			'classname' => self::name, 
			'description' => __('Displays a list of popular posts by page view', self::locale)
		);	
		$this->WP_Widget( self::slug, __( self::name, self::locale ), $widget_opts );
		
    	// Load JavaScript and stylesheets
    	$this->register_scripts_and_styles();
		
	} // end constructor

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
		
		echo $before_widget;
		
		$title = empty($instance['title']) ? '' : apply_filters('title', $instance['title']);
		$number_of_posts = empty($instance['number_of_posts']) ? 6 : apply_filters('number_of_posts', $instance['number_of_posts']); 
		
		// Display the widget
		include( plugin_dir_path(__FILE__) . '/views/widget.php' );
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags(stripslashes($new_instance['title'])); 
		$instance['number_of_posts'] = strip_tags(stripslashes($new_instance['number_of_posts']));
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form( $instance ) {
	
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '',
				'number_of_posts' => ''
			)
		);
	
		$title = strip_tags(stripslashes($new_instance['title']));
		$number_of_posts = strip_tags(stripslashes($new_instance['number_of_posts']));

		// Display the admin form
    	include( plugin_dir_path(__FILE__) . '/views/admin.php' );
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
			$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
		} else { 
			$this->load_file( self::slug . '-script', '/js/widget.js', true );
			$this->load_file( self::slug . '-style', '/css/widget.css' );
		} // end if/else
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {
		
		$url = DS_WIDGETS . '/' . self::slug . '/' . $file_path;
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') );
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if
    
	} // end load_file
	
} // end class
add_action( 'widgets_init', create_function( '', 'register_widget("ds_Popular_Posts_Widget");' ) ); 
?>
