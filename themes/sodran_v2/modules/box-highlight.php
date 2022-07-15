<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

$post_id = get_the_ID();
$title = get_the_title();
$preamble = papi_get_field('preamble');
$link = get_permalink( );
$categories = '';
$date = '';
$location = '';

$imgId = get_post_thumbnail_id($post_id);
$imgSrcUrl = wp_get_attachment_url( $imgId );
$filetype = wp_check_filetype($imgSrcUrl);

if ($filetype['ext'] == 'gif') {
  $img = wp_get_attachment_image_src( $imgId, 'full', false);
} else {
  $img = wp_get_attachment_image_src( $imgId, 'card', false, '' );
}

$img_url = $img[0];

//fill categories
$terms = wp_get_post_terms($post_id, 'category');
$counter = 0;
$len = count($terms);

foreach ( $terms as $term ) {
	if($counter == ($len -1)) {
		$categories .= $term->name;
	} else {
		$categories .= $term->name . " / ";
	}
	$counter++;
}

//fill date
$dates = papi_get_field($post_id, 'dates');

foreach($dates as $values) {

  if( date('Y m d', strtotime($values['date_time'])) >= date('Y m d') ) {

    if(date('Y m d', strtotime($values['date_time'])) == date('Y m d')) {
      $date = 'Idag';
    } elseif(date('Y m d', strtotime('+1 day', strtotime($values['date_time']))) == date('Y m d')) {
      $date = 'Igår';
    } else {
      $date = strftime('%d %b', strtotime($values['date_time']));
    }

    $date .= ' kl ' . strftime('%H:%M', strtotime($values['date_time']));

    if($values['location'] == "other_location") {
      $location = $values['other_location'];
    } else {
      $location = $values['location'];
    }

    break;
  }
}

?>

<a class="box box--hover box--hover--highlight span-6-12--sbp span-3-12--lbp" href="<?= $link ?>" style="background-image: url(<?= $img_url; ?>)">
  <div class="box__wrapper txt-c">
    <h2 class="title"><?= $title; ?></h2>
    <p class="preamble preamble--small"><?= $preamble; ?></p>
		<?php if(!empty($date)): ?>
	    <div class="details table">
	      <p class="details__info cell icon icon--date-light txt-r"><?= $date; ?></p>
	      <p class="details__info cell icon icon--location-light txt-l"><?= $location; ?></p>
	    </div>
		<?php endif; ?>
    <div class="box__btn">
      <div class="btn btn--internal">Tips!</div>
    </div>
  </div>

  <span class="categories categories--box"><?= $categories; ?></span>
</a>
