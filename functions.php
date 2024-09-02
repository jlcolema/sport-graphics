<?php
	

	/*-------------------------------------------
		Translations
	-------------------------------------------*/


	load_theme_textdomain( 'sg', TEMPLATEPATH . '/languages' );
 
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);


	/*-------------------------------------------
		Add RSS links to <head> section
	-------------------------------------------*/


	automatic_feed_links();


	/*-------------------------------------------
		Primary Navigation
	-------------------------------------------*/


	register_nav_menu( 'primary', __( 'Primary Menu', 'sg' ) );


	/*-------------------------------------------
		Excerpt Length
	-------------------------------------------*/


	function new_excerpt_more($more) {

		global $post;
		return '&hellip; <p class="more"><a href="'. get_permalink($post->ID) . '">Read More</a></p>';

	}

	add_filter('excerpt_more', 'new_excerpt_more');

	/* Limit number of words */

	function custom_excerpt_length( $length ) {

		return 10;

	}

	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


	/*-------------------------------------------
		Widget Containers
	-------------------------------------------*/


	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => __('Sidebar Widgets','sg' ),
			'id'   => 'sidebar-widgets',
			'description'   => __( 'These are widgets for the sidebar.','sg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3><div class="widget-container">'
		));
		register_sidebar(array(
			'name' => __('Footer Widgets','sg' ),
			'id'   => 'footer-widgets',
			'description'   => __( 'These are widgets for the footer.','sg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => __('Page Widgets','sg' ),
			'id'   => 'page-widgets',
			'description'   => __( 'These are widgets for individual pages.','sg' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
	}



	/*-------------------------------------------
		Tweets (for SportG News Feed)
	-------------------------------------------*/

	function recentTweets() {

		include_once(ABSPATH . WPINC . '/feed.php');

		/* Configuration */

		$username = "thesgway";
		$feed = "http://twitter.com/statuses/user_timeline/$username.rss";
		$num = 4;

		/* Make links clickable */

		function makeClickableLinks($text) {
			$text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a class="url" href="\\1">\\1</a>', $text);
			$text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)','\\1<a class="url" href="http://\\2">\\2</a>', $text);
			return $text;
		}

		$rss = fetch_feed($feed);

		if (!is_wp_error( $rss ) ) :
		     $maxitems = $rss->get_item_quantity($num);
		     $rss_items = $rss->get_items(0, $maxitems);
		endif;

		echo '<ul>';

			if ($maxitems == 0) echo '<li>No items.</li>';

			else

			foreach ( $rss_items as $item ) :

			echo '<li>';
  
				$tweet = str_replace($username.':','',$item->get_title()); // replaces the username which is displayed on the feed
				$tweet = makeClickableLinks($tweet); // converts text links to clickable links
				$tweet = preg_replace('#@([\\d\\w]+)#', '<a href="http://twitter.com/$1">$0</a>', $tweet); // converts hashtags to clickable links
				$tweet = preg_replace('/#([\\d\\w]+)/', '<a class="hashtag" href="http://twitter.com/search?q=%23$1">$0</a>', $tweet); // converts @username to links
				echo $tweet . " <small><a class='timestamp' href='".$item->get_permalink()."'>" . human_time_diff($item->get_date('U'), current_time('timestamp')) . " ago</a></small>";

			echo '</li>';

			endforeach;

		echo '</ul>';

	}
	
	if (!is_admin()) {  
				
		/*-------------------------------------------
			Deregister scripts
		-------------------------------------------*/
		add_action('init','tune_deregister_scripts');
		function tune_deregister_scripts() {
			wp_deregister_script( 'jquery' );
		}
		
		/*-------------------------------------------
			Register scripts
		-------------------------------------------*/
		add_action('init','tune_register_scripts');
		function tune_register_scripts() {
			wp_register_script( 'jquery', 			'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', 	array(), 							null, 	false );			
			if (stripos($_SERVER['REQUEST_URI'],'/contact') !== false) {
				wp_register_script( 'googlemaps', 	'https://maps.googleapis.com/maps/api/js?sensor=false', 			array(), 							null, 	true );
				wp_register_script( 'stamen', 		'http://maps.stamen.com/js/tile.stamen.js?v1.1.2', 					array('googlemaps'), 				null, 	true );
				wp_register_script( 'contact', 		'/js/contact.js', 													array('googlemaps'), 				null, 	true );
			}
		}
		
		/*-------------------------------------------
			Enqueue scripts
		-------------------------------------------*/
		add_action( 'wp_enqueue_scripts', 'tune_enqueue_scripts' );
		function tune_enqueue_scripts() {
			wp_enqueue_script( 'jquery' );
			
			if (stripos($_SERVER['REQUEST_URI'],'/contact') !== false) {
				wp_enqueue_script( 'googlemaps' );
				wp_enqueue_script( 'stamen' );
				wp_enqueue_script( 'contact' );
			}
		}
	
	}
	


	/*-------------------------------------------
		Set up Multiple post thumbnails 
		for specific pages
	-------------------------------------------*/
	add_theme_support( 'post-thumbnails', array( 'homepage_slideshow','homepage_tabs','page','post','clients' ) );
	if (class_exists('MultiPostThumbnails')) {
		
		new MultiPostThumbnails(array(
			'label' => 'Project Thumbnail',
			'id' => '_project_thumbnail',
			'post_type' => 'projects'
		) );
		for($i = 1; $i < 11; $i++){
			new MultiPostThumbnails(array(
				'label' => 'Featured Image '.$i,
				'id' => 'featured_image_'.$i,
				'post_type' => 'projects'
			) );
			new MultiPostThumbnails(array(
				'label' => 'Featured Image '.$i.' Popup',
				'id' => 'featured_image_'.$i.'_popup',
				'post_type' => 'projects'
			) );
		}
		new MultiPostThumbnails(array(
			'label' => 'Client Thumbnail',
			'id' => 'client_thumbnail',
			'post_type' => 'clients'
		) );
	}




	/*-------------------------------------------
		Set up connections
	-------------------------------------------*/
	function my_connection_types() {
		p2p_register_connection_type( array(
			'name' => 'projects_to_projects',
			'from' => 'projects',
			'to' => 'projects',
			'cardinality' => 'one-to-many',
			'admin_box' => 'from',
			'title' => array( 'to' => 'Connected Projects' )
		) );
	}
	add_action( 'p2p_init', 'my_connection_types' );



