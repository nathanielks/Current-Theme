<?php

$args = array(
	'post_type' => 'slide',
	'posts_per_page' => -1,
);

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
?>

<section id="home-slider" class="clearfix">
	<div class="flex-container">
		<div id="slider-image" class="flexslider">
			<ul class="slides">

				<?php // Slide Image
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$title_class = sanitize_title( get_the_title() );
				?>

				<li id="slide-<?php echo $title_class; ?>-image" <?php post_class('slide'); ?>>
					<?php cur_post_thumbnail('featured-image');  ?>
				</li>

				<?php endwhile; ?>

			</ul>
		</div><!-- /#slider-image --> 
		<div id="slider-body">
			<div class="flexslider-container">
				<div class="flexslider">
					<ul class="slides">

						<?php // Slide Body
						while ( $the_query->have_posts() ) : $the_query->the_post();

						?>

						<li id="slide-<?php echo $title_class; ?>-body" <?php post_class('slide'); ?>>
							<a class="slide-link" href="<?php the_permalink();?>">
								<h2><?php the_title(); ?></h2>
								<div class="slide-content">
									<?php echo cur_excerpt(25); ?>
								</div>
							</a>
						</li>

						<?php endwhile; ?>

					</ul>
				</div><!-- /.flexslider -->
				<div class="flex-nav-container clearfix">
					<span class="button small hide no-bs">Hide</span>
					<div class="flex-nav">
						<ol class="flex-control-nav">
						<?php // Slide Navigation
						while ( $the_query->have_posts() ) : $the_query->the_post();
						?>
							<li><a>.</a></li>
						<?php endwhile; ?>
						</ol>
					</div>
				</div><!-- /.flex-nav-container -->
			</div><!-- /.flexslider-container -->
		</div><!-- /#slider-body --> 
	</div><!-- /.flex-container -->
</section>

<?php
endif;

// Reset Post Data
wp_reset_postdata();
?>
