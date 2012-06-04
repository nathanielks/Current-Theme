<?php

/*
	Plugin Name: Navigation Menu IDs & Classes
	Plugin URI: http://aarontgrogg.com/2011/09/28/wordpress-plug-in-navigation-menu-ids-classes/
	Description: Removes extraneous WP classes, and adds page name slug as LI's ID.
	Version: 1.2
	Author: Aaron T. Grogg
	Author URI: http://aarontgrogg.com/
	License: GPLv2 or later
*/

/*
	Some day I'd like to create Admin screen to allow users to:
	1)	Make ID prefixes either context-aware (meaning the `nav-` prefix would change based on which Nav Menu was being built),
		or allow users to define their own prefix (but this would always be limited to a single menu occurance, to prevent dupe IDs...)
	2)	Create checkbox list of all possible native WP classes, allowing users to decide which to dis-/allow (currently hard-coded to
		only allow `current_page_item`).  Users can currently only allow other classes by hard-coding additional class names into the
		`$nmic_okayclasses` array in `admin-menu.php`.
*/

//	"Slugify" string
	function nmic_slugify_string( $v ) {
        $v = preg_replace('/[^a-zA-Z0-9\s]/', '', $v);
        $v = str_replace(' ', '-', $v);
        $v = strtolower($v);
        return $v;
    }

//	Global array of allowed classes
	$nmic_okayclasses = array('current_page_item');

//	Add page->slug as id attributes
	/*	Current lydoesn't work for standard menus, only custom menus.
		Core WP code blocks redundant IDs, which is good, but this means only one custom nav can have IDs...
		Probably useless at this point, the enhancements to nmic_limit_classes make it somewhat obselete,
		but I'm leaving it so I don't break any sites that are already using it.
	*/
    function nmic_add_id_attribute( $id, $item ) {
        return 'nav-'.nmic_slugify_string($item->title);
    }
    add_filter( 'nav_menu_item_id', 'nmic_add_id_attribute', 10, 2 );

//	Limit the nav classes to only the "current_page_item"
    function nmic_limit_classes( $oldclasses, $page ) { // $oldclasses = array of classes WP wants to append; $page = $page object
		global $nmic_okayclasses;
		$current = nmic_slugify_string(($page->post_type === 'page') ? $page->post_title : $page->title);
		$newclasses[] = $current;
		foreach($oldclasses as $class) {
			if (in_array($class, $nmic_okayclasses)) {
				$newclasses[] = $class;
			}
		}
        return $newclasses;
    }
	add_filter( 'page_css_class', 'nmic_limit_classes', 10, 2 ); // standard menus
    add_filter( 'nav_menu_css_class', 'nmic_limit_classes', 10, 2 ); // custom menus

?>
