<title>
	<?php if (is_home()) { bloginfo('name'); ?> | <?php bloginfo('description'); } ?>
	<?php if (is_search()) { _e('Search Results for', 'designa'); ?> <?php $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; echo $key; echo ' &mdash; '; echo $count . ' '; _e('Articles', 'designa'); wp_reset_query(); } ?>
	<?php if (is_404()) { bloginfo('name'); ?> | <?php _e('404 Nothing Found', 'designa'); } ?>
	<?php if (is_author()) { bloginfo('name'); ?> | <?php _e('Author Archives', 'designa'); } ?>
	<?php if (is_single()) { the_title(); ?> | <?php bloginfo('name'); } ?>
	<?php if (is_page()) { bloginfo('name'); ?> | <?php the_title(''); } ?>
	<?php if (is_category()) { single_cat_title(); ?> | <?php bloginfo('name'); } ?>
	<?php if (is_month()) { bloginfo('name'); ?> | <?php _e('Archive', 'designa'); ?> | <?php the_time('F, Y'); } ?>
	<?php if (is_day()) { bloginfo('name'); ?> | <?php _e('Archive', 'designa'); ?> | <?php the_time('F j, Y'); } ?>
	<?php if (function_exists('is_tag')) { if ( is_tag() ) { bloginfo('name'); ?> | <?php _e('Tag Archive', 'designa'); ?> | <?php single_tag_title("", true); } } ?>
</title>
