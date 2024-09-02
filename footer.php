		</div>

	</div>

	<footer id="footer">

		<div class="widgets group">

			<?php dynamic_sidebar( 'Footer Widgets' ); ?>

		</div>

		<p id="copyright" class="source-org vcard copyright"><small>&copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?>. All Rights Reserved.</small></p>

	</footer>

	<?php wp_footer(); ?>

	<!-- Scripts -->

	<script src="<?php bloginfo('template_directory'); ?>/-/js/flexslider.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/mosaic.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/tabs.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/easing.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/equal.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/simplemodal.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/carousel.js"></script>

	<script>

		// Google Maps

		<?php if (stripos($_SERVER['REQUEST_URI'],'/contact') !== false) { ?>
			$(window).load(function() {
				initialize();
			});
		<?php } ?>

	</script>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/functions.js"></script>

	<!--
	
		Asynchronous google analytics; this is the official snippet.
		Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	
		<script>
	
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
			_gaq.push(['_trackPageview']);
	
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
	
		</script>
	
	-->

</body>

</html>