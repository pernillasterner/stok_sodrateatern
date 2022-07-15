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

	<main class="section entry--extra-padding-top full-height--lbp span-12-12--lbp scrollable--lbp">
    <?php include(locate_template('modules/content.php')); ?>

    <?php 
    	$col = 'col-1'; 
   		include(locate_template('modules/flexible-sections.php')); 
   	?>

	</main>

</div>

<?php
get_footer();
