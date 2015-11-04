<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package web2feel
 */

get_header(); ?>

<style>
	.page-title {
	    width: 49% !important;
	}

	@media (max-width: 1280px)  {
		.page-title {
			width: 46% !important;
		}

		.page-content {
		    max-width: 90%;
		    margin: 0px auto;
		}
	}

	@media (max-width: 1024px)  {
		.page-title {
			width: 46% !important;
		}
	}

	@media (max-width: 640px) {
		.page-title {
			width: 65% !important;
		}
	}
</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found col-md-12">
				<header class="pages-header">
					<div class="description">
						<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'web2feel' ); ?></h1>
					</div>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'web2feel' ); ?></p>

					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>