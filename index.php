<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('span9 entry aligncenter'); ?>>


		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

		<div class="entry-meta">
			<p>Posted on <span class="time"><?php the_date(); ?></span> |  
				<?php 
				if ( comments_open() && ! post_password_required() ) {
					comments_popup_link( '<span class="comments-link">' . __( '0 comments', 'designa' ) . '</span>','<span class="comments-link">'._x( '1 comment', 'comments number', 'designa' ).'</span>', '<span class="comments-link">'._x( '% comments', 'comments number', 'designa' ).'</span>' ); 
				} else {
					echo '<span class="comments-link">Comments are closed.</span>';
				} 
				?>
			</p>
		</div> <!-- /.entry-meta -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div> <!-- /.entry-content -->

	</article>

	<hr>

<?php endwhile; ?>


<?php get_footer(); ?>
