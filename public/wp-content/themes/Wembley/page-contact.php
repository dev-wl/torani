<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 */

get_header(); ?>
<style type="text/css">
	#main {
		margin-top: -40px;
		padding-top: 0px;
	}

	.description {
		margin-bottom: 20px;
		justify-content: initial !important;
	}

	.column {
		-moz-columns: auto 1;
		columns: auto 1;
		-webkit-columns: auto 1;
		font-size: 20px;
		margin-left: 17%;
	}
	
	input, textarea {
		border: none;
	}

	#main input[type="submit"] {
	    background: linear-gradient(to bottom, #f78e18, #f78218);
	    outline: none;
	    color: #fff;
	    text-transform: uppercase;
	    box-shadow: none;
	    border: 0px #f7aa52;
	    padding: 3px 15px;
	}

	input[type="submit"]:active {
	   box-shadow: 0px 0px 7px 0px inset;
	}

	@media (device-width: 768px) {
		.description h1.page-title {
			/*width: 50% !important;*/
			width: 19% !important;
		}

		.column {
			width: 80%;
		    margin: 0px auto;
		}
	}

	@media (max-width: 746px) {
		.description h1.page-title {
			/*width: 50% !important;*/
			width: 19% !important;
		}

		.column {
			width: 80%;
		    margin: 0px auto;
		}
	}

	@media (max-width: 640px) and (orientation: portrait) {
		.description h1.page-title {
		    width: 100% !important;
		}
	}

	@media (max-width: 462px) {
		h1.page-title {
			width: 50% !important;
		}

		.column {
		    margin: 0px 0px 0px 47px;
		}
	}

	
</style>

	<div class="col-md-12 intro-me clearfix">
		<h2> <?php echo ft_of_get_option('fabthemes_welcome_title'); ?></h2>
		<p> <?php echo ft_of_get_option('fabthemes_welcome_text'); ?> </p>
	</div>
	
	
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
			<div class="description">
				<h1 class="page-title">CONTACT US</h1> 
				<?php 
					$cat_text = get_page_by_title('Contact us info', 'ARRAY_A', 'post' );
					$cat_text = $cat_text['post_content']; 
				?>
				<div class="column"><p><?php echo $cat_text; ?></p></div><div class="clearfix"></div>
			</div>
		
			<div class="flex-main">
				<div class="contact-form">
					<div class="radio-btns">
						<input type="radio" name="form-opt" value="Customer" id="customer" checked/> <label for="customer">Customer</label>
						<input type="radio" name="form-opt" value="Business" id="business"/> <label for="business">Business</label>
					</div>	
					
					<div id="form-customer">
						<?php echo do_shortcode('[contact-form-7 id="374" title="Contact form 1"]'); ?>
					</div>

					<div id="form-business">
						<?php echo do_shortcode('[contact-form-7 id="375" title="contact form business"]'); ?>
					</div>
				</div>
			</div>

			<!-- Begin MailChimp Signup Form -->
			<div style="visibility:hidden;">
				<!-- <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css"> -->

				<div id="mc_embed_signup">
					<form action="//coffeemarvel.us8.list-manage.com/subscribe/post?u=533848f743a26d8c40a07bda8&amp;id=5ed4181b04" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
						
					<div class="mc-field-group">
						<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
						<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
					</div>
					<div class="mc-field-group">
						<label for="mce-FNAME">First Name </label>
						<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
					</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_533848f743a26d8c40a07bda8_5ed4181b04" tabindex="-1" value=""></div>
					    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
					    </div>
					</form>
				</div>
			</div>

			<!--End mc_embed_signup-->

			<div class="clearfix"></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<script>
	$("input:radio[name='form-opt']").change(function() {
		if ($("input:radio[name='form-opt']:checked").val() == 'Customer') {
			$('#form-business').slideUp();
			$('#form-customer').slideDown();
		}
		else {
			$('#form-customer').slideUp();
			$('#form-business').slideDown();
		}
	});

	if ($("input:radio[name='form-opt']:checked").val() == 'Customer') {
		$('#form-business').slideUp();
		$('#form-customer').slideDown();
	}
	else {
		$('#form-customer').slideUp();
		$('#form-business').slideDown();
	}

	var theForm;
	var send = false;

	
	

	$('.wpcf7 input[type="submit"]').click(function() {
		theForm = $(this).parent().parent();
		$('#mce-FNAME').val($(theForm).find('input[type="text"]:eq(0)').val());
		$('#mce-EMAIL').val($(theForm).find('input[type="email"]').val());

		if($(theForm).find('input[type="checkbox"]:checked').length == 1) {
			send = true;
		}
	});

	$(document).on('DOMNodeInserted', function(e) {
	    if ($(e.target).attr('class') == 'wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok') {
	    	if(send) {
        		$('#mc-embedded-subscribe-form').submit();
	        }
	    }
	});

</script>

<?php get_footer(); ?>