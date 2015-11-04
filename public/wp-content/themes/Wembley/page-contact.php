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
		
			<div class="flex-main blog">
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						//get_template_part( 'blog-tpl', get_post_format() );

						if(!true)
							echo do_shortcode('[contact-form-7 id="374" title="Contact form 1"]');
						else
							echo do_shortcode('[contact-form-7 id="375" title="contact form business"]');
					?>

			</div>
			<div class="clearfix"></div>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>