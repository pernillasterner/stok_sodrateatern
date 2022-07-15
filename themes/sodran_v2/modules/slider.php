<?php
$slides = papi_get_field('slides');
if(!empty($slides)) :
?>

<div class="slider js-slick">

<?php
  foreach($slides as $slide_image):
    $img = $img = wp_get_attachment_image_src( $slide_image->id, 'large', false);
    $img_url = $img[0];
?>
    <div  class="slider__item js-slick-slide" style="background-image: url(<?= $img_url; ?>)"></div>
<?php
  endforeach;

else :
?>

<div class="slider">

<?php
  if( has_post_thumbnail() ){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "xl", false );
    echo '<div class="slider__item" style="background-image: url(' . $image[0] . ')"></div>';
  } else {
    echo '<div class="slider__item"></div>';
  }
endif;
?>

</div>
