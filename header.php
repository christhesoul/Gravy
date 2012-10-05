<?php

$dir = get_bloginfo('template_directory');

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php the_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php	wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		
		<div id="container" class="cf">
		
		<header role="banner" class="cf">

			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid nav-container">
						<nav role="navigation">
							<a class="brand hidden-desktop" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
							
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
							</a>
							
							<div class="nav-collapse">
								<?php bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
							</div>
							
						</nav>
						
						<form class="navbar-search form-search pull-right visible-desktop" action="<?php echo home_url( '/' ); ?>">
						  <div class="input-append">
						    <input type="text" placeholder="Search" name="s" id="search" class="span2 search-query" value="<?php the_search_query(); ?>">
						    <button type="submit" class="btn">Search</button>
						  </div>
						</form> 
						
					</div>
				</div>
			</div>
				
		</header>
		
