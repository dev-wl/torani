<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package web2feel
 */

get_header(); ?>
<style type="text/css">
	#page {
		background-color: #eae4d8;
	}
</style>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="pages-header col-md-12">
				<div class="description">
					<h1 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title();
								$id = get_the_category();
								$id = $id[0]->term_id;
								if($id == 11) {
									$cat_text = get_page_by_title('Coffee Description', 'ARRAY_A', 'post' );
									$cat_text = $cat_text['post_content'];
								}
								else if($id == 12) {
									$cat_text = get_page_by_title('Flavored coffee description', 'ARRAY_A', 'post' );
									$cat_text = $cat_text['post_content'];
								} else if($id == 13) {
									$cat_text = get_page_by_title('Indulgent beverages', 'ARRAY_A', 'post' );
									$cat_text = $cat_text['post_content'];
								}
								$a = null;

							elseif ( is_tag() ) :
								single_tag_title();

							// elseif ( is_author() ) :
							// 	/* Queue the first post, that way we know
							// 	 * what author we're dealing with (if that is the case).
							// 	*/
							// 	the_post();
							// 	printf( __( 'Author: %s', 'web2feel' ), '<span class="vcard">' . get_the_author() . '</span>' );
							// 	/* Since we called the_post() above, we need to
							// 	 * rewind the loop back to the beginning that way
							// 	 * we can run the loop properly, in full.
							// 	 */
							// 	rewind_posts();

							// elseif ( is_day() ) :
							// 	printf( __( 'Day: %s', 'web2feel' ), '<span>' . get_the_date() . '</span>' );

							// elseif ( is_month() ) :
							// 	printf( __( 'Month: %s', 'web2feel' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							// elseif ( is_year() ) :
							// 	printf( __( 'Year: %s', 'web2feel' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							// elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							// 	_e( 'Asides', 'web2feel' );

							// elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							// 	_e( 'Images', 'web2feel');

							// elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							// 	_e( 'Videos', 'web2feel' );

							// elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							// 	_e( 'Quotes', 'web2feel' );

							// elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							// 	_e( 'Links', 'web2feel' );

							// else :
							// 	_e( 'Archives', 'web2feel' );

							endif;
						?>
					</h1> 
					<div class="column"><p><?php echo $cat_text; ?></p></div><div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div class="flex-main">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */	
						get_template_part( 'product_tpl', get_post_format() );

					?>

				<?php endwhile; ?>
			</div>
			<div class="clearfix"></div>
			<?php bootstrap_pagination();?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function() {
			$.each($('.flex-main article'), function() {
				//get direct product link 
				prod_link = $(this).find('a.read-more').attr('href');
				//clear it
				prod_link = prod_link.substr(7); 
				
				//social links
				facebook = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(0)');
				old_link = facebook.attr('href').substr(facebook.attr('href').indexOf('u='), facebook.attr('href').lastIndexOf('/'));
				facebook.attr('href', facebook.attr('href').replace(old_link, "u=" + prod_link));
				facebook.attr('onclick', facebook.attr('onclick').replace(old_link, "u=" + prod_link));

				twitter = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(1)');
				old_link = twitter.attr('href').substr(twitter.attr('href').indexOf('status='), twitter.attr('href').lastIndexOf('/'));
				console.log("old_link = " + old_link);
				twitter.attr('href', twitter.attr('href').replace(old_link, "status=" + prod_link));
				twitter.attr('onclick', twitter.attr('onclick').replace(old_link, "status=" + prod_link));


				// pinterest = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(2)');
				
			});
		}, 2000);
	});
</script>

<?php get_footer(); ?>
