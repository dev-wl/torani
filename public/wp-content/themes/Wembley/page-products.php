<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php
            global $post;
            $args = array('category' => 2, 'numberposts' => -1 );
            $myposts = get_posts( $args );
            $i = 0;
			foreach ( $myposts as $post ) : {
				setup_postdata( $post ); 
				$i++;
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-2 col-md-2 col-sm-2 pbox'); ?>>

						<?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 720, 560, true ); //resize & crop the image
						?>
						
						<?php if($image) : ?>
						<a href="<?php the_permalink(); ?>"> <img class="img-responsive product" src="<?php echo $image ?>"/></a>
						<?php endif; ?>	
					
						<h2 class="box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="box-meta"><?php the_category(', '); ?></div>	
					</article><!-- #post-## -->
					<?php if($i == 3) : ?>
						<div style="clear:both;"></div>
						<?php $i = 1; endif; ?>
			<?php } endforeach;
            wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<script type="text/javascript">
		$(document).ready(function() {
			$.each($('.flex-main article', function() {
				//get direct product link 
				prod_link = $(this).find('a.read-more').attr('href');
				//clear it
				prod_link = prod_link.substr(7); 
				
				//social links
				facebook = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(0)');
				old_link = facebook.substr(facebook.indexOf('u='), facebook.lastIndexOf('/'));
				facebook.replace(old_link, "u=" + prod_link);
				facebook.attr('onclick').replace(old_link, "u=" + prod_link);

				alert('done');
				// twitter = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(1)');
				// pinterest = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(2)');
				
			});
		});
	</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
