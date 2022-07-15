<div class="entry__wrapper">

<?php
if(is_page_type('evenemang-page-type') ) :
    $categories = '';
    $post_terms = wp_get_post_terms(get_the_ID(), 'category');
    $counter = 0;
    $len = count($post_terms);

    foreach ( $post_terms as $post_term ) {
      if($counter == ($len -1)) {
        $categories .= $post_term->name;
      } else {
        $categories .= $post_term->name . " / ";
      }
      $counter++;
    }

    if(!empty($categories)) {
      echo '<span class="categories">' . $categories . '</span>';
    }
?>

    <div class="entry__share">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode( get_the_permalink() ); ?>" class="link--social icon icon--facebook" target="_blank">
        <span class="visually-hidden">Dela på Facebook</span>
      </a>
      <a href="https://twitter.com/intent/tweet?text=<?= rawurldecode( get_the_title() . ' på Södra Teatern ' . get_the_permalink() ); ?>" class="link--social icon icon--twitter" target="_blank">
        <span class="visually-hidden">Dela på Twitter</span>
      </a>
      <a href="mailto:?&subject=<?= ( get_the_title() . ' på Södra Teatern '); ?>&body=<?= urlencode( get_the_permalink() ); ?>" class="link--social icon icon--mail">
        <span class="visually-hidden">Dela via mail</span>
      </a>
    </div>

<?php endif; ?>

  <h1 class="title title--big"><?= get_the_title(); ?></h1>

<?php
  $preamble = papi_get_field('preamble');
  $content = papi_get_field("content");
  $open_hours = papi_get_field('open_hours');
  $info = papi_get_field('info');
  $menu_heading = papi_get_field('menu_heading');
  $menu = papi_get_field('menu');
  $hide_button = papi_get_field('hide_button');
  $links = papi_get_field('links');

  if(!empty($preamble)) {
    echo '<p class="preamble preamble--big">' . $preamble . '</p>';
  }

  if(!empty($content)) {
    echo apply_filters('the_content',$content);
  }

  //FALLBACK FOR OLD PAGES
  if (have_posts()) : while (have_posts()) : the_post();

  the_content();

  endwhile; endif;
  //END FALLBACK

  if(!empty($open_hours)) {

    $outputString = '<h4 class="title">Öppettider</h4>';
    $outputString .= '<p>';

    $i = 0;

    foreach ($open_hours as $values) {
      if($i != 0){
        $outputString .=  '<br/>';
      }
      $outputString .= '<strong>' . $values['day'] . '</strong> ' . $values["time"];
      $i++;
    }
    $outputString .= '</p>';
    echo $outputString;
  }
?>


<?php if(is_page_type('mat-page-type') && !$hide_button) : ?>
  <p class="hide--mbp-max">
      <?php /*
      <button class="btn btn--primary btn--internal js-popup" data-popup="popup--book-table">Boka bord</button>
      */ ?>
      <button class="btn btn--primary btn--internal js-book-table">Boka bord</button>
  </p>
<?php endif; ?>

<?php
  if(!empty($menu_heading)) :
?>

<h2 class="title"><?= $menu_heading; ?></h2>

<?php
  endif;

  if(!empty($menu)) {
    $outputString = "";

    foreach ($menu as $menu_item) {
      $outputString .=  '<p>';
      if(!empty($menu_item['title'])){
        $outputString .= '<strong class="txt-uc">' . $menu_item['title'] . '</strong><br/>';
      }
      if(!empty($menu_item['text'])){
        $outputString .= $menu_item['text'] . '<br/>';
      }
      if(!empty($menu_item['text'])){
        $outputString .= '<span class="txt-subtle">' . $menu_item['text_sub'] . '</span>';
      }
      $outputString .=  '</p>';
    }
    echo $outputString;
  }
?>

<?php

  if(!empty($links[0])){
    echo '<p class="entry__extra">';
    $homepage = array();
    $facebook = array();
    $twitter = array();
    $instagram = array();

    $spotify = array();
    $soundcloud = array();
    $itunes = array();
    $youtube = array();
    $vimeo = array();
    foreach ($links as $link) {
      switch ($link['link_type']) {
          case 'youtube':
              array_push($youtube, $link['link']);
              break;
          case 'vimeo':
              array_push($vimeo, $link['link']);
              break;
          case 'spotify':
              array_push($spotify, $link['link']);
              break;
          case 'facebook':
              array_push($facebook, $link['link']);
              break;
          case 'twitter':
              array_push($twitter, $link['link']);
              break;
          case 'itunes':
              array_push($itunes, $link['link']);
              break;
          case 'instagram':
              array_push($instagram, $link['link']);
              break;
          case 'homepage':
            array_push($homepage, $link['link']);
              break;
      }
    }

    foreach($homepage as $link){
      echo '<a class="entry__extra__link span-6-12--sbp" href="' . $link . '"><span class="icon icon--hompage"></span>Besök hemsida</a>';
    }
    foreach($facebook as $link){
      echo '<a class="entry__extra__link span-6-12--sbp" href="' . $link . '"><span class="icon icon--facebook"></span>Besök på Facebook</a>';
    }
    foreach($twitter as $link){
      echo '<a class="entry__extra__link span-6-12--sbp" href="' . $link . '"><span class="icon icon--twitter"></span>Besök på Twitter</a>';
    }
    foreach($instagram as $link){
      echo '<a class="entry__extra__link span-6-12--sbp" href="' . $link . '"><span class="icon icon--instagram"></span>Besök på Instagram</a>';
    }
    foreach($itunes as $link){
      echo '<a class="entry__extra__link span-6-12--sbp" href="' . $link . '"><span class="icon icon--itunes"></span>Lyssna på iTunes</a>';
    }

    echo '</p>';

    if(isset($_COOKIE['st_cookie_consent']) && $_COOKIE['st_cookie_consent'] >= 0 ) {

      echo '<p class="entry__extra">';

      foreach($spotify as $link){
        echo '<iframe class="entry__extra__iframe" src="https://embed.spotify.com/?uri=' . $link . '" width="100%" height="80" frameborder="0" allowtransparency="true"></iframe>';
      }
      foreach($soundcloud as $link){
        echo $link;
      }

      foreach($youtube as $link){
        echo '<iframe class="entry__extra__iframe" width="100%" height="360" src="https://www.youtube-nocookie.com/embed/' . $link . '?rel=0" frameborder="0" allowfullscreen></iframe>';
      }

      foreach($vimeo as $link){
        echo '<iframe class="entry__extra__iframe" src="https://player.vimeo.com/video/' . $link . '" width="100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
      }

      echo '</p>';
    }

  }
?>

</div>
