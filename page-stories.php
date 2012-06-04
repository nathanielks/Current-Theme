<?php 
/*
 * Template Name: Custom Post Type
 */

get_header(); ?>

				<ul class="row mbottom-large center-list">
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
					'media_category' => 'story',
					'posts_per_page' => -1,
					'paged' => $paged,
					'orderby' => 'ID',
				);
				$wp_query = new WP_Query($args);

				$title_class = title_to_class( get_the_title() );
				$i = 0;

				if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				
					if ($i % 4 == 0 && $i !== 0) {
						echo '</ul>';
						echo '<ul class="row mbottom-large center-list">';
					}

				?>

						<li id="post-<?php echo $title_class; ?>" <?php post_class($title_class.' recent-post'); ?>>

								<a href="<?php the_permalink(); ?>">
									<?php ds_post_thumbnail('small'); ?>
								</a>

								<p>
									<?php the_title(); ?>
								</p>
						</li>



					<?php 
						$i++;
						endwhile; 
					?>
					</ul>
					<hr>
					<div class="row">
						<?php ds_pagination(); ?>
					</div><!-- /.row -->

<?php 
						endif;
						//Resets $wp_query
						$wp_query = null; 
						$wp_query = $temp; //reset 
						wp_reset_query();
?>


<?php get_footer(); ?>
