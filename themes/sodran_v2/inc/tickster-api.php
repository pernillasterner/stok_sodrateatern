<?php

/**
 * Get data from Tickster
 *
 * @package sodran_v2
 */

function sodran_v2_tickster_get_event_id($url) {
  // Get Event ID from URL
  //    https://secure.tickster.com/Intro.aspx?ERC=ZH17C6T0XRA09MC
  //    http://www.tickster.com/sv/events/zh17c6t0xra09mc 

	$reg = '~(?:http|https|)(?::\/\/|)(?:www.|secure.|)?tickster.com\/.+?(?:events\/|erc=)~i';
 	$id = preg_replace( $reg, '$1', strtolower($url) );
 	

	if(!empty($id)) {
		return $id;
	} else {
		return false;
	}
}


function sodran_v2_tickster_get_event($key, $id, $eventId, $eventDate) {
	// https://api.tickster.com/{language-code}/api/{api-version}/events/{event-id}?key={api-key}

  //$ticksterEvent = wp_cache_get( 'date_'.$eventDate, 'post_'.$eventId, true );

  $ticksterEventTransient = get_transient( 'post_'.$eventId.'_'.$eventDate );

  if ( false === $ticksterEventTransient ) {
    if( !empty($id) && !empty($key) ) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tickster.com/sv/api/0.3/events/".$id."?key=".$key,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache"
        ),
      ));
      $ticksterResponse = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      $ticksterEvent = json_decode($ticksterResponse, true); //because of true, it's in an array
    } else {
      $ticksterEvent = false;
    }

    $cacheTime = 30 * 60; // minutes * seconds per minute
    //wp_cache_set( 'date_'.$eventDate, $ticksterEvent, 'post_'.$eventId, $cacheTime);

    $transistentResponse = set_transient( 'post_'.$eventId.'_'.$eventDate , $ticksterEvent, $cacheTime );

    if( false === $transistentResponse ) {
      // Setting the transient didn't work, so return false for failure
      $ticksterEventTransient = false;
    } else {
      $ticksterEventTransient = get_transient( 'post_'.$eventId.'_'.$eventDate );
    }

  }

  return $ticksterEventTransient;
}