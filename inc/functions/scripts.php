<?php 

add_action('wp_enqueue_scripts', 'register_theme_libs');
function register_theme_libs() {


	wp_deregister_script('jquery');
	if (WP_ENV == 'local') {
		wp_enqueue_script('jquery', CUR_ASSETS.'js/libs/jquery-1.7.2.min.js', array(), '1.7.2', true);
	}
	else{
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array(), NULL, true);
	}
	wp_enqueue_script('modernizr', CUR_ASSETS.'js/libs/modernizr-2.5.3.min.js', array(), '2.5.3', false);

	$slides = new WP_Query(array( 'post_type' => 'slide' ));
	if ($slides->have_posts()) {
		wp_enqueue_script('flexslider', CUR_ASSETS . 'js/libs/jquery.flexslider-min.js', array('jquery'), NULL, true);
	}

	//Styles
	wp_enqueue_style('current', CUR_ASSETS . 'css/style.css', array(), NULL);
}


add_action('wp_enqueue_scripts', 'register_theme_scripts');
function register_theme_scripts() {
		wp_enqueue_script('theme-scripts', CUR_ASSETS . 'js/scripts.js', array('jquery'), NULL, true);
}

function cur_deregister_conflicts(){
    wp_deregister_style('ai1ec-calendar');
    wp_deregister_style('ai1ec-event');
}
//add_action('wp_enqueue_scripts', 'cur_deregister_conflicts', 999);

add_action('admin_enqueue_scripts', 'cur_admin_enqueue_scripts');
function cur_admin_enqueue_scripts(){

    global $pagenow;
    if ( !empty($_GET['post'] ) ) {
        $post = get_post($_GET['post']);
    }

	if (is_admin()) {
		if ($pagenow=='post-new.php' OR $pagenow=='post.php') { 
			wp_enqueue_script('jquery');
			wp_enqueue_script('cur-admin-scripts', CUR_ASSETS . "js/admin-scripts.js",array('jquery'));
		}
	}

}

