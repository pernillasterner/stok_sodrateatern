<?php
/**
 * @package sodran_v2
 */
// Deprecated, don't work in this file, but don't remove it as it might be in use.

get_header(); ?>

<div id="container" class="scrollable">




<?php
$slides = papi_get_field('slides');
if(empty($slides)){
  $slides[0] = [
    'slide_title' =>  papi_get_field('slide_title'),
    'slide_preamble' =>  papi_get_field('slide_preamble'),
    'slide_image' =>   papi_get_field('slide_image'),
    'slide_button_link' =>  papi_get_field('slide_button_link'),
    'slide_button_text' => papi_get_field('slide_button_text'),
    'slide_buttons' => papi_get_field('slide_buttons')
  ];
}
?>

<?php if(is_page_type('start-page-type')) : ?>
	<header class="header">
    <a class="logotype" href="<?php echo get_bloginfo('url');?>">
			<h1 class="visually-hidden">Södra teatern</h1>
		</a>
	</header>

	<section class="section hero hero--start">
    <?php
      if(!empty($slides)) {
        include(locate_template('modules/slider-hero.php'));
      }
    ?>

  </section>

  <section class="scroll-to">
    <a href="#js-ajax-container" class="scroll-to__btn js-scroll-to">
      <span class="scroll-to__txt">Scrolla ner för att se vad som händer på Södran</span>
    </a>
  </section>

<?php else : ?>
	<header class="header">
		<a class="logotype" href="<?php echo get_bloginfo('url');?>">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>
	<h1 class="visually-hidden"><?= get_the_title(); ?></h1>

  <section class="section hero">
  <?php
    if(!empty($slides)) {
      include(locate_template('modules/slider-hero.php'));
    }
  ?>
	</section>
<?php endif; ?>


<?php if( is_page_type('start-page-type') ) : ?>

	<section id="js-ajax-container" class="section"></section>

  <?php
    $stories = papi_get_field('stories');
    if(!empty($stories)) :
  ?>
    <section class="section bg--stripes">
      <div class="section--grid txt-c">
        <p class="title no-margin">Södran stories</p>
      </div>
      <div class="section--grid">
        <?php
    			$stories = papi_get_field('stories');
          $stories_counter = 0;

    			foreach($stories as $story){

            global $post;

    				// Assign your post details to $post (& not any other variable name!!!!)
    				$post = $story;
            setup_postdata( $post );


            if($stories_counter == 0) {
              include(locate_template('modules/card-sticky.php'));
            } else {
              include(locate_template('modules/card.php'));
            }

            $stories_counter++;
            wp_reset_postdata();


    			}
    		?>
      </div>

      <div class="section txt-c">
        <?php
          $stories_btn = papi_get_field('stories_btn');
          $stories_page = papi_get_field('stories_page');
          $stories_url = get_the_permalink($stories_page->ID);
          if(!empty($stories_btn) && !empty($stories_url)) :
        ?>
          <a href="<?=$stories_url?>" class="btn btn--primary btn--internal btn--b-margin"><?= $stories_btn; ?></a>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php
    $hideGlobalPosts = papi_get_field('hide_global_posts');
  ?>

  <?php if(!$hideGlobalPosts) : ?>
    <section class="section">
      <?php include(locate_template('modules/global-tips-posts.php')); ?>
    </section>
  <?php endif; ?>


<?php else : ?>

  <section class="section">

    <?php
      $child_pages;
      $is_page = true;
      if(is_page_type('start-mat-page-type')) {
        $child_pages = papi_get_field('menues');
      } elseif (is_page_type('start-event-page-type')) {
        $child_pages = papi_get_field('facilities');
      } else {
        $child_pages = papi_get_field('pages');
      }

      if(!empty($child_pages)) {
  			foreach($child_pages as $page){
  				include(locate_template('modules/box-page.php'));
  			}
      }
		?>

	</section>

<?php endif; ?>


<?php 

  $puffs = papi_get_field('puffs');

  if(!empty($puffs)) : 
?>

	<section class="section section--padding bg--dark">
    <div class="section--grid js-masonry">
      <?php

  			foreach($puffs as $puff){
  				$puff_id = $puff->ID;
  				include(locate_template('modules/puff.php'));
  			}
  		?>
    </div>
	</section>
<?php endif; ?>

<?php 
  $col = 'col-1'; 
  include(locate_template('modules/flexible-sections.php')); 
?>




</div>

<?php
get_footer();
