<?php
/**
 * @package sodran_v2
 */


$preamble = papi_get_field('preamble');
$content = papi_get_field("page_content");


$col = papi_get_field('page_cols');
$bg = 'white';
$asideSlider = false;
$asideSidebar = false;


if( $col === 'col-1' ) {

	$bg = papi_get_field('page_bg');
	$mainClass = 'section full-height--lbp span-12-12--lbp scrollable--lbp';

} elseif( $col === 'col-2' ) {

	$asideSlider = true;
	$asideSliderClass =  'section span-6-12--lbp';
	$mainClass = 'section entry full-height--lbp span-6-12--lbp scrollable--lbp';

} elseif( $col === 'col-3' ) {

	$asideSlider = true;
	$asideSliderClass =  'section span-7-12--mbp span-4-12--lbp';
	$asideSidebar = true;
	$asideSidebarContent = papi_get_field('page_sidebar');

	$mainClass = 'section entry full-height--lbp span-5-12--lbp scrollable--lbp';

} 

get_header(); ?>

<div id="container" class="container--<?=$bg?> scrollable--lbp-max">

<!-- HEADER -->
	<header class="header">
		<a class="logotype" href="#">
			<?php if(is_front_page()) : ?>
				<h1 class="visually-hidden">Södra teatern</h1>
			<?php else : ?>
				<span class="visually-hidden">Södra teatern</span>
			<?php endif; ?>
		</a>

		<?php if(!is_front_page() && $col === 'col-1') : ?>
			<h1 class="visually-hidden"><?= get_the_title(); ?></h1>
		<?php endif; ?>
	</header>


<!-- SLIDER -->
	<?php if($asideSlider) : ?>


		<aside class="<?= $asideSliderClass ?> half-height full-height--lbp hide--mbp-only">
			<?php include(locate_template('modules/flexible-slider.php')); ?>

			<?php if($asideSidebar) : ?>

				<div class="section__wrapper hide--mbp">
        		<?= do_shortcode($asideSidebarContent['sidebar_btn']) ?>

		  			<button class="btn btn--primary btn--margin btn--internal js-popup" 
		  							data-popup="popup--information">
		  								<?=$asideSidebarContent['sidebar_title'];?> 
		  			</button>
		      
				</div>
			<?php endif; ?>
		</aside>

	<?php endif; ?>



<!-- MAIN -->
	<?php if($col !== 'col-1') : ?>
		<main class="<?=$mainClass?>">
			<section class="entry__wrapper">

				<h1 class="title title--big"><?= get_the_title(); ?></h1>

				<?php 
					if(!empty($preamble)) {
				    echo '<p class="preamble preamble--big">' . $preamble . '</p>';
				  }
			    if(!empty($content)) {
				    echo apply_filters('the_content', $content);
				  }
				?>

			</section>

			<?php if($asideSlider) : ?>
				<aside class="<?= $asideSliderClass ?> ratio-height hide--mbp-max hide--lbp">
					<?php include(locate_template('modules/flexible-slider.php')); ?>
				</aside>
			<?php endif; ?>

			<?php if($asideSidebar) : ?>
				<aside class="section sidebar ratio-height full-height--lbp span-5-12--mbp span-3-12--lbp hide--mbp-max hide--lbp">
			    <?php include(locate_template('modules/flexible-sidebar.php')); ?>
				</aside>
			<?php endif; ?>


	    <?php include(locate_template('modules/flexible-sections.php')); ?>
		</main>

	<?php else: ?>
		<main class="<?=$mainClass?>">
			<?php include(locate_template('modules/flexible-sections.php')); ?>
		</main>
	<?php endif; ?>


<!-- SIDEBAR: Desktop -->

	<?php if($asideSidebar) : ?>
		<aside class="section sidebar ratio-height full-height--lbp span-5-12--mbp span-3-12--lbp hide--lbp-max">
	    <?php include(locate_template('modules/flexible-sidebar.php')); ?>
		</aside>
	<?php endif; ?>

</div>

<?php
get_footer();

?>

