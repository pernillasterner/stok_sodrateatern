<?php
$page = $tip["tips_page_post"];
$page_id = $title = $page->ID;

$title = $tip["tips_page_title"];
if(empty($title)) {
  $title = $page->post_title;
}

$preamble = $tip["tips_page_preamble"]; //override preamble
if(empty($preamble)) {
  $preamble = papi_get_field($page_id, 'preamble'); //if empty get papi preamble of page

  if(empty($preamble)) {
    $preamble = $page->post_excerpt; //if still empty get excerpt
  }
}

$link = get_permalink($page_id);

$post_type = $page->post_type;

$parent_post_title = '';

if($post_type == 'post') {
  $parent_post_title = "Evenemang";
} else if($post_type == 'stories') {
  $parent_post_title = "Södran Stories";
} else if($page->post_parent != 0) {
  $parent_post = get_post($page->post_parent);
  $parent_post_title = $parent_post->post_title;
}


$img_id = get_post_thumbnail_id($page_id);
$img = wp_get_attachment_image_src( $img_id, 'card', false, '' );
$img_url = $img[0];
$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true);


?>

<a href="<?= $link ?>" class="card card--inv js-masonry-item">
  <div class="card__wrapper">
    <div class="card__img">
      <?php if(!empty($img_url)) : ?>
        <img src="<?= $img_url; ?>" alt="<?= $img_alt ?>">
      <?php endif; ?>
      <?php if(!empty($parent_post_title)) : ?>
        <span class="categories categories--box"><?= $parent_post_title ?></span>
      <?php endif; ?>
    </div>
    <div class="card__content txt-l">
      <h2 class="title card__title"><?= $title; ?></h2>
      <p class="preamble preamble--small"><?= $preamble; ?></p>
    </div>
  </div>
</a>
