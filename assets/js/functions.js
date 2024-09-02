// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){

	/*-------------------------------------------
		Navigation Toggle
	-------------------------------------------*/


	$('header h3.toggle').click(function() {

		$('.menu').toggleClass('active', 'slow', function() {

			/* Animation */

		});

		$(this).toggleClass('active');

	});


	/*-------------------------------------------
		Search
	-------------------------------------------*/

	$('#searchform label').click(function() {
		$('#searchform label').css('display', 'none');
		$('#searchform input[type=submit]').css('display', 'block');
		
		$('#s').animate({
		    opacity: 1,
		    width: 'toggle',
		    height: '100%'
		  }, 250, function() {
		    // Animation complete.
		  });
	});

	/*-------------------------------------------
		Responsive Equal-Height Columns
	-------------------------------------------*/

	/* SportG News Feed (Home Page) */

	$('.container').equalHeights()
		$(window).bind( "resize", function(e) {
		$('.container').equalHeights()
	});


	/*-------------------------------------------
		Modal
	-------------------------------------------*/

	// Load dialog on click

	$('.basic').click(function (e) {

		$('#modal').modal();
	
		return false;
	
	});

	// Load dialog on click

	$('.basic').click(function (e) {

		$('#modal').modal();
	
		return false;
	
	});

	/*-------------------------------------------
		Map
	-------------------------------------------*/

	function initialize() {

		var myLatlng = new google.maps.LatLng(39.76839, -86.15696);
		var mapOptions = {
			zoom: 16,
			center: myLatlng,
			mapTypeId: "Toner",
			mapTypeControlOptions: {
				mapTypeIds: ["Toner", "Terrain", "Watercolor"]
			}
		}

		var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		map.mapTypes.set("Toner", new google.maps.StamenMapType("toner"));
		map.mapTypes.set("Terrain", new google.maps.StamenMapType("terrain"));
		map.mapTypes.set("Watercolor", new google.maps.StamenMapType("watercolor"));

		var contentString =

		'<div id="content">'+

			'<div id="siteNotice">'+'</div>'+

			'<h1 id="firstHeading" class="firstHeading">Tune Development</h1>'+

			'<div id="bodyContent">'+

				'<p>Circle Tower<br />'+
				'55 Monument Circle, &#8470; 719<br />'+
				'Indianapolis, IN 46204</p>'+

				'<p>o: (317) 829-3620<br />'+
				'c: (317) 513-6288<br />'+
				'f: (317) 216-3688</p>'+

				'<p><a href="http://maps.google.com/maps?q=55+monument+circle+suite+719,+indianapolis,+in&client=safari&oe=UTF-8&hnear=55+Monument+Cir,+Indianapolis,+Indiana+46204&gl=us&t=m&z=16">Get Directions</a></p>'+

			'</div>'+
	
		'</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Tune Development'
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});

		// Center
		
		var center;
		
		function calculateCenter() {
			center = map.getCenter();
		}
		
		google.maps.event.addDomListener(map, 'idle', function() {
			calculateCenter();
		});
		
		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(center);
		});

	}

	/*-------------------------------------------
		Carousel
	-------------------------------------------*/

	$('.carousel .slides').carouFredSel({
		responsive: true,
		scroll: 1,
		items: {
			width: 140,
			visible: {
				min: 2,
				max: 7
			}
		}
	});
	
	
	

});

$(window).load(function (){

	/*-------------------------------------------
		Slideshow
	-------------------------------------------*/

	/* Slide */

	$('.slideshow').flexslider({
		namespace: "slideshow-",
		animation: "fade",
		pauseOnHover: true,
		start: function(slider) {
		  slider.removeClass('loading');
		}

	});

	/* Details */

	$('.slide').mosaic({
		animation: 'slide',
		speed: 300
	});

	// Projects

	$(function(){
	
		var $container = $('#container');
	
		$container.isotope({
	
			itemSelector: '.element',
			layoutMode: 'fitRows'

		});

		$(window).smartresize(function() {
		
			// ****************************************
			// begin code to change cols based on width
			// ****************************************
			console.log($container.width());
			
			if ( $container.width() >= 0 && $container.width() <= 300 ) {

				$cols = 1.00;

			} else if ( $container.width() > 300 && $container.width() <= 490 ) {
			
				$cols = 2.00;
			
			} else if ( $container.width() > 490 && $container.width() <= 725 ) {
			
				$cols = 3.00;
			
			} else {

				$cols = 4.00;

			}

			// ****************************************
			// end code to change cols based on width
			// ****************************************

			$container.isotope({
			
				resizable: false,
				masonry: { columnWidth: $container.width() / $cols }
				
			});
			
		}).smartresize();

		$container.imagesLoaded( function(){
		
			$(window).smartresize();
			
		});

		var $optionSets = $('#categories .option-set'),
		$optionLinks = $optionSets.find('a');
	
		$optionLinks.click(function(){
	
			var $this = $(this);
	
			// don't proceed if already selected
	
			if ( $this.hasClass('selected') ) {
	
				return false;
	
			}

			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');
	
			// make option object dynamically, i.e. { filter: '.my-filter-class' }
	
			var options = {},
			key = $optionSet.attr('data-option-key'),
			value = $this.attr('data-option-value');
	
			// parse 'false' as false boolean
	
			value = value === 'false' ? false : value;
			options[ key ] = value;
	
			if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	
				// changes in layout modes need extra logic
	
				changeLayoutMode( $this, options )
	
			} else {
	
				// otherwise, apply new options
	
				$container.isotope( options );
	
			}
	
			return false;
	
		});
	
	});

	/*-------------------------------------------
		Tabs
	-------------------------------------------*/

	function createTabsH() {
		$('.tab_horizontal').slideTabs({
			buttonsFunction: 'click',
			contentAnim: 'slideH',
			contentAnimTime: 600,
			classBtnDisabled: 'tab_btn_disabled',
			classBtnNext: 'tab_next',
			classBtnPrev: 'tab_prev',
			classExtLink: 'tab_ext',
			classTab: 'tab_tab',
			classTabActive: 'tab_tab_active',
			classTabsContainer: 'tab_tabs_container',			
			classTabsList: 'tab_tabs',
			classView: 'tab_view',
			classViewActive: 'tab_active_view',
			classViewContainer: 'tab_view_container',
			contentEasing: 'easeInOutExpo',
			orientation: 'horizontal',
			tabsAnimTime: 300,
			autoHeight: true,
			autoHeightTime: 500,
			totalwidth: 'auto'
		});	
	}
	function createTabsV() {
		$('.tab_vertical').slideTabs({
			buttonsFunction: 'click',
			contentAnim: 'slideV',
			contentAnimTime: 600,
			classBtnDisabled: 'tab_btn_disabled',
			classBtnNext: 'tab_next',
			classBtnPrev: 'tab_prev',
			classExtLink: 'tab_ext',
			classTab: 'tab_tab',
			classTabActive: 'tab_tab_active',
			classTabsContainer: 'tab_tabs_container',			
			classTabsList: 'tab_tabs',
			classView: 'tab_view',
			classViewActive: 'tab_active_view',
			classViewContainer: 'tab_view_container',
			contentEasing: 'easeInOutExpo',
			orientation: 'vertical',
			tabsAnimTime: 300,
			autoHeight: true,
			autoHeightTime: 500,
			totalwidth: 'auto'
		});	
	}
	createTabsH();
	createTabsV();
	
});