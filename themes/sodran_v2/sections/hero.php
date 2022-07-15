<?php 
	$noOfItems = count($section['hero_slides']);

	$sectionClass = 'section hero bg--darkest';
	$videoUrl = '';

 	if($noOfItems === 1) {
		$sliderClass = 'slider';
		$slideClass = 'slider__item';

		$videoUrl = papi_get_field($section['hero_slides'][0]->ID, 'video_url');

	} else {
		$sliderClass = 'slider js-slick';
		$slideClass = 'slider__item js-slick-slide';

	} 

	if($sectionsCounter === 0 && is_front_page() && $col === 'col-1' && is_page_type('flexible-page-type') ) {
		$sectionClass .= ' hero--start'; 
	} elseif( !empty($videoUrl) ) {
		$sectionClass .= ' hero--ratio';
	} 

?>


<section id="<?= $secitonId ?>" class=" <?= $sectionClass ?>">

	<div class="<?= $sliderClass ?>">

		<?php foreach($section['hero_slides'] as $slide) : ?>

			<?php



				$item = array(
					'title' => $slide->post_title,
					'preamble' => papi_get_field($slide->ID, 'preamble'),
					'buttons'	=> papi_get_field($slide->ID, 'button_shortcodes')
				);

				$imgId = get_post_thumbnail_id($slide->ID);

				if(!empty($imgId)) {

	    		if($noOfItems === 1) {
	    			// check if gif then load that instead

				    $imgSrcUrl = wp_get_attachment_url( $imgId );
				    $filetype = wp_check_filetype($imgSrcUrl);

				    if ($filetype['ext'] == 'gif') {
				  		$img = wp_get_attachment_image_src( $imgId, 'full', false);
				    }
	    		} 

	    		if(!isset($img) || empty($img) ) {
	    			$img = wp_get_attachment_image_src( $imgId, 'xl', false);
	    		}


	    		$img_url = $img[0];

	    		$item['image'] = $img_url;
				} 




				$hideTitle = papi_get_field($slide->ID, 'hide_title');

				if($hideTitle) {
					$item['title'] = '';
				}

				if(!empty($videoUrl)) {
					$videoCode = sodran_v2_get_embed_code($videoUrl);
					$item['video'] = $videoCode;
				}
			?>

			<?php if(!empty($item['image'])) : ?>
				<div class="<?=$slideClass?>" style="background-image: url(<?= $item['image']; ?>);">
			<?php else : ?>
				<div class="<?=$slideClass?>">
			<?php endif; ?>

				<?php if( !empty($item['video']) ) : ?>
					<div class="hero__video">
						<?=$item['video']?>
					</div>
				<?php endif; ?>
				<div class="hero__wrapper txt-c js-slick-content">
						<?php if( !empty($item['title']) ) : ?>
							<?php if($col === 'col-1') : ?>
			        	<h2 class="title title--biggest"><?= $item['title']; ?></h2>

							<?php else : ?>
			        	<h3 class="title title--big"><?= $item['title']; ?></h3>
							<?php endif; ?>
						<?php endif; ?>

		        <?php if( !empty($item['preamble']) ) : ?>
		         <p class="txt-uc"><?= $item['preamble']; ?></p>
		        <?php endif; ?>

		        <?php
		          if( !empty($item['buttons']) ) {
								echo do_shortcode($item['buttons']);
							}
		        ?>

		    </div>


			</div>


		<?php endforeach; ?>
	</div>
</section>
