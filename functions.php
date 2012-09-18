<?php 
$curr_theme = wp_get_theme();
$theme_version = trim($curr_theme['Version']);
if(!$theme_version) $theme_version = "1.0";

$uploads_dir = wp_upload_dir();

//Define constants:
define('CUR_INC', TEMPLATEPATH . '/inc/');
define('CUR_CLASSES', CUR_INC . 'classes/');
define('CUR_FUNCTIONS', CUR_INC . 'functions/');
define('CUR_PLUGINS', CUR_INC . 'plugins/');
define('CUR_SHORTCODES', CUR_INC . 'shortcodes/');
define('CUR_THEME_DIR', get_template_directory_uri());
define('CUR_ASSETS',  CUR_THEME_DIR. '/assets/');
define('CUR_THEME', 'Current Theme');
define('CUR_UPLOADS_URL', $uploads_dir['baseurl']);
define('CUR_MAINMENU_NAME', 'general-options');
define('CUR_THEME_VERSION', $theme_version);


require_once CUR_CLASSES.'jw_custom_posts.php';
require_once CUR_PLUGINS.'plugins.php';
require_once CUR_FUNCTIONS.'meta-boxes.php';
require_once CUR_FUNCTIONS.'theme-setup.php';
require_once CUR_FUNCTIONS.'theme-functions.php';
require_once CUR_FUNCTIONS.'scripts.php';
require_once CUR_FUNCTIONS.'sidebars.php';
require_once CUR_FUNCTIONS.'menus.php'; 
require_once CUR_FUNCTIONS.'post-types.php';
//require_once CUR_FUNCTIONS.'post-connections.php';
require_once CUR_INC.'widgets/widgets.php';
