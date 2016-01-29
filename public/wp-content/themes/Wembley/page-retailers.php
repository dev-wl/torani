<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="flex-main blog">
				<?php
	            global $post;
	            $args = array('category' => 16, 'numberposts' => -1 );
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
								<a href="<?php echo get_post_meta($post->ID, 'buy-now-link', true); ?>" target="_blank"> <img class="img-responsive" src="<?php echo $image ?>"/></a>
								<?php endif; ?>	
								
								<h2 class="box-title"><a href="<?php echo get_post_meta($post->ID, 'buy-now-link', true); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a></h2>
								<div class="box-meta"><?php the_excerpt(); ?></div>	
								<!-- <div class="box-meta"><?php the_category(', '); ?></div> -->
								
								<div class="options">
									<a href="<?php echo get_post_meta($post->ID, 'buy-now-link', true); ?>" target="_blank" class="torani-btn read-more">BUY NOW</a>
								</div>
						</article>

						<?php 
							if($i == 3) : ?>
							<div style="clear:both;"></div>
							<?php $i = 0; endif; ?>
				<?php } endforeach;
	            wp_reset_postdata(); ?>
	        </div>
		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>