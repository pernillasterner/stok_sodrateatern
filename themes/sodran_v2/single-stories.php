<?php
/**
 * The template for displaying all single stories.
 *
 * @package sodran_v2
 */

get_header();

?>

<div id="container" class="scrollable story">
  <header class="header">
    <a class="logotype" href="#">
      <span class="visually-hidden">Södra teatern</span>
    </a>
  </header>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php
      $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false);
      $img_url = $img[0];
    ?>

    <div class="story__img">
      <div class="story__img__bg-wrapper">
        <div class="story__img__bg" style="background-image: url(<?= $img_url ?>)"></div>
      </div>
      <img class="story__img__front" src="<?= $img_url ?>">
    </div>

    <article class="section story__content">
       <p class="txt-c no-margin" aria-hidden="true">
        <span class="visually-hidden">Publicerad</span>
        <time class="fineprint" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y-m-d'); ?></time>
      </p>
      <h1 class="title title--big txt-c story__title"><?= get_the_title(); ?></h1>
      <p class="preamble preamble--big story__preamble"><?= get_the_excerpt() ?></p>
      <?php the_content(); ?>
    </article>
    <aside class="story__aside">
      <div class="story__nav">

        <?php
          $prev_page = get_adjacent_post(false, '', true);

          if(!empty($prev_page)) :
            $prev_id = $prev_page->ID;
            $prev_link = get_the_permalink($prev_id);
            $prev_title = $prev_page->post_title;
            $prev_img = wp_get_attachment_image_src( get_post_thumbnail_id($prev_id), 'thumbnail', false);
            $prev_img_url = $prev_img[0];
            $prev_terms = wp_get_post_terms( $prev_id, 'story_categories' );
            $prev_categories = '';

            $prev_counter = 0;
            $prev_len = count($prev_terms);

            foreach ( $prev_terms as $prev_term ) {
              if($counter == ($prev_len -1)) {
                $prev_categories .= $prev_term->name;
              } else {
                $prev_categories .= $prev_term->name . " / ";
              }
              $prev_counter++;
            }
        ?>

          <a class="story__nav__prev table" href="<?=$prev_link?>">
              <div class="cell story__nav__img-wrapper">
                  <div class="story__nav__img ">
                    <?php if(!empty($prev_img_url)): ?>
                      <img src="<?=$prev_img_url?>">
                    <?php endif; ?>
                  </div>
              </div>
            <div class="story__nav__content cell">
              <span class="title title--smallest txt-subtle"><?=$prev_categories?></span>
              <p class="title title--medium no-margin"><?=$prev_title?></p>
            </div>
          </a>
        <?php endif; ?>

        <?php
          $next_page = get_adjacent_post(false, '', false);

          if(!empty($next_page)) :
            $next_id = $next_page->ID;
            $next_link = get_the_permalink($next_id);
            $next_title = $next_page->post_title;
            $next_img = wp_get_attachment_image_src( get_post_thumbnail_id($next_id), 'thumbnail', false);
            $next_img_url = $next_img[0];
            $next_terms = wp_get_post_terms( $next_id, 'story_categories' );
            $next_categories = '';

            $next_counter = 0;
            $next_len = count($next_terms);

            foreach ( $next_terms as $next_term ) {
              if($counter == ($next_len -1)) {
                $next_categories .= $next_term->name;
              } else {
                $next_categories .= $next_term->name . " / ";
              }
              $next_counter++;
            }
        ?>

          <a class="story__nav__next table" href="<?=$next_link?>">
            <div class="story__nav__content cell">
              <span class="title title--smallest txt-subtle"><?=$next_categories?></span>
              <p class="title title--medium no-margin"><?=$next_title?></p>
            </div>

            <div class="cell story__nav__img-wrapper">
              <div class="story__nav__img ">
                <?php if(!empty($next_img_url)): ?>
                  <img src="<?=$next_img_url?>">
                <?php endif; ?>
              </div>
            </div>
          </a>
        <?php endif; ?>


      </div>
      <div class="story__share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode( get_the_permalink() ); ?>" class="link--social icon icon--facebook" target="_blank">
          <span class="visually-hidden">Dela på Facebook</span>
        </a>
        <a href="https://twitter.com/intent/tweet?text=<?= rawurldecode( get_the_title() . ' ' . get_the_permalink() ); ?>" class="link--social icon icon--twitter" target="_blank">
          <span class="visually-hidden">Dela på Twitter</span>
        </a>
        <a href="mailto:?&subject=<?= get_the_title(); ?>&body=<?= urlencode( get_the_permalink() ); ?>" class="link--social icon icon--mail">
          <span class="visually-hidden">Dela via mail</span>
        </a>
      </div>

      <?php 
        $col = 'col-1'; 
        include(locate_template('modules/flexible-sections.php')); 
      ?>

      <?php
        $hideGlobalPuffs = papi_get_field('hide_global_puffs');
        $hideGlobalPosts = papi_get_field('hide_global_posts');
      ?>

      <?php if(!$hideGlobalPosts) : ?>
        <section class="section">
          <?php include(locate_template('modules/global-tips-posts.php')); ?>
        </section>
      <?php endif; ?>

      <?php if(!$hideGlobalPuffs) : ?>
        <section class="section section--grid js-masonry">
          <?php include(locate_template('modules/global-tips-pages.php')); ?>
        </section>
      <?php endif; ?>
      
    </aside>
  <?php endwhile; ?>
</div>

<?php
get_footer();
