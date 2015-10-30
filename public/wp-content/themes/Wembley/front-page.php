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
<style>
	.container {
		width: 100% !important;
		max-width: 100%;
	}

	img {
		max-width: none;
	}
</style>
	<div class="col-md-12 intro-me clearfix">
		<p> <?php echo ft_of_get_option('fabthemes_welcome_text'); ?> </p>
	</div>
	
	
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
			<div class="grid">
				<!-- css slider -->
					<div class="sl-wrapper grid-item grid-item--width3">
						<input type="radio" name="point" id="slide1" checked>
						<input type="radio" name="point" id="slide2">
						<input type="radio" name="point" id="slide3">
						<input type="radio" name="point" id="slide4">
						<input type="radio" name="point" id="slide5">
						<div class="slider">
							<div class="slides slide1"></div>
							<div class="slides slide2"></div>
							<div class="slides slide3"></div>
							<div class="slides slide4"></div>
							<div class="slides slide5"></div>
						</div>	
						<div class="controls">
							<label for="slide1"></label>
							<label for="slide2"></label>
							<label for="slide3"></label>
							<label for="slide4"></label>
							<label for="slide5"></label>
						</div>
					</div>
				<!-- eofcss slide -->
				<?php /* Start the Loop */ ?>
				<?php
	            global $post;
	            $args = array('category' => 4, 'numberposts' => -1, 'orderby' => 'date', 'order' => 'ASC' );
	            $myposts = get_posts( $args );
	            $i = 0;
				foreach ( $myposts as $post ) : {
					setup_postdata( $post );
					$i++;
					if($i == 1)
						continue;
					?>
						<?php
							$thumb_id = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb_id,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
						
							$res = getimagesize($img_url);

							$additional = '';
							if($res[0] == 460)
								$additional .= ' grid-item--width2';
							if($res[0] == 900)
								$additional .= ' grid-item--width3';
							if($res[1] == 460)
								$additional .= ' grid-item--height2';
						  ?> 
						  <div class="grid-item <?php echo $additional;?>">
						  <?php if($i == 1) : ?>
						  	<img src='<?php echo $img_url?>' alt=''/>
						  <?php else : ?>
							<div class="flipper_container">
								<div class="flipper shadow">
									<div class="front face">
										<img src='<?php echo $img_url?>' alt=''/>
									</div>
									<div class="back face center">
									    <?php $i = catch_that_image();?>
									    <img src='<?php echo $i; ?>' alt=''/>
									    <?php the_excerpt(); ?>
								  </div>
								</div>
							</div>
						<?php endif; ?>
						  </div>
						<?php } endforeach;?>
							
						<div class="grid-item grid-item--heightFeed grid-item--widthFeed feed tw-feed">
							<div class="feed-header">
								<h1><label class="feed-image tw"></label> twitter</h1>
							</div>
								<a class="twitter-timeline"  href="https://twitter.com/Skinnygirl_tea" data-widget-id="644784352090550272">Tweets by @Skinnygirl_tea</a>
					            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>

						<div class="grid-item grid-item--heightFeed feed fb-feed">
							<div class="feed-header">
								<h1><label class="feed-image fb"></label> facebook</h1>
							</div>
							<?php echo do_shortcode('[facebook-feed]'); ?>
						</div>
				<?php
	            wp_reset_postdata(); ?>
            </div>

            <div class="mobile">
            	<?php 
            	 global $post;
	            $args = array('category' => 4, 'numberposts' => -1, 'orderby' => 'date', 'order' => 'ASC' );
	            $myposts = get_posts( $args );
	            $i = 0;
				foreach ( $myposts as $post ) : {
					setup_postdata( $post );
					?>
						<?php
							$thumb_id = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb_id, 'meduim' ); //get full URL to image (use "large" or "medium" if the images too big)
						?>
							
						<article class="col-md-4 col-sm-4 pbox post-83 post type-post status-publish format-standard has-post-thumbnail hentry">
							<a href="<?php get_permalink(); ?>"><img class="img-responsive" src="<?php echo $img_url;?>" /></a>
							<h2 class="box-title">
								<a href="<?php get_permalink(); ?>"><?php echo get_the_title();?></a>
							</h2>
							<div class="box-meta">
							  	<?php echo wp_strip_all_tags( get_the_content() ); ?>
							</div>
						</article>
						  
						<?php } endforeach;
	            wp_reset_postdata(); ?>

	            <div class="feed tw-feed">
							<div class="feed-header">
								<h1><label class="feed-image tw"></label> twitter</h1>
							</div>
								<a class="twitter-timeline"  href="https://twitter.com/Skinnygirl_tea" data-widget-id="644784352090550272">Tweets by @Skinnygirl_tea</a>
					            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>

						<div class="feed fb-feed">
							<div class="feed-header">
								<h1><label class="feed-image fb"></label> facebook</h1>
							</div>
							<?php echo do_shortcode('[facebook-feed]'); ?>
						</div>


            </div>

			<div class="clearfix"></div>
			<div class="col-md-12">
			<?php bootstrap_pagination();?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<script>
	$(window).on('load', function() {
		$('.grid').masonry({
		  // options
		  itemSelector: '.grid-item',
		  columnWidth: 7
		});
		$(document).on('click', '.back .link_container', function(e) {
			window.location.href = $(this).find('a').attr('href');
		});
	});
</script>

<?php get_footer(); ?>