</section><!-- /#content -->

<footer>
    <div class="container">
        <div class="row-full">
			<div id="footer-nav">
			<?php 
				if ( has_nav_menu( 'footer' )) {
					wp_nav_menu( 
						array( 
							'theme_location' => 'footer',
							'container' => 'nav',
							//'walker' => new MV_Cleaner_Walker_Nav_Menu,
						)
					);
				} 
			?>
			</div>
            <div id="copyright">&copy; 2012 - All rights reserved</span></div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
