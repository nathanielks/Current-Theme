<?php 
$curr_theme = get_theme_data(TEMPLATEPATH . '/style.css');
$theme_version = trim($curr_theme['Version']);
if(!$theme_version) $theme_version = "1.0";

//Define constants:
define('CUR_INC', TEMPLATEPATH . '/inc/');
define('CUR_FUNCTIONS', CUR_INC . 'functions/');
define('CUR_PLUGINS', CUR_INC . 'plugins/');
define('CUR_INCLUDES', CUR_INC . 'includes/');
define('CUR_THEME_DIR', get_template_directory_uri());
define('CUR_ASSETS',  CUR_THEME_DIR. '/assets/');
define('CUR_THEME', 'Current Theme');
//define('CUR_THEME_DOCS', CUR_THEME_DIR.'/functions/docs/docs.pdf');
//define('CUR_THEME_LOGO', CUR_THEME_DIR.'/functions/img/logo.png');
define('CUR_MAINMENU_NAME', 'general-options');
define('CUR_THEME_VERSION', $theme_version);

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri().'/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory().'/inc/meta-box' ) );

define( 'CUR_SHORTCODES_URI', trailingslashit( get_stylesheet_directory_uri().'/inc/plugins/ds-shortcodes' ) );

if ( ! defined( 'CUR_SHORTCODES_PATH' ) )
	define( 'CUR_SHORTCODES_PATH', dirname( __FILE__ ) );

//Define Options Framework paths
if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}


require_once RWMB_DIR.'meta-box.php';
require_once CUR_PLUGINS.'plugins.php';
require_once CUR_FUNCTIONS.'meta-boxes.php';
require_once CUR_FUNCTIONS.'theme-setup.php';
require_once CUR_FUNCTIONS.'theme-functions.php';
require_once CUR_FUNCTIONS.'scripts.php';
require_once CUR_FUNCTIONS.'sidebars.php';
require_once CUR_FUNCTIONS.'menus.php'; 
require_once CUR_FUNCTIONS.'post-types.php';
require_once CUR_INC.'widgets.php';

if (is_admin()) :
	require_once('admin/options-init.php');
endif;

//remove_filter('the_content', 'wpautop');
//remove_filter('the_excerpt', 'wpautop');
//remove_filter('the_excerpt', 'wptexturize');
//remove_filter('the_excerpt', 'wptexturize');
