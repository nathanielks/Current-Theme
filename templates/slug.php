<?php 
/*
 * Template Name: Custom Post Type
 */

get_header();


//Sets up pagination
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

global $wp_query;
$temp = $wp_query;
$wp_query = null;
$args=array(
	'post_type' => 'custom',
	'custom_category' => 'cat_name',
	'posts_per_page' => -1,
	'paged' => $paged,
	'orderby' => 'ID',
);
$wp_query = new WP_Query($args);

$i = 0;

if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 

//Query stuff goes here

endwhile; 
ds_pagination(); //Goes between endwhile and endif to work


endif;
//Resets $wp_query
$wp_query = null; 
$wp_query = $temp; //reset 
wp_reset_query();


get_footer();
