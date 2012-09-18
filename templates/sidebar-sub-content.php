<?php 

/*
 *Template Name: Sidebar w/ Subcontent
 */

get_header(); ?>

	<div class="row-full">

		<?php get_template_part('inc/loops/page'); ?>
	
		<?php get_sidebar(); ?>

	</div><!-- /.row-full -->

	<div class="row-full">
		<div id="page-subcontent">
			<?php echo get_post_meta($post->ID, 'cur_page_subcontent', TRUE); ?>
		</div>
	</div>

<?php get_footer(); ?>
