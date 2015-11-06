<?php
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {


		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		 $mainSlider = get_posts(array(
			'numberposts'		=> -1,
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_type'			=> 'Micro Slider'
		));

	    $title = 'Slider-' . (rand() + rand());
		$id = wp_insert_post(array(
			'post_type'		=> 'Micro Slider',
			'post_title'	=> $title,
			'post_name'		=> $title,
			'post_parent'	=> $mainSlider[0]->ID,
			'post_content'	=> '',
			'post_author'	=> 1,
			'comment_status'=> 'closed',
			'ping_status'	=> 'closed',
			'post_status'	=> 'publish', // for created sliders
			'menu_order'	=> 1,
			'post_date'		=> date('Y-m-d H:i:s'),
			'guid'          => '',
		));

		$res = media_handle_upload('userfile', $id); 

		if ( is_wp_error($res)) {
			echo $res->get_error_message();
			echo ' error ';
		}
	}
		
	// print_r(wp_upload_dir());
	// unlink('/home/akirilkov/html/torani/public/wp-content/uploads/2015/11/7039746-cool-hd-wallpapers-21913.jpg');
?>

Upload Image
<label for="upload_image">
<form action="" enctype="multipart/form-data" method="POST">
	<input id="upload_image" type="file" name="userfile" value="" />
	<input id="upload_image_button" type="submit" value="Upload Image" />
</form>
</label>


<?php
	$mainSlider = get_posts(array(
		'numberposts'		=> -1,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
		'post_type'			=> 'Micro Slider',
		'post_parent'		=> 0
	));

	$id = $mainSlider[0]->ID;

	$slidePosts = get_posts(array(
		'numberposts'		=> -1,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
		'post_parent'		=> $id,
		'post_type'			=> 'Micro Slider'
	));
?>

<!-- <div id="all-slides"> -->
	<?php
		// foreach ($slidePosts as $slider) :
			// $attach = get_attached_media( 'image', $slider->ID);
			// $cleanedObject = reset($attach);
			// print_r(reset($attach)->guid);
			// echo "<img src='" . reset($attach)->guid . "' />" . "<br />";
	?>

	<!-- <div class="single-slide">
		<div class="image">
			<img src="<?php echo reset($attach)->guid ?>" />
		</div> 
		
		<textarea cols='10' rows='10' placeholder="Input image decription here"></textarea>
		<div class="cf"></div>
	</div>
	
	<a href="">Delete slilde</a> -->
	<?php //endforeach; ?>
<!-- </div> -->


	
<?php
	
	// print_r($mainSlider);
	
	// wp_delete_post(385, 1);
?>