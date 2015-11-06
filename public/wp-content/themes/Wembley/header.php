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
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->

<?php wp_head(); ?>

<script>
	function recheckFooter() {
		if($('#page .container:eq(1)').height() < $(window).height() - $('.footer').height()) {
			$('.footer').css('position', 'fixed');
		} else {
			$('.footer').css('position', 'static');
		}
	}


	$(window).on('load', function() {
		$("#topmenu li:first-child, #submenu, #submenu li").mouseenter(function() {
			if($(window).width() < 640)
				return;
			$('#submenu').css('display', 'block');
		});

		$('ul#topmenu li a').css('text-transform', 'uppercase');

		// $("#topmenu li:first-child, #submenu, #submenu li").touchstart(function() {
		// 	alert('a');
		// });


		// $("#topmenu li:first-child").touchend(function(e) {
		// 	e.stopPropagation();
		// 	e.preventDefault();
		// });

		$('#submenu').mouseleave(function(){
			setTimeout(function() {
				$('#submenu').css('display', 'none');
			}, 500);
		});

		$("#submenu li").click(function() {
			$(window).location = $(this).find('a').attr('href');
		});

		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			recheckFooter();
		}

	});


</script>

</head>

<body <?php body_class(); ?>>
<div class="pushy pushy-left">
	<?php get_sidebar(); ?>
</div>

    <div class="site-overlay"></div>
<div id="page" class="hfeed site  ">
<!-- <div class="menu-btn"><i class="glyphicon glyphicon-cog"></i></div> -->
	
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
			
			<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="mobilenavi">
				<div id="mobnav"></div>
			</div>
			
			 <nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ) ); ?>
				<nav id="submenu">
					<?php wp_nav_menu( array('menu' => 'secondary', 'before' => '<div><img src="/wp-content/themes/Wembley/Transparent.png"/>',) ); ?>
				</nav>	
			 </nav><!-- #site-navigation -->

			 <div id="maillist">
				<form>
					<input type="text" placeholder="JOIN OUR MAILING LIST" />
					<div class="submit-wrapper">
						<input class="submit-button" type="submit" value="SUBMIT" />
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			</div>
		</div></div>
		
	</header><!-- #masthead -->
	
	<div class="container">
	<div id="content" class="site-content row">

<script>
	if($(window).width() < 1100) {
		$('#maillist').insertAfter('.pushy .searchbox');
	} else {
		$('#maillist').insertAfter('nav#site-navigation');
	}
	$(window).on('resize', function() {
		if($(window).width() < 1100) {
			$('#maillist').insertAfter('.pushy .searchbox');
		} else {
			$('#maillist').insertAfter('nav#site-navigation');
		}
	});
	
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		// $('#maillist').insertAfter('.pushy .searchbox');

		window.addEventListener('orientationchange', recheckFooter);
	}

	$('#secondary-mobile li').insertAfter('.pushy #topmenu li:eq(0)').addClass('indent');
</script>