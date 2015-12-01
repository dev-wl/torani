<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 */

get_header(); ?>

	<div id="primary" class="content-area	">
		<main id="main" class="site-main" role="main">
		<div class="col-lg-8 col-lg-offset-2">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h2 class="single-title"> <?php the_title();?> </h2>
				<div class="post_images recipe"></div>

				<div class="recipe">
					<?php the_content(); ?>
				</div>

				<?php
					$str = '';
					$i = 0;
					$search = ' ';
					$tag = wp_get_post_tags( get_the_ID() ); 
					foreach ($tag as $key) {
						$i++;
						$str = strtolower(str_replace(' ', '-', $key->name));
						if($i > 1)
							$search .= ', ';
						$search .= $str;
					}

					$args = array(
						'tag' => $search,
						'category' => 2,
					);
					$postslist = get_posts( $args );
				?>
				<div class="clearfix"></div>
				<h3 class="featured">FEATURED IN THIS RECIPE</h3>
				<?php foreach ($postslist as $post): ?>
					<div class="related_product">
						<a href="<?php echo $post->guid;?>"><h5><?php echo $post->post_title; ?></h5></a>
						<?php
							 $thumb = get_post_thumbnail_id($post->ID);
							 $img_url = wp_get_attachment_url( $thumb,'small' );
						 ?>
						 <a href="<?php echo $post->guid;?>" class="buy">BUY NOW</a>
						<img src="<?php echo $img_url; ?>" alt="">
					</div>
				<?php endforeach; ?>
				<div class="clearfix"></div>

				<?php web2feel_content_nav( 'nav-below' ); ?>
				
				<div class="col-lg-12 col-md-12 col-lg-offset-2">
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<script>
	$('#main.site-main .recipe img').appendTo($('.post_images'));
	$('#page').addClass('single-details');
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>