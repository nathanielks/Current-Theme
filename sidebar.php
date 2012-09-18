<aside id="sidebar">
<?php

		$sidebar = wp_title('', false );

		if ( is_active_sidebar( $sidebar )) {
			dynamic_sidebar($sidebar); 
		} else {
			dynamic_sidebar( 'Blog' ); 
		}
	?>
</aside>
