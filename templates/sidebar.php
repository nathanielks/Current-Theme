<?php 

/*
 *Template Name: Sidebar
 */

get_header(); ?>

	<div class="row-full">

		<?php get_template_part('inc/loops/page'); ?>
	
		<?php get_sidebar(); ?>

	</div><!-- /.row-full -->

<?php get_footer(); ?>
