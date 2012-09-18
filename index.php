<?php get_header(); ?>

	<div class="row-full">

		<div id="blog">
		    <h1>Blog</h1>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a class="headline" href="<?php the_permalink(); ?>">
		                    <h2><?php the_title(); ?></h2>
		                </a>
		                <div class="content">
							<?php the_excerpt(); ?>
						</div>
						<?php get_template_part('inc/models/meta'); ?>
					</div>
				</article>

			<?php endwhile; ?>

				<div class="pagination">
					<?php cur_pagination(); ?>
				</div>

			<?php endif; ?>
		</div> <!-- /#blog -->

		<?php get_sidebar('blog'); ?>

	</div><!-- /.row-full -->




<?php get_footer(); ?>
