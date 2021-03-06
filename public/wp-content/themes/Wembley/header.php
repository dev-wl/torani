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
	<meta name="viewport" content="initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/Wembley/style.css">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/wp-content/themes/Wembley/js/masonry.pkgd.min.js"></script>
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
	<![endif]-->

	<?php

		global $wp_query;
		$post_id = $wp_query->post->ID;

		$post = get_post( $post_id );
		$slug = $post->post_name;

	 if( is_single() || $slug == 'about') :?>
			<meta property="og:url"                content="<?php echo the_permalink();?>" />
			<meta property="og:type"               content="article" />
			<meta property="og:title"              content="<?php the_title(); ?>" />
			<meta property="og:description"        content="<?php the_title(); ?> - Read more on Torani site!" />

			<?php 
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 720, 560, true ); //resize & crop the image
			?>

			<meta property="og:image"              content="<?php echo $image; ?>" />
	<?php endif; ?>

<?php wp_head(); ?>


<?php
	if( in_category( array( 11,12,13 ) ) )
		$products = 1;
	else 
		$products = 0;

	if( in_category( array( 7 ) ) )
		$recepies = 1;
	else 
		$recepies = 0;

	if( is_single())
		$single = 1;
	else
		$single = 0;

	if( is_single() && in_category( array( 16 ) ) )
		$retailer = 1;
	else 
		$retailer = 0;
?>

