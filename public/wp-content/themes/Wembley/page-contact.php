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
		margin-top: 0px;
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

	input[type="submit"] {
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

	@media (max-width: 462px) {
		h1.page-title {
			width: 50% !important;
		}

		.column {
		    margin: 0px 0px 0px 47px;
		}
	}

	@media (max-width: 746px) {
		.description h1.page-title {
			width: 50% !important;
		}

		.column {
			width: 80%;
		    margin: 0px auto;
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

			<!-- BEGIN DIRECT MAIL SUBSCRIBE FORM -->
			<link rel="stylesheet" type="text/css" href="https://www.dm-mailinglist.com/subscribe_forms/embed.css?v=2&f=bf05580c&sbg=1" media="all">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
			<script src="https://www.dm-mailinglist.com/subscribe_forms/localized.js" charset="UTF-8"></script>
			<script src="https://www.dm-mailinglist.com/subscribe_forms/subscribe_embed.js" charset="UTF-8"></script>
			<div style="visibility:hidden;">
			<form method="post" action="https://www.dm-mailinglist.com/subscribe" data-directmail-use-ajax="1" data-form-id="bf05580c" accept-charset="UTF-8" id="bf05580c">
			<input type="hidden" name="email"></input>
			<input type="hidden" name="form_id" value="bf05580c"></input>
			<div>
			<table>
			<tr>
			<td colspan=1>Torani Coffee Newsletter Subscription</td>
			</tr>
			<tr>
			<td colspan=1></td>
			</tr>
			<tr>
			<td>
			<label for="directmail-bf05580c-first_name">First Name:</label>
			<input type="text" id="directmail-bf05580c-first_name" name="first_name" value="" placeholder="First Name" ></input>
			</td>
			</tr>
			<tr>
			<td>
			<label for="directmail-bf05580c-last_name">Last Name:</label>
			<input type="text" id="directmail-bf05580c-last_name" name="last_name" value="" placeholder="Last Name" ></input>
			</td>
			</tr>
			<tr>
			<td>
			<label for="directmail-bf05580c-custom_1">Country:</label>
			<input type="text" id="directmail-bf05580c-custom_1" name="custom_1" value="" placeholder="Country" ></input>
			</td>
			</tr>
			<tr>
			<td>
			<label for="directmail-bf05580c-subscriber_email">Email*:</label>
			<input type="email" id="directmail-bf05580c-subscriber_email" name="subscriber_email" value="" placeholder="Email*" required="required"></input>
			</td>
			</tr>
			<tr>
			<td>
			<input type="submit" value="Subscribe"></input>
			</td>
			</tr>
			</table>
			</div>
			</form>
			</div>
			<!-- END DIRECT MAIL SUBSCRIBE FORM -->
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
		$('#directmail-bf05580c-first_name').val($(theForm).find('input[type="text"]:eq(0)').val());
		$('#directmail-bf05580c-custom_1').val($(theForm).find('input[type="text"]:eq(4)').val());
		$('#bf05580c #directmail-bf05580c-subscriber_email').val($(theForm).find('input[type="email"]').val());

		if($(theForm).find('input[type="checkbox"]:checked').length == 1) {
			send = true;
		}
	});

	$(document).on('DOMNodeInserted', function(e) {
	    if ($(e.target).attr('class') == 'wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok') {
	    	if(send) {
        		$('#bf05580c').submit();
	        }
	    }
	});

</script>

<?php get_footer(); ?>