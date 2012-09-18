<!-- Begin .meta -->
<div class="meta footer">
<?php 
	echo '<span class="date">' . get_the_date('jS F Y') . '</span> - ' 
	. __(' by ', 'current') 
	. '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="author">' . get_the_author() . '</a>';
?>

<?php if ( comments_open() && ! post_password_required() ) {
	echo ' - with ';
	comments_popup_link( '<span class="comments-link">' . __( '0 comments', 'current' ) . '.</span>'
	,'<span class="comments-link">'._x( '1 comment', 'comments number', 'current' ).'.</span>'
	, 'with <span class="comments-link">'._x( '% comments', 'comments number', 'current' ).'.</span>' );
} ?>

<?php
	if ( is_single() ){ ?>
	<a class="comments-link fright teal" href="<?php comments_link();?>">Leave a comment</a>
<? } ?>
</div>
<!-- End .meta -->
