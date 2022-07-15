<?php
/**
 * Search modifications
 *
 * @package sodran_v2
 */

function sodran_v2_change_wp_search_size($query) {
    if ( $query->is_search ) { // Make sure it is a search page
    	$query->set('post_type',array('post', 'page','stories'));
        $query->query_vars['posts_per_page'] = 50; // Change 10 to the number of posts you would like to show

	    return $query; // Return our modified query variables
	}
}
add_filter('pre_get_posts', 'sodran_v2_change_wp_search_size'); // Hook our custom function onto the request filter

// Match post_type: post and post_date newer than 6 months in search
function sodran_v2_date_weights($match) {
	$post_type = relevanssi_get_post_type($match->doc);
	$post_date = strtotime(get_the_date("Y-m-d", $match->doc));

	if ($post_type == 'post' && date('Y-m-d', $post_date) > date('Y-m-01', strtotime("-12 month"))) {
 		$match->weight = $match->weight * 2;
	}
	else if($post_type == 'post' && date('Y-m-d', $post_date) < date('Y-m-01', strtotime("-12 month"))) {
		$match->weight = 0;
	}
	return $match;
}
add_filter('relevanssi_match', 'sodran_v2_date_weights');



function sodran_v2_only_publish($array) {
	return array('publish');
}
add_filter('relevanssi_valid_status', 'sodran_v2_only_publish');
