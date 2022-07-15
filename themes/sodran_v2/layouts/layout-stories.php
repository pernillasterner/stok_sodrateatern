<?php
/**
 * @package sodran_v2
 */


get_header(); ?>

<div id="container" class="scrollable bg--stripes">

	<header class="header">
		<a class="logotype" href="#">
			<span class="visually-hidden">Södra teatern</span>
		</a>
	</header>
  <section class="section--grid">
    <?php while ( have_posts() ) : the_post(); ?>

    	<h1 class="title title--biggest txt-c page-content"><?= get_the_title(); ?></h1>
    	<?php 
	    	$preamble = papi_get_field('preamble');
			?>

			<?php if( !empty($preamble) ) : ?>
				<p class="preamble preamble--big txt-c page-content"><?=$preamble?></p>
			<?php endif; ?>

      <?php
        $sticky_post = papi_get_field('sticky_post');
				if(!empty($sticky_post)) :
					global $post;

					// Assign your post details to $post (& not any other variable name!!!!)
					$post = $sticky_post;

					setup_postdata( $post );


	        	include(locate_template('modules/card-sticky.php'));
					wp_reset_postdata();
				endif;
      ?>

    <?php endwhile; ?>
  </section>

	<?php
		$args = array(
			'paged' => 1,
			'posts_per_page' => 18,
			'post_type' => 'stories',
			'post_status' => 'publish',
			'post__not_in' => array($sticky_post->ID)
		);
		$loop = new WP_Query( $args );

		if($loop->have_posts()) :
	?>
	  <section id="js-ajax-container" class="section--grid js-masonry" data-except-id="<?=$sticky_post->ID?>">
			<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					include(locate_template('modules/card.php'));
				endwhile;
			?>
	  </section>

		<?php if($loop->found_posts >= 18) : ?>
			<section id="js-ajax-controller" class="section txt-c">
				<button class="btn btn--primary js-load-more">Visa fler stories</button>
				<div class="loading-bar info-txt"></div>
			</section>
		<?php endif; ?>

	<?php endif; wp_reset_postdata(); ?>

	<?php 
  	$col = 'col-1'; 
 		include(locate_template('modules/flexible-sections.php')); 
 	?>

</div>

<?php
get_footer();
