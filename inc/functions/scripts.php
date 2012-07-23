<?php 

add_action('wp_enqueue_scripts', 'register_theme_libs');
function register_theme_libs() {

		wp_deregister_script('jquery');
		if ( !is_page( 23 ) ){
			wp_deregister_script('jquery-form');
		}
		wp_enqueue_script('jquery', DS_ASSETS . 'js/libs/jquery-1.7.2.min.js', array(), NULL, true);

		global $post;
		$slides = explode(' ', get_post_meta($post->ID,'cur_slides', TRUE));
		$slides_count = count($slides);
		if ( $slides_count > 1 ){
			wp_enqueue_script('flexslider', DS_ASSETS . 'js/jquery.flexslider-min.js', array('jquery'), NULL, true);
		}


		wp_enqueue_script('modernizr', DS_ASSETS.'js/libs/modernizr-2.5.3.min.js', array(), '2.5.3', false);
		
}

add_action('wp_enqueue_scripts', 'register_scrollto');
function register_scrollto() {
		if ( is_page( 11 ) || is_page( 57 ) ){
		
			wp_enqueue_script('scrollto', DS_ASSETS . 'js/jquery.scrollTo.js', array('jquery'), NULL, true);
			wp_enqueue_script('localscroll', DS_ASSETS . 'js/jquery.localScroll.js', array('scrollto'), NULL, true);

		}
}

//add_action('wp_enqueue_scripts', 'register_theme_scripts');
function register_theme_scripts() {
		wp_enqueue_script('theme-scripts', DS_ASSETS . 'js/scripts.js', array('jquery'), NULL, true);
}
