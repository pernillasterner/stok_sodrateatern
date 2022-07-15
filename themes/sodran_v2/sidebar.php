<?php   
    $ticksterApiKey = papi_get_option('tickster_api'); //'344413868e8c5858';
?>


<div class="sidebar__wrapper">



      <?php if(is_page_type('evenemang-page-type')) : ?>

      <?php
				setlocale(LC_ALL, "sv_SE.UTF-8");
        $dates = papi_get_field(get_the_ID(), 'dates');
        $first_date = $dates[0];
        $buy_link;
        $tickets_link = papi_get_field(get_the_ID(), 'tickets_link');
        $ymd_today = strftime('%y%m%d');

        $all_dates_passed = true;
        $all_dates_sold_out = true;

        if(!empty($tickets_link)) {
          $buy_link = $tickets_link;
        } elseif(count($dates) == 1) {
          $buy_link = $first_date['buy_link'];
        }

      ?>

        <?php if(!empty($dates)) : ?>
          <div class="sidebar__section">
            <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp">
              <h2 class="title title--small">Datum & Biljetter</h2>
              <ul class="list">

                <?php foreach($dates as $date) :

                  $raw_date = $date['date_time'];
                  $ymd_date = strftime('%y%m%d', strtotime($raw_date));
                  $link = $date['buy_link'];

                  $ticksterEventId = sodran_v2_tickster_get_event_id($link);
                  $ticksterEvent = false;

                  $passed = true;
                  $sold_out = $date['sold_out'];

                  if($ymd_date >= $ymd_today) {
                    $passed = false;
                  }

                  if(!$passed) {
                    $all_dates_passed = false;

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
                  }

                  if(!$sold_out) {
                    $all_dates_sold_out = false;
                  }

                  $datetime = strftime('%d %b', strtotime($raw_date));
                  $datetime .= ' kl ';
                  $datetime .= strftime('%H:%M', strtotime($raw_date));

                  $location = $date['location'];
                  if($location == "other_location"){
                    $location = $date['other_location'];
                  }
                ?>

                <li class="list__item">
                  <?php if($passed) : ?>

                      <div class="details details--link details--old table">
                        <span class="details__info icon icon--date-light cell"><?= $datetime; ?></span>
                        <span class="details__info cell"><?= $location; ?></span>
                        <span class="details__info details__info--status icon icon--status icon--status--passed cell" data-tooltip-stickto="top" data-tooltip-animate-function="foldout" data-tooltip="Passerat" data-tooltip-color="#767676">
                          <span class="visually-hidden">Passerat</span>
                        </span>
                      </div>

                  <?php elseif($sold_out) : ?>

                      <?php
                        if(!empty($link)) :
                          $closeTag = '</a>';
                      ?>
                        <a href="<?= $link; ?>" class="details details--link table" target="_blank">
                      <?php
                        else :
                          $closeTag = '</div>';
                      ?>
                        <div class="details details--link table">
                      <?php endif; ?>

                        <span class="details__info icon icon--date-light cell"><?= $datetime; ?></span>
                        <span class="details__info cell"><?= $location; ?></span>
                        <span class="details__info details__info--status icon icon--status icon--status--unavailable cell" data-tooltip-stickto="top" data-tooltip-animate-function="foldout" data-tooltip="Utsålt" data-tooltip-color="#D40000">
                          <span class="visually-hidden">Utsålt</span>
                        </span>

                      <?= $closeTag; ?>

                  <?php elseif($few_left) : ?>

                      <?php
                        if(!empty($link)) :
                          $closeTag = '</a>';
                      ?>
                        <a href="<?= $link; ?>" class="details details--link table" target="_blank">
                      <?php
                        else :
                          $closeTag = '</div>';
                      ?>
                        <div class="details details--link table">
                      <?php endif; ?>

                        <span class="details__info icon icon--date-light cell"><?= $datetime; ?></span>
                        <span class="details__info cell"><?= $location; ?></span>
                        <span class="details__info details__info--status icon icon--status icon--status--limited cell" data-tooltip-stickto="top" data-tooltip-animate-function="foldout" data-tooltip="Fåtal" data-tooltip-color="#FFD200">
                          <span class="visually-hidden">Fåtal kvar</span>
                        </span>

                      <?= $closeTag; ?>

                  <?php else : ?>

                    <?php
                      if(!empty($link)) :
                        $closeTag = '</a>';
                    ?>
                      <a href="<?= $link; ?>" class="details details--link table" target="_blank">
                    <?php
                      else :
                        $closeTag = '</div>';
                    ?>
                      <div class="details details--link table">
                    <?php endif; ?>

                        <span class="details__info icon icon--date-light cell"><?= $datetime; ?></span>
                        <span class="details__info cell"><?= $location; ?></span>
                        <span class="details__info details__info--status icon icon--status icon--status--available cell" data-tooltip-stickto="top" data-tooltip-animate-function="foldout" data-tooltip="Tillgänglig" data-tooltip-color="#91BA00">
                          <span class="visually-hidden">Tillgänglig</span>
                        </span>
                      <?= $closeTag; ?>

                  <?php endif; ?>
                </li>
              <?php endforeach; ?>


              </ul>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <?php if(is_page_type('event-page-type')) : ?>
        <div class="sidebar__section sidebar__section--double sidebar__section--gradient hide--mbp-max">
          <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp">
            <h2 class="title title--small">Information om lokalen</h2>

      <?php else : ?>

        <?php if(empty($dates)) : ?>
          <div class="sidebar__section sidebar__section--double sidebar__section--gradient hide--mbp-max">
        <?php else: ?>
          <div class="sidebar__section sidebar__section--gradient hide--mbp-max">
        <?php endif; ?>

          <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp">
            <h2 class="title title--small">Information om biljetter</h2>

      <?php endif; ?>

          <?php
            $info = papi_get_field(get_the_ID(), 'info');
            if(!empty($info)) {
              echo wpautop( $info );
            }
          ?>


    </div>
  </div>

  <div class="sidebar__section sidebar__section--button hide--mbp-max table">
    <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp cell cell--bottom txt-c">

      <?php if(is_page_type('event-page-type')) : ?>

        <button data-popup="popup--quotation" class="btn btn--primary btn--big btn--margin btn--internal js-popup">Begär offert</button>

      <?php else : ?>

        <?php if(!$all_dates_passed && !empty($buy_link)) :?>

          <?php if($all_dates_sold_out) : ?>
            <a href="<?= $buy_link; ?>" class="btn btn--primary btn--big btn--margin btn--external" target="_blank">Utsålt</a>
          <?php else : ?>
            <a href="<?= $buy_link; ?>" class="btn btn--primary btn--big btn--margin btn--external" target="_blank">Köp biljett</a>
          <?php endif; ?>

        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>


</div>