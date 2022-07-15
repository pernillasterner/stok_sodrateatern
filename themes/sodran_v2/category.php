<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sodran_v2
 */

$cat_id = get_queried_object_id();

get_header(); ?>

<div id="container" class="scrollable">



	<?php $slides = papi_get_term_field('slides'); ?>


  <header class="header">
  	<a class="logotype" href="#">
  		<span class="visually-hidden">Södra teatern</span>
  	</a>
  </header>

  <?php the_archive_title( '<h1 class="visually-hidden">', '</h1>' ); ?>

  <?php if(!empty($slides)) : ?>
    <section class="section hero">
      <?php include(locate_template('modules/slider-hero.php')); ?>
    </section>
  <?php endif; ?>

  <?php 
    $sectionId = 'page-notice';
    $section = array();
    $section['notice_txt'] = papi_get_term_field('notice_txt');
    $section['notice_url'] = papi_get_term_field('notice_url');
    include(locate_template('sections/notice-banner.php'));
  ?>

	<?php if ( have_posts() ) : ?>

  	<section id="js-ajax-container" class="section section-min-100" data-cat="<?=$cat_id?>"></section>

	<?php endif; ?>


</div>

<?php
get_footer();

