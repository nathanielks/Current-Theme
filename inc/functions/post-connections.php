<?php


function cur_register_connections(){

	p2p_register_connection_type( array(
		'name' => '',
		'from' => '',
		'to' => '',
		//'to_query_vars' => array( 'role' => 'editor' )
	) );

}

add_action('p2p_init', 'cur_register_connections');
