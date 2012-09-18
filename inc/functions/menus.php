<?php
//Register Menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(
			array(
				'primary' => __( 'Primary', 'current' ),
				'social' => __( 'Social', 'current' ),
				'footer' => __( 'Footer', 'current' ),
				
			)
		);
}

get_template_part('inc/classes/walker-bootstrap-nav-menu');
get_template_part('inc/classes/walker-mv-cleaner');
get_template_part('inc/classes/walker-extract-current-submenu');
