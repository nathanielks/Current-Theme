<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
	<!--[if lte IE 9]> <link rel="stylesheet" href="assets/css/ie.css"> <![endif]-->
	
	<?php if( WP_ENV == 'local') { ?>
		<script type="text/javascript">
			var disqus_developer = 1; // developer mode is on
		</script>
	<?php } ?>

</head>
<body <?php body_class(); ?>>

<div id="navbar" class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <a class="logo" href="<?php echo home_url(); ?>">Logo</a>
		<div id="nav-primary">

<?php 
						if ( has_nav_menu( 'primary' )) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'primary',
									'depth' => 2,
									'container' => 'nav',
									'container_class' => 'nav-collapse collapse',
									'menu_class' => 'nav',
									'walker' => new Bootstrap_Walker_Nav_Menu,
								)
							);
						} 
?>
	</div>
      </div>
    </div><!-- /navbar-inner -->
  </div><!-- /.navbar -->

<?php 
if ( is_front_page() ){
	get_template_part('inc/models/slider'); 
}

?>

<section id="content" class="container">