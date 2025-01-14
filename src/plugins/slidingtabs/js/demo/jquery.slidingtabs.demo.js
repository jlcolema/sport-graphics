/*
 * Sliding Tabs 1.9.2 jQuery Plugin - http://codecanyon.net/item/sliding-tabs-jquery-plugin/141774
 * 
 * Copyright 2012, Christian André
 * All rights reserved.
 *
 * You need to purchase a license if you want to use this script.
 * http://codecanyon.net/wiki/buying/howto-buying/licensing/
 *
 */

(function($) {
 	
	$.fn.slideTabs = function(client_config) {
		var default_config = {
			autoplay: false,
			autoplayClickStop: false,
			autoplayInterval: 4000,
			autoHeight: false,
			autoHeightTime: 0,			
			buttonsFunction: 'slide',
			classBtnDisabled: 'st_btn_disabled',
			classBtnNext: 'st_next',
			classBtnPrev: 'st_prev',
			classExtLink: 'st_ext',
			classTab: 'st_tab',
			classTabActive: 'st_tab_active',
			classTabsContainer: 'st_tabs_container',			
			classTabsList: 'st_tabs',
			classView: 'st_view',
			classViewActive: 'st_active_view',
			classViewContainer: 'st_view_container',
			contentAnim: 'slideH',
			contentAnimTime: 600,
			contentEasing: 'easeInOutExpo',						
			offsetBR: 0,
			offsetTL: 0,
			orientation: 'horizontal',
			tabSaveState: false,			
			tabsAnimTime: 300,								
			tabsEasing: '',			
			tabsScroll: true,			
			tabsSlideLength: 0,
			totalHeight: '',
			totalWidth: '',
			urlLinking: true
		},
        		
		conf = $.extend(true, {}, default_config, client_config);
        
		return this.each(function() {
            var tabs = new SlideTabs($(this), conf);
            tabs.init();
        });
    };
	
	function SlideTabs($container, conf) {
		var	$tabsCont = $container.find('.'+conf.classTabsContainer),
			$tabsInnerCont = $tabsCont.children('div').first(),
			$tabs = $tabsCont.find('.'+conf.classTabsList),			
			$a = $tabs.children('li').find('a'),
			$contentCont = $container.find('.'+conf.classViewContainer),
			$content = $contentCont.find('.'+conf.classView),		
			$prev = $container.find('.'+conf.classBtnPrev).click(function() { tabs[conf.buttonsFunction+'Prev'](val); return false; }), // Bind the prev button click event
			$next = $container.find('.'+conf.classBtnNext).click(function() { tabs[conf.buttonsFunction+'Next'](val); return false; }), // Bind the next button click event					
			$tab, $activeTab = [], $li, $lastElem, $view, $activeView, 
			val = {}, margin = 0;
						
		this.init = function() {			
			// Set the correct function and object names
			if (conf.orientation == 'horizontal') {
				$tabsInnerCont.css('overflow', 'hidden');				
				val.func = 'outerWidth';
				val.obj = 'left';				
				val.attr = 'marginLeft';								
			} else {
				val.func = 'outerHeight';										
				val.obj = 'top';													
				val.attr = 'marginTop';				
				val.prevBtnH = $prev.outerHeight();
				val.nextBtnH = $next.outerHeight();				
				(val.prevBtnH >= val.nextBtnH) ? val.buttonsH = val.prevBtnH : val.buttonsH = val.nextBtnH;
			}												
						
			// Set the dimensions if specified in the options			
			if (conf.totalWidth.length > 0) { resize.width(); }
			if (conf.totalHeight.length > 0) { resize.height(); }
											
			tabs.init();			
			if (conf.autoplay == true) { autoplay.init(); } // Set intervals if autoplay is enabled						
		};
		
		/* 
		 * Resizing methods
		 */	
		var resize = {
			width: function() {				
				if (conf.totalWidth == 'auto') { $container.css('width', '100%'); } 
				else { $container.css('width', conf.totalWidth+'px'); }								
			},
			
			height: function() {
				var contentContOH = ($contentCont.outerHeight(true)-$contentCont.height());							
								
				//$container.css('height', conf.totalHeight+'px');
				
				if (conf.orientation == 'vertical') {					
					var	tabsContOH = ($tabsCont.outerHeight()-$tabsCont.height());										
										
					$tabsCont.css('height', (conf.totalHeight-tabsContOH)+'px');
					$contentCont.css('height', (conf.totalHeight-contentContOH)+'px');							
				} else {
					$contentCont.css('height', (conf.totalHeight-($tabsCont.outerHeight(true)+contentContOH))+'px');								
				}								
			}
		},
											
		/* 
		 * Tab methods
		 */			 
		tabs = {
			init: function() {
				this.setSlideLength(); // Set the tabs slide length value
				this.posActive(); // Position the active tab			
				this.bind(); // Bind tab events				
			},
			
			setSlideLength: function() {
				if (conf.tabsSlideLength == 0) {
					if (conf.orientation == 'horizontal') { val.tabsSlideLength = $tabsInnerCont.width(); }
					else { val.tabsSlideLength = ($tabsCont.height() - val.buttonsH); }																			
				} else {
					val.tabsSlideLength = conf.tabsSlideLength;
				}								
			},					
			
			bind: function() {
				if (conf.totalWidth == 'auto') {
					var resizeTimer = null;
					
					// Bind dynamic resizing
					$(window).resize(function() {
						if (resizeTimer) { clearTimeout(resizeTimer); }						
						resizeTimer = setTimeout(function() { 
							if (conf.orientation == 'horizontal') { tabs.setAutoWidth(); }
							if (conf.autoHeight == true) { content.adjustHeight(); }
						}, 100);
					});				
				}				
				
				// Delegate the tabs click event
				$tabs.delegate('li a.'+conf.classTab, 'click', function() {					
					tabs.click(this, true);
					return false;
				});

				// Mouse scroll wheel event				
				if ($.fn.mousewheel && conf.tabsScroll == true) {	
					$tabs.mousewheel(function(event, delta) {
						(delta > 0) ? tabs.slidePrev(val) : tabs.slideNext(val);					
						return false; // Prevents default scrolling
					});
				}
				
				// Find any external links on the page
				$('a.'+conf.classExtLink).each(function() {
					// Bind the links with a matching rel attribute					
					if ($(this).attr('rel') == $container.attr('id')) {						
						$(this).click(function() {							
							$tab = tabs.findByRel($(this).attr('href').slice(1));																					
							tabs.click($tab);							
							return false;
						});
					};
				});								
			},
			
			setAutoWidth: function() {
				val.tabsSlideLength = $tabsInnerCont.width();
							
				// Get the current dimensions
				var lastTabPos = ($lastElem.outerWidth(true) + $lastElem.position().left),
					tabsContOW = $tabsCont.outerWidth(true),
					buttonsW = ($prev.outerWidth(true) + $next.outerWidth(true));
				
				// Check the tab positions
				if (lastTabPos > tabsContOW) {					
					$tabsCont.addClass('st_sliding_active');
					val.tabsSlideLength = $tabsInnerCont.width();
												
					tabs.initButtons();
					tabs.showButtons();
				} else {
					if (-+margin < (0 + conf.offsetBR)) {						
						if (lastTabPos < $tabsInnerCont.width()) {						
							var gap = (val.tabsSlideLength - lastTabPos);									
							margin = (margin - gap);
							
							if ((margin + 1) < (buttonsW + conf.offsetBR)) {
								margin = (0 + conf.offsetBR);
								tabs.hideButtons();										
								val.tabsSlideLength = tabsContOW;																			
							}
							
							tabs.initButtons();
						} else if (lastTabPos <= (tabsContOW - margin)) {
							margin = (0 + conf.offsetBR);
							tabs.hideButtons();										
							val.tabsSlideLength = tabsContOW;												
						}
						
						$tabs.animate({'marginLeft': -+margin}, 150);
					} else if (margin == (0 + conf.offsetBR) && lastTabPos <= tabsContOW) {
						tabs.hideButtons();
						val.tabsSlideLength = tabsContOW;
					}					
				}
			},								
			
			posActive: function() {
				// Get the active tab
				this.getActive();				
				
				// Show the active tab's content
				content.showActive();
				
				$lastElem = $tabs.children('li:last');
				$tab = $activeTab;
				$activeTab = $activeTab.parents('li');				
			
				if (($lastElem[val.func](true) + $lastElem.position()[val.obj]) > val.tabsSlideLength) {					
					$tabsCont.addClass('st_sliding_active');
					
					this.setSlideLength(); // Set the tabs slide length value after the active class has been added
					
					// Get the values needed to get the total width/height of the tabs
					val.elemD = $activeTab[val.func](true);
					val.elemP = $activeTab.position()[val.obj];	
					
					// Find the active element's position
					if (val.elemP > val.tabsSlideLength) {
						margin += (val.elemD + (val.elemP - val.tabsSlideLength));							
						margin = (margin + conf.offsetBR);						
					} else if ((val.elemP + val.elemD) > val.tabsSlideLength) {
						margin += (val.elemD - (val.tabsSlideLength - val.elemP));						
						margin = (margin + conf.offsetBR);
					} else {
						margin = (margin - conf.offsetTL);
					}								
																																	
					// Set the active element's position					
					$tabs.css(val.attr, -+margin);
					
					// Show the directional buttons after the position has been set
					this.initButtons();
					this.showButtons();
				}								
			},
			
			initButtons: function() {				
				if (conf.buttonsFunction == 'slide') {
					// Deactivate the arrow button if the tab element is at the beginning or end of the list													
					if ($tabs.children('li:first').position()[val.obj] ==( 0 + conf.offsetTL)) { this.disableButton($prev); } 
					else { this.enableButton($prev); }										
					
					if (($lastElem.position()[val.obj] + $lastElem[val.func](true)) <= (val.tabsSlideLength - conf.offsetBR)) { this.disableButton($next); } 
					else { this.enableButton($next); }
				} else {
					this.setButtonState();
				}																
			},
						
			enableButton: function($btn) {
				$btn.removeClass(conf.classBtnDisabled);
			},
			
			disableButton: function($btn) {
				$btn.addClass(conf.classBtnDisabled);
			},
			
			showButtons:function() {
				// Show the directional buttons
				$prev.show(); $next.show();
			},
			
			hideButtons: function() {
				$tabsCont.removeClass('st_sliding_active');
				
				// Hide the directional buttons
				$prev.hide(); $next.hide();	
			},
			
			click: function(tab, organic) {				
				// Return false if an animation is already running
				if ($(content.views).is(':animated')) { return false; }
				
				$tab = $(tab);
				
				// Return false if the active tab is clicked
				if ($tab.hasClass(conf.classTabActive)) { return false; }
				
				$li = $tab.parents('li');				
				
				// Set the new active state
				this.setActive();
												
				if (conf.autoplay == true) {					
					if (conf.autoplayClickStop == true && organic == true) {
						// Disable autoplay
						conf.autoplay = false;
						autoplay.clearInterval();
					} else {					
						val.index = $tab.parents('li').index(); // Set the clicked tab's index			
						autoplay.setInterval(); // Set new interval
					}
				}
								
				// Get the element's position
				val.elemP = $li.position();
				val.activeElemP = $activeTab.position();								
				// Get the clicked tab's hash value
				val.hash = this.getHash($tab);
				
				// Slide partially hidden tab into view
				this.slideClicked(val);
											
				// Set the content vars and remove/add the active class
				$activeView = $content.children('div.'+conf.classViewActive).removeClass(conf.classViewActive);					
				$view = $content.children(val.hash).addClass(conf.classViewActive);							
								
				if (conf.autoHeight == true) { content.adjustHeight(); }
				
				// Show/animate the clicked tab's content into view	
				if (conf.contentAnim.length > 0) {			
					content[conf.contentAnim](val);
				} else {
					$activeView.hide();	$view.show();		
				}								
			},						
			
			clickPrev: function() {				
				// Return false if an animation is already running
				if ($(content.views).is(':animated')) { return false; };
				
				// Find the previous tab
				val.$prevTab = this.find('prev');				
				if (val.$prevTab.length) { this.click(val.$prevTab); }
			},
			
			clickNext: function() {				
				// Return false if an animation is already running
				if ($(content.views).is(':animated')) { return false; };
				
				// Find the next tab
				val.$nextTab = this.find('next');				
				if (val.$nextTab.length) { this.click(val.$nextTab); }
			},						
			
			find: function(func) {				
				return $tab.parents('li')[func]().find('a.'+conf.classTab);								
			},
			
			findByRel: function(rel) {
				// Find the tab via it's rel attribute
				return $tabs.find('[rel='+rel+']');
			},
			
			getHash: function($tab) {
				// Get the tab's hash value				
				val.hash = $tab.attr('hash');
								
				if (val.hash) {	return val.hash; } 
				else { return $tab.prop('hash'); }								
			},
			
			getActive: function() {
				if (conf.urlLinking == true && location.hash) {
					// Use the URL's hash value to find the active-tab via it's rel attribute
					$activeTab = this.findByRel(location.hash.slice(1));										
				}
				
				// If no tab element has been found
				if (!$activeTab.length) {										
					// See if the active-tab id is saved in a cookie
					if ($.cookie) { var savedTabIndex = $.cookie($container.attr('id')); }					
													
					if (savedTabIndex) {						
						// Remove the static active class
						this.removeActive();												
						
						// Set the active class on the saved tab						
						$activeTab = $a.eq(savedTabIndex).addClass(conf.classTabActive);												
					} else {					
						$activeTab = $tabs.children('li').find('.'+conf.classTabActive);
						
						// Set the first tab element to 'active' if no tab element has the active class
						if (!$activeTab.length) { $activeTab = $tabs.find('a:first').addClass(conf.classTabActive); }										
					}								
				
				} else {
					// Remove the static active class
					this.removeActive();
					// Add the active class to the tab
					$activeTab.addClass(conf.classTabActive);
				}								
				
				this.saveActive($activeTab);
			},
						
			removeActive: function() {
				// Remove the current active class
				$tabs.children('li').find('.'+conf.classTabActive).removeClass(conf.classTabActive);
			},										
			
			setActive: function() {								
				// Set new active states				
				$activeTab = $tabs.children('li').find('a.'+conf.classTabActive).removeClass(conf.classTabActive);								
				$tab.addClass(conf.classTabActive);								
				this.saveActive($tab);								
			},
			
			saveActive: function($tab) {				
				// Save the active tab's parent index value in a cookie so we can retrive it later
				if (conf.tabSaveState == true) { $.cookie($container.attr('id'), $tab.parents('li').index()); }
			},
			
			slideClicked: function(val) {				
				val.elemP = val.elemP[val.obj];
				val.elemD = $li[val.func](true);					
				val.nextElemPos = ($li.next().length == 1) ? $li.next().position()[val.obj] : 0;
				
				if (val.elemP < (0 + conf.offsetTL)) {															
					val.elemHidden = (val.elemD - val.nextElemPos);						
					margin = (margin - (val.elemHidden + conf.offsetTL));
										
					this.enableButton($next);
				} else if ((val.elemD + val.elemP) > (val.tabsSlideLength - conf.offsetBR)) {						
					margin += (val.elemD - (val.tabsSlideLength - (val.elemP + conf.offsetBR)));
																							
					this.enableButton($prev);
				}																															
				
				this.animate();
				this.setButtonState();
			},
			
			slidePrev: function(val) {
				// Return false if an animation is running
				if ($tabs.is(':animated')) { return false; }
				
				// Find the element and set the margin 			
				$tabs.children('li').each(function() {	
					$li = $(this);										
					val.elemP = $li.position()[val.obj];												
					
					if (val.elemP >= (-1 + conf.offsetTL)) {
						tabs.$liPrev = $li.prev();
						
						if (tabs.$liPrev.length) {
							val.elemHidden = (tabs.$liPrev[val.func](true) - val.elemP);																		
							margin = ((margin - val.elemHidden) - conf.offsetTL);							
						
							$li = tabs.$liPrev; // Set the $li variable to the first visible element
						}
						
						tabs.animate();
						tabs.setButtonState($next);
						
						return false;
					}																									
				});								
			},
			
			slideNext: function(val) {									
				// Return false if an animation is running
				if ($tabs.is(':animated')) { return false; }
				
				// Find the element and set the margin					
				$tabs.children('li').each(function() {						
					$li = $(this);
					val.elemD = $li[val.func](true);
					val.elemP = $li.position()[val.obj];																																																																		
													
					if ((val.elemD + val.elemP) > (val.tabsSlideLength - conf.offsetBR)) {																																																		
						val.elemHidden = (val.tabsSlideLength - val.elemP);																																																				
						margin += ((val.elemD - val.elemHidden) + conf.offsetBR);														
													
						tabs.animate();																					
						tabs.setButtonState($prev);
						
						return false;
					}																							
				});								
			},
			
			animate: function() {					
				// Animate tabs with the new value					
				if (conf.orientation == 'horizontal') { $tabs.animate({'marginLeft': -+margin}, conf.tabsAnimTime, conf.tabsEasing); } 
				else { $tabs.animate({'marginTop': -+margin}, conf.tabsAnimTime, conf.tabsEasing); }													
			},								
			
			setButtonState: function($btn) {
				// If the directional buttons are set to click through the tabs, get the active tab instead of the first visible
				if (conf.buttonsFunction == 'click') { $li = $tab.parents('li'); }								
				
				if ($li.is(':first-child')) { this.disableButton($prev); this.enableButton($next); } // Is the active or visible tab the first one?
				else if ($li.is(':last-child')) { this.disableButton($next); this.enableButton($prev); } // Is the active or visible tab the last one?
				else { 
					if ($btn) {	this.enableButton($btn); } // Enable the specified button only
					else if (conf.buttonsFunction == 'click') { this.enableButton($prev); this.enableButton($next); } // Enable both buttons										
				}				
			}						
		},
		
		/* 
		 * Content methods
		 */	
		content = {
			views: '#'+$container.attr('id')+' .st_tab_view',
			
			showActive: function() {
				// Show the active tab's content
				$view = $content.children($activeTab.attr('href')).addClass(conf.classViewActive);								
				
				 // Set the content div's to absolute and hide the 'inactive' content		
				$content.children('div').css('position', 'absolute').show().not('div.'+conf.classViewActive).hide();
				
				// Set the content container's height if autoHeight is set to: true
				if (conf.autoHeight == true) { $content.css('height', $view.height()).parent().css('height', 'auto'); }
			},
			
			adjustHeight: function() {
				// Set the content's height
				if (conf.autoHeightTime > 0) { $content.animate({'height': $view.height()}, conf.autoHeightTime); } 
				else { $content.css('height', $view.height()); }		
			},						
			
			fade: function() {				
				$activeView.fadeOut(conf.contentAnimTime);
				$view.fadeIn(conf.contentAnimTime);
			},
			
			fadeOutIn: function() {
				$activeView.fadeOut(conf.contentAnimTime, function() {														
					$view.fadeIn(conf.contentAnimTime);
				});				
			},			
			
			slideH: function(val) {								
				val.wh = $container.outerWidth(true);															
				this.setSlideValues(val);										
				
				$activeView.animate({'left': val.animVal}, conf.contentAnimTime, conf.contentEasing);												
							
				$view.css({'display': 'block', 'left': val.cssVal}).animate({'left': '0px'}, conf.contentAnimTime, conf.contentEasing, function() {				
					$activeView.css('display', 'none');				
				});																												
			},
			
			slideV: function(val) {
				val.wh = $container.outerHeight(true);					
				this.setSlideValues(val);										
				
				$activeView.animate({'top': val.animVal}, conf.contentAnimTime, conf.contentEasing);
											
				$view.css({'display': 'block', 'top': val.cssVal}).animate({'top': '0px'}, conf.contentAnimTime, conf.contentEasing, function() {				
					$activeView.css('display', 'none');												
				});		
			},
			
			setSlideValues: function(val) {									
				if (val.elemP > val.activeElemP[val.obj]) {	val.animVal = -val.wh; val.cssVal = val.wh;	} 
				else { val.animVal = val.wh; val.cssVal = -val.wh; }	
			}
		},
		
		/* 
		 * Autoplay methods
		 */	
		autoplay = {
			init: function() {
				val.index = 0;
				this.setInterval(); // Set the autoplay interval
			},						
			
			setInterval: function() {				
				this.clearInterval();
				// Set the new interval
				val.intervalId = setInterval(function() { autoplay.play(); }, conf.autoplayInterval);
			},
			
			clearInterval: function() {
				// Clear any previous interval
				clearInterval(val.intervalId);
			},
			
			play: function() {
				// Set the next tab's index				
				val.index++; if (val.index == $a.length) { val.index = 0; }				
				// Trigger the click event for the next tab
				tabs.click($a[val.index]);
			}
		},																
		
		
		/* 
		 * Methods for customizing the tabs (FOR DEMO PURPOSES, NOT NEEDED FOR THE SLIDING TABS TO WORK)
		 */										
		$optsBox = $container.find('div.options_box'),
		$addBtn = $container.find('ul.customize li a.add').click(function() { customize.addTab(); return false; }),
		$removeBtn = $container.find('ul.customize li a.remove').click(function() { customize.removeTab(); return false; }),
		$optsBtn = $container.find('ul.customize li a.options').click(function() { customize.toggleBox(); return false; }),		
		$saveBtn = $optsBox.find('a.save_btn').click(function() { customize.saveOptions(); return false; }),		
		length, totSize,				
		
		customize = {																					
			addTab: function() {
				length = ($tabs.children('li').length + 1);									
				
				if ($tabs.is(':animated') || length == 31) { return false; }
				
				// Enable/disable links			
				if (length == 2) { $removeBtn.removeClass('btn_disabled').addClass('btn_enabled'); }
				if (length == 30) { $addBtn.removeClass('btn_enabled').addClass('btn_disabled'); }																									
			
				if (conf.orientation == 'horizontal') {	this.appendContent('st_content_', 'Horizontal Tab #', ''); } 
				else { this.appendContent('stv_content_', 'Vertical Tab #', '<span>Lorem ipsum dolor sit amet</span>');	}
				
				// Show the appended tab
				this.showAppended();
				
				// Bind click event to the appended tab
				$tabs.find('li a:last').click(function() {
					tabs.click(this); return false;
				});				
								
				if (conf.buttonsFunction == 'slide') {
					tabs.enableButton($prev);
					tabs.disableButton($next);					
				} else {
					tabs.enableButton($next);
				}
				
				$content.children('div.st_tab_view:last').css({'position': 'absolute', 'display': 'none'});										
			},
			
			appendContent: function(id, text, span) {
				$tabs.append('<li><a href="#'+id+length+'" rel="tab_'+length+'" class="st_tab">'+text+length+span+'</a></li>');																									
				$content.append('<div id="'+id+length+'" class="st_tab_view"><h2>'+text+length+'</h2><div class="text">'+$content.children('#'+id+'1').find('div.text').html()+'</div></div>');				
			},
			
			showAppended: function() {
				totSize = this.totLength();												
							
				if (totSize > val.tabsSlideLength - conf.offsetBR) {
					$tabsCont.addClass('st_sliding_active');
					
					// Show the prev/next buttons
					$prev.show(); $next.show();
											
					margin = totSize - val.tabsSlideLength + conf.offsetBR;
					
					// Animate with the new value
					this.animate();						
				}
			},
			
			totLength: function() {
				totSize = 0;
			
				$tabs.children('li').each(function() {						
					totSize += $(this)[val.func](true);
				});
				
				return totSize;	
			},
			
			animate: function() {
				if (conf.orientation == 'horizontal') {	$tabs.animate({'marginLeft': -+margin}, 300); } 
				else { $tabs.animate({'marginTop': -+margin}, 300); }
			},
			
			removeTab: function() {				
				length = $tabs.children('li').length;		
				
				if ($tabs.is(':animated') || length == 1) { return false; }
				
				// Enable/disable links					
				if (length == 30) { $addBtn.removeClass('btn_disabled').addClass('btn_enabled'); }
				if (length == 2) { $removeBtn.removeClass('btn_enabled').addClass('btn_disabled'); }										
																			
				$li = $tabs.children('li:last');					
															
				if ($li.children('a').hasClass(conf.classTabActive)) {											
					var prevLink = $li.prev().children('a'),						
						tabLink = tabs.getHash(prevLink);										
														
					// Add active class
					prevLink.addClass(conf.classTabActive);
								
					// Show the previous tab's content												
					$content.children(tabLink).css({'top': '0px', 'left': '0px', 'display': 'block'}).addClass(conf.classViewActive);
					
					// Set the previous tab as the active tab
					$tab = $li.prev().children('a.'+conf.classTab);		
				}
				
				$li.remove(); // Remove the last tab		
				$content.children('div:last').remove(); // Remove the last content
												
				totSize = this.totLength(); // Get the total size of the tabs
				
				// Get the new position
				if (totSize > val.tabsSlideLength - conf.offsetBR) {						
					margin = totSize - val.tabsSlideLength + conf.offsetBR;												
																	
					// Add/remove active classes					
					if (conf.buttonsFunction == 'slide') {
						tabs.enableButton($prev); tabs.disableButton($next);						
					} else {						
						if ((length-2) == $tab.parents('li').index()) { tabs.disableButton($next); }						
					}
					
				} else {
					margin = 0;																			
					
					// Hide the prev/next buttons 
					$prev.hide(); $next.hide();
					
					$tabsCont.removeClass('st_sliding_active');																			
				}								
								
				// Animate with the new value
				this.animate();
			},
			
			toggleBox: function() {				
				$optsBox.toggleClass('show');
				$optsBtn.toggleClass('active');
			},						
			
			saveOptions: function() {
				var $contParent = $container.parent('div').addClass('loading'),
					$tabDivs = $container.children('div').not('div.customize_container');
															
				$tabDivs.fadeOut(200, function() {					
					$tabDivs.css({'visibility': 'hidden', 'display': 'block'});					
					setTimeout(function() { $tabDivs.css({'visibility': 'visible', 'display': 'none'}).fadeIn(200, function() { $contParent.removeClass('loading'); }); }, 50);
					
					// Set new options		
					if ($optsBox.find('input#orientation').val() == 'horizontal') {
						conf.buttonsFunction = $optsBox.find('input[name="buttons"]:checked').val();
						conf.contentAnimTime = parseInt($optsBox.find('input[name="cont_dur"]:checked').val());					
						conf.tabsAlignment = $optsBox.find('input[name="tabs_align"]:checked').val();  
						conf.tabsAnimTime = parseInt($optsBox.find('input[name="tabs_dur"]:checked').val());
						conf.tabsScroll = $optsBox.find('input[name="scroll"]:checked').val();
					} else {
						conf.buttonsFunction = $optsBox.find('input[name="v_buttons"]:checked').val();
						conf.contentAnimTime = parseInt($optsBox.find('input[name="v_cont_dur"]:checked').val());
						conf.tabsAlignment = $optsBox.find('input[name="v_tabs_align"]:checked').val();
						conf.tabsAnimTime = parseInt($optsBox.find('input[name="v_tabs_dur"]:checked').val());
						conf.tabsScroll = $optsBox.find('input[name="v_scroll"]:checked').val();																
					} 								 																				
					conf.contentAnim = $optsBox.find('select.cont_anim option:selected').val();
					conf.contentEasing = $optsBox.find('select.cont_fx option:selected').val();
					conf.tabsEasing = $optsBox.find('select.tab_fx option:selected').val();																								
					
					$container[0].className = $container[0].className.replace(/\balign.*?\b/g, '');								
					$container.addClass('align_'+conf.tabsAlignment);								
									
					if (conf.buttonsFunction == 'click') {
						tabs.setButtonState();
					} else {
						$lastElem = $tabs.children('li:last');					
						tabs.initButtons();
					}
						
					if (conf.contentAnim == 'fadeOutIn') { conf.contentAnimTime = (conf.contentAnimTime - 100); }
					
					// Set/unset scrolling 
					if (conf.tabsScroll == 'true') {
						$tabs.mousewheel(function(event, delta) {
							(delta > 0) ? tabs.slidePrev(val) : tabs.slideNext(val);						
							return false;
						});
					} else { 
						$tabs.unmousewheel();
					}						
													
					$content.children('div').css('position', 'absolute');								
					
					// Set the content div styles according to the new content animation option
					switch(conf.contentAnim) {
						case 'slideH': $content.children('div:not(.'+conf.classViewActive+')').css('top', '0px'); break;
						case 'slideV': $content.children('div:not(.'+conf.classViewActive+')').css('left', '0px'); break;					
						default: $content.children('div:not(.'+conf.classViewActive+')').css({'top': '0px', 'left': '0px', 'display': 'none'});
					}										
				});
				
				$optsBox.removeClass('show');
				$optsBtn.removeClass('active');
			}
		};								
	};

})(jQuery);