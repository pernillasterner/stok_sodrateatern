<section id="<?= $secitonId ?>" class="section bg--darkest">
	<?php 
		$layout = $section['events_layout']; // normal / tips
		$listSetting = $section['events_list']; // now / cat /custom

		//if now / cat, NOT custom
		if($listSetting === 'custom' ) {

			$items = $section['events_items'];

		} else {

			$noOfItems = $section['events_number'];
			$cat = false;


			if($listSetting === 'cat') {
				$cat = $section['events_category'];
				$cat = $cat->term_id;
			}

			$items = sodran_v2_build_static_query($noOfItems, $cat);
		}


		$noOfItems = count($items);

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

		if( $layout == 'tips' ) {
			$boxClass = 'box--hover--highlight ' . $boxClass;
		}
		if( !empty($items) ) {
			foreach($items as $item) {
				include(locate_template('sections/components/box-post.php'));
			}
		}
	?>

</section>