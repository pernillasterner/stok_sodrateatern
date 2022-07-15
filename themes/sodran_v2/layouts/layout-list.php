<?php
/**
 * @package sodran_v2
 */
// Deprecated, don't work in this file, but don't remove it as it might be in use.

get_header(); ?>

<div id="container" class="scrollable">

	<header class="header">
		<a class="logotype" href="#">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>
	<h1 class="visually-hidden"><?= get_the_title(); ?></h1>
  <section id="js-ajax-container" class="section section-min-100"></section>
</div>

<?php
get_footer();
