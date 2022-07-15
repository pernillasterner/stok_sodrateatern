/* Database - AJAX to MySQL view through Wordpress php */
/* This was a pain in the ass, so if you break it you fix it! */
(function($) {

	var monthNames = ['januari','februari','mars','april','maj','juni','juli','augusti','september','oktober','november','december'];
	var $dancingFeetPos = 0,
			$newDateQuery = false,
			$xhrFailedTxt = 'Hoppsan! Något gick fel',
			$offset = 0,
			$paginationLimitUsed = true,
	    $pagination = 1,
	    $scrollToEnd = false,
			$listview = 0,
			$busy = false,
			$initmessage = '',
			$timeout,
	    $xhr,
			$error = false,
	    $afterDateQuery = false,
			$newQuery = true,
			// $preLoader = '<img class="loading-bar__loader" src="/wp-content/themes/sodran_v2/dist/images/dancestep.gif" alt="Laddar fler evenemang">';
			$preLoader = '';

 	if($('body').hasClass('stories-page-type') || 
 		$('body').hasClass('start-evenemang-page-type') || 
 		$('body').hasClass('category-evenemang-taxonomy-type')) {
			var State = History.getState();
	}


  Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
  };

	function scrollToDancingFeets() {
		$('#container').animate({
			scrollTop: $dancingFeetPos
		}, 100);
	}


	function isSet(value) {
    if (typeof (value) === 'undefined' ||
    		value === null ||
    		value == 0 ||
    		value == "0" ||
    		value.lenght == 0) {
        
        return false;
    } else {
        return true;
    }
	}

  function pageFilter() {
    $settings.orderby = 'datetime';
    $offset = 0;
    $error = false;

    var $tax = 'all';
    if($('body').hasClass('category-evenemang-taxonomy-type')) {
			$tax = $($settings.idController).attr('data-cat');
    }

    if($tax === "all"){
			$settings.taxonomies = [];
		} else {
			$settings.taxonomies = [Number($tax)];
		}

    //if date, get speficic date, create a sepparator and then continue loading from there
    if($newQuery && isSet(State.data.date) ) {

      var dateArr = State.data.date.split('-');

      $settings.year = dateArr[0];
  		$settings.month = dateArr[1];
  		$settings.day = dateArr[2];

      var thisDay = new Date( Date.parse( State.data.date ) );
      thisDay.setHours(12,0,0,0);

      var nextDay = new Date(thisDay);
      nextDay.setDate(thisDay.getDate() + 1);

      $settings.curdate = nextDay.yyyymmdd();

      $newDateQuery = true;
      $afterDateQuery = true;

    } else {
      $settings.year = 0;
  		$settings.month = 0;
  		$settings.day = 0;

      if(State.data.date == 0 && State.data.date == "0" ) {
        $settings.curdate = 0;
      }

    }
		if($('body').hasClass('start-evenemang-page-type') || $('body').hasClass('category-evenemang-taxonomy-type')) {
			if(State.data.date != 0 && 
				State.data.date != "0") {

					scrollToDancingFeets();
			}
		}

		getData();
  }

	function initBusy() {
		clearTimeout($timeout);

    if($xhr && $xhr.readystate != 4){
        $xhr.abort();
    }

    $busy = true;
		showPreloader();
	}

	function xhrFailed() {
		if($('body').hasClass('start-page-type')) {
			$('#js-ajax-container').html('<p class="no-events info-txt">'+$xhrFailedTxt+'</p>');
		} else if($('body').hasClass('evenemang-page-type')) {
			$('#js-ajax-container').html('<p class="no-related-posts info-txt">'+$xhrFailedTxt+'</p>');

		} else {
			$busy = false;
			$error = true;
			$('.loading-bar', $settings.idController).html($xhrFailedTxt);

			if($('body').hasClass('stories-page-type')) {
				$('.js-load-more', $settings.idController).hide();
			}
		}
	}

	function settingsByQueryType() {
		if($newDateQuery){
			$settings.limit = 20;
			$scrollToEnd = false;
		} else if(!$paginationLimitUsed) {
			$settings.limit = $settings.limit * $pagination;
			$paginationLimitUsed = true;
			$scrollToEnd = true;
		} else if($newQuery || $afterDateQuery) {
			$settings.limit = 12;
			$afterDateQuery = false;
			$scrollToEnd = false;
		} else {
			$settings.limit = 12;
			$scrollToEnd = false;
			$pagination++;

			History.replaceState({date:State.data.date,view:State.data.view,c:$pagination}, document.title, "?date="+State.data.date+"&view="+State.data.view+"&c="+$pagination);
		}

		if($newQuery) {
			$('.content', $settings.idController).html('');
			$newQuery = false;
		}
	}

	function showInitMsg() {
		$('.loading-bar', $settings.idController).html($initmessage);
		if($('body').hasClass('stories-page-type')) {
			$('.js-load-more', $settings.idController).show();
		}
	}

	function showPreloader() {
		$('.loading-bar', $settings.idController).html($preLoader);
		if($('body').hasClass('stories-page-type')) {
			$('.js-load-more', $settings.idController).hide();
		}
	}

	function showErrorMsg() {
		if($('body').hasClass('start-page-type')) {
			$('#js-ajax-container').html('<p class="no-events info-txt">Inga evenemang hittades</p>');
		} else if($('body').hasClass('evenemang-page-type')) {
			$('#js-ajax-container').html('<p class="no-related-posts info-txt">Inga relaterade evenemang hittades</p>');
		} else {
			$('.loading-bar', $settings.idController).html($settings.errorMsg);

			if($('body').hasClass('stories-page-type')) {
				$('.js-load-more', $settings.idController).remove();
			}
			$error = true;
		}
	}

	function scrollToEnd() {

		if($scrollToEnd){
			setTimeout(function() {
				var position = $('#container')[0].scrollHeight - $('#container').height() - 188;
				$('#container').animate({
					scrollTop: position
				}, 1000);

			}, 100);
		}
	}

	function emptyResponse() {
		if($newDateQuery) {
			var textnode = document.createTextNode("Inget evenemang hittades detta datum. Kommande evenemang:");
			var node = document.createElement('div');
					node.className = "info-txt date-break";
					node.appendChild(textnode);

			if($listview == 1){
				node.className = "info-txt date-break list-view";
			}

			$('.content', $settings.idController)[0].appendChild(node);

			$newDateQuery = false;
			pageFilter();
		} else {
			showErrorMsg();
		}

		$busy = false;
	}

  function getData() {
    initBusy();

		settingsByQueryType();

    $xhr = $.post('/wp-admin/admin-ajax.php', {
			action      : 'build_sql_query',
			orderby	  	: $settings.orderby,
      curdate     : $settings.curdate,
			limit		    : $settings.limit,
			offset	  	: $offset,
			year		    : $settings.year,
			month	    	: $settings.month,
			day 	    	: $settings.day,
			taxonomies	: $settings.taxonomies,
			listview    : $listview
		})
    .done( function(data) {
      if(data === "") {
        emptyResponse();
      } else {

        $timeout = setTimeout(function () {

  				var $tmp;
          var delayTime = 100;
          var fadeTime = 300;
					var finalDelay = 1;

          if($listview == 1) {
            $tmp = $(data).filter('.list-view');
            delayTime = 50;
            fadeTime = 10;
          } else {
            $tmp = $(data).filter('.box');
          }

          if($scrollToEnd){
            delayTime = 0;
            fadeTime = 0;
          }


  				$.each( $tmp, function ( i, val) {
            finalDelay = i+1;

						$(val).hide();
						$('.content', $settings.idController)[0].appendChild(val);

  					if( i === $tmp.length - 1) {

  						$(val).delay(delayTime*i).fadeIn(fadeTime, function () {

                if(!$newDateQuery) {
                  $offset = $offset + $settings.limit;
                }

  							$busy = false;

                if( $tmp.length < $settings.limit && !$newDateQuery ) {
  								showErrorMsg();
  							} else {
  								showInitMsg();
  							}

                if($newDateQuery) {
                  var textnode = document.createTextNode("Kommande evenemang");
                  var node = document.createElement('div');
                      node.className = "info-txt date-break";
                      node.appendChild(textnode);

                  $(node).hide();
                  $('.content', $settings.idController)[0].appendChild(node);
                  $(node).delay(delayTime*finalDelay).fadeIn(fadeTime);
                  $newDateQuery = false;
                  pageFilter();
                }
  						});

              scrollToEnd();

  					} else {

  						$(val).delay(delayTime*i).fadeIn(fadeTime);
  					}
  				});
        }, 10);
      }
		})
		.fail( function(xhr, textStatus, errorThrown) {
      if (textStatus != "abort") {
        xhrFailed();
      }
		});
	}


	function getStories() {
		var iso = Isotope.data( $( $settings.idContainer )[0] );


		initBusy();
		$xhr = $.post('/wp-admin/admin-ajax.php', {
			action     : 'stories',
			page       : $pagination,
			ppp		 		 : $settings.ppp,
			sticky		 : $settings.sticky
		})
		.done( function(data) {
			if(data === "") {
				emptyResponse();
			} else {

				if($pagination > $presetPagination) {
					History.replaceState({c:$pagination}, document.title, "?c="+$pagination);
				}

				$pagination++;

				$timeout = setTimeout(function () {
					var $tmp;
					var delayTime = 100;
					var finalDelay = 1;


					$tmp = $(data).filter('.card');


					$.each( $tmp, function ( i, val) {
						finalDelay = i + 1;

						setTimeout(function() {
							$(val).hide();
							$( $settings.idContainer ).isotope().append(val).isotope( 'appended', val ).imagesLoaded(function() {
								iso.layout();
							});
						}, (delayTime * i));

					});

					setTimeout(function() {
						$busy = false;

						if( $tmp.length < $settings.ppp ) {
							showErrorMsg();
						} else {
							showInitMsg();
						}

						if( $presetPagination != 0 && ($pagination - 1) < $presetPagination ) {
							getStories();
						} else if ( firstCall && ($pagination - 1) == $presetPagination ) {
							firstCall = false;
							scrollToEnd();
						}

					}, (delayTime*finalDelay));


				}, 10);
			}
		})
		.fail( function(xhr, textStatus, errorThrown) {
			if (textStatus != "abort") {
				xhrFailed();
			}
		});
	}


	if($('body').hasClass('start-page-type')){
		$.post('/wp-admin/admin-ajax.php', {
			action     : 'build_sql_query',
			orderby    : 'datetime',
			limit      : 4
		})
		.done( function(data) {
			if(data == "") {
				emptyResponse();
			} else {
				$('#js-ajax-container').html(data);
			}
		}).fail( function(xhr, textStatus, errorThrown) {
			xhrFailed();
		});
	}

	else if($('body').hasClass('stories-page-type')) {
		$preLoader = '<span>Laddar...</span>';

		$scrollToEnd = true;
		$initmessage = '<span></span>';
		$pagination = 2;
		var $presetPagination = 0;
		var $settings = {
			idController : '#js-ajax-controller',
			idContainer	 : '#js-ajax-container',
			sticky			 : Number($('#js-ajax-container').data('except-id')),
			ppp        	 : 18,
			page				 : $pagination,
			errorMsg     : '<span>Inga fler poster hittades</span>',
			delay        : 300
		};

		$('.js-load-more').on('click keydown', function(e) {
			var etype = e.type;

			if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
				return true;
			}

			e.preventDefault();
			if($busy === false && $error === false ) {
        getStories();
			}
		});

		var firstCall = true;

		History.Adapter.bind(window,'statechange',function(){
	    State = History.getState();

			$presetPagination = (typeof State.data.c === 'undefined') ? 0 : State.data.c;
			if($presetPagination == 0) {
				firstCall = false;
			} else if($pagination <= $presetPagination && firstCall) {
				getStories();
			}
		});
	}

	else if($('body').hasClass('evenemang-page-type')) {

		var $post_id = $('#related').attr('data-post-id'),
		$post_tags = ($('#related').attr('data-post-tags')).slice(0,-1),
		$tag_ids = $post_tags.split(' '),
		$post_cats = ($('#related').attr('data-post-cats')).slice(0,-1),
		$cat_ids = $post_cats.split(' ');

    //first check if mathing taxonomies
    var relatedDate;
    var relatedItems;

		$.post('/wp-admin/admin-ajax.php', {
			action     : 'build_sql_query',
			orderby    : 'related',
			limit      : 20,
			post_id    : $post_id,
			taxonomies : $tag_ids
		})
		.done( function(data) {
      if(data === "" ) {
        //if not enough check mathing categories
				$.post('/wp-admin/admin-ajax.php', {
					action               : 'build_sql_query',
					orderby              : 'related',
          limit                : 20,
					post_id              : $post_id,
					taxonomies           : $cat_ids
				})
				.done( function(data) {
          if(data === "") {
						emptyResponse();
					} else {
						$('#js-ajax-container').html(data);
					}
				})
				.fail( function(xhr, textStatus, errorThrown) {
					xhrFailed();
				});
			} else {
				$('#js-ajax-container').html(data);
			}
		})
		.fail( function(xhr, textStatus, errorThrown) {
			xhrFailed();
		});

	}

	else if( $('body').hasClass('start-evenemang-page-type') || $('body').hasClass('category-evenemang-taxonomy-type') ){
		var $settings = {
			idController : '#js-ajax-container',
			orderby      : 'datetime',
      curdate      : 0,
			limit        : 12,
			year         : 0,
			month        : 0,
			day 		     : 0,
			taxonomies   : [],
			errorMsg     : 'Inga fler evenemang hittades',
			delay        : 300,
			scroll       : true
		};

		//infinite scroll
		if($settings.scroll === true) {
			$initmessage = '<span class="info-txt">Scrolla eller klicka här för fler evenemang</span>';
		} else {
			$initmessage = '<span class="info-txt">Klicka här för fler evenemang</span>';
		}

    if($('body').hasClass('category-evenemang-taxonomy-type')) {
      $settings.taxonomies =[Number($($settings.idController).attr('data-cat'))];
    }


    $($settings.idController).html('<div class="content"></div><div class="loading-bar info-txt">'+$initmessage+'</div>');

		// If scrolling is enabled
		if($settings.scroll === true) {
			var scrollHeight;
			// .. and the user is scrolling
			$('#container').on('scroll', function() {
        scrollHeight = $($settings.idController).height() - 50;

        if($listview == 0) {
          scrollHeight = Math.floor( $(window).height() * 0.58 ) + $($settings.idController).height();
        }

				if( ( $('#container').scrollTop() + $(window).height() ) >= scrollHeight && $busy === false && $error === false) {
					getData();
				}
			});
		}

		// Also content can be loaded by clicking the loading bar/
		$('.loading-bar', $settings.idController).on('click keydown', function (e) {
			var etype = e.type;

			if(etype === 'keydown' && (e.keyCode !== 13 && e.keyCode !== 32)) {
				return true;
			}

			e.preventDefault();
			if($busy === false && $error === false ) {
        getData();
			}
		});

    var firstCall = true;
    var prevDate;
    var prevTax;
    var prevView;


		History.Adapter.bind(window,'statechange',function(){
	    State = History.getState();

        var newDate = State.data.date;

        var newTax = 'all';
        if($('body').hasClass('category-evenemang-taxonomy-type')) {
        	var newTax = $($settings.idController).attr('data-cat');
        }

        if($('body').hasClass('category-evenemang-taxonomy-type') ||
        	$('body').hasClass('start-evenemang-page-type') ) {

        		var newView = State.data.view;
        		$listview = (newView == 'list') ? 1 : 0;
        }

        $pagination = State.data.c;

        if($pagination > 1 && firstCall) {
          $paginationLimitUsed = false;
        }

        if(prevTax != newTax || prevDate != newDate || prevView != newView){
          $newQuery = true;

          if($pagination > 1) {
            $paginationLimitUsed = false;
          }

          pageFilter();

          prevDate = newDate;
          prevTax = newTax;
          prevView = newView;

					if( $dancingFeetPos === 0 ){
						if( $(document).width() >= 1024 ) {
							$dancingFeetPos = ( $('#container').height() * 0.6 ) - 80;
						} else {
							$dancingFeetPos = ( $('#container').height() * 0.6 );
						}
					}
        }

        firstCall = false;
	  });
	}
})(jQuery);
