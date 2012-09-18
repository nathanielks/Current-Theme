<?php get_header(); ?>

	<div class="row-full">

		<div id="blog">
			<h1>Blog</h1>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>

					<h2 class="headline"><?php the_title(); ?></h2>
					
					<?php get_template_part('inc/models/meta'); ?>
					<?php cur_post_thumbnail('blog-wide'); ?>

	                <div class="content">
						<?php the_content(); ?>
					</div>

				</article>

				<?php comments_template('', true); ?>
			<?php endwhile; ?>
			<?php endif; ?>


		</div> <!-- /#blog -->

		<?php get_sidebar('blog'); ?>

	</div><!-- /.row-full -->




<?php get_footer(); ?>
