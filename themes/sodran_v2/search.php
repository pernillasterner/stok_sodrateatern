<?php
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

  <section class="section">
    <div class="list-view is-light">
      <div class="list-view__wrapper">
        <div class="list-view__content txt-c">
            <h1 class="title title--big"><?= $wp_query->found_posts; ?> <?php _e( 'Sökresultat för', 'locale' ); ?>: "<?php the_search_query(); ?>"</h1>
        </div>
      </div>
    </div>
  <?php if ( have_posts() ) : ?>


    <?php while ( have_posts() ) : the_post(); ?>

      <?php include(locate_template('modules/list-view-search.php')); ?>

    <?php endwhile; ?>

  <?php else : ?>

    <div class="no-content txt-c">
      <img src="<?= get_template_directory_uri(); ?>/dist/images/see-no-evil.png">
      <p class="preamble preamble--big">Det fanns tyvärr inget innehåll som matchade din sökning. Vänligen försök igen med andra nyckelord.</p>

    </div>

  <?php endif; ?>

	</section>

  <section class="section bg--stripes">
    <div class="section--grid js-masonry ">
      <?php include(locate_template('modules/global-tips-pages.php')); ?>
    </div>
  </section>



</div>


<?php
get_footer();
