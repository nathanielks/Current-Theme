<?php 
/*
 *Template Name: Full Width
 */

get_header(); ?>

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('entry aligncenter'); ?>>


							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

							<div class="entry-content">
								<?php the_content(); ?>
							</div> <!-- /.entry-content -->
						</article>

					<?php endwhile; ?>

</section>

<?php get_footer(); ?>
