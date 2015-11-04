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
	}

	.column {
		-moz-columns: auto 1;
		columns: auto 1;
		-webkit-columns: auto 1;
		font-size: 20px;
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
</script>

<?php get_footer(); ?>