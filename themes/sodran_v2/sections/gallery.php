<?php 

	$noOfImages = count( $section['gallery_images'] );

	$diffToCompleteRowSbp = $noOfImages % 2; // Small brekpoint, will be 0 or 1
	$diffToCompleteRowLbp = $noOfImages % 4; // Large breakpoint, will be 0 - 3

	$counter = 1; //start at one becuse ^ wont be compatible with zero
?>

<section id="<?= $secitonId ?>" class="section bg--darkest">
	<div class="gallery">

		<?php foreach($section['gallery_images'] as $image) : ?>

			<?php 
				if(	$counter == $diffToCompleteRowSbp ) {
					$class = 'span-12-12--sbp ' ; 
				} else {
					$class = 'span-6-12--sbp ';
				}

				if( $counter <= $diffToCompleteRowLbp  ) {
					$class .= 'span-' . (12 / $diffToCompleteRowLbp ) . '-12--lbp';
				} else {
					$class .= 'span-3-12--lbp ';
				}

			?>
			<div class="<?=$class?>">
				<a href="<?=$image->url?>" class="gallery__item" target="_blank"> 
					<?php if($col == 'col-3' && $noOfImages != 1 ) : ?>
						<?= wp_get_attachment_image( $image->id, 'medium' ); ?>
					<?php elseif($noOfImages == 1) : ?>
						<?= wp_get_attachment_image( $image->id, 'large' ); ?>
					<?php else : ?>
						<?= wp_get_attachment_image( $image->id, 'card' ); ?>
					<?php endif; ?>
				</a>
			</div>

			<?php $counter++; ?>

		<?php endforeach; ?>

	</div>
</section>