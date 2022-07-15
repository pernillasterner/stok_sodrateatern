<?php
  //$sticky_post is inherited from parent template
  $link = get_the_permalink();
  $title = get_the_title();
  $preamble = get_the_excerpt();
  $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'card', false);
  $img_url = $img[0];
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

<a href="<?=$link?>" class="card card--sticky">
  <div class="card__wrapper">
    <div class="card__img" >
      <div class="card__img__bg-wrapper">
        <div class="card__img__bg" style="background-image: url(<?= $img_url; ?>)"></div>
      </div>
      <?php if(!empty($categories)) : ?>
        <span class="categories categories--box"><?= $categories ?></span>
      <?php endif; ?>
    </div>
    <div class="card__content txt-l">
      <p class="card__date" aria-hidden="true">
        <span class="visually-hidden">Publicerad</span>
        <time class="fineprint" datetime="<?php echo get_the_date('Y / m / d'); ?>"><?php echo get_the_date('Y / m / d'); ?></time>
      </p>
      <h2 class="title card__title"><?= $title ?></h2>
      <p class="preamble preamble--small"><?= $preamble ?></p>
      <div class="card__btn">
        <span class="btn btn--primary btn--internal" aria-hidden="true">Läs mer om detta</span>
      </div>
    </div>
  </div>
</a>
