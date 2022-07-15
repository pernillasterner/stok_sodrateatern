


<?php
setlocale(LC_ALL, "sv_SE.UTF-8");

$title = $post_title;
$preamble = papi_get_field($post_id, 'preamble');
$link = get_permalink( $post_id );
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail', false);
$img_url = $img[0];
$date = '';
$location = '';
$tickets_link = papi_get_field($post_id, 'tickets_link');
$buy_link;
$sold_out = false;
$passed = false;
$ymd_today = strftime('%y%m%d');
$categories = '';

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

foreach($dates as $date) {
	if($date['date_time'] == $post_date) {
    $raw_date = $date['date_time'];
    $ymd_date = strftime('%y%m%d', strtotime($raw_date));

    if($ymd_date < $ymd_today) {
      $passed = true;
    }

		if(date('Y m d', strtotime($date['date_time'])) == date('Y m d')) {
			$datetime = 'Idag';
		} else {
			$datetime = strftime('%d %b', strtotime($date['date_time']));
		}

		$datetime .= ' kl ' . strftime('%H:%M', strtotime($date['date_time']));

		if($date['location'] == "other_location") {
			$location = $date['other_location'];
		} else {
			$location = $date['location'];
		}

    if($date['sold_out']){
      $sold_out = true;
    }

    if(!empty($tickets_link)) {
      $buy_link = $tickets_link;
    } else {
      $buy_link = $date['buy_link'];
    }
	}
}
?>

<div class="list-view">
  <div class="list-view__wrapper table--sbp">

    <div class="list-view__img cell--sbp hide--sbp-max">
      <div class="list-view__img__wrapper">
        <?php if(!empty($img_url)) : ?>
          <img src="<?= $img_url; ?>">
        <?php endif; ?>
      </div>
    </div>

    <div class="list-view__content cell--sbp">
      <a href="<?= $link; ?>">
        <?php if(!empty($categories)) : ?>
          <span class="list-view__parent-title"><?= $categories; ?></span>
        <?php endif; ?>
        <h2 class="title title--list-view"><?= $title; ?></h2>
        <p><?= $preamble; ?></p>

      <?php if($passed) : ?>
        <div class="details details--old">
      <?php else : ?>
        <div class="details">
      <?php endif; ?>
          <span class="details__info icon icon--date"><?= $datetime; ?></span>
          <span class="details__info icon icon--location"><?= $location; ?></span>
        </div>
      </a>
    </div>

  <?php if(!empty($buy_link) && !$passed) : ?>
    <div class="list-view__btn cell--sbp hide--sbp-max">
      <?php if($sold_out) : ?>
        <a href="<?= $buy_link; ?>" class="btn btn--primary btn--external" target="_blank">Utsålt</a>
      <?php else: ?>
        <a href="<?= $buy_link; ?>" class="btn btn--primary btn--external" target="_blank">Köp biljett</a>
      <?php endif; ?>
    </div>

  <?php endif; ?>

  </div>
</div>
