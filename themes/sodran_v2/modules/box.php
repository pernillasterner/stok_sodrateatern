<?php
setlocale(LC_ALL, "sv_SE.UTF-8");

$title = $post_title;
$preamble = papi_get_field($post_id, 'preamble');
$link = get_permalink( $post_id );
$categories = '';
$img_small = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'small', false);
$img_url_small = $img_small[0];
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
	if($values['date_time'] == $post_date) {
		if(date('Y m d', strtotime($values['date_time'])) == date('Y m d')) {
			$date = 'Idag';
		} elseif(date('Y m d', strtotime('+1 day', strtotime($values['date_time']))) == date('Y m d')) {
      $date = 'Igår';
    } else {
			$date = strftime('%d %b', strtotime($values['date_time']));
			//$outputString .= date('d M', strtotime($values['date_time']));
		}

    if(!$is_related){
  		$date .= ' kl ' . strftime('%H:%M', strtotime($values['date_time']));

  		if($values['location'] == "other_location") {
  			$location = $values['other_location'];
  		} else {
  			$location = $values['location'];
  		}
    }
	}
}

?>
<?php if($is_related) : ?>
  <a class="box box--hover box--related" href="<?= $link; ?>" style="background-image: url(<?= $img_url_small; ?>)">
    <div class="box__wrapper txt-c">
      <h2 class="title title--small"><?= $title; ?></h2>
      <div class="details table">
        <p class="details__info cell icon icon--date-light"><?= $date; ?></p>
      </div>
      <div class="box__btn">
        <div class="btn btn--internal">Läs mer</div>
      </div>
    </div>
  </a>

<?php else : ?>
  <a class="box box--hover span-6-12--sbp span-3-12--lbp" href="<?= $link; ?>" style="background-image: url(<?= $img_url; ?>)">
    <div class="box__wrapper txt-c">
      <h2 class="title"><?= $title; ?></h2>
      <p class="preamble preamble--small"><?= $preamble; ?></p>
      <div class="details table">
        <p class="details__info cell icon icon--date-light txt-r"><?= $date; ?></p>
        <p class="details__info cell icon icon--location-light txt-l"><?= $location; ?></p>
      </div>
      <div class="box__btn">
        <div class="btn btn--internal">Läs mer</div>
      </div>
    </div>

    <span class="categories categories--box"><?= $categories; ?></span>
  </a>

<?php endif; ?>
