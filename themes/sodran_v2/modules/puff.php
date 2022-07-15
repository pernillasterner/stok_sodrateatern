<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

	$img = wp_get_attachment_image_src( get_post_thumbnail_id($puff_id), 'card', false, '' );
	$img_url = $img[0];
	$title = get_the_title($puff_id);
  $preamble = papi_get_field($puff_id, 'text');
	$link = papi_get_field($puff_id, 'button_link');

?>


<?php if( empty($link) ) : ?>
  <div class="card card--inv js-masonry-item">
    <div class="card__wrapper">
      <div class="card__img">
        <?php if(!empty($img_url)) : ?>
          <img src="<?= $img_url; ?>">
        <?php endif; ?>
      </div>
      <div class="card__content txt-l">
        <h2 class="title card__title"><?= $title; ?></h2>
        <p class="preamble preamble--small"><?= $preamble; ?></p>
      </div>
    </div>
  </div>

<?php else : ?>

  <a href="<?= $link ?>" class="card card--inv js-masonry-item">
    <div class="card__wrapper">
      <div class="card__img">
        <?php if(!empty($img_url)) : ?>
          <img src="<?= $img_url; ?>">
        <?php endif; ?>
      </div>
      <div class="card__content txt-l">
        <h2 class="title card__title"><?= $title; ?></h2>
        <p class="preamble preamble--small"><?= strip_tags($preamble, '<br><p><strong><em>'); ?></p>
      </div>
    </div>
  </a>


<?php endif; ?>



