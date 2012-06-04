<?php if (have_posts()) : while (have_posts() ) : the_post(); ?>

	<article class="post">

		<h2><a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a></h2>

		<div class="meta">
			<p>Posted on <span class="time"><?php the_date(); ?></span> by <a href="#" class="fn"><?php the_author(); ?></a> in <?php the_category(','); ?> with
				<?php if ( comments_open() && ! post_password_required() ) : ?>
					<?php comments_popup_link( '<span class="comments-link">' . __( '0 comments', 'designa' ) . '.</span>','<span class="comments-link">'._x( '1 comment', 'comments number', 'designa' ).'.</span>', 'with <span class="comments-link">'._x( '% comments', 'comments number', 'designa' ).'.</span>' ); ?>
				<?php endif; ?>
			</p>
		</div>

		<div class="entry">
			<p><?php the_excerpt(); ?></p>
		</div>

		<footer>
			<a href="<?php the_permalink(); ?>" class="more-link">Continue reading...</a>
		</footer>

	</article>

<?php endwhile; ?>

	<ul class="page-numbers"><?php ds_pagination(); ?></ul>

<?php else : ?>

	<h1>Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php endif;  ?> 
