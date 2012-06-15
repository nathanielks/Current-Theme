<?php
//flush_rewrite_rules();
?>

<!doctype html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie" itemscope itemtype="http://schema.org/Organization"><![endif]-->
<!--[if lt IE 7]><html class="no-js ie6 oldie" lang="en" itemscope itemtype="http://schema.org/Organization"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en" itemscope itemtype="http://schema.org/Organization"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en" itemscope itemtype="http://schema.org/Organization"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" itemscope itemtype="http://schema.org/Organization"><!--<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en" itemscope itemtype="http://schema.org/Organization"><!--<![endif]-->

<head>
    <meta charset="utf-8">
	<title>Hope Unlimited for Children | A Non-Profit dedicated to transformating childrens live's</title>
<!-- Update your html tag to include the itemscope and itemtype attributes -->
	<html >

	<meta itemprop="name" content="">
	<meta name="author" content="">
	<meta itemprop="description" content="">
	<meta name="description" content="">

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0">
    
	<?php wp_head(); ?>

	<link href="<?php echo get_stylesheet_uri() ?>" media="screen, projection" rel="stylesheet" type="text/css" />

    <!--[if lte IE 8]>
        <link href="/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <![endif]-->

	<meta http-equiv="cleartype" content="on">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!--[if lt IE 7 ]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script><script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script><![endif]-->
</head>
<body <?php body_class($classes); ?>>

 <?php include('inc/templates/facebook.php'); ?>


					<?php 

							wp_nav_menu( 
								array( 
									'theme_location' => 'secondary',
									'container' => 'nav',
									'menu_class' => 'no-list-style content secondary',
									'walker' => new Bootstrap_Walker_Nav_Menu,
								)
							);

					?>

					<?php 
						if ( has_nav_menu( 'primary' )) {
							wp_nav_menu( 
								array( 
									'theme_location' => 'primary',
									'depth' => 2,
									'container' => false,
									'menu_class' => 'nav-collapse clearfix',
									//'walker' => new Roots_Navbar_Nav_Walker,
									'walker' => new Bootstrap_Walker_Nav_Menu,
									//'walker' => new MV_Cleaner_Walker_Nav_Menu,
								)
							);
						} 

					?>


</div> 
