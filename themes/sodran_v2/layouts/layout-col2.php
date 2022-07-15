<?php
/**
 * @package sodran_v2
 */
// Deprecated, don't work in this file, but don't remove it as it might be in use.

get_header(); ?>

<div id="container" class="container--white scrollable--lbp-max">
	<header class="header">
		<a class="logotype" href="#">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>

	<aside class="section span-6-12--lbp half-height full-height--lbp">
		<?php include(locate_template('modules/slider.php')); ?>
		<div class="section__wrapper hide--lbp">
	  <?php if(is_page_type('mat-page-type') && !papi_get_field('hide_button')) : ?>
			<?php /*
			  <button class="btn btn--primary btn--margin btn--internal js-popup" data-popup="popup--book-table">Boka bord</button>
			*/ ?>
			<button class="btn btn--primary btn--margin btn--internal js-book-table">Boka bord</button>
      <?php endif; ?>
		</div>
	</aside>

	<main class="section entry full-height--lbp span-6-12--lbp scrollable--lbp">
    <?php include(locate_template('modules/content.php')); ?>

     <?php 
    	$col = 'col-2'; 
   		include(locate_template('modules/flexible-sections.php')); 
   	?>
	</main>

</div>

<?php
get_footer();
