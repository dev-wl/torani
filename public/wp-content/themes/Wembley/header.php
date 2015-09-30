<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package web2feel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/wp-content/themes/Wembley/js/masonry.pkgd.min.js"></script>


<?php wp_head(); ?>

<script>
	$(window).on('load', function() {
		$("ul#topmenu, #submenu").mouseenter(function() {
			$('#submenu').css('display', 'block');
		}).mouseleave(function(){
			$('#submenu').css('display', 'none');
		});
	});
</script>

</head>

<body <?php body_class(); ?>>
<div class="pushy pushy-left">
	<?php get_sidebar(); ?>
</div>

    <div class="site-overlay"></div>
<div id="page" class="hfeed site  ">
<div class="menu-btn"><i class="glyphicon glyphicon-cog"></i></div>
	
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="container" style="width: 100%;max-width: 100%;"> <div class="row"> 
			<div class="col-xs-12 the_logo">
				<div class="site-branding">

	<?php if (get_theme_mod(FT_scope::tool()->optionsName . '_logo', '') != '') { ?>
				<h1 class="site-title logo"><a class="mylogo" rel="home" href="<?php bloginfo('siteurl');?>/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img relWidth="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxWidth', 0)); ?>" relHeight="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxHeight', 0)); ?>" id="ft_logo" src="<?php echo get_theme_mod(FT_scope::tool()->optionsName . '_logo', ''); ?>" alt="" /></a></h1>
	<?php } else { ?>
				<h1 class="site-title logo"><a id="blogname" rel="home" href="<?php bloginfo('siteurl');?>/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php //bloginfo( 'name' ); ?></a></h1>
	<?php } ?>

				</div>
		</div>
			
			<div class="col-lg-12 col-md-8 col-xs-12">
			<div class="mobilenavi"></div>
			
			 <nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ) ); ?>
				<nav id="submenu">
					<?php wp_nav_menu( array('menu' => 'secondary', 'before' => '<div><img src="/wp-content/themes/Wembley/Transparent.png"/>',) ); ?>
				</nav>	
			 </nav><!-- #site-navigation -->
			</div>
		</div></div>
	</header><!-- #masthead -->
	
	<div class="container">
	<div id="content" class="site-content row">
