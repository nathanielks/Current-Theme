<?php

function cur_recent_posts( $options = array() ){

	$defaults = array('post_type' => 'post', 'posts_per_page' => 2, 'ignore_sticky' => 0);
	$merged = array_merge($defaults, $options);
	extract($merged);
	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $posts_per_page,
		'ignore_sticky_posts' => $ignore_sticky,
		//'order' => 'ASC',
	);

	$the_query = new WP_Query( $args );

	// The Loop
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();

	$title_class = title_to_class( get_the_title() );

	?>
				<div id="post-<?php echo $title_class; ?>" <?php post_class($title_class.' mleft fleft recent-post'); ?>>
					<div class="media-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php cur_post_thumbnail('small'); ?>
							<p>
								<span class="arrow"><img src="<?php echo DS_ASSETS; ?>img/arrow-orange.png"></span><span class="title"><?php the_title(); ?></span>
							</p>
						</a>
					</div>
				</div>
<?php

	endwhile;
	endif;

	// Reset Post Data
	wp_reset_postdata();
}

function cur_excerpt_more() {
  return '<div class="read-more">&#8212; <a href="' . get_permalink() . '">' . __( 'Read more', 'hope' ) . '</a> &#8212;</div>';
}

add_filter('excerpt_more', 'cur_excerpt_more');

function get_page_url($page_name){
	return esc_url( get_permalink( get_page_by_title( $page_name ) ) );
}

//Courtesy @pjrvsWP, http://wp-snippets.com/1896/pagination-without-plugin/
function cur_pagination($prev = 'Prev', $next = 'Next') {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'prev_text' => __($prev),
		'next_text' => __($next),
		'type' => 'list'
);
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
};

//Gets the name of the site and generates a placeholder image from placehold.it
//Uses the same parameters as the_post_thumbnail
function cur_post_thumbnail($size='post-thumbnail', $attr='')
{
	if(!has_post_thumbnail()){

			$title = urlencode(get_bloginfo('name'));
			global $_wp_additional_image_sizes;
			$size = $_wp_additional_image_sizes[$size];
			$default_attr = array(
						'src'	=> '',
						'class'	=> 'attachment',
						'alt'	=> "$title Image", // Use Alt field first
						'title'	=> "$title",
					);
			$attr = wp_parse_args($attr, $default_attr);
			$attr = array_map( 'esc_attr', $attr);
			echo '<img class="' . $attr['class'] . '" src="http://placehold.it/'.$size['width'].'x'.$size['height'].'/&text='.$title.'" alt="' . $attr['alt'] . '" title="' . $attr['title'] . '" />';
			//echo '<img class="' . $attr['class'] . '" src="' . DS_ASSETS . '/img/placeholder.gif" alt="' . $attr['alt'] . '" title="' . $attr['title'] . '" />';
			
		}
		else {
			the_post_thumbnail($size, $attr);	
		}
}

//Courtesy Alix Axel, http://stackoverflow.com/questions/2762061/how-to-add-http-if-its-not-exists-in-the-url
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function cur_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li class="comment">
	<p><span class="bebas comment-author"><?php  echo comment_author_link(); ?></span> <span class="meta"> on <?php comment_date('m/d/y'); ?> </span></p>
	<?php comment_text(); ?>
	<hr>
	</li>
<?php
}

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 100 ); ?>
			<?php printf( __( '%s says:', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
			<br />
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'starkers' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' );
			?>

		<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/*
 *Courtesy Carina Javier,
 *http://wp.tutsplus.com/tutorials/customizing-and-styling-the-password-protected-form/
 */
add_filter( 'the_password_form', 'cur_password_form' );
function cur_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">'
	.'<p>' . __( "We're sorry, this post is password protected. Please enter the password below to enter." ) . '</p>'
	.'<label class="pass-label" for="' . $label . '">' . __( "Password:" ) . ' </label>' 
	.'<input name="post_password" id="' . $label . '" type="password" />' 
	.'<input type="submit" name="Submit" class="button" value="' . esc_attr__( "Submit" ) . '" /></form>';
	return $o;
}

/*
 *Courtesy Steve Wheatly,
 *http://stv.whtly.com/2011/02/19/wordpress-append-page-slug-to-body-class/
 *Adds the post type of current page and the name of the page to the body class
 */
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes )
{
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}



if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}
