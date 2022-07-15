<?php
/**
 * The Template for displaying all single puffs.
 *
 * @package sodran_v2
 */

get_header(); ?>

<div class="puff-preview">
	<h1 class="title">Liten puff:</h1>
	<div class="puff-single-preview">
		<div class="puff-single-preview--wrapper">
			<?php
				$puff_id = $post->ID;
				include(locate_template('modules/box-sidebar.php'));
			?>
		</div>
	</div>
	<h1 class="title">Stor puff:</h1>
	<div class="puff-page-preview">
	<?php

		include(locate_template('modules/puff.php'));
	?>
	</div>
</div>

<?php get_footer(); ?>
