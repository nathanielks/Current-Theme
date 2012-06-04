<div class="row">
<?php

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 2,
	'ignore_sticky_posts' => 1,
	//'order' => 'ASC',
);

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();

$title_class = title_to_class( get_the_title() );
?>
	<div class="span6">
		<div class="inner content">
			<div id="post-<?php echo $title_class; ?>" class="recent-post row <?php post_class(); ?>">
				<div class="media-thumb">
					<a href="">
						<?php ds_post_thumbnail('small'); ?>
						<p>
							<span class="arrow"><img src="<?php echo DS_ASSETS; ?>img/arrow-orange.png"></span><span class="title"><?php the_title(); ?></span>
						</p>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php
// Do Stuff
endwhile;
endif;

// Reset Post Data
wp_reset_postdata();
?>
</div>
