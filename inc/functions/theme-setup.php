<?php

add_action('after_setup_theme', 'of_setup_theme');
function of_setup_theme(){
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(242, 229, TRUE);
	add_image_size('featured-image', 1280, 450, TRUE);
	add_filter('the_generator', 'wp_remove_version');
	add_filter('login_errors',create_function('$a', "return null;"));
	//remove_filter('the_content', 'wpautop');
	add_editor_style();

	function cur_excerpt_more($more) {
		return '...';
	}
	add_filter('excerpt_more', 'cur_excerpt_more');

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
	}

	add_action('init', 'roots_head_cleanup');

	//move wpautop filter to AFTER shortcode is processed
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	add_filter( 'the_content', 'shortcode_unautop',100 );


}
