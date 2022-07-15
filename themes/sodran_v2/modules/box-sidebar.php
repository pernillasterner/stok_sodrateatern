<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

$puff_id = $puff->ID;
$titel = get_the_title($puff_id);
$preamble = papi_get_field($puff_id, 'preamble');
$button_text = papi_get_field($puff_id, 'button_text');
$button_link = papi_get_field($puff_id, 'button_link');
$closeTag;

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

<?php
if(!empty($button_link) && empty($button_text)) :
  $closeTag = '</a>';
?>

<a href="<?= $button_link; ?>" class="box box--sidebar" style="background-image: url(<?= $img_url; ?>)">

<?php
else :
  $closeTag = '</div>';
?>

<div class="box box--sidebar" style="background-image: url(<?= $img_url; ?>)">

<?php endif; ?>
  <div class="box__wrapper txt-c">
    <h2 class="title"><?= $titel; ?></h2>
    <?php if(!empty($preamble)) : ?>
      <p class="preamble preamble--small"><?= $preamble; ?></p>
    <?php endif; ?>

    <?php if(!empty($button_link) && !empty($button_text)) : ?>
      <a class="btn btn--primary btn--internal" href="<?= $button_link; ?>"><?= $button_text; ?></a>
    <?php endif; ?>
  </div>
<?= $closeTag; ?>
