<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-12 col-md-12 col-sm-12 col-xs-12 single-product'); ?>>

			<?php
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 720, 560, true ); //resize & crop the image
			?>
						
			<?php if($image) : ?>
				<div class="image-block">
					<img class="img-responsive" src="<?php echo $image ?>"/>
					<div class="share-icons">
						<span class="share">share</span> <?php echo do_shortcode('[huge_it_share]'); //echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
					</div>
				</div>
			<?php endif; ?>	

			<div class="general">
				<div class="description">
					<h2 class="box-title"><?php the_title(); ?></h2>
				</div>
				<div class="box-meta"><?php the_content(); ?></div>	
				<div class="share-icons">
					<span class="share">share</span> <?php echo do_shortcode('[huge_it_share]'); //echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
				</div>
				<div class="options">
					<a href="<?php echo get_post_meta($post->ID, 'buy-now-link', true); ?>" class="torani-btn buy-now" target="_blank">BUY NOW</a>
				</div>
			</div>

			<div class="clearfix"></div>
	</article><!-- #post-## -->

	<div class="col-md-12">
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				// if ( comments_open() || '0' != get_comments_number() )
					// comments_template();
			?>
			</div>
		<?php endwhile; // end of the loop. ?>

		
		</main><!-- #main -->
	</div><!-- #primary -->
<script>
	// $('#main.site-main .recipe img').appendTo($('.post_images'));
	// $('#page').addClass('single-details');
	$('.post .share-icons:eq(0)').width('100%'); //$('.img-responsive').width());

	$(document).ready(function() {
		if(checkMainImage()) {
			getMainImage();
		}

		if($('.box-meta').find('img').length > 0) {
			getSecondaryImage();
		} else if(checkMainImage()) {
			getMainImage('secondary');
		}
	});

	function checkMainImage() {
		if($('#main').find('.image-block img').length > 0) {
			return true;
		}

		return false;
	}

	function getMainImage(selector) {
		if($(selector) == 'secondary')
			selector = '.general .share-icons .huge-it-share-buttons-list a:eq(2)';
		else
			selector = '.image-block .share-icons .huge-it-share-buttons-list a:eq(2)';
		pinterest = $(selector);
		old_medial_link = pinterest.attr('href').substring(pinterest.attr('href').indexOf('&media'), pinterest.attr('href').lastIndexOf('&description'));
		pinterest.attr('href', pinterest.attr('href').replace(old_medial_link, "&media=" + $('.image-block img').attr('src') ));
		pinterest.attr('onclick', pinterest.attr('onclick').replace(old_medial_link, "&media=" + $('.image-block img').attr('src') ));
		console.log('done all');
	}

	function getSecondaryImage() {
		img = $('.box-meta img:eq(0)');
		pinterest = $('.general .share-icons .huge-it-share-buttons-list a:eq(2)');
		old_medial_link = pinterest.attr('href').substring(pinterest.attr('href').indexOf('&media'), pinterest.attr('href').lastIndexOf('&description'));
		pinterest.attr('href', pinterest.attr('href').replace(old_medial_link, "&media=" + $(img).attr('src') ));
		pinterest.attr('onclick', pinterest.attr('onclick').replace(old_medial_link, "&media=" + $(img).attr('src') ));
	}
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>