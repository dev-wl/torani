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

add_action('admin_init', 'adminScripts');

function adminScripts() {
	wp_enqueue_script('jquery-ui-core');
}

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

	//options
	if(get_option('m_slider_enabled') == false)
		add_option('m_slider_enabled', 0);
	if(get_option('m_slider_mode') == false)
		add_option('m_slider_mode', 'Auto');
	if(get_option('effects') == false)
		add_option('ffects', 'off');

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


function delete_slider() {
	global $wpdb; // this is how you get access to the database

	$postId = intval(substr($_POST['slide-id'], 6));

	//first, delete all images attached to the post
	$attaches = get_attached_media( 'image', $postId );
	foreach ($attaches as $image) {
		wp_delete_attachment( $image->ID, true );
	}

	//second,delete the post itself
	$deleted = wp_delete_post( $postId, true );

    if($deleted != false)
    	echo '1';
    else
    	echo '-1';

	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_slider-delete', 'delete_slider' );

function update_description() {
	//add image description
	
	global $wpdb; // this is how you get access to the database

	$postId = intval(substr($_POST['slide-id'], 5));

	$description = $_POST['description'];

	//check if the meta already exists
	$the_meta = get_post_meta ( $postId, 'description', false);

	//if it doesn't
	if(empty($the_meta)) {
		add_post_meta($postId, 'description', $description, true); //create it
	} else {
		update_post_meta($postId, 'description', $description); //else change it
	}

	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_text-update', 'update_description' );

function update_link() {
	//add image description
	
	global $wpdb; // this is how you get access to the database

	$postId = intval(substr($_POST['slide-id'], 5));

	$link = $_POST['link'];

	//check if the meta already exists
	$the_meta = get_post_meta ( $postId, 'link', false);

	//if it doesn't
	if(empty($the_meta)) {
		add_post_meta($postId, 'link', $link, true); //create it
	} else {
		update_post_meta($postId, 'link', $link); //else change it
	}

	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_link-update', 'update_link' );

function update_options() {
	//add image description
	
	global $wpdb; // this is how you get access to the database

	$opt = array();
	parse_str($_POST['options'], $opt);
	print_r($opt);
	if($opt['slider-enable'] == 'no') {
		update_option('m_slider_enabled', 0);
	} else {
		update_option('m_slider_enabled', 1);
	}

	if($opt['slider-mode'] == 'auto') {
		update_option('m_slider_mode', 'auto');
	} else {
		update_option('m_slider_mode', 'manual');
	}

	if($opt['slider-effects'] == 'on') {
		update_option('effects', 'on');
	} else {
		update_option('effects', 'off');
	}

	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_slider-options', 'update_options' );


?>