=<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sodran_v2
 */

get_header(); ?>

<div id="container" class="scrollable">

	<header class="header">
		<a class="logotype" href="#">
			<h1 class="visually-hidden">Södra teatern</h1>
		</a>
	</header>

  <section class="section section--min-height">
    <div class="no-content txt-c">
      <img src="<?= get_template_directory_uri(); ?>/dist/images/see-no-evil.png">
      <h1 class="title title--big">Hoppsan! Sidan du letar efter finns inte</h1>
      <p class="preamble preamble--big">Prova menyn till vänster för att hitta det du letar efter.</p>
    </div>
  </section>

  <section class="section">
		<?php
			$puffs = papi_get_field(get_option('page_on_front'), 'puffs');

      foreach($puffs as $puff){
				$puff_id = $puff->ID;
				include(locate_template('modules/puff.php'));
			}
		?>
	</section>

</div>

<?php
get_footer();
