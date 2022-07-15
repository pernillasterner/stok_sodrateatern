<?php
/**
 * @package sodran_v2
 */
// Deprecated, don't work in this file, but don't remove it as it might be in use.

get_header(); ?>

<div id="container" class="scrollable--lbp-max">
	<header class="header">
		<a class="logotype" href="<?php get_bloginfo('url');?>">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>

	<aside class="section span-6-12--lbp half-height full-height--lbp">
		<?php include(locate_template('modules/slider.php')); ?>
	</aside>

	<main class="section entry full-height--lbp span-6-12--lbp scrollable--lbp">
    <?php include(locate_template('modules/content.php')); ?>
	</main>

</div>

<?php
get_footer();
