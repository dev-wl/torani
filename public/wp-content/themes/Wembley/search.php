<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package web2feel
 */

get_header(); ?>

<style>
	.page-header {
		border: none !important;
	}
	
	.page-title {
	    width: 30% !important;
	}

	@media (max-width: 1280px)  {
		.page-title {
			width: 48% !important;
		}
	}

	@media (max-width: 1024px) {
		.page-title {
		    width: 36% !important;
		}
	}

	@media (max-width: 640px) {
		.page-title {
		    width: 50% !important;
		}
	}
</style>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="pages-header col-md-12">
				<div class="description">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'web2feel' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<div class="column"><p><?php echo $cat_text; ?></p></div><div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</header><!-- .page-header -->
	
			<div class="flex-main blog">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'blog-tpl' ); ?>

					<div class="clearfix"></div>

				<?php endwhile; ?>
			</div>
			<div class="clearfix"></div>
			<?php bootstrap_pagination();?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>