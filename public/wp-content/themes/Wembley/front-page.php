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

	@media(min-device-width: 1281px) {
			#primary {
				padding-bottom: initial !important;
			}

			#main {
				padding-top: 0px !important;
				margin: 74px auto 0px;
			}

			#content {
				padding-bottom: 40px !important;
			}
	}

	@media (device-width: 768px) and (orientation: portrait) {
		.feed:nth-child(3) {
		    left: 9% !important;
		}

		.feed:nth-child(3), .feed:last-child {
		    top: 428px !important;
		}
	}

	@media (device-width: 768px) and (orientation: landscape) {
		.grid {
			height: 1290px;
		}

		#main {
			margin: 32px auto 0px auto;
		}

		.grid-item:nth-child(2) {
			top: 600px !important;
		}

		.feed:nth-child(3), .feed:last-child {
		    top: 803px !important;
		}
	}


	@media(max-width: 640px) {
		#main {
		    margin-top: 0px;
	        margin: 0px 10% !important;
		    padding-top: 81px !important;
		}
	}

	@media (max-width: 400px) and (orientation: portrait) {
		#main {
			margin: 32px 10%;
		}
	}

</style>

	<div class="col-md-12 intro-me clearfix">
		<p> <?php echo ft_of_get_option('fabthemes_welcome_text'); ?> </p>
	</div>
	
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
			<div class="grid">
				<!-- css slider -->
					<?php if(get_option('m_slider_enabled') == 1): ?>

						<?php
							$mainSlider = get_posts(array(
								'numberposts'		=> -1,
								'orderby'			=> 'menu_order',
								'order'				=> 'ASC',
								'post_type'			=> 'Micro Slider',
								'post_parent'		=> 0
							));

							$id = $mainSlider[0]->ID;

							$slidePosts = get_posts(array(
								'numberposts'		=> -1,
								'orderby'			=> 'menu_order',
								'order'				=> 'ASC',
								'post_parent'		=> $id,
								'post_type'			=> 'Micro Slider'
							));

							$pic_count = count($slidePosts);
						?>



						<div class="sl-wrapper grid-item grid-item--width3">
							<?php for($i=1; $i<=$pic_count; $i++): ?>
								<input type="radio" name="point" id="<?php echo 'slide' . $i; ?>" value="" <?php checked($i, 1); ?> >
							<?php endfor; ?>
							
							<div class="slider">
								<?php $i=1; foreach ($slidePosts as $slider): ?>
								<?php 
									$attach = get_attached_media( 'image', $slider->ID);
									$cleanedObject = current($attach);
									$the_meta = get_post_meta ( $slider->ID, 'description', false);
								?>
								<div class="slides <?php echo 'slide' . $i?> <?php echo get_option('effects') == 'on' ? 'slides-zoomy' : ''?>" style="background-image:url('')">
									<div>
										<img src="<?php echo $cleanedObject->guid?>" />
										<?php if($the_meta[0] != '') : ?>
											<div class="text"><?php echo $the_meta[0]; ?></div>
										<?php endif; ?>
									</div>
								</div>
								<?php $i++; ?>
								<?php endforeach; ?>
							</div>	
							<div class="controls">
								<?php for($i=1; $i<=$pic_count; $i++): ?>
									<label for="<?php echo 'slide' . $i; ?>"></label>
								<?php endfor; ?>
							</div>
						</div>
						
						<?php
							$backgrounds = '';
							for($i=1; $i<=$pic_count; $i++) {
								$backgrounds .= '#slide' . $i . ':checked ~ .controls label:nth-of-type(' . $i .')';
								if($i != $pic_count)
									$backgrounds .= ', ';
							}

							$selectors = '';
							for($i=1; $i<=$pic_count; $i++) {
								$selectors .= '#slide' . $i . ':checked ~ .slider > .slide' . $i .'';
								if($i != $pic_count)
									$selectors .= ', ';
							}
						?>
						
						

					<?php endif; ?>
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
									<img src='<?php echo $img_url?>' alt=''/>
							</div>
						<?php endif; ?>
						  </div>
						<?php } endforeach;?>
							
						<div class="grid-item grid-item--heightFeed grid-item--widthFeed feed tw-feed">
							<div class="feed-header">
								<h1><label class="feed-image tw"></label> twitter</h1>
							</div>
					            <a class="twitter-timeline"  href="https://twitter.com/toranisinglecup" data-widget-id="677043375565049856">Tweets by @toranisinglecup</a>
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


			<div class="clearfix"></div>
			<div class="col-md-12">
			<?php bootstrap_pagination();?>
			</div>
	
		</main><!-- #main -->
	</div><!-- #primary -->
	
<style>
	<?php echo $backgrounds; ?> {
		background: #ffc718;
	}

	<?php echo $selectors; ?> {
		opacity: 1;
		z-index: 1;
		-webkit-transform: scale(1);
		-ms-transform: scale(1);
		transform: scale(1);
		background-size: 100% auto;
	}
</style>

<script>
	$('.grid').masonry({
		  // options
		  itemSelector: '.grid-item',
		  columnWidth: 7
		});

	$(window).on('load', function() {
		var current = 0;
		var total_slides = $('.sl-wrapper input[type="radio"]').length;
		
		<?php if (get_option('m_slider_mode') == 'auto'): ?>
			setInterval(function() {
				$('.sl-wrapper input[type="radio"]:eq(' + current + ')').prop('checked', true);
				current++;
				if(current > total_slides-1)
					current = 0;
			}, 4500);
		<?php endif; ?>

		if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('.grid').masonry({
			  // options
			  itemSelector: '.grid-item',
			  columnWidth: 7
			});
		}
		$(document).on('click', '.back .link_container', function(e) {
			window.location.href = $(this).find('a').attr('href');
		});
	});

	//if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	
	$(document).ready(function() {
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			window.addEventListener('orientationchange', function() {
				$('body').css('opacity', '0.5');
				window.location = window.location;
			});
		}

		if($(window).width() <= 640) {
			$('.sl-wrapper .slider').css('height', $('.slider .slides:eq(0) img').height() + 'px');	
		}
		 $('.flipper_container').css('height', $('.front.face img').height());
		 $('.sl-wrapper').css('height', $('.slider .slides:eq(0) img').height() + 'px');
		// $('.feed').css('margin-top', $('.front.face img').height() + 10 + 'px');

		if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1)
			$('.sl-wrapper').css('height', '530px');
	})

	$(window).on('resize', function() {
		$('.flipper_container').css('height', $('.front.face img').height());
		$('.sl-wrapper').css('height', $('.slider .slides:eq(0) img').height() + 'px');
		// $('.feed:eq(0)').css('margin-top', $('.front.face img').height() + 80 + 'px');
	});

	if($(window).width() < 1100 ) {
		// $('.grid-item.grid-item--width3:eq(1)').css('margin-left', $('.grid-item.grid-item--width3:eq(0)').offset().left);
		// if($(window).width() >= 768)
		// 	$('.grid-item.grid-item--heightFeed:eq(0)').css('margin-left', $('.grid-item.grid-item--width3:eq(0)').offset().left);
	}
	
</script>

<?php get_footer(); ?>