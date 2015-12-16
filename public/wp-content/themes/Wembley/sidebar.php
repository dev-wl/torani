<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package web2feel
 */
?>
	<div class="searchbox">
		<?php get_search_form(); ?>
	</div>
	
	<div id="nav" class="widget-area">
		<aside class="widget widget_categories">
			<h1 class="widget-title">NAVIGATION</h1>
			<?php wp_nav_menu( array( 'menu'=> 'Menu 1', 'menu_id'=>'topmenu' ) ); ?>
			<?php wp_nav_menu( array( 'menu'=>'secondary', 'menu_id' => 'secondary-mobile' ) ); ?>
			<?php wp_nav_menu( array( 'menu'=>'buy-now', 'menu_id' => 'buy-now-mobile' ) ); ?>
		</aside>
	</div>

	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
		<?php //get_template_part( 'sponsors' ); ?>
	</div><!-- #secondary -->
	