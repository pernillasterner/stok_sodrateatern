<?php
  $link = get_the_permalink();
  $title = get_the_title();
  $preamble = get_the_excerpt();
  $date = get_the_date('Y / m / d');

  $img_id = get_post_thumbnail_id();
  $img = wp_get_attachment_image_src( $img_id, 'card', false, '' );
  $img_url = $img[0];
  $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true);
  
  $terms = wp_get_post_terms( get_the_ID(), 'story_categories' );
  $categories = '';
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
?>

<a href="<?=$link?>" class="card js-masonry-item">
  <div class="card__wrapper">
    <div class="card__img">
      <?php if(!empty($img_url)) : ?>
        <img src="<?= $img_url; ?>" alt="<?= $img_alt ?>">
      <?php endif; ?>
      <?php if(!empty($categories)) : ?>
        <span class="categories categories--box"><?= $categories ?></span>
      <?php endif; ?>
    </div>
    <div class="card__content txt-l">
      <p class="card__date" aria-hidden="true">
        <span class="visually-hidden">Publicerad</span>
        <time class="fineprint" datetime="<?= $date; ?>"><?= $date; ?></time>
      </p>
      
      <h2 class="title card__title"><?= $title ?></h2>

      <p class="preamble preamble--small"><?= $preamble ?></p>


    </div>
  </div>
</a>
