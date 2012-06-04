<?php

/*
 *Define your Shortcodes here
 */


function of_column_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'number' => 'empty'), $atts ));
	$output = '<div class="column two in">' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('column', 'of_column_shortcode');

function of_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'url' => '#', 'class' => '', 'target' => '_self' ), $atts ));
	$output = '<a href="' . $url . '" class="button ' . $class . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
	return $output;
}
add_shortcode('button', 'of_button_shortcode');

function of_toggle_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'title' => 'Toggle' ), $atts ));
	$output= '<h6 class="toggle">' . $title . '</h6>'
		.'<div class="t">'
		.'<p>' . do_shortcode($content) . '</p>'
		.'</div>';
	return $output;
}
add_shortcode('toggle', 'of_toggle_shortcode');

function of_warning_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'class' => '' ), $atts ));
	$output = '<p class="warning ' . $class . '">' . do_shortcode($content) . '</p>';
	return $output;
}
add_shortcode('warning', 'of_warning_shortcode');

function of_smalltext_shortcode( $atts, $content = null ) {
	$output = '<span class="small">' . do_shortcode($content) . '</span>';
	return $output;
}
add_shortcode('small', 'of_smalltext_shortcode');

//Tabs
function of_tabs_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'tabs' => 'empty' ), $atts ));
	if ($tabs == 'empty'){
		return;	
	}
	$output = '<ul class="tabs">';
	$tabs = explode(',', $tabs);
	foreach ($tabs as $tab){
		$tab_underscore = strtolower(str_replace(' ', '_', trim($tab)));
		$output .= '<li><a href="#' . $tab_underscore . '">' . $tab . '</a></li>';
	}
	$output .= '</ul>'
			.'<div class="tab_container">'
			. do_shortcode($content)
			.'</div>';
	
	return $output;
}
add_shortcode('tabs', 'of_tabs_shortcode');

function of_tab_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'title' => 'empty' ), $atts ));
	if ($title == 'empty'){
		return;	
	}
	$title_underscore = strtolower(str_replace(' ', '_', trim($title)));
	$output = '<div id="' . $title_underscore . '" class="tab_content">'
				.'<p>' . do_shortcode($content) . '</p>'
			.'</div>';
	return $output;
}
add_shortcode('tab', 'of_tab_shortcode');
