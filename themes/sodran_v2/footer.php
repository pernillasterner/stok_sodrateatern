<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package sodran
 */
?>


<?php if ( is_page_type('event-page-type')) : ?>

	<div class="popup popup--information visually-hidden hide--lbp">
		<div class="popup__wrapper js-popup" data-popup="popup--information">
			<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--information"><span class="visually-hidden">Stäng popup</span></button>

			<?php
				$info = papi_get_field('info');
				if(!empty($info)) :
			?>
					<div class="popup__content js-popup-no-action">
					<h3 class="title title--small">Information om lokalen</h3>
						<?= wpautop( $info ); ?>
					</div>
			<?php
				endif;
			?>
		</div>
	</div>

<?php elseif ( is_page_type('evenemang-page-type')) : ?>

	<div class="popup popup--information visually-hidden hide--lbp">
		<div class="popup__wrapper js-popup" data-popup="popup--information">
			<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--information"><span class="visually-hidden">Stäng popup</span></button>
			<?php
				$info = papi_get_field('info');
				if(!empty($info)) :
			?>
					<div class="popup__content js-popup-no-action">
					<h3 class="title title--small">Information om biljetter</h3>
						<?= wpautop( $info ); ?>
					</div>
			<?php
				endif;
			?>
		</div>
	</div>

<?php elseif ( is_page_type('flexible-page-type') ) :  ?>

	<?php $col = papi_get_field('page_cols'); ?>

	<?php if($col === 'col-3') : ?>
		<div class="popup popup--information visually-hidden hide--lbp">
			<div class="popup__wrapper js-popup" data-popup="popup--information">
				<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--information"><span class="visually-hidden">Stäng popup</span></button>
				<?php
					$asideSidebarContent = papi_get_field('page_sidebar');
				?>
						<div class="popup__content js-popup-no-action">
						<h3 class="title title--small"><?=$asideSidebarContent['sidebar_title'];?></h3>
							<?= wpautop( $asideSidebarContent['sidebar_text'] ); ?>
						</div>
			</div>
		</div>
	<?php endif ?>

<?php endif ?>
<!-- search popup -->
<div id="search" class="popup popup--search visually-hidden">
	<div class="popup__wrapper js-popup" data-popup="popup--search">
		<button title="Stäng sök" class="icon icon--close popup__close-btn js-popup" data-popup="popup--search"><span class="visually-hidden">Stäng sök</span></button>
		<div class="search-wrapper js-popup-no-action">
	  	<?php get_search_form(); ?>
		</div>
	</div>
</div>

<!-- quotation popup -->
<div class="popup popup--quotation visually-hidden">
	<div class="popup__wrapper js-popup"  data-popup="popup--quotation">
		<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--quotation"><span class="visually-hidden">Stäng popup</span></button>
			<?php include(locate_template('modules/quotation.php')); ?>
	</div>
</div>

<!-- book table popup -->
<div class="popup popup--book-table visually-hidden">
	<div id="book-table-iframe" class="popup__wrapper js-popup" data-popup="popup--book-table">
		<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--book-table"><span class="visually-hidden">Stäng popup</span></button>
		<p id="popup__iframe-loader">Laddar...</p>
		<!--<iframe class="book-table-iframe js-popup-no-action" frameborder="0" hspace="0" scrolling="auto" src="https://api.caspeco.net/externalBookingClient/?publicID=fd16edd734e41c8284140877e7c804b2&unitID=2&fixedSize=1"></iframe>-->
	</div>
</div>


<!-- newsletter popup -->
<div class="popup popup--newsletter visually-hidden">
	<div class="popup__wrapper js-popup"  data-popup="popup--newsletter">
		<button title="Stäng popup" class="icon icon--close popup__close-btn js-popup" data-popup="popup--newsletter"><span class="visually-hidden">Stäng popup</span></button>
		<?php include(locate_template('modules/newsletter.php')); ?>

	</div>
</div>


<?php the_papi_option('footer_scripts') ?>

<?php wp_footer(); ?>


</body>
</html>
