<?php 

add_action('wp_enqueue_scripts', 'register_theme_libs');
function register_theme_libs() {

		wp_deregister_script('jquery');
		if ( !is_page( 23 ) ){
			wp_deregister_script('jquery-form');
		}
		wp_enqueue_script('jquery', DS_ASSETS . 'js/jquery.min.js', array(), NULL, true);

		global $post;
		$slides = explode(' ', get_post_meta($post->ID,'hu_slides', TRUE));
		$slides_count = count($slides);
		if ( $slides_count > 1 ){
			wp_enqueue_script('flexslider', DS_ASSETS . 'js/jquery.flexslider-min.js', array('jquery'), NULL, true);
		}


		wp_enqueue_script('modernizr', DS_ASSETS.'js/modernizr.js', array(), NULL, false);
		//wp_enqueue_script('theme-libs', DS_ASSETS.'js/libs.min.js', array(), NULL, true);
		//wp_enqueue_script('bootstrap-transition', DS_ASSETS.'js/bootstrap/bootstrap-transition.js', array(), NULL, true);
		//wp_enqueue_script('bootstrap-collapse', DS_ASSETS.'js/bootstrap/bootstrap-collapse.js', array(), NULL, true);
		//wp_enqueue_script('bootstrap-dropdown', DS_ASSETS.'js/bootstrap/bootstrap-dropdown.js', array(), NULL, true);
		//wp_enqueue_script('dropdown', DS_ASSETS.'js/dropdown.js', array(), NULL, true);
		
}

add_action('wp_enqueue_scripts', 'register_scrollto');
function register_scrollto() {
		if ( is_page( 11 ) || is_page( 57 ) ){
		
			wp_enqueue_script('scrollto', DS_ASSETS . 'js/jquery.scrollTo.js', array('jquery'), NULL, true);
			wp_enqueue_script('localscroll', DS_ASSETS . 'js/jquery.localScroll.js', array('scrollto'), NULL, true);

		}
}

add_action('wp_enqueue_scripts', 'register_five_for_ten');
function register_five_for_ten() {
		if ( is_page( 57 ) ){
		
			wp_enqueue_script('bootstrap-tooltip', DS_ASSETS.'js/bootstrap/bootstrap-tooltip.js', array(), NULL, true);
			
		}
}

add_action('wp_enqueue_scripts', 'register_leaflet_scripts');
function register_leaflet_scripts() {
		if ( is_page( 11 ) ){
			//Scripts
			wp_enqueue_script('leaflet-js', DS_ASSETS . 'js/leaflet.js', array(), NULL, true);
			wp_enqueue_script('tile-stamen-js', DS_ASSETS . 'js/tile.stamen.js', array(), NULL, true);
			wp_enqueue_script('leaflet-init', DS_ASSETS . 'js/leaflet-init.js', array('localscroll'), NULL, true);

			//Styles
			wp_enqueue_style('leaflet-css', DS_ASSETS . 'css/leaflet.css', array(), NULL, false);
			wp_enqueue_style('leaflet-css-ie', DS_ASSETS . 'css/leaflet.ie.css', array(), NULL, false);
			$GLOBALS['wp_styles']->add_data( 'leaflet-css-ie', 'conditional', 'lte IE 8' );
		
		}
}

//add_action('wp_enqueue_scripts', 'register_theme_scripts');
function register_theme_scripts() {
		wp_enqueue_script('theme-scripts', DS_ASSETS . 'js/scripts.js', array('jquery'), NULL, true);
}
