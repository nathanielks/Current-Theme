<?php
//Full Page Slider

//Content
//	Video Embeds
//	Text
//	Headers
//	Call to action button links
//	Background Image

//Functionality
//  Multiple Sliders
//		They have different elements in each.
//		You select which slider you want to display on that page
//	Doesn't load bg images for certain resolutions
//	Responsive
//	Easily updatable by end user

// Slider types
//
//
//TODO
//	Need to add styles to hide the sliders at first, then reveal them
//	Need to use the callback functions to do that
//	Have a default loading image, then reveal the stuff
?>


<section id="cta" class="clearfix full-size-background">
	<div class="flex-container">
		<div class="flexslider">
			<ul class="slides clearfix">

				<?php

				$slides = explode(' ', get_post_meta($post->ID,'hu_slides', TRUE));
				$args = array(
					'post_type' => 'slide',
					'post__in' => $slides,
					'posts_per_page' => -1,
				);

				$the_query = new WP_Query( $args );

				$i = 0;
				// The Loop
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();

				$title_class = title_to_class( get_the_title() );
				$slide_classes = get_post_meta($post->ID, 'hu_slide_classes', TRUE);
				$slide_classes = ( $slide_classes ) ? $slide_classes : '';
				$slide_number = ( $i == 0 ) ? 'first' : 'hide';
				$slide_classes = $title_class . ' ' . $slide_number . ' ' . $slide_classes;
				?>

					<li id="slide-<?php echo $title_class; ?>" class="slide <?php echo $slide_classes; ?>">
						<div class="container">
							<div class="slide-content">
							<?php echo get_post_meta($post->ID,'hu_slide_content', TRUE); ?>
							</div>
						</div>
							<?php $extra_markup = get_post_meta($post->ID,'hu_extra_markup', TRUE);  
								echo $extra_markup;
							?>
						<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); 
						if ( $src ) { ?>
						<div class="slide-bg-container">
							<div class="slide-bg">
								<span class="bg" style="background: url('<?php echo $src[0];?>') repeat-x top center;"></span>
							</div>
						</div>
						
					<?php } ?>
					</li>
				<?php
				// Do Stuff
				$i++;
				endwhile;
				endif;

				// Reset Post Data
				wp_reset_postdata();
				?>

			</ul>
		</div>
		<div class="flex-nav-container full-size-background">
				<div class="flex-nav">
			</div>
		</div>
	</div>

</section>
