
<?php

//Sets up pagination
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

global $wp_query;
$temp = $wp_query;
$wp_query = null;
$args=array(
'post_type' => 'five-for-ten',
'paged' => $paged,
'orderby' => 'ID',
'order' => 'asc',
);
$wp_query = new WP_Query($args);

$i = 0;

if ($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
$title_class = title_to_class( get_the_title() );
$donate_link = get_post_meta($post->ID,'hu_donate_link', TRUE);
$f4f_content = get_post_meta($post->ID,'hu_f4f_content', TRUE);
$row = ( $i % 2 ) ? 'even' : 'odd';
?>

<div id="<?php echo $title_class; ?>" class="full-width-row <?php echo $row; ?>">
	<div class="row f4f-option">
		<div class="span7">
			<div class="media-thumb featured-image">
			<?php ds_post_thumbnail('featured-image', array('class' => 'round')); ?>
			</div>
		</div>
		<div class="span5">
			<div class="copy">
				<h3 class="large aligncenter mbottom"><?php the_title(); ?></h3>
				<div class="hr small"></div>
					<?php echo $f4f_content; ?>
				<div class="aligncenter"><a class="btn btn-orange" href="<?php echo $donate_link; ?>">Give Now</a></div>
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
						reset_wp_query();
?>
