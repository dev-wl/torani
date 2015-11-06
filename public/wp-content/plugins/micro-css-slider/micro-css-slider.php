<?php
/*
Plugin Name: Micro Css Slider
Plugin URI:
Description: Very simple customisable css slider with js support
Version: 0.0.1
Author: 
Author URI:
*/
function micro_slider_activation() {
	$slider = get_posts(array(
		'numberposts'		=> -1,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
		'post_type'			=> 'Micro Slider'
	));

	//if it is a fresh install of the plugin, create new post of type Micro Slider; in this version it can be only one slider per site
	if(empty($slider)) {
		wp_insert_post(array(
			'post_type'		=> "Micro Slider",
			'post_title'	=> 'Main slider',
			'post_name'		=> 'Main title',
			'post_parent'	=> 0,
			'post_content'	=> '',
			'post_author'	=> 1,
			'comment_status'=> 'closed',
			'ping_status'	=> 'closed',
			'post_status'	=> 'publish',
			'menu_order'	=> 1,
			'post_date'		=> date('Y-m-d H:i:s'),
			'guid'          => '',
		));
	}
}
register_activation_hook(__FILE__, 'micro_slider_activation');


//register custom post type, create admin menu and set action for the menu option
function slider_cpt_register() {
    $args = array(
        'label' => __("Micro Slider"),
        'singular_label' => __("Micro Slider"),
       );  
 
    register_post_type("Micro Slider", $args );
}
add_action('init', 'slider_cpt_register');

function manage_slider_menu() {
	add_menu_page( 'Manage Micro Slider', 'Manage Micro Sliders', 'manage_options', 'micro-slider-manager', 'micro_slider_menu_page' );
}
add_action( 'admin_menu', 'manage_slider_menu' );

function micro_slider_menu_page() {
	include_once __DIR__ . '/pages/edit.php';
}

function micro_css_scripts($hook) {
	// Add general scripts & styles
	wp_enqueue_style('micro-css-slider-admin',  plugin_dir_url(__FILE__) . '/css/admin.css', array());
}
add_action( 'admin_enqueue_scripts', 'micro_css_scripts');

?>