<?php
/**
 * @package sodran_v2
 */

get_header(); ?>



<?php if(is_page_type('evenemang-page-type')) :
  setlocale(LC_ALL, "sv_SE.UTF-8");

  $tags = wp_get_post_tags($post->ID);
  $tags_ids = "";

  $cats = wp_get_post_categories($post->ID);
  $cats_ids = "";

  foreach($tags as $tag){
    $tags_ids .= $tag->term_id . " ";
  }

  foreach($cats as $cat){
    $cats_ids .= get_category($cat)->term_id . " ";
  }

  $dates = papi_get_field('dates');
  $first_date = $dates[0];
  $buy_link;
  $tickets_link = papi_get_field('tickets_link');
  $ymd_today = strftime('%y%m%d');

  $all_dates_passed = true;
  $all_dates_sold_out = true;

  if(!empty($tickets_link)) {
    $buy_link = $tickets_link;
  } elseif(count($dates) == 1) {
    $buy_link = $first_date['buy_link'];
  }

  foreach($dates as $date) {
    $raw_date = $date['date_time'];
    $ymd_date = strftime('%y%m%d', strtotime($raw_date));
    $link = $date['buy_link'];

    $ticksterEventId = sodran_v2_tickster_get_event_id($link);
    $ticksterEvent = false;

    $sold_out = $date['sold_out'];
    $passed = true;

    if($ymd_date >= $ymd_today) {
      $passed = false;
    }

    if(!$passed) {
      // only check tickster if event has not passed
      if(!empty($ticksterEventId) && !empty($ticksterApiKey)) {
        $ticksterEvent = sodran_v2_tickster_get_event($ticksterApiKey, $ticksterEventId, $post->ID, $ymd_date);
      } 

      $few_left = false;

      if(!empty($ticksterEvent['stockStatus'])) {
        if($ticksterEvent['stockStatus'] == 'SoldOut') {
          $sold_out = true;
          $few_left = false;

        } elseif($ticksterEvent['stockStatus'] == 'FewLeft'){
          $few_left = true;
          $sold_out = false;
        } else {
          $sold_out = false;
          $few_left = false;
        }
      }
      $all_dates_passed = false;
    }

    if(!$sold_out) {
      $all_dates_sold_out = false;
    }
  }

?>

<button class="js-expand-related related-btn related-btn--mobile hide--sbp" aria-controls="related" aria-expanded="false">
	<span class="visually-hidden">Relaterade artister</span>
	<span class="icon icon--related-gray"></span>
</button>

<div id="related" class="" aria-hidden="true" data-post-id="<?= get_the_ID(); ?>" data-post-tags="<?= $tags_ids; ?>" data-post-cats="<?= $cats_ids; ?>">
	<div id="js-ajax-container" class="related__wrapper">
	</div>
</div>
<?php endif; ?>

<div id="container" class="container--white scrollable--lbp-max">
	<header class="header">
		<a class="logotype" href="#">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>

	<aside class="section span-7-12--mbp span-4-12--lbp ratio-height">
    <?php include(locate_template('modules/slider.php')); ?>

		<div class="section__wrapper hide--mbp">
      <?php if(is_page_type('evenemang-page-type')) : ?>
        <?php if(!empty($buy_link) && !$all_dates_passed) : ?>
          <?php if($all_dates_sold_out) : ?>
            <a href="<?= $buy_link; ?>" class="btn btn--primary btn--margin btn--external" target="_blank">Utsålt</a>
          <?php else : ?>
    			     <a href="<?= $buy_link; ?>" class="btn btn--primary btn--margin btn--external" target="_blank">Köp biljett</a>
          <?php endif; ?>
        <?php endif; ?>
  			<a href="#js-scroll-destination" class="btn btn--primary btn--margin btn--internal js-scroll-to">Datum & Biljetter</a>

      <?php elseif(is_page_type('event-page-type')) : ?>

        <button class="btn btn--primary btn--margin btn--internal js-popup" data-popup="popup--quotation">Begär offert</a>
      <?php endif; ?>

			<button class="btn btn--primary btn--margin btn--internal js-popup" data-popup="popup--information">Information</button>
		</div>
	</aside>

  <aside class="section sidebar ratio-height span-5-12--mbp hide--mbp-max hide--lbp">
    <?php include(locate_template('sidebar.php')); ?>
  </aside>

	<main class="section entry full-height--lbp span-5-12--lbp scrollable--lbp">
    <?php include(locate_template('modules/content.php')); ?>

    <?php 
      $col = 'col-3'; 
      include(locate_template('modules/flexible-sections.php')); 
    ?>
	</main>
	<aside id="js-scroll-destination" class="section sidebar full-height--lbp span-3-12--lbp hide--mbp-only">
    <?php include(locate_template('sidebar.php')); ?>
	</aside>

</div>

<?php
get_footer();
