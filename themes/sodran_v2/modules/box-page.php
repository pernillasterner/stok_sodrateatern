<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

  $page_id = $page->ID;
  $title = get_the_title($page_id);;
  $preamble = papi_get_field($page_id, 'preamble');
  $link = get_the_permalink($page_id);

  $imgId = get_post_thumbnail_id($page_id);
  $imgSrcUrl = wp_get_attachment_url( $imgId );
  $filetype = wp_check_filetype($imgSrcUrl);

  if ($filetype['ext'] == 'gif') {
    $img = wp_get_attachment_image_src( $imgId, 'full', false);
  } else {
    $img = wp_get_attachment_image_src( $imgId, 'card', false, '' );
  }

  $img_url = $img[0];

?>

<a class="box box--hover span-6-12--sbp span-3-12--lbp" href="<?= $link; ?>" style="background-image: url(<?= $img_url; ?>)">
  <div class="box__wrapper txt-c">
    <h2 class="title"><?= $title; ?></h2>
    <?php if( !empty($preamble) ) : ?>
      <p class="preamble preamble--small"><?= $preamble; ?></p>
    <?php endif; ?>
    <div class="box__btn">
      <div class="btn btn--internal">Läs mer</div>
    </div>
  </div>
</a>
