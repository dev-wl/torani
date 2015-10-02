<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 */

get_header(); ?>

	<div id="primary" class="content-area	">
		<main id="main" class="site-main" role="main">
		<div class="col-lg-8 col-lg-offset-2 product">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h2 class="single-title"> <?php the_title();?> </h2>
				<div class="post_images">
					<?php
						$thumb = get_post_thumbnail_id($post->ID);
						$img_url = wp_get_attachment_url( $thumb,'small' );
					?>
					<img src="<?php echo $img_url;?>" />
				</div>

				<div class="recipe">
					<?php the_content(); ?>
				</div>

				<?php
					$str = '';
					$i = 0;
					$search = ' ';
					$tag = wp_get_post_tags( get_the_ID() ); 
					foreach ($tag as $key) {
						$str = strtolower(str_replace(' ', '-', $key->name));
						if($i == 0)
							$search = $str;
						$i++;
						if($i > 1) {
							$search .= ', ';
							$search .= $str;
						}
					}

					$args = array(
						'tag' => $search,
						'category' => 7,
					);

					$postslist = get_posts( $args );
					// print_r($postslist);
				?>
				<div class="clearfix">
				<h3 class="featured">RECIPES WITH THIS PRODUCT</h3>
				<?php foreach ($postslist as $post): ?>
					<div class="related_recipe col-lg-4">
						<h5><a href="<?php echo $post->guid;?>"><?php echo $post->post_title; ?></a></h5>
						<?php
							 $thumb = get_post_thumbnail_id($post->ID);
							 $img_url = wp_get_attachment_url( $thumb,'small' );
						 ?>
					</div>
				<?php endforeach; ?>

				<div class="clearfix"></div>

				<?php web2feel_content_nav( 'nav-below' ); ?>
				
				<div class="col-lg-12 col-md-12 col-lg-offset-2">
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					//if ( comments_open() || '0' != get_comments_number() )
					//	comments_template();
				?>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<script>
	$('#page').addClass('single-details');
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>