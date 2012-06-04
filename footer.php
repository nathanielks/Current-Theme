	
<section class="nav-bottom">
<?php 

		wp_nav_menu( 
			array( 
				'theme_location' => 'footer',
				'container' => 'nav',
				'menu_class' => 'footer-nav center-list',
				'depth' => 1,
			)
		);

?>
</section>

<section id="scripts">

	<?php wp_footer(); ?>

</section>

</body>
</html>
