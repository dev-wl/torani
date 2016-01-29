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
						FOLLOW US ON <a href="http://twitter.com/toranisinglecup" target="_blank"><img src="/wp-content/themes/Wembley/twitter_1.png" /></a> <a href="https://www.facebook.com/Torani-Single-Cup-Coffee-1675206376026754/" target="_blank"><img src="/wp-content/themes/Wembley/facebook_1.png" /></a> <a href="/?p=498">Privacy Policy</a>
					</div>
					<div class="footer-right">
						<p>For more information on all Torani products</p>
						<a href="http://torani.com/" target="_blank"><p class="info">VISIT TORANI.COM</p></a>
						<p class="copy">Torani is a trademark of R. Torre &amp; Company and is used under license to Single Cup Coffee</p>
					</div>
					<div class="clearfix"></div>
				</div>		
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		</div>
	</div> <!-- footer -->
</div><!-- #page -->


<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-49590367-3', 'auto');
ga('send', 'pageview');
</script>
<?php //include_once("analyticstracking.php"); ?>


<?php wp_footer(); ?>

</body>
</html>
