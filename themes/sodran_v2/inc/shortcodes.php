<?php
/**
 * @package sodran_v2
 */


//add button shortcode
// [btn title="foo-value" link="http://loremipsum.com/dolor/sit/amet" external="true" margin="true" big="true"]
function sodran_v2_shortcode_btn_func( $atts ) {
    $a = shortcode_atts( array(
        'title' => 'Läs mer',
        'link' => 'http://sodrateatern.com',
				'external' => false,
				'margin' => false,
				'big' => false,
    ), $atts );

		$classes="btn btn--primary";

		if($a["margin"] !== false) {
			$classes .= " btn--margin";
		}

		if($a["external"] !== false) {
			$classes .= " btn--external";
		} else {
			$classes .= " btn--internal";
		}

		if($a["big"] !== false) {
			$classes .= " btn--big";
		}


		if($a["external"] !== false) {
			return '<a class="'.$classes.'" href="'.$a["link"].'" target="_blank">'.$a["title"].'</a>';

		} else {
			return '<a class="'.$classes.'" href="'.$a["link"].'">'.$a["title"].'</a>';

		}
}
add_shortcode( 'btn', 'sodran_v2_shortcode_btn_func' );

// [booktablebtn title="Override default" margin="true" big="true"]
function sodran_v2_shortcode_booktablebtn_func($atts) {
	$a = shortcode_atts( array(
			'title' => 'Boka bord',
			'margin' => false,
			'big' => false,
	), $atts );

	$classes="btn btn--primary btn--internal js-popup";

	if($a["margin"] !== false) {
		$classes .= " btn--margin";
	}

	if($a["big"] !== false) {
		$classes .= " btn--big";
	}

	// return '<button class="'.$classes.'" data-popup="popup--book-table">'.$a["title"].'</button>';
	return '<button class="'.$classes.' js-book-table">'.$a["title"].'</button>';
}
add_shortcode( 'booktablebtn', 'sodran_v2_shortcode_booktablebtn_func' );

// [quotationbtn title="Override default" margin="true" big="true"]
function sodran_v2_shortcode_quotationbtn_func($atts) {
	$a = shortcode_atts( array(
			'title' => 'Begär offert',
			'margin' => false,
			'big' => false,
	), $atts );

	$classes="btn btn--primary btn--internal js-popup";

	if($a["margin"] !== false) {
		$classes .= " btn--margin";
	}

	if($a["big"] !== false) {
		$classes .= " btn--big";
	}

	return '<button class="'.$classes.'" data-popup="popup--quotation">'.$a["title"].'</button>';
}
add_shortcode( 'quotationbtn', 'sodran_v2_shortcode_quotationbtn_func' );


// [newsletterbtn title="Override default" margin="true" big="true"]
function sodran_v2_shortcode_newsletterbtn_func($atts) {
	$a = shortcode_atts( array(
			'title' => 'Nyhetsbrev',
			'margin' => false,
			'big' => false,
	), $atts );

	$classes="btn btn--primary btn--internal js-popup js-popup-newsletter";

	if($a["margin"] !== false) {
		$classes .= " btn--margin";
	}

	if($a["big"] !== false) {
		$classes .= " btn--big";
	}

	return '<button class="'.$classes.'">'.$a["title"].'</button>';
}
add_shortcode( 'newsletterbtn', 'sodran_v2_shortcode_newsletterbtn_func' );


