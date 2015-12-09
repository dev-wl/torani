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
<?php
	global $post;
	setup_postdata( $post );
?>

<style>
	.description {
		display: block !important;
	}
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 blogpost'); ?> style="margin-top: 55px;">

		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 1200, 720, true ); //resize & crop the image
		?>
					
		<?php if($image) : ?>
			<div class="image-block">
				<img class="img-responsive singlepic" src="<?php echo $image ?>"/>
				<div class="share-icons">
					<span class="share">share</span> <?php echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
				</div>
			</div>
		<?php endif; ?>	

	<div class="entry-content" style="text-align:justify;">
		<div class="description">
			<h2 class="page-title"><?php the_title(); ?></h2>
		</div><!-- header -->
		<?php echo get_the_content(); ?>
		<div class="share-icons">
			<span class="share">share</span> <?php echo do_shortcode('[DISPLAY_ULTIMATE_PLUS]'); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

<script>
	$(document).ready(function() {
		$(".sfsiplus_inerCnt").find("div.sfsi_tool_tip_2").hide();
	});
</script>

<?php get_footer(); ?>