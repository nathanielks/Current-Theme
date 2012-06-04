<?php 
	echo $before_title;
    echo esc_html( trim($instance['title'] ));
	echo $after_title;


	$args=array(
		'meta_key' => 'ds_post_views_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'post_type' => 'post',
		'posts_per_page' => $number_of_posts,
	);
?>	
		<ul>
<?php base_display_popular_posts(); ?>
		</ul>
<?php 


/**
 * Popular posts display
 * Courtesy Kevin Leary, http://www.kevinleary.net/track-display-popular-posts-wordpress/
 * Display a list of popular posts without the containing element (just LI's)
 *
 * @param $size The number of posts to display
 */
function base_display_popular_posts( $size = 8 ) {
	// Query arguments
	$popular_args = array(
		'posts_per_page' => $size,
		'meta_key' => '_base_popular_posts_count',
		'orderby' => 'meta_value_num'
	);
 
	// The query
	$popular_posts = new WP_Query( $popular_args );
 
	// The loop
	while ( $popular_posts->have_posts() ) : $popular_posts->the_post();
		echo '<li><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></li>';
	endwhile;
 
	// Reset post data
	wp_reset_postdata();
}
