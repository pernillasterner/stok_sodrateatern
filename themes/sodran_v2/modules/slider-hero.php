<div class="slider js-slick">

<?php

  foreach($slides as $slide) :

    
    $slide_image = $slide['slide_image'];
    $img = wp_get_attachment_image_src( $slide_image->id, 'xl', false);
    $slide_post = isset($slide['slide_post']) ? $slide['slide_post'] : null;

    $imgSrcUrl = wp_get_attachment_url( $slide_image->id );
    $filetype = wp_check_filetype($imgSrcUrl);

    if ($filetype['ext'] == 'gif') {
      $img = wp_get_attachment_image_src( $slide_image->id, 'full', false);
    }

    $img_url = $img[0];

    if(!empty($slide_post)){
      $post_id = $slide_post->ID;
      $slide_title = $slide_post->post_title;
      $slide_preamble = papi_get_field($post_id, 'preamble');
      $slide_date;
      $slide_location;
      $slide_href = get_the_permalink($post_id);

      $dates = papi_get_field($post_id, 'dates');

      if(!empty($dates[0])){
        foreach ($dates as $values) {
          if(date('Y m d', strtotime($values['date_time'])) >= date('Y m d')) {

            if(date('Y m d', strtotime($values['date_time'])) == date('Y m d')) {
        			$slide_date = 'Idag';
        		} else {
        			$slide_date = strftime('%d %b', strtotime($values['date_time']));
        		}

            if($values['location'] == "other_location") {
      				$slide_location = $values['other_location'];
      			} else {
      				$slide_location = $values['location'];
      			}

            break;
          }
        }
      }

    } else {
      $slide_button_text = isset($slide['slide_button_text']) ? $slide['slide_button_text'] : null;
      $slide_button_link = isset($slide['slide_button_link']) ? $slide['slide_button_link'] : null;
      $slide_buttons = $slide['slide_buttons'];
      $slide_title = $slide['slide_title'];
      $slide_preamble = $slide['slide_preamble'];
    }
?>

  <div class="slider__item js-slick-slide" style="background-image: url(<?= $img_url; ?>);">
    <div class="hero__wrapper txt-c js-slick-content">

        <?php if(is_page_type('start-evenemang-page-type')) : ?>

          <a href="<?= $slide_href; ?>"><h2 class="title title--biggest"><?= $slide_title; ?></h2></a>

        <?php else:  ?>
          <h2 class="title title--biggest"><?= $slide_title; ?></h2>
        <?php endif; ?>

        <?php if(!empty($slide_preamble)) : ?>
         <p class="txt-uc"><?= $slide_preamble; ?></p>
        <?php endif; ?>

        <?php if( !empty($slide_date) && !empty($slide_location) ) : ?>
          <div class="details table">
  					<p class="details__info cell icon icon--date-light txt-r"><?= $slide_date; ?></p>
  					<p class="details__info cell icon icon--location-light txt-l"><?= $slide_location; ?></p>
  				</div>
        <?php endif; ?>

        <?php
          if( !empty($slide_buttons) ) {
             echo do_shortcode($slide_buttons);

          }
        ?>

    </div>
  </div>

<?php endforeach; ?>
</div>
