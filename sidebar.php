<?php

	if( is_page( 'blog' ) || is_page_template( 'page-blog.php' ) ) {
		dynamic_sidebar('blog');
					
	} elseif ( is_page('contact') || is_page_template( 'page-contact.php' ) ) {
		dynamic_sidebar('contact'); 
	
	} elseif ( is_page('portfolio') || is_page_template( 'page-portfolio.php' ) ) {
		dynamic_sidebar('portfolio'); 

	} elseif ( is_page() ) {
		dynamic_sidebar('page'); 

	} else {
		dynamic_sidebar('blog'); 
	}

?>
