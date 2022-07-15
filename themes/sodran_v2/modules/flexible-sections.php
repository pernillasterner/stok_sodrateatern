
<?php 
	$sections = papi_get_field('flexible_section'); 
	$sectionsCounter = 0; 

	if(!empty($sections)) {
		foreach( $sections as $section) {

			$secitonId = 'section-id-'.$sectionsCounter;

			include(locate_template('sections/'.$section['_layout'].'.php'));

			$sectionsCounter++;
		}
	}
?>