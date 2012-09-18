<form method="get" class="search-form lightest-grey bg" action="<?php echo home_url(); ?>/">
		<input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search...', 'theatre' ); ?>" />
		<input class="button" type="submit" value="a" />      
</form>
