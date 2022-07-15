<?php
/**
 *
 * @package sodran_v2
 */

function sodran_v2_get_evenemang_titles() {
  global $wpdb;

  $sql = "SELECT * FROM event_all_data WHERE DATE_ADD(meta_date, INTERVAL 6 HOUR) >= NOW() GROUP BY post_id ORDER BY meta_date ASC";
  $results = $wpdb->get_results($sql, OBJECT);

  return $results;
}


function sodran_v2_build_static_query ($ppp, $cat) {
	global $wpdb;
	global $post;

  $params = array();

	$sql = "SELECT * FROM event_all_data";
	$sql .= " WHERE DATE_ADD(meta_date, INTERVAL 6 HOUR) >= NOW()";

	if(!empty($cat)) {
		$sql .= " AND (";
		$sql .= "tax_id = %d";
		$params[] = $cat;
		$sql .= ")";
	} 
	
	$sql .= " GROUP BY meta_id ORDER BY meta_date ASC";

	$sql .= " LIMIT %d";
	$params[] = $ppp;

  $results = $wpdb->get_results( $wpdb->prepare(
          $sql,
          $params
  ), OBJECT );

  return $results;
	die();
	exit;
}


function sodran_v2_build_sql_query () {
	global $wpdb;
	global $post;

	$orderby = isset( $_POST["orderby"] )? $_POST["orderby"] : 'datetime';
	$limit = isset( $_POST["limit"] )? $_POST["limit"] : 0;
	$offset = isset( $_POST["offset"] )? $_POST["offset"] : 0;
	$year = isset( $_POST["year"] )? $_POST["year"] : 0;
	$month = isset( $_POST["month"] )? $_POST["month"] : 0;
	$day = isset( $_POST["day"] )? $_POST["day"] : 0;
	$taxonomies = isset( $_POST["taxonomies"] )? $_POST["taxonomies"] : [];
  $exclude_taxonomies = isset( $_POST["exclude_taxonomies"] )? $_POST["exclude_taxonomies"] : [];
	$post_id = isset( $_POST["post_id"] )? $_POST["post_id"] : 0;
  $curdate = isset( $_POST["curdate"] )? $_POST["curdate"] : 0;
  $listview = isset( $_POST["listview"] )? $_POST["listview"] : 0;



	$sql = "SELECT * FROM event_all_data";

  $params = array();

	if( $year == 0 || $month == 0 ){

    if($curdate == 0){
      $sql .= " WHERE DATE_ADD(meta_date, INTERVAL 6 HOUR) >= NOW()";
    } else {
      //$curdate = '"'.$curdate.'"';
      $sql .= " WHERE DATE(meta_date) >= %s";
      $params[] = $curdate;
    }

	} else if ($day == 0) {
		$sql .= " WHERE YEAR(meta_date) = %d AND MONTH(meta_date) = %d";
    $params[] = $year;
    $params[] = $month;
	} else {
		//$sql .= " WHERE YEAR(meta_date) = %d AND MONTH(meta_date) = %d AND DAY(meta_date) = %d";
		$sql .= " WHERE DATE(meta_date) = %s OR DATE(DATE_ADD(meta_date, INTERVAL 6 HOUR)) = %s";

		$date = $year.'-'.$month.'-'.$day;

		$params[] = $date;
		$params[] = $date;

    //$params[] = $year;
    //$params[] = $month;
    //$params[] = $day;
	}

	if( count($taxonomies) > 0 ){
		$sql .= " AND (";
		$counter = 0;
		foreach ($taxonomies as $tax_id){
			if($counter == 0){
				$sql .= "tax_id = %d";
        $params[] = $tax_id;
			} else {
				$sql .= " OR tax_id = %d";
        $params[] = $tax_id;
			}
			$counter++;
		}
		$sql .= ")";
	}

  //NEEDS INNER QUERY OR SOMETHING
  /*
  if( count($exclude_taxonomies) > 0 ){
		foreach ($exclude_taxonomies as $exclude_tax_id){
			$sql .= " AND tax_id != %d"; // FROM SAME ID AS PREVIOUSLY PICKED
      $params[] = $exclude_tax_id;
		}
	}
  */

	switch ( $orderby ){
		case 'datetime':
			$sql .= " GROUP BY meta_id ORDER BY meta_date ASC";
			break;
    case 'title':
			$sql .= " GROUP BY post_id ORDER BY post_title ASC";
			break;
		case 'related':
			$sql .= " AND post_id <> %d";
			$sql .= " GROUP BY post_id ORDER BY meta_date ASC";
      $params[] = $post_id;
			break;
		case 'taxonomies':
			$sql .= " GROUP BY post_id ORDER BY meta_date ASC";
			break;
	}
	if($limit != 0){
		$sql .= " LIMIT %d";
    $params[] = $limit;
	}

	if($offset != 0){
		$sql .= " OFFSET %d";
    $params[] = $offset;
	}
	/* Get the results */
	//$results = $wpdb->get_results($sql, OBJECT);
  $results = $wpdb->get_results( $wpdb->prepare(
          $sql,
          $params
  ), OBJECT );



	$is_related = false;

	if($orderby == "related"){
		$is_related = true;
	}

	/* create the event-boxes */
	foreach($results as $event){
		$post_id = $event->post_id;
		$post_title = $event->post_title;
		$post_date = $event->meta_date;


    if($listview == 1){
      include(locate_template('modules/list-view.php'));
    } else {
      include(locate_template('modules/box.php'));
    }
	}

	/* return the boxes for append on page */
	die();
	exit;
}
add_action( 'wp_ajax_build_sql_query', 'sodran_v2_build_sql_query' );
add_action( 'wp_ajax_nopriv_build_sql_query', 'sodran_v2_build_sql_query' );


function sodran_v2_get_stories() {
  $page = isset( $_POST["page"] )? $_POST["page"] : 2;
  $ppp = isset( $_POST["ppp"] )? $_POST["ppp"] : 18;
  $sticky = isset( $_POST["sticky"] )? $_POST["sticky"] : 0;


  $args = array(
    'paged' => $page,
    'posts_per_page' => $ppp,
    'post_type' => 'stories',
    'post_status' => 'publish'
  );

  if($sticky != 0) {
    $args = array(
      'paged' => $page,
      'posts_per_page' => $ppp,
      'post_type' => 'stories',
      'post_status' => 'publish',
      'post__not_in' => array($sticky)
    );
  }

  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();
    include(locate_template('modules/card.php'));
  endwhile;

  die();
}

add_action( 'wp_ajax_stories', 'sodran_v2_get_stories' );
add_action( 'wp_ajax_nopriv_stories', 'sodran_v2_get_stories' );

function sodran_v2_build_sql_query_enqueue() {
	//wp_enqueue_script ( 'history_script', get_template_directory_uri() . '/dist/scripts/plugins/jquery.history.js', array('jquery'), null, true);

	wp_localize_script('main', 'ajaxObj', array('ajax_url' => admin_url( 'admin-ajax.php' )));

}
add_action( 'wp_enqueue_scripts', 'sodran_v2_build_sql_query_enqueue' );

?>
