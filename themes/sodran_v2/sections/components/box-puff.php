

<?php
  $puff_id = $item->ID;
  $preamble = papi_get_field($puff_id, 'preamble');
	$link = papi_get_field($puff_id, 'button_link');

  $imgId = get_post_thumbnail_id($puff_id);
  $imgSrcUrl = wp_get_attachment_url( $imgId );
  $filetype = wp_check_filetype($imgSrcUrl);

  if ($filetype['ext'] == 'gif') {
    $img = wp_get_attachment_image_src( $imgId, 'full', false);
  } else {
    $img = wp_get_attachment_image_src( $imgId, 'card', false, '' );
  }

  $img_url = $img[0];
?>


<?php if( empty($link) ) : ?>

  <div class="box <?= $boxClass ?>" style="background-image: url(<?= $img_url; ?>)">
    <div class="box__wrapper txt-c">
      <h2 class="title"><?= $item->post_title; ?></h2>
      <?php if( !empty($preamble) ) : ?>
        <p class="preamble preamble--small"><?= $preamble; ?></p>
      <?php endif; ?>
    </div>
  </div>

<?php else : ?>

  <a class="box box--hover <?= $boxClass ?>" href="<?= $link; ?>" style="background-image: url(<?= $img_url; ?>)">
    <div class="box__wrapper txt-c">
      <h2 class="title"><?= $item->post_title; ?></h2>
      <?php if( !empty($preamble) ) : ?>
        <p class="preamble preamble--small"><?= $preamble; ?></p>
      <?php endif; ?>
      <div class="box__btn">
        <div class="btn btn--internal">Läs mer</div>
      </div>
    </div>
  </a>

<?php endif; ?>

