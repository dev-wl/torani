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
            $args = array('category' => 7, 'numberposts' => 31 );
            $myposts = get_posts( $args );
            $i = 0;
			foreach ( $myposts as $post ) : {
				setup_postdata( $post ); 
				$i++;
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-3 col-md-2 col-sm-2 pbox recipe'); ?>>

						<?php
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
							$image = aq_resize( $img_url, 720, 560, true ); //resize & crop the image
						?>
						
						<?php if($image) : ?>
						<a href="<?php the_permalink(); ?>"> <img class="img-responsive product" src="<?php echo $image ?>"/></a>
						<?php endif; ?>	
					
						<h2 class="box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>	
					</article><!-- #post-## -->
					<?php if($i == 6) : ?>
						<div style="clear:both;"></div>
						<?php $i = 0; endif; ?>
			<?php } endforeach;
            wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
