<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="ie ie7 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie ie9 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">

	<meta charset="<?php bloginfo('charset'); ?>">

	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		<?php
			if (function_exists('is_tag') && is_tag()) {
				single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
			elseif (is_archive()) {
				wp_title(''); echo ' Archive - '; }
			elseif (is_search()) {
				echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
			elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title('-', true, 'right'); }
			elseif (is_404()) {
				echo 'Not Found - '; }
			if (is_home() || is_front_page()) {
				bloginfo('name'); echo ' - '; bloginfo('description'); }
			else {
				bloginfo('name'); }
			if ($paged>1) {
				echo ' - page '. $paged; }
		?>
	</title>

	<meta name="title" content="<?php
			if (function_exists('is_tag') && is_tag()) {
				single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
			elseif (is_archive()) {
				wp_title(''); echo ' Archive - '; }
			elseif (is_search()) {
				echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
			elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title('-', true, 'right'); }
			elseif (is_404()) {
				echo 'Not Found - '; }
			if (is_home() || is_front_page()) {
				bloginfo('name'); echo ' - '; bloginfo('description'); }
			else {
				bloginfo('name'); }
			if ($paged>1) {
				echo ' - page '. $paged; }
		?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<meta name="google-site-verification" content="">

	<meta name="author" content="Tune Development -- http://www.tunedevelopment.com">
	<meta name="Copyright" content="Copyright 2012 Sport Graphics. All Rights Reserved.">

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<meta name="apple-mobile-web-app-title" content="SportG">

	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/-/media/touch-icon-114.png">
	<!-- For iPad -->

	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/-/media/touch-icon-72.png">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/-/media/touch-icon-144.png">

	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/-/media/touch-icon.png">

	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/-/media/favicon.png">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

	<script src="<?php bloginfo('template_directory'); ?>/-/js/modernizr.js"></script>
	
	<!--[if (lt IE 9) & (!IEMobile)]>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/-/js/respond.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/-/js/selectivizr.js"></script>
	<![endif]-->

	<script src="<?php bloginfo('template_directory'); ?>/js-global/FancyZoom.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js-global/FancyZoomHTML.js" type="text/javascript"></script>

	<script>
	
		function initialize() {

			var myLatlng = new google.maps.LatLng(39.8191, -85.9929);
			
			var mapOptions = {
				zoom: 15,
				center: myLatlng,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
				}
			
			var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			
			var contentString =

				'<div id="content">'+

					'<div id="siteNotice">'+'</div>'+

					'<h1 id="firstHeading" class="firstHeading"><b>Sport Graphics</b></h1>'+

					'<div id="bodyContent">'+

						'<p>3423 Park Davis Circle,<br />' +
						'Indianapolis, IN, United States<br />' +
						'(317) 899-7000</p>' +

						'<p><a href="https://maps.google.com/maps?ie=UTF8&cid=2333795856403407044&q=Sport+Graphics&iwloc=A&gl=US&hl=en">Get directions &raquo;</a></p>' +

					'</div>'+

				'</div>';
			
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

			var image = 'http://sportg.tunedev.com/wp-content/themes/sg/-/media/map-icon.png';
			var myLatLng = new google.maps.LatLng(39.8186, -85.9929);

			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				icon: image
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});

		}

	</script>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>

	<script src="<?php bloginfo('template_directory'); ?>/-/js/jquery.isotope.min.js"></script>

	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "ur-66b8bbfd-285e-86ba-908d-1944ce51531c"});</script>

</head>

<body <?php body_class(); ?> onload="setupZoom()">

	<div id="page">

		<header id="header">

			<div class="inner-wrap">

				<hgroup>
	
					<h1 id="site-title"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
	
					<h2 id="site-description"><?php bloginfo('description'); ?></h2>
	
				</hgroup>

				<div class="toggle-wrap">
	
					<nav id="access">
	
						<h3 class="toggle">Menu</h3>
	
						<?php $defaults = array(
			
							'theme_location'  => 'primary',
							'menu'            => '', 
							'container'       => '', 
							'container_class' => '', 
							'container_id'    => '',
							'menu_class'      => 'menu', 
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '<span>',
							'link_after'      => '</span>',
							'items_wrap'      => '<div class="nav"><ul role="navigation" class="menu">%3$s</ul></div>',
							'depth'           => 1,
							'walker'          => ''
			
						); ?>
						
						<?php wp_nav_menu( $defaults ); ?>
	
					</nav>
		
					<div class="search">
		
						<?php get_search_form(); ?>
		
						<div class="social">
		
							<h3 class="assistive">Follow Us</h3>
		
							<ul class="social">
								<li class="twitter"><a href="http://twitter.com/#!/TheSGway" rel="external">Twitter</a></li>
								<li class="linkedin"><a href="http://www.linkedin.com/company/sport-graphics" rel="external">LinkedIn</a></li>
								<li class="facebook"><a href="http://www.facebook.com/thesgway" rel="external">Facebook</a></li>
							</ul>
		
						</div>
		
					</div>

				</div>
	
				<p class="phone">317 899 7000</p>

			</div>

		</header>

		<div id="body" class="group">
