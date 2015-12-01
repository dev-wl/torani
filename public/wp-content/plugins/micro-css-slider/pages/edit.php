<?php
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		if(isset($_POST['update'])) {
	
			if ( ! function_exists( 'wp_handle_upload' ) ) {
			    require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			//$res = media_handle_upload('userfile', $_POST['update']); 

			// $uploadedfile = $_FILES['userfile'];

			// $upload_overrides = array( 'test_form' => false );

			// $wp_upload_dir = wp_upload_dir();
			// $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

			// if ( $movefile && !isset( $movefile['error'] ) ) {
			// 	$attachment = array(
			// 		'guid'           => $wp_upload_dir['url'] . '/' . basename( $movefile['file']), 
			// 		'post_mime_type' => 'image',
			// 		'post_title'     => '',
			// 		'post_content'   => '',
			// 		'post_status'    => 'inherit'
			// 	);

			    $postId = ($_POST['update']);
			    $attaches = get_attached_media( 'image', $postId );
			    foreach ($attaches as $image) {
			    	wp_delete_attachment( $image->ID, true );
			//     	media_handle_upload('userfile', $_POST[]);
			    	//$e = wp_insert_attachment( $attachment, $movefile['file'], $_POST['update'] );
			    	// echo "<pre>";
			    	// print_r($e);
			    	// echo "</pre>";
			    }
			    media_handle_upload('userfile', $postId); 
			// } else {
			//     echo $movefile['error'];
			// }
		} else {
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
	}
		
	// print_r(wp_upload_dir());
?>

<label for="upload_image" class="new"><a>Add new slide</a>
<form action="" enctype="multipart/form-data" method="POST" id="newslide">
	<input id="upload_image" type="file" id="newslide_file" name="userfile" value=""  onChange="submitForm('newslide');"/>
	<input id="upload_image_button" type="submit" value="Upload Image" />
</form>
</label>

<div id="ccc"></div>

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

<div id="all-slides">
<?php 
	// wp_delete_post(431, true);
	//+проверка на пустую картинку
?>
 <?php 
	 // echo "<pre>";
  // print_r($slidePosts); 
  // echo "</pre>";?>
	<?php
		foreach ($slidePosts as $slider) :
			$attach = get_attached_media( 'image', $slider->ID);
			$cleanedObject = reset($attach);
			// print_r(reset($attach)->guid);
			//echo "<img src='" . reset($attach)->guid . "' />" . "<br />";
	?>

	<div class="single-slide" id="item-<?php echo $cleanedObject->post_parent; ?>">
		<div class="image">
			<img src="<?php echo $cleanedObject->guid; ?>" />
		</div> 
		<?php $the_meta = get_post_meta ( $cleanedObject->post_parent, 'description', false); ?>
		<textarea cols='10' rows='10' placeholder="Input image decription here" class="image_description" id="text-<?php echo $cleanedObject->post_parent; ?>"><?php echo isset($the_meta[0]) ? $the_meta[0] : ''?></textarea>
		<div class="cf"></div>

		<a class="slide-delete" id="slide-<?php echo $cleanedObject->post_parent; ?>">Delete slilde</a>
		
		<label for="update-image<?php echo $cleanedObject->post_parent; ?>" class="slide-image-update" data-id="slide-<?php echo $cleanedObject->post_parent; ?>"><a class="slide-upd">Update image</a>
		<form action="" enctype="multipart/form-data" method="POST" class="update" id="updateSlide<?php echo $cleanedObject->post_parent;?>">
			<input id="update-image<?php echo $cleanedObject->post_parent; ?>" type="file" name="userfile" value="" onchange="submitForm('updateSlide<?php echo $cleanedObject->post_parent;?>')" />
			<input type="text" name="update" value="<?php echo $cleanedObject->post_parent;?>" />
			<input id="update-image_button" type="submit" value="Upload Image" />
			</form>
		</label>
	</div>
	
	<?php endforeach; ?>
</div>

<div class="confirm" data-id="0">
	<p class="text">Are you sure want to delete this slide?</p>
	<a class="btn btn-yes">Yes</a> <a class="btn btn-no">No</a>
</div>

<div class="options">
	<p>MicroSlider options</p>
	
	<form action="" method="POST" id="options-form">
		<div class="enabled">
			<p>Enable slider:</p>
			<input type="radio" value="no" name="slider-enable" <?php echo get_option('m_slider_enabled') == 0 ? 'checked' : ''; ?> /> No
			<input type="radio" value="yes" name="slider-enable" <?php echo get_option('m_slider_enabled') == 1 ? 'checked' : ''; ?> /> Yes
			
			<p>Slider mode:</p>
			<input type="radio" value="auto" name="slider-mode" <?php echo get_option('m_slider_mode') == 'auto' ? 'checked' : ''; ?> /> Auto
			<input type="radio" value="manual" name="slider-mode" <?php echo get_option('m_slider_mode') == 'manual' ? 'checked' : ''; ?> /> Manual

			<p>Slider effects:</p>
			<input type="radio" value="on" name="slider-effects" <?php echo get_option('effects') == 'on' ? 'checked' : ''; ?> /> On
			<input type="radio" value="off" name="slider-effects" <?php echo get_option('effects') == 'off' ? 'checked' : ''; ?> /> Off
		</div>

		<a class="update_options btn">Update options</a>
	</form>
</div>

<div class="cf"></div>

<?php
add_action( 'admin_footer', 'my_action_javascript' );


// unlink('/home/akirilkov/html/torani/public/wp-content/uploads/2015/11/Best-Photography-Coffee-Drink-Wallpaper3-150x150.jpg');

function my_action_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function() {

		jQuery('.slide-delete').click(function(e) {
			jQuery('.confirm').css('display', 'block');
			jQuery('.confirm').attr('data-id', jQuery(this).attr('id'));
		});

		jQuery('.btn-no').click(function(e) {
			jQuery(this).parent().css('display', 'none');
		});

		jQuery('.btn-yes').click(function(e) {
			jQuery(this).parent().css('display', 'none');
			var data = {
				'action': 'slider-delete',
				'slide-id': jQuery(this).parent().attr('data-id')
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				if(response == '1') {
					jQuery('#item-' + data['slide-id'].substring(data['slide-id'].indexOf('-')+1)).remove();
				} else {
					alert('Delete failure');
				}
			});
		});

		jQuery('.update_options').click(function(e) {
			var data = {
				'action': 'slider-options',
				'options': jQuery('#options-form').serialize()
			};

			jQuery.post(ajaxurl, data, function(response) {
				alert(response);
			});
		});


		jQuery('.image_description').on('change', function(e) {
			var data = {
				'action': 'text-update',
				'slide-id': jQuery(this).attr('id'),
				'description': jQuery(this).val()
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
			});
		});
	});
	</script>

	<?php
}
?>

<script>
	function submitForm(formId) {
		jQuery('#' + formId.toString()).submit();
	}
</script>