<script>
	function recheckFooter() {
		if($('#page .container:eq(1)').height() < $(window).height() - $('.footer').height()) {
			$('.footer').css('position', 'fixed');
		} else {
			$('.footer').css('position', 'static');
			$('html, body').css('height', 'auto');
			$('html, body').css('min-height', '100%');
		}
	}

	$(document).ready(function() {
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			recheckFooter();
		}

		if($(window).width() >= 1900)  {
			$('html, body').css('min-height', '98%');				
		}

		if($('#submenu').find('.current-menu-item').length > 0)
			$('ul#topmenu li:first-child').addClass('current-menu-item');
		if($('#submenu-buynow').find('.current-menu-item').length > 0)
			$('ul#topmenu li:nth-child(2)').addClass('current-menu-item');
		blog = "<?php echo $products; ?>";
		single = "<?php echo $single; ?>";
		recepies = "<?php echo $recepies; ?>";
		retailer = "<?php echo $retailer; ?>";
		if(window.location.href.indexOf('privacy-policy') > -1)
			$('.menu-item').removeClass('current-menu-item');
		else if(window.location.href.indexOf('retailers/') > -1) {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$('ul#topmenu li').removeClass('current-menu-item');
				setTimeout(function() {
					$('.jspContainer ul#topmenu li:nth-child(8)').addClass('current-menu-item');
				}, 1000);
			}
			else
				$('ul#topmenu li:nth-child(2)').addClass('current-menu-item');
		}
		else if(blog == 1)
			$('ul#topmenu li:first-child').addClass('current-menu-item');
		else if(recepies == 1) {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$('ul#topmenu li').removeClass('current-menu-item');
				setTimeout(function() {
					$('.jspContainer ul#topmenu li:nth-child(10)').addClass('current-menu-item');
				}, 1000);
			}
			else {
				$('ul#topmenu li:nth-child(4)').addClass('current-menu-item');
			}
		}
		else if(retailer == 1) {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$('ul#topmenu li').removeClass('current-menu-item');
				setTimeout(function() {
					$('.jspContainer ul#topmenu li:nth-child(8)').addClass('current-menu-item');
				}, 1000);
			}
			else
				$('ul#topmenu li:nth-child(2)').addClass('current-menu-item');
		}
		else if(single == 1) {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$('ul#topmenu li').removeClass('current-menu-item');
				setTimeout(function() {
					$('.jspContainer ul#topmenu li:nth-child(9)').addClass('current-menu-item');
				}, 1000);
			}
			else {
				$('ul#topmenu li:nth-child(3)').addClass('current-menu-item');
			}
		}

		$(window).on('scroll', function() {
			if($(window).scrollTop() > 100)
				$('.red-header').hide();
			else
				$('.red-header').show();
		});

		$('.footer').css('display', 'block');

		if($('body').find('ul.huge-it-share-buttons-list')) {
			// $('.huge-it-share-buttons.nobackground li:eq(4) a').css('background-image', 'url("/wp-content/themes/Wembley/inst.png")');
			$('.huge-it-share-buttons.nobackground li:nth-child(5) a').attr('onclick', '');
			$('.huge-it-share-buttons.nobackground li:nth-child(5) a').attr('href', 'https://www.instagram.com/toranisinglecup/');
			$('.huge-it-share-buttons.nobackground li:nth-child(5) a').attr('target', '_blank');
			$('.huge-it-share-buttons.nobackground li:nth-child(5) a').css('border-radius', '3px');
		}

		if(/iPad/i.test(navigator.userAgent) ) {
			window.addEventListener('orientationchange', function() {
			 if($(window).width() > $(window).height()){
			 	$('.pushy').removeClass('pushy-open').addClass('pushy-left');
			 	$('body').removeClass('pushy-active');
			 	$('#page.hfeed').removeClass('container-push');
			 }
			});
		}

		$('#submenu-buynow li:nth-child(1) a, #submenu-buynow li:nth-child(2) a').attr('target', '_blank');

		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Mac') != -1 && navigator.userAgent.indexOf('iPhone') == -1) {
			if(window.location.href.indexOf('contact/') > -1)
				return;
			if(navigator.userAgent.indexOf('iPad') != -1) {
				$('h1.page-title').attr('style', 'width:35% !important');
				return;
			}
			if(navigator.userAgent.indexOf('Mac') != -1) {
				$('h1.page-title').attr('style', 'width:20% !important');
				return;
			}
			if($('#main').find('h1.page-title')) {
				$('h1.page-title').attr('style', 'width:100% !important');
				$('.description .colums').css('margin-left', '30px');
			}
		}

		if(window.location.href.indexOf('privacy-policy') > -1)
			$('.menu-item').removeClass('current-menu-item');

		$('.menu li div img').click(function() {
			window.location.href = $(this).parent().find($('a')).attr('href');
		});

		$('#submenu-buynow li:nth-child(1) img, #submenu-buynow li:nth-child(2) img').unbind('click');
		$('#submenu-buynow li:nth-child(1) img, #submenu-buynow li:nth-child(2) img').click(function(e) {
			e.preventDefault();
			e.stopPropagation();
			window.open($(this).parent().find($('a')).attr('href'), '_blank');
		});

	});

	$(window).on('load', function() {
		$("#topmenu li:first-child, #topmenu li:first-child a, #submenu, #submenu li").mouseenter(function() {
			if($(window).width() < 640)
				return;
			$('#submenu').css('display', 'block');
			$('#submenu-buynow').css('display', 'none');
		});


		$("#topmenu li:nth-child(2), #topmenu li:nth-child(2),  #submenu-buynow, #submenu-buynow li").mouseenter(function() {
			if($(window).width() < 640)
				return;
			$('#submenu-buynow').css('display', 'block');
			$('#submenu').css('display', 'none');
		});

		$("#topmenu li:first-child, #topmenu li:first-child a, #submenu, #submenu li").on('touchend', function() {
			$('#submenu').css('display', 'block');
			setTimeout(function() {
				$('#submenu').css('display', 'none');
			}, 1500);
		})

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

		$('#submenu-buynow').mouseleave(function(){
			setTimeout(function() {
				$('#submenu-buynow').css('display', 'none');
			}, 500);
		});

		$('#submenu-buynow li div a').unwrap();

		$("#submenu li").click(function() {
			$(window).location = $(this).find('a').attr('href');
		});

		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			recheckFooter();
		}

		if($('.sl-wrapper').height() == 0) {
			if(navigator.userAgent.indexOf('Mac') != -1) {
				$('.sl-wrapper').height(500);
			}
		}

	});


</script>
<!-- Hotjar Tracking Code for http://www.toranisinglecup.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:166977,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!--HotJar-->
</head>

<body <?php body_class(); ?>>
<div class="pushy pushy-left">
	<?php get_sidebar(); ?>
</div>

    <div class="site-overlay"></div>
<div id="page" class="hfeed site  ">
<!-- <div class="menu-btn"><i class="glyphicon glyphicon-cog"></i></div> -->
	
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="red-header">
			<div id="logo">
				<a href="/"><img src="/wp-content/themes/Wembley/logo.png" width="124" /></a>
			</div>
			
			<div id='red-right'>
				<p>SINGLE SERVE BEVERAGE CUPS</p> 
				<img src="/wp-content/themes/Wembley/header_cups.png" width="124" />
			</div>

			<div class="clearfix"></div>
		</div>

		<div class="container" style="width: 100%;max-width: 100%;">

		 <div class="row"> 
			<!-- <div class="col-xs-12 the_logo">
				<div class="site-branding">

	<?php if (get_theme_mod(FT_scope::tool()->optionsName . '_logo', '') != '') { ?>
				<h1 class="site-title logo"><a class="mylogo" rel="home" href="<?php bloginfo(site_url());?>/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img relWidth="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxWidth', 0)); ?>" relHeight="<?php echo intval(get_theme_mod(FT_scope::tool()->optionsName . '_maxHeight', 0)); ?>" id="ft_logo" src="<?php echo get_theme_mod(FT_scope::tool()->optionsName . '_logo', ''); ?>" alt="" /></a></h1>
	<?php } else { ?>
				<h1 class="site-title logo"><a id="blogname" rel="home" href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php //bloginfo( 'name' ); ?></a></h1>
	<?php } ?>

				</div>
		</div> -->
			
			<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="mobilenavi">
				<div id="mobnav"></div>
			</div>
			
			 <nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ) ); ?>
				<nav id="submenu">
					<?php wp_nav_menu( array('menu' => 'secondary', 'before' => '<div><img src="/wp-content/themes/Wembley/Transparent.png"/>',) ); ?>
				</nav>
				<nav id="submenu-buynow">
					<?php wp_nav_menu( array('menu' => 'buy-now', 'before' => '<div><img src="/wp-content/themes/Wembley/Transparent.png"/>',) ); ?>
				</nav>
			 </nav><!-- #site-navigation -->
	

			 <div id="maillist">
				<form action="//coffeemarvel.us8.list-manage.com/subscribe/post?u=533848f743a26d8c40a07bda8&amp;id=5ed4181b04" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<input type="email" placeholder="JOIN OUR MAILING LIST" value="" name="EMAIL" class="required email" id="mce-EMAIL" />
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
	$(document).unbind('mousemove');
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

	$('#menu-buy-now li:eq(0) a, #menu-buy-now li:eq(1) a').attr('target', '_blank')

	if(/Android|iPad/i.test(navigator.userAgent) ) {
		$(document).ready(function() {
			if($("#content").height() < $(window).height()) {
				$('html, body, #page').css('height', '100%');
			}
		});
	}
	
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		// $('#maillist').insertAfter('.pushy .searchbox');

		window.addEventListener('orientationchange', recheckFooter);
	}

	$('#secondary-mobile li').insertAfter('.pushy #topmenu li:eq(0)').addClass('indent');
	$('#buy-now-mobile li').insertAfter('.pushy #topmenu li:eq(4)').addClass('indent');

	$('body').bind('touchmove', function(e){
		if($('.pushy').hasClass('pushy-open'))
			e.preventDefault();
	});

</script>