<?php

function cur_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'link' => '',
		'color' => '',
		'size' => '',
		'class' => '',
	), $atts ) );
	return '<a href="' . addhttp( $link ) . '" class="button ' . $color . ' ' . $size . ' ' . $class . '">' . do_shortcode($content) . '</a>';
}

function cur_small( $atts, $content = null ) {
	return '<small>' . do_shortcode($content) . '</small>';
}