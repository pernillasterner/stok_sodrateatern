<?php
/**
 * @package sodran_v2
 */

get_header(); ?>

<div id="container" class="scrollable">

<?php $slides = papi_get_field('slides');?>


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

	<?php 
		$sectionId = 'page-notice';
		$section = array();
		$section['notice_txt'] = papi_get_field('notice_txt');
		$section['notice_url'] = papi_get_field('notice_url');
		include(locate_template('sections/notice-banner.php'));
	?>

  <section id="js-ajax-container" class="section section-min-100"></section>

</div>

<?php
get_footer();
