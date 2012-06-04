<?php
$terms = get_terms('media_category', array('orderby' => 'id'));
	foreach ( $terms as $term ) {
?>
<h2 class="alignleft"><?php echo $term->name . 'S'; ?></h2>
<section class="alignleft row">
	<div class="span12">
			<ul class="row mbottom-large no-list-style list-left">
			<?php

			//Sets up pagination
			$paged = 1;
			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			if ( get_query_var('page') ) $paged = get_query_var('page');

			global $wp_query;
			$temp = $wp_query;
			$wp_query = null;
			$args=array(
			'post_type' => 'media',
			'media_category' => $term->slug,
			'posts_per_page' => 4,
			'paged' => $paged,
			'orderby' => 'ID',
			);
			$wp_query = new WP_Query($args);

			$title_class = title_to_class( get_the_title() );

			if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 

			?>

			<li id="post-<?php echo $title_class; ?>" <?php post_class($title_class.' span3'); ?>>
				<div class="media-thumb">
					<a href="<?php the_permalink(); ?>">
						<?php ds_post_thumbnail('grid3'); ?>
						<p>
							<span class="arrow"><img src="<?php echo DS_ASSETS; ?>img/arrow-orange.png"></span><span class="title"><?php the_title(); ?></span>
						</p>
				</a>
				</div>
			</li>



			<?php 
			endwhile; 
			?>
			</ul>

			<?php 
			endif;
			//Resets $wp_query
			$wp_query = null; 
			$wp_query = $temp; //reset 
			?>
		<div class="alignright btn btn-orange">
			<a href="<?php echo home_url() . '/' . $term->slug . 's/'; ?>">View All</a>
		</div>
	</div>
</section>
<?php } ?>
