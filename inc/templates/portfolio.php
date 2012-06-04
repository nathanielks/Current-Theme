<?php

	//Portfolio Posts query on main page
	global $wp_query;
	$temp = $wp_query;
	$wp_query = null;
	$args=array(
		'post_type' => 'portfolio',
	);
	$wp_query = new WP_Query($args);

	if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

	//Adds the name of the Skill to the Portfolio item as a class so it can 
	//be selected by the list of Skills on the left of the page
	$terms = get_the_terms( get_the_id(), 'portfolio_category');
	$output = '';

	if ($terms){
		foreach($terms as $term) {
			$output .= $term->slug; 
		}
	}

?>

	<figure class="portfolio-item <?php echo $output; ?>">

		<a href="<?php the_permalink(); ?>" >
			<?php ds_post_thumbnail(); ?>
			<span class="zoom"></span>
		</a>

		<figcaption>
			<a href="<?php the_permalink(); ?>" class="arrow"><?php the_title(); ?></a>
		</figcaption>

	</figure>

<?php endwhile; ?>
	
	<ul class="page-numbers"><?php ds_pagination(); ?></ul>

<?php else : ?>

	<h1>Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php 

	//End of the loop.
	endif; 

	//Resets $wp_query
	$wp_query = null; 
	$wp_query = $temp; //reset 
?>
