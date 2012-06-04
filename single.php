<?php get_header(); ?>

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
							<div class="entry-meta">
								<p>Posted on <span class="time"><?php the_date(); ?></span> |  
									<?php 
									if ( comments_open() && ! post_password_required() ) {
										comments_popup_link( '<span class="comments-link">' . __( 'No comments', 'designa' ) . '</span>','<span class="comments-link">'._x( '1 comment', 'comments number', 'designa' ).'</span>', '<span class="comments-link">'._x( '% comments', 'comments number', 'designa' ).'</span>' ); 
									} else {
										echo '<span class="comments-link">Comments are closed.</span>';
									} 
									?>
								</p>
							</div> <!-- /.entry-meta -->

							<div class="entry-content">
								<?php the_content(); ?>
							</div> <!-- /.entry-content -->
						</article>

						<hr>

					<?php endwhile; ?>

				<?php comments_template('', TRUE); ?>	

	<aside id="sidebar" class="span3">
		<ul class="content no-list-style inner">
			<?php dynamic_sidebar('sidebar') ?>
		</ul>
	</aside>



</section>

<?php get_footer(); ?>
