<?php if( $section['puffs_layout'] === 'puff' ) : ?>
	<?php $bg = $section['puffs_stripes_bg'] ? 'bg--stripes' : 'bg--dark'; ?>
	<section id="<?= $secitonId ?>" class="section section--padding <?=$bg?>">
<?php else: ?>
	<section id="<?= $secitonId ?>" class="section bg--darkest">
<?php endif; ?>

	<?php if( $section['puffs_layout'] === 'puff' ) : ?>

		<?php if( !empty($section['puffs_title']) ) : ?>
			<div class="section--grid txt-c">
        <p class="title no-margin"><?=$section['puffs_title']?></p>
      </div>
		<?php endif; ?>


	<?php endif; ?>

	<?php 
		$noOfItems = count($section['puffs_items']);

		if( $noOfItems === 1 ) {
		  $boxClass = 'span-12-12--sbp';
		} elseif( $col === 'col-3' || $noOfItems === 2  ) {
			$boxClass = 'span-6-12--sbp';
		} elseif( $col === 'col-1' && $noOfItems % 4 === 0 ) {
			$boxClass = 'span-6-12--sbp span-3-12--lbp';
		} elseif( $noOfItems % 3 === 0 ) {
			$boxClass = 'span-6-12--sbp span-4-12--lbp';
		} else {
			$boxClass = 'span-6-12--sbp';
		}


		$cardClass = '';
		if( $col === 'col-2' ) {
		  $cardClass = 'is-bigger';
		} elseif( $col === 'col-3' ) {
			$cardClass = 'is-biggest';
		} 

		$isBig = false;

		if( $section['puffs_layout'] === 'puff' ) {
			$cardClass .= ($section['puffs_color'] === 'light') ? ' card--inv' : null;

			if($section['puffs_sticky']) {
				$isBig = true;
			}
		}
		$wasBig = false;
		$itemsCounter = 1;

		if(!empty($section['puffs_items'])) {
			foreach( $section['puffs_items'] as $item ) {



		 			if( $section['puffs_layout'] === 'box' ) {

						if($itemsCounter == 1) {
							echo '<div class="section">'; //open grid
						}

		 				include(locate_template('sections/components/box-'.$item->post_type.'.php'));
		 				
						if($itemsCounter == $noOfItems) {
				 			echo '</div>'; //close grid
				 		} 
		 			} elseif( $section['puffs_layout'] === 'puff' ) {
		 				
						if($isBig) {
							echo '<div class="section--grid">'; //open grid
							$wasBig = true;
						} elseif($itemsCounter == 1 || $wasBig) {
							echo '<div class="section--grid js-masonry">'; //open grid
							$wasBig = false;
						}

		 				include(locate_template('sections/components/card-'.$item->post_type.'.php'));

		 				if($isBig || $itemsCounter == $noOfItems) {
				 			echo '</div>'; //close grid
				 		} 
		 			}


		 		$itemsCounter++;
	 			$isBig = false;
	 		}
	 	}
 	?>


	<?php if( $section['puffs_layout'] === 'puff' ) : ?>

		<?php if( !empty($section['puffs_buttons']) ) : ?>
      <div class="section txt-c">
      		<?= do_shortcode($section['puffs_buttons']); ?>
      </div>
		<?php endif; ?>

	<?php endif; ?>

</section>



