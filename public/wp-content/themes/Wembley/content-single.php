<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 blogpost'); ?>>

		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 1200, 720, true ); //resize & crop the image
		?>
					
		<?php if($image) : ?>
			<div class="image-block">
				<img class="img-responsive singlepic" src="<?php echo $image ?>"/>
				<div class="share-icons">
					<span class="share">share</span> <?php echo do_shortcode('[huge_it_share]'); //echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
				</div>
			</div>
		<?php endif; ?>	

	<div class="entry-content">
		<div class="description">
			<h2 class="page-title"><?php the_title(); ?></h2>
		</div><!-- header -->

		<?php the_content(); ?>
		<div class="share-icons">
			<span class="share">share</span> <?php echo do_shortcode('[huge_it_share]'); //echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
		</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'web2feel' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			// $category_list = get_the_category_list( __( ', ', 'web2feel' ) );

			/* translators: used between list items, there is a space after the comma */
			// $tag_list = get_the_tag_list( '', __( ', ', 'web2feel' ) );

			// if ( ! web2feel_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				// if ( '' != $tag_list ) {
					// $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
				// } else {
					// $meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
				// }

			// } else {
				// But this blog has loads of categories so we should probably display them here
				// if ( '' != $tag_list ) {
					// $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
				// } else {
					// $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
				// }

			// } // end check for categories on this blog

			/*printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);*/
		?>

		<?php edit_post_link( __( 'Edit', 'web2feel' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->

<script>
	//temporary js to align share icons next to the post image
	$(document).ready(function() {
		setTimeout(function() {
			$('.post .share-icons:eq(0)').width('100%'); //$('.img-responsive').width());
		}, 500);

		if(checkMainImage()) {
			getMainImage();
		}

		if($('.box-meta').find('img').length > 0) {
			getSecondaryImage();
		} else if(checkMainImage()) {
			selector = '.general .share-icons .huge-it-share-buttons-list a:eq(2)';
			pinterest = $(selector);
			old_medial_link = pinterest.attr('href').substring(pinterest.attr('href').indexOf('&media'), pinterest.attr('href').lastIndexOf('&description'));
			pinterest.attr('href', pinterest.attr('href').replace(old_medial_link, "&media=" + $('.image-block img').attr('src') ));
			pinterest.attr('onclick', pinterest.attr('onclick').replace(old_medial_link, "&media=" + $('.image-block img').attr('src') ));
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