<?php 

  $slides = papi_get_field('page_slides'); 
  $noOfSlides = count($slides);
  $sliderClass = ($noOfSlides === 1) ? 'slider' : 'slider js-slick';
  $sliderItemClass = ($noOfSlides === 1) ? 'slider__item' : 'slider__item js-slick-slide';



?>

<?php if(!empty($slides)) : ?>

  <div class="<?=$sliderClass?>">

    <?php
      foreach($slides as $slide_image):
        $img = $img = wp_get_attachment_image_src( $slide_image->id, 'large', false);
        $img_url = $img[0];
    ?>
        <div  class="<?=$sliderItemClass?>" style="background-image: url(<?= $img_url; ?>)"></div>
    <?php endforeach;?>

  </div>

<?php else : ?>

  <div class="slider">

    <?php
      if( has_post_thumbnail() ){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large", false );
        echo '<div class="slider__item" style="background-image: url(' . $image[0] . ')"></div>';
      } else {
        echo '<div class="slider__item"></div>';
      }
    ?>
    
  </div>
<?php endif; ?>

