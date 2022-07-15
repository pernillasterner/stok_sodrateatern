<?php

  $page_id = $item->ID;
  $preamble = papi_get_field($page_id, 'preamble');
  $link = get_the_permalink($page_id);

  $img_id = get_post_thumbnail_id($page_id);
  $img = wp_get_attachment_image_src( $img_id, 'card', false, '' );
  $img_url = $img[0];
  $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true);

  $parent_post_title = '';

  if($item->post_parent != 0) {
    $parent_post = get_post($item->post_parent);
    $parent_post_title = $parent_post->post_title;
  }


?>

<a href="<?= $link ?>" class="card js-masonry-item <?= $cardClass ?> <?= $isBig ? 'card--sticky' : null ?>">
  <div class="card__wrapper">
    <div class="card__img">
      <?php if($isBig) : ?>
        <div class="card__img__bg-wrapper">
          <div class="card__img__bg" style="background-image: url(<?= $img_url; ?>)"></div>
        </div>
        <?php if(!empty($parent_post_title)) : ?>
          <span class="categories categories--box"><?= $parent_post_title ?></span>
        <?php endif; ?>
      <?php else : ?>
        <?php if(!empty($img_url)) : ?>
          <img src="<?= $img_url ?>" alt="<?= $img_alt ?>">
        <?php endif; ?>
        <?php if(!empty($parent_post_title)) : ?>
          <span class="categories categories--box"><?= $parent_post_title ?></span>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="card__content txt-l">
      <h2 class="title card__title"><?= $item->post_title; ?></h2>
      <p class="preamble preamble--small"><?= $preamble; ?></p>

      <?php if($isBig) : ?>
        <span class="btn btn--primary btn--internal" aria-hidden="true">Läs mer om detta</span>
      <?php endif; ?>
    </div>
  </div>
</a>
