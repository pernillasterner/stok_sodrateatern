<?php

$id = isset($post_id) ? $post_id : $post->id;
setlocale(LC_ALL, "sv_SE.UTF-8");
$parent_post = get_post($post->post_parent);
$parent_post_title = $parent_post->post_title;
$title = get_the_title();
$preamble = papi_get_field('preamble');
$link = get_permalink();
$img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'thumbnail', false);
$img_url = $img[0];
$post_type = $post->post_type;
$dates = papi_get_field('dates');
$all_dates_passed = true;
$all_dates_sold_out = true;
$tickets_link = papi_get_field('tickets_link');
$hide_button = papi_get_field('hide_button');

$buy_link;

if(!empty($tickets_link)) {
  $buy_link = $tickets_link;
} elseif(!empty($dates) && count($dates) == 1) {
  $first_date = $dates[0];
  $first_date_sold_out = $first_date['sold_out'];
  $buy_link = $first_date['buy_link'];

  if( !$first_date_sold_out ){
    $all_dates_sold_out = false;
  }
}

if($post_type == 'post') {
  $parent_post_title = "Evenemang";
} else if($post_type == 'stories') {
  $parent_post_title = "Södran Stories";
}

if(empty($preamble)){
  $preamble = get_the_excerpt();
}

$ymd_today = strftime('%y%m%d');
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
        <?php if(!empty($parent_post_title)) : ?>
          <span class="list-view__parent-title"><?= $parent_post_title; ?></span>
        <?php endif; ?>
        <h2 class="title title--list-view"><?= $title; ?></h2>
        <p><?= $preamble; ?></p>

        <?php if($post_type == 'post') {
          $outputString = '';
          $outputString .= '<p class="list-view__dates">Speldatum: ';

          foreach($dates as $date){
            $sold_out = $date['sold_out'];
            $passed = false;
            $raw_date = $date['date_time'];
            $ymd_date = strftime('%y%m%d', strtotime($raw_date));

            if($ymd_date < $ymd_today) {
              $passed = true;
            }
            if(!$sold_out) {
              $all_dates_sold_out = false;
            }
            if(!$passed) {
              $all_dates_passed = false;
              $outputString .= '<span>';
              $outputString .= date('Y-m-d', strtotime($raw_date));
              $outputString .= '</span>';
            } else {
              $outputString .= '<span class="old">';
              $outputString .= date('Y-m-d', strtotime($raw_date));
              $outputString .= '</span>';
            }
          }
          $outputString .= '</p>';

          echo $outputString;
        } ?>
      </a>
    </div>

  <?php if( is_page_type('mat-page-type', $id) && !$hide_button) : ?>
    <div class="list-view__btn cell--sbp hide--sbp-max">
      <?php /*
      <button class="btn btn--primary btn--internal js-popup" data-popup="popup--book-table">Boka bord</button>
      */ ?>
      <button class="btn btn--primary btn--internal js-book-table">Boka bord</button>
    </div>
  <?php elseif( is_page_type('event-page-type', $id)) : ?>
    <div class="list-view__btn cell--sbp hide--sbp-max">
      <button data-popup="popup--quotation" class="btn btn--primary btn--internal js-popup">Begär offert</button>
    </div>
  <?php elseif( $post_type == 'post' && !$all_dates_passed && !empty($buy_link)) : ?>
    <div class="list-view__btn cell--sbp hide--sbp-max">
      <?php if($all_dates_sold_out) : ?>
        <a href="<?= $buy_link; ?>" class="btn btn--primary btn--external" target="_blank">Utsålt</a>
      <?php else: ?>
        <a href="<?= $buy_link; ?>" class="btn btn--primary btn--external" target="_blank">Köp biljett</a>
      <?php endif; ?>
    </div>

  <?php else : ?>
    <div class="list-view__btn cell--sbp hide--sbp-max">
    </div>
  <?php endif; ?>

  </div>
</div>
