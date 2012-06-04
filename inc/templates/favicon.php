<?php if(of_get_option('ds_favicon_ico') and of_get_option('ds_favicon_ico')!=""): ?>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo stripslashes(of_get_option('ds_favicon_png')); ?>" />	

<?php endif; ?>	

<?php if(of_get_option('ds_favicon_png') and of_get_option('ds_favicon_png')!=""): ?>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="<?php echo stripslashes(of_get_option('ds_favicon_png')); ?>" />	

<?php endif; ?>	
