<?php

add_action('after_setup_theme', 'of_setup_theme');
function of_setup_theme(){
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(222, 137, TRUE);
	add_image_size('grid2', 140, 78, TRUE);
	add_image_size('grid3', 208, 127, TRUE);
	add_image_size('grid4', 288, 168, TRUE);
	add_image_size('small', 178, 107, TRUE);
	add_image_size('blog', 250, 250, TRUE);
	add_image_size('blog-wide', 700, 250, TRUE);
	add_image_size('featured-image', 525, 284, TRUE);
	add_filter('the_generator', 'wp_remove_version');
	add_filter('login_errors',create_function('$a', "return null;"));
	//remove_filter('the_content', 'wpautop');
	add_editor_style();

	function roots_head_cleanup() {
	  // http://wpengineer.com/1438/wordpress-header/
	  remove_action('wp_head', 'feed_links', 2);
	  remove_action('wp_head', 'feed_links_extra', 3);
	  remove_action('wp_head', 'rsd_link');
	  remove_action('wp_head', 'wlwmanifest_link');
	  remove_action('wp_head', 'index_rel_link');
	  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	  remove_action('wp_head', 'start_post_rel_link', 10, 0);
	  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	  remove_action('wp_head', 'wp_generator');
	  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	  //remove_action('wp_head', 'noindex', 1);
	  //add_action('wp_head', 'roots_noindex');
	  //add_action('wp_head', 'roots_remove_recent_comments_style', 1);
	  //add_filter('gallery_style', 'roots_gallery_style');

	  //if (!class_exists('WPSEO_Frontend')) {
		//remove_action('wp_head', 'rel_canonical');
		//add_action('wp_head', 'roots_rel_canonical');
	  //}
	}

	add_action('init', 'roots_head_cleanup');

	function enable_more_buttons($buttons) {
	  $buttons[] = 'hr';
	 
	  /* 
	  Repeat with any other buttons you want to add, e.g.
		  $buttons[] = 'fontselect';
		  $buttons[] = 'sup';
	  */
	 
	  return $buttons;
	}
	add_filter("mce_buttons", "enable_more_buttons");

	/*
	 * OpenGraph Meta for WordPress
	 * @author Mathias Schopmans
	 * @link http://rheinschafe.de
	 *
	 */

	// set xmlns namespaces in head
	add_action('language_attributes', 'open_graph_language_attributes');
	function open_graph_language_attributes($attributes){
	  $attributes .= ' ';
	  $attributes .= 'xmlns:og="http://ogp.me/ns#" ';
	  $attributes .= 'xmlns:fb="http://www.facebook.com/2008/fbml" ';
	  return $attributes;
	}

	// return the data as array
	function get_open_graph_meta(){ 
	  $og_data = array(
		'fb:app_id' => apply_filters('og_app_id', '328534607204127'),
		'fb:page_id' => apply_filters('fb_page_id', '115086935188056'),
		'og:site_name' => get_bloginfo('name'),
		'og:locale' => 'de_DE',
		'og:type' => is_single() ? 'article' : 'website',
		'og:url' => is_single() ? get_permalink() : home_url('/'),
		'og:title' => is_single() ? get_the_title() : get_bloginfo('name'),
	  );
	  
	  if(is_single() && $post_thumbnail_id = get_post_thumbnail_id()){
		$image = wp_get_attachment_image_src($post_thumbnail_id, apply_filters('og_image_size', 'post-thumbnail'));
		if(isset($image[0])){
		  $og_data['og:image'] = $image[0];
		  $og_data['og:image:width'] = $image[1];
		  $og_data['og:image:height'] = $image[2];
		}
	  }
	  
	  // run them through a filter so plugins can easily manipulate them.
	  // e.g. add_filter('open_graph_meta', 'manipulate_og');
	  return apply_filters('open_graph_meta', $og_data);
	}

	// echo 'em in wp_head
	add_action('wp_head', 'the_open_graph_meta');
	function the_open_graph_meta(){
	  foreach(get_open_graph_meta() as $k => $v ){
		echo '<meta property="'.$k.'" content="'.$v.'" />' . "\n";
	  }
	}	

}
