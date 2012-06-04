<?php

/*
 *Variables Required:
 *$post_type
 *$taxonomy
 *$term
 *$row_class
 *$post_content
 *$button_link
 */

$post_type = 'media';
$taxonomy = 'media_category';
$term = strtolower(substr(get_the_title(), 0, -1));
$row_class = 'featured';

//Sets up pagination
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

global $wp_query;
$temp = $wp_query;
$wp_query = null;
$args=array(
	'post_type' => $post_type,
	$taxonomy => $term,
	'media_tag' => 'featured',
	'paged' => $paged,
	'orderby' => 'ID',
	'order' => 'asc',
	'posts_per_page' => '1',
);
$wp_query = new WP_Query($args);

$i = 0;

if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
$title_class = title_to_class( get_the_title() );
//$media_embed = ds_post_thumbnail('featured-image', array('class' => 'round'));
$media_desc = get_post_meta($post->ID,'hu_media_desc', TRUE);
$button_link = get_permalink($post->ID);
$row = ( $i % 2 ) ? 'even' : 'odd';

?>

<div id="<?php echo $title_class; ?>" class="full-width-row <?php echo $row; ?>">
	<div class="row <?php echo $row_class; ?>">
		<div class="span7">
			<div class="media-thumb featured-image">
			<a href="<?php echo get_permalink($post->ID); ?>">
				<?php ds_post_thumbnail('featured-image', array('class' => 'round')); ?>
			</a>
			</div>
		</div>
		<div class="span5">
			<div class="copy">
				<h3 class="large aligncenter mbottom"><?php the_title(); ?></h3>
				<div class="hr small"></div>
					<?php echo $media_desc; ?>
				<div class="aligncenter"><a class="btn btn-orange" href="<?php echo $button_link; ?>">View Now</a></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php 
	$i++;
	endwhile; 
?>
<?php 
						endif;
						//Resets $wp_query
						$wp_query = null; 
						$wp_query = $temp; //reset 
						wp_reset_query();
?>
