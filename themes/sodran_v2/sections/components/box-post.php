<?php
  $event_id = isset($item->ID) ? $item->ID : $item->post_id;
  $title = $item->post_title;
  $preamble = papi_get_field($event_id, 'preamble');
  $link = get_permalink( $event_id );

  $categories = '';
  $date = '';
  $location = '';


  $imgId = get_post_thumbnail_id($event_id);
  $imgSrcUrl = wp_get_attachment_url( $imgId );
  $filetype = wp_check_filetype($imgSrcUrl);

  if ($filetype['ext'] == 'gif') {
    $img = wp_get_attachment_image_src( $imgId, 'full', false);
  } else {
    $img = wp_get_attachment_image_src( $imgId, 'card', false, '' );
  }

  $img_url = $img[0];

  $terms = wp_get_post_terms($event_id, 'category');
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
  $dates = papi_get_field($event_id, 'dates');
  if(isset($item->meta_date)) {
    // if we have a speficif date to get
    foreach($dates as $values) {

      if($values['date_time'] == $item->meta_date) {

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

        }
      }
    }
  } else {
    // else get date closes in time
    if(!empty($dates[0])){
      foreach ($dates as $values) {
        if(date('Y m d', strtotime($values['date_time'])) >= date('Y m d')) {

          if(date('Y m d', strtotime($values['date_time'])) == date('Y m d')) {
            $date = 'Idag';
          } else {
            $date = strftime('%d %b', strtotime($values['date_time']));
          }

          if($values['location'] == "other_location") {
            $location = $values['other_location'];
          } else {
            $location = $values['location'];
          }

          break;
        }
      }
    }
  }



?>

<a class="box box--hover <?= $boxClass ?>" href="<?= $link ?>" style="background-image: url(<?= $img_url; ?>)">
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
      <?php if( $layout == 'tips') : ?>
      <div class="btn btn--internal">Tips!</div>
      <?php else: ?>
      <div class="btn btn--internal">Läs mer</div>
      <?php endif; ?>
    </div>


  </div>
  <span class="categories categories--box"><?= $categories; ?></span>

</a>
