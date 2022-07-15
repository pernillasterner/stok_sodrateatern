(function ($) {
	$(function(){

// General vars
    var overlayTimer;
    var expandTrottle;

// FUNCTIONS
		//General

		/* initial ulr */
		function parseUrl(url) {
	    var parser = document.createElement('a'),
	        searchObject = {},
	        queries, split, i;
	    // Let the browser do the work

	    parser.href = url;
	    // Convert query string to object
	    queries = parser.search.replace(/^\?/, '').split('&');
      for( i = 0; i < queries.length; i++ ) {
	        split = queries[i].split('=');
	        searchObject[split[0]] = split[1];
	    }
	    return {
	        searchObject: searchObject
	    };
		}

		// Returns a function, that, as long as it continues to be invoked, will not
		// be triggered. The function will be called after it stops being called for
		// N milliseconds. If `immediate` is passed, trigger the function on the
		// leading edge, instead of the trailing.
    // https://davidwalsh.name/javascript-debounce-function
		function debounce(func, wait, immediate) {
			var timeout;
			return function() {
				var context = this, args = arguments;
				var later = function() {
					timeout = null;
					if (!immediate) {
            func.apply(context, args);
          }
				};
				var callNow = immediate && !timeout;
				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
				if (callNow) {
          func.apply(context, args);
        }
			};
		}

		function strToBool(str) {
			switch(str.toLowerCase().trim()){
				case 'true': case 'yes': case '1': return true;
				case 'false': case 'no': case '0': case null: return false;
				default: return Boolean(str);
			}
		}

		function animateItem(item, time) {
			setTimeout(function() {
				$(item).addClass('animate');
			}, time);
		}

//overlay
		function openOverlay() {
			clearTimeout(overlayTimer);

			if(!$('body').hasClass('overlay')) {
				$('body').addClass('overlay');

				animateItem($('body'),10);
			}
		}

		function closeOverlay() {
			overlayTimer = setTimeout(function() {
				$('body').removeClass('animate');

				setTimeout(function(){
					$('body').removeClass('overlay');
				}, 200);
			}, 300);

		}

		function toggleOverlay() {
			if($('body').hasClass('overlay')) {
				$('body').removeClass('animate');

				setTimeout(function(){
					$('body').removeClass('overlay');
				}, 200);

			} else {
				$('body').addClass('overlay');

				animateItem($('body'),10);
			}
		}


//Menu
    var scrollTopContainer;

    function menuScroll() {
      if( ( $('#container').scrollTop() >= (scrollTopContainer + 100) || $('#container').scrollTop() <= (scrollTopContainer - 100) ) && $(document).width() > 767 && $(menu).hasClass('is-open')) {
        $('#container').off('scroll.menuscroll', menuScroll);

        toggleMenu();
      }
    }
		var toggleMenu = debounce(
      function () {
  			var menuIsOpen =	$(menu).hasClass('is-open');

  			$(menuBtn).attr('aria-expanded', !menuIsOpen);
  			//toggleOverlay();

  			if(menuIsOpen){
  				closeOverlay();
  				$(menu).removeClass('is-open');

  				expandTrottle = setTimeout(function(){
  						$(menuAriaHidden).attr('aria-hidden', menuIsOpen);

  						for(var i = 0; i < menuItemsArr.length; i++) {
  							$(menuItemsArr[i]).removeClass('animate');
  						}
  						$(menuSearchAnim).removeClass('animate');
  				}, 500);

          $('#container').off('scroll.menuscroll', menuScroll);


  			} else {
  				openOverlay();
  				$(menuAriaHidden).attr('aria-hidden', menuIsOpen);

  				expandTrottle = setTimeout(function(){
  					$(menu).addClass('is-open');

  					for(var j = 0; j < menuItemsArr.length; j++) {
  						animateItem($(menuItemsArr[j]), (j*100)+300); //+300 due to #menu.is-open animation time
  						menuSearchAnimTime = j;
  					}

  					menuSearchAnimTime += 1;
  					menuSearchAnimTime = ((menuSearchAnimTime*100)+300);
  					animateItem($(menuSearchAnim), menuSearchAnimTime);

  				}, 100);

          scrollTopContainer = $('#container').scrollTop();
          $('#container').on('scroll.menuscroll', menuScroll);
  			}
  		}, 300, true);

//Related
		var toggleRelated = debounce( function () {
			var relatedIsOpen = $(related).hasClass('is-open');

			$(relatedBtn).attr('aria-expanded', !relatedIsOpen);

			if(relatedIsOpen) {
				$(related).removeClass('is-open');

				expandTrottle = setTimeout(function(){
						$(related).attr('aria-hidden', relatedIsOpen);
				}, 500);
			}	else {

				$(related).attr('aria-hidden', relatedIsOpen);

				expandTrottle = setTimeout(function(){
					$(related).addClass('is-open');
				}, 100);
			}
		}, 300, true);

		function slickAnimateContent() {
			animateItem($('.js-slick-slide'),100);
			animateItem($('.js-slick-content'),700);
		}

// PLUGINS
	//SLICK SLIDER
		$('.js-slick').slick({
      infinite: true,
			arrows: true,
			cssEase: 'ease-in-out',
			dots: true,
			autoplay: true,
			autoplaySpeed: 5000,
			speed: 500,
			onInit: slickAnimateContent()
		});

  //==================================================================
  // IF EVENEMANG START PAGE TYPE / KALENDER EVENEMANG START PAGE TYPE / CATEGORY
  //==================================================================
	  if( $('body').hasClass('start-evenemang-page-type') || 
	  		$('body').hasClass('category-evenemang-taxonomy-type') ) {
	  	//HISTORY
			var State;
			var initState = parseUrl(window.location.href).searchObject;

			if(Object.keys(initState).length > 1 && initState.hasOwnProperty('view') ){
				$('.js-sort-view[data-view="'+initState.view+'"]').addClass('is-active');
				$('.js-sort-view[data-view="'+initState.view+'"]').attr('aria-pressed',true);

				if(initState.view == 'list') {
					$('body').addClass('evenemang-list-view');
				}
			}

			History.Adapter.bind(window,'statechange',function(){
				State = History.getState();
				if($.isEmptyObject(State.data)){

					if(Object.keys(initState).length > 1 && initState.hasOwnProperty('date') ){

						History.replaceState({date:initState.date,view:initState.view,c:initState.c}, document.title, "?date="+initState.date+"&view="+initState.view+"&c="+initState.c);

						$('.js-sort-view[data-view="'+initState.view+'"]').addClass('is-active');
						$('.js-sort-view[data-view="'+initState.view+'"]').attr('aria-pressed',true);

						if(initState.view == 'list') {
							$('body').addClass('evenemang-list-view');
						} else {
							$('body').removeClass('evenemang-list-view');
						}

					} else {

						History.replaceState({date:0,view:"default",c:1}, document.title, "?date=0&view=default&c=1");
						$('.js-sort-view[data-view="default"]').addClass('is-active');
						$('.js-sort-view[data-view="default"]').attr('aria-pressed',true);

						if(initState.view == 'list') {
							$('body').addClass('evenemang-list-view');
						} else {
							$('body').removeClass('evenemang-list-view');
						}
					}
				}
			});

			History.Adapter.trigger(window,'statechange');

	  	//sort name
			$('#js-sort--name').select2();


	  	//sort genre
			var $sortGenre = $('#js-sort--genre').select2({
				minimumResultsForSearch: Infinity
			});

			//Select and input
			$('.js-goto-url').on('change', function() {
				if ( 	$(this).attr('id') === 'js-sort--genre' ) {

					var sParams = parseUrl(window.location.href).searchObject;
					if(Object.keys(sParams).length >= 1){
						window.location.href = this.value + '?date='+sParams['date']+'&view='+sParams['view']+'&c=1';
						return true;
					}

				}
				
				window.location.href = this.value; 
			});

			$('.js-sort-view').on('click', function(e) {

				var val = $(this).data('view');

				if(!$(this).hasClass('is-active')) {
					$('.js-sort-view').removeClass('is-active');
					$('.js-sort-view').attr('aria-pressed',false);

					$('.js-sort-view[data-view="'+val+'"]').addClass('is-active');
					$('.js-sort-view[data-view="'+val+'"]').attr('aria-pressed',true);

					if(val == 'list') {
						$('body').addClass('evenemang-list-view');
					} else {
						$('body').removeClass('evenemang-list-view');
					}

					History.pushState({date:State.data.date,view:val,c:State.data.c}, document.title, "?date="+State.data.date+"&view="+val+"&c="+State.data.c);
				}

			});

	  	//DATEPICKER
			var startDate = new Date();
					startDate.setMonth(startDate.getMonth() - 1, 1);
					startDate = startDate.toISOString().substring(0, 10);

					var endDate = new Date();
					endDate.setMonth(endDate.getMonth() +13, 0);
					endDate = endDate.toISOString().substring(0, 10);

					var dDate = null;

	        if(State.data.date && (State.data.date != 0 || State.data.date != "0")){
						dDate = new Date(State.data.date);
					}


			$( '#js-sort--date' ).datepicker({
			  buttonText: 'Välj',
				dayNames: [ 'Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag' ],
				dayNamesMin: [ 'Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö' ],
				dayNamesShort: [ 'Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö' ],
				monthNames: [ 'Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December' ],
				monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec' ],
				firstDay: 1,
				dateFormat: 'yy-mm-dd',
				minDate: startDate,
				maxDate: endDate,
	      defaultDate: dDate,
	      showButtonPanel: true,
	      closeText: 'Rensa datum',
	      currentText: 'Idag',
				onSelect: function(d,i){

					$('#js-control-sort--date').val(d);

	        var pushD = d;

	        if( d == "" || d == null) {
	          pushD = 0;
	        }


					if( d !== i.lastVal){
		        History.pushState({date:pushD,view:State.data.view,c:1}, document.title, "?date="+pushD+"&view="+State.data.view+"&c=1");
					}

				},
				onClose: function(d, i){

	        if( d == i.lastVal){
	          $.datepicker._clearDate(this);
	        }
				}

			}).keyup(function(e) {
	      if(e.keyCode == 8 || e.keyCode == 46) {
	        $.datepicker._clearDate(this);
	      }
	    });

	    if(State.data.date && (State.data.date != 0 || State.data.date != "0")){
	      $('#js-sort--date').datepicker('setDate', new Date(State.data.date) );
	      $('#js-control-sort--date').val(State.data.date);
	    }

			$('#js-control-sort--date').on('change', debounce(function() {
				var currDate = $.datepicker.formatDate( "yy-mm-dd", $('#js-sort--date').datepicker('getDate') );
				var newDate = this.value;

				if(currDate !== newDate) {
	        if(newDate == "" || newDate == null) {
	          $.datepicker._clearDate('#js-sort--date');
	        } else {
	          $('#js-sort--date').datepicker('setDate', new Date(newDate) );
	          $('.ui-datepicker-current-day').click(); //poor hack will trigger onSelect - shit happens :-)
	        }
				}
			}, 300));

	    //SORT
	  	$('.js-toggle-sv-controls').on('click keydown', function(e) {
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}

	  		var isExpanded = $(this).attr('aria-expanded'),
	  				controlsId = '#'+$(this).attr('aria-controls');

	  				isExpanded = strToBool(isExpanded);

	  		$(this).attr('aria-expanded', !isExpanded);

	  		if(isExpanded){
	  			$(controlsId).slideUp(200);
	  		} else {
	  			$(controlsId).slideDown(200);
	  		}
	  	});

	    }

		//======================================================================
	  // END IF EVENEMANG START PAGE TYPE / KALENDER EVENEMANG START PAGE TYPE
	  //======================================================================

	// INIT
			//menu
			var menu = '#menu',
					menuBtn = '.js-expand-menu',
					menuAriaHidden = '#js-menu-content',
					menuItemsArr = $('.js-menu-item'),
					menuSearchAnim = '.js-anim-search',
					menuSearchAnimTime = 0;

			//related if evenemang-page-type
			var related = '#related',
					relatedBtn = '.js-expand-related';

	// MENU
	    if(!$('html').hasClass('ie')){
	      $(menuItemsArr).addClass('to-animate');
	      $(menuSearchAnim).addClass('to-animate');
	    }

			$('html').on('click keydown', function(e) {
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}
			  //Hide the menus if visible
			  if($(menu).hasClass('is-open')){
			  	toggleMenu();
			  }
			});

			$(menu).on('click keydown', function(e){
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}

				e.stopPropagation();
			});

			$(menuBtn).on('click keydown', function(e) {
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}

				toggleMenu();
	      //make sure related is closed when using menu
	      if($(related).hasClass('is-open')){
	        toggleRelated();
	      }
	      $(menuBtn).blur();
			});

	//RELATED
			$(relatedBtn).on('click keydown', function(e) {
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}
				toggleRelated();
	      if($(menu).hasClass('is-open')){
					toggleMenu();
				}
			});

	// EXPAND
			$('.js-expand').on('click keydown', function(e) {
				var etype = e.type;

				if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
					return true;
				}
				var btnControls = '#' + $(this).attr('aria-controls');
				var btnExpanded = strToBool( $(this).attr('aria-expanded') );

				//is open
				if(btnExpanded) {
					$(this).attr('aria-expanded', !btnExpanded);

					$(btnControls).toggleClass('is-open');

					expandTrottle = setTimeout(function(){
						$(btnControls).attr('aria-hidden',btnExpanded);
					}, 500);

				//is closed
				}	else {
	        var expandTrottleTime = 100;

	        var parentSiblingsExpandedChild = $(this).parent().siblings().find('.js-expand[aria-expanded="true"]');
	        if(typeof parentSiblingsExpandedChild != undefined && parentSiblingsExpandedChild.length != 0) {
	          $(parentSiblingsExpandedChild).trigger('click'); //close  other open navs
	          expandTrottleTime = 400;
	        }

					$(this).attr('aria-expanded', !btnExpanded);

					$(btnControls).attr('aria-hidden',btnExpanded);

					expandTrottle = setTimeout(function(){
						$(btnControls).toggleClass('is-open');
					}, expandTrottleTime);
				}
			});


	// NEWSLETTER
		var subscribeNewsletterUrl = encodeURI($('#js-newsletter-subscribe').data('url'));

		function subscribe() {
			var userMail = encodeURI($('#js-newsletter-subscribe-mail').val());
			var userList = [];
			var lists = $('.js-newsletter-list-id', '#js-newsletter-subscribe');
			
			for(var i = 0; i < lists.length; i++) {
				if( $(lists[i]).prop('checked') ) {
					userList.push( encodeURI( $(lists[i]).val() ) );
				} 
			}
			
	    // subscription page url. Remember to add parameter 'ajax' in the end
	    
	    var url = subscribeNewsletterUrl, 
			    post_data = {
			        email: userMail,
			        join: userList
			    };


	    $.ajax({
	        url: url,
	        method: 'POST',
	        data: post_data,
	        complete: function(data) {
	        	$('#js-newsletter-response').removeClass("has-error");

            if (data.responseJSON.success) {
            		$('#js-newsletter-subscribe').remove(); // remove form
            		$('#js-newsletter-response').addClass("has-success"); // show message
            }
            else {
                // request was not successful
                $('#js-newsletter-error').text(data.responseJSON.error_msg); // set error message
            		$('#js-newsletter-response').addClass("has-error"); // show message
                //$('#js-newsletter-subscribe-btn').prop('disabled',false); // enable btn
            }
	        }
	    });

		
	  }

	  $('#js-newsletter-subscribe-btn').on('click keydown', function (e) {
			var etype = e.type;

			if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
				return true;
			}

			e.preventDefault();
			//e.stopPropagation();


			//$(this).prop('disabled',true);

			subscribe();
		});


	//POPUP
		$('.js-popup').on('click keydown', function (e) {
			var etype = e.type;

			if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
				return true;
			}

			if( $(e.target).hasClass('js-popup-no-action') || $(e.target).parents('.js-popup-no-action').length != 0 ) {
				return true;
			}

			e.preventDefault();
			e.stopPropagation();

			var isNewsletter = $(this).hasClass('js-popup-newsletter');
			var popupToOpen =  isNewsletter ? '.popup--newsletter' : '.' + $(this).attr('data-popup');


			$(popupToOpen).toggleClass('visually-hidden');



			if(!$('#search').hasClass('visually-hidden') ){
				$('#search .search-field').focus();
			}

			if(popupToOpen === ".popup--book-table"){
				if($('#book-table-iframe--content').length <= 0){
					$('#book-table-iframe').append('<iframe id="book-table-iframe--content" class="popup__iframe" frameborder="0" hspace="0" scrolling="auto" src="https://api.caspeco.net/externalBookingClient/?publicID=fd16edd734e41c8284140877e7c804b2&unitID=2&fixedSize=1"></iframe>');
					$('#book-table-iframe--content').focus();
				}

				$('#book-table-iframe--content').ready(function () {
					$('#popup__iframe-loader').css('display', 'none');
				});
				$('#book-table-iframe--content').load(function () {
					$('#popup__iframe-loader').css('display', 'none');
				});
			}
		});

	//COOKIES
		function setCookie(cname, cvalue) {
			var domain = window.location.hostname;

	    var d = new Date();
			d.setFullYear(d.getFullYear()+1);

	    var expires = "expires="+d.toGMTString();
	    document.cookie = cname + "=" + cvalue + "; " + expires +"; path=/; domain="+domain;
		}

		getCookie = function (cname) {
	    var name = cname + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var ca = decodedCookie.split(';');

	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return 0;
		};


		function checkCookie() {

			var cookieName = "st_cookie_consent";
			var cookieExists = getCookie(cookieName);

			// < 0 = first visit
			// 0 = visited one time
			// 1 = clicked consent button
			// in future level e.g. 2 might be used for active consent


	    if (cookieExists <= 0 && navigator.cookieEnabled) {
	    	setCookie(cookieName, 0);

	    	$('#cookies').show();
	    	$("#approve-cookies").on("click keydown", function(e) {
					var etype = e.type;

					if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
						return true;
					}

					e.preventDefault();
					setCookie(cookieName, 1);
					$('#cookies').hide();
				});

	      if($('body').hasClass('start-page-type') && $(window).width() > 1024){
	        setTimeout(toggleMenu, 1000);
	      }

	    } else {
	    	$('#cookies').hide();
	    }
		}
		checkCookie();


	//SCROLL TO
		$('.js-scroll-to').on('click keydown', function (e) {
			var etype = e.type;

			if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
				return true;
			}

			e.preventDefault();


			var href = $(this).attr('href');
			var toId = false;



			if (href.match("^#")) {
			  toId = href;
			}


			if(toId) {
				var position = $(toId).position().top;

		    if(href == '#js-scroll-destination'){
		      position = position - 50;
		    }

				$('#container').animate({
					scrollTop: position
				}, 1000);
			} else {
				window.location.href = href;
			}			

			
		});



	//MASONRY
		if( $('body').hasClass('stories-page-type') ){
			var State;
			var initState = parseUrl(window.location.href).searchObject;

			State = History.getState();

			if($.isEmptyObject(State.data)){
				if(Object.keys(initState).length >= 1){
					if(initState.hasOwnProperty('c')){
						History.replaceState({c:initState.c}, document.title, "?c="+initState.c);
					}
				}
			}
		}

		var $grid = $('.js-masonry').isotope({
			positionPercent: true,
		  itemSelector: '.js-masonry-item',
			masonry: {
		    columnWidth: '.js-masonry-item',
				//horizontalOrder: true,
				//fitWidth: true
		  }
		});

		$grid.imagesLoaded(function() {
		  $grid.isotope('layout');
			$('.js-masonry').css('opacity','1')

			if($('body').hasClass('stories-page-type')){
				History.Adapter.trigger(window,'statechange');
			}
		});
	});

	//NEW BOOK TABLE
  $(function () { $(".js-book-table").lbuiDirect(
    {
     connectionid  :  "SE-RES-RESTAURANGMOSEBACKESDRATEATERN_283019:96384",
     style  :  {
     useFlatDesign  :  true
     },
     language  :  "sv-SE",
     modalWindow  :  {
       enabled  :  true}
    });
	});

})(jQuery);