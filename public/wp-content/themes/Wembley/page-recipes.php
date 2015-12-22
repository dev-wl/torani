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
            $args = array('category' => 7, 'numberposts' => -1 );
            $myposts = get_posts( $args );
            $i = 0;
			foreach ( $myposts as $post ) : {
				setup_postdata( $post ); 
				$i++;
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-4 col-md-4 col-sm-6 col-xs-12 pbox post'); ?>>
							<?php
								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
								$image = aq_resize( $img_url, 720, 560, true ); //resize & crop the image
							?>
										
							<?php if($image) : ?>
							<a href="<?php the_permalink(); ?>"> <img class="img-responsive" src="<?php echo $image ?>"/></a>
							<?php endif; ?>	
							
							<h2 class="box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="box-meta"><?php the_excerpt(); ?></div>	
							<!-- <div class="box-meta"><?php the_category(', '); ?></div> -->
							<div class="share-icons">
								<span class="share">share</span> <?php echo do_shortcode('[huge_it_share]'); //echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
							</div>
							<div class="options">
								<a href="<?php the_permalink(); ?>" class="torani-btn read-more">READ MORE</a>
								<a href="<?php echo get_post_meta($post->ID, 'buy-now-link', true); ?>" class="torani-btn buy-now" target="_blank">BUY NOW</a>
							</div>
					</article>

					<?php if($i == 3) : ?>
						<div style="clear:both;"></div>
						<?php $i = 0; endif; ?>
			<?php } endforeach;
            wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function() {
			$.each($('#main article'), function() {
				//get direct product link 
				prod_link = $(this).find('a.read-more').attr('href');
				//clear it
				prod_link = prod_link.substr(7); 
				
				//social links - fb
				facebook = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(0)');
				old_link = facebook.attr('href').substring(facebook.attr('href').indexOf('u='), facebook.attr('href').lastIndexOf('/')+1);
				facebook.attr('href', facebook.attr('href').replace(old_link, "u=" + prod_link));
				facebook.attr('onclick', facebook.attr('onclick').replace(old_link, "u=" + prod_link));

				//twitter
				twitter = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(1)');
				old_link = twitter.attr('href').substring(twitter.attr('href').indexOf('status='), twitter.attr('href').lastIndexOf('/')+1);
				twitter.attr('href', twitter.attr('href').replace(old_link, "status=" + prod_link));
				twitter.attr('onclick', twitter.attr('onclick').replace(old_link, "status=" + prod_link));

				//pinterest
				pinterest = $(this).find('.share-icons .huge-it-share-buttons-list a:eq(2)');
				old_article_link = pinterest.attr('href').substring(pinterest.attr('href').indexOf('?url='), pinterest.attr('href').lastIndexOf('&media'));
				old_medial_link = pinterest.attr('href').substring(pinterest.attr('href').indexOf('&media'), pinterest.attr('href').lastIndexOf('&description'));
				pinterest.attr('href', pinterest.attr('href').replace(old_article_link, "?url=" + prod_link));
				pinterest.attr('href', pinterest.attr('href').replace(old_medial_link, "&media=" + $(this).find('a:eq(0) img').attr('src')));
				
				pinterest.attr('onclick', pinterest.attr('onclick').replace(old_article_link, "?url=" + prod_link));
				if($(this).find('a:eq(0) img').length > 0)
					pinterest.attr('onclick', pinterest.attr('onclick').replace(old_medial_link, "&media=" + $(this).find('a:eq(0) img').attr('src')));
			});
		}, 1000);
	});
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
