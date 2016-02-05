<?php
/**
* Plugin Name: Powered by Wonderslab
* Plugin URI: http://wonderslab.com/
* Description: Adds Powered by Wonderslab footer link
* Version: 1.0
* Author: wl
* Author URI: http://wonderslab.com/
* License: 
*/


function wlpowered( $atts ){
	return '<div class="wl-powered"><a href="#">Powered by Wonderslab</a></div>';
}
add_shortcode( 'wlpowered', 'wlpowered' );

function wlpowered_markup($atts) {
	return '<div class="overlay"></div>

        <div id="wlpopup-wrap"><div class="close"><div class="close-overlay"></div></div>
            <img class="popup_img_header" src="' . plugin_dir_url(__FILE__) . '/images/earth_bg_logo.png" />
            <div class="popup_form">
                <div class="controls">

                    <div class="group">
                        <label for="username">Name:</label>
                        <input type="text" id="username" name="username" />
                        
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" />
                    </div>

                        <br />
                        <label for="message">Message:</label>
                        <textarea id="message"></textarea>
                </div>

                <br />
                <div class="contact-us">
                    <img src="' . plugin_dir_url(__FILE__) . '/images/skype.png"/> <p>dev_wl</p>
                    
                    <a class="contact" href="#">contact us</a>
                </div>

                <div class="preloader">
                    <img src="' . plugin_dir_url(__FILE__) . '/images/720.gif" />
                </div>
            </div>
        </div>';
}
add_shortcode( 'wlpowered-markup', 'wlpowered_markup' );

function wlpowered_script($atts) {
return "<script type='text/javascript'>
	$('.wl-powered a').click(function(e) {
    	e.preventDefault();
        $('#wlpopup-wrap').css('display', 'block');
        $('.overlay').css('display', 'block');
    });

    $('.close').click(function(e) {
    	e.preventDefault();
        $('#wlpopup-wrap').css('display', 'none');
        $('.overlay').css('display', 'none');
    });
</script>";
}
add_shortcode( 'wlpowered-script', 'wlpowered_script' );

function wlpowered_get_css($hook) {
	wp_enqueue_style('wlpowered-css',  plugin_dir_url(__FILE__) . '/css/style.css', array());
	wp_enqueue_script( 'wlpowered-script', plugin_dir_url(__FILE__) . '/js/script.js', array('jquery'), '1.0.0', true );

	$html = '<script type="text/javascript">';
    $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
    $html .= '</script>';
 
    echo $html;
}
add_action( 'wp_enqueue_scripts', 'wlpowered_get_css');

function send() {	
	$email = $_POST['email'];
	if(!is_email($email)) {
		echo "0";
		wp_die();
	}

	$name = esc_html($_POST['name']);
	$msg = esc_html(esc_textarea($_POST['msg']));

	$msg = 'Contact Name: ' . $name . '
Contact Email: ' . $email . '

' . $msg;

	$sent = mail('katerina.stasik@wonderslab.com, anton.vlasenko@wonderslab.com', 'Contact information', $msg, "From:Wonderslab Messenger\r\n");
    $sent = true;
	if($sent == true)
		echo '1';
	else
		echo '-1';
	
	wp_die();
}
add_action( 'wp_ajax_nopriv_send', 'send' );