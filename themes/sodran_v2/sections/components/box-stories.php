<?php

  $stories_id = $item->ID;
  $link = get_the_permalink($stories_id);

  $imgId = get_post_thumbnail_id($stories_id);
  $imgSrcUrl = wp_get_attachment_url( $imgId );
  $filetype = wp_check_filetype($imgSrcUrl);

  if ($filetype['ext'] == 'gif') {
    $img = wp_get_attachment_image_src( $imgId, 'full', false);
  } else {
    $img = wp_get_attachment_image_src( $imgId, 'card', false, '' );
  }

  $img_url = $img[0];
?>
<a class="box box--hover <?= $boxClass ?>" href="<?= $link; ?>" style="background-image: url(<?= $img_url; ?>)">
  <div class="box__wrapper txt-c">
    <h2 class="title"><?= $item->post_title; ?></h2>
    <p class="preamble preamble--small">
      Södran stories
    </p>
    <div class="box__btn">
      <div class="btn btn--internal">Läs mer</div>
    </div>
  </div>
</a>

