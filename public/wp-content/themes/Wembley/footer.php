<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package web2feel
 */
?>

	</div><!-- #content -->
	

	</div>

	<div class="footer">
		<div id="darkener">
			
		</div>
		<div id="bottom">
				<div class="row">
				
				<?php if ( !function_exists('dynamic_sidebar')
				        || !dynamic_sidebar("Footer") ) : ?>  
				<?php endif; ?>
					
				</div>
		</div>
		<div class="row"> 
		<footer id="colophon" class="site-footer col-md-12" role="contentinfo">
			<div class="site-info">
				<div class="fcred col-12">
					<div class="footer-left">
						FOLLOW US ON <a href="http://twitter.com/"><img src="/wp-content/themes/Wembley/twitter.png" /></a> <a href="http://facebook.com"><img src="/wp-content/themes/Wembley/facebook.png" /></a> <a href="/?p=498">Privacy Policy</a>
					</div>
					<div class="footer-right">
						<a href="#"><p class="info">VISIT TORANI.COM</p></a>
						<p class="copy">Torani is a trademark of R. Torre &amp; company and is used under license to Single Cup Coffee</p>
					</div>
					<div class="clearfix"></div>
				</div>		
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		</div>
	</div> <!-- footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
