<?php
/**
 * @package sodran_v2
 */

/**
 * Sanetize uploads
 */

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function sodran_v2_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'sodran_dashboard_widget',         // Widget slug.
                 'Shortcodes:',         // Title.
                 'sodran_v2_dashboard_widget_function' // Display function.
        );
}
add_action( 'wp_dashboard_setup', 'sodran_v2_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function sodran_v2_dashboard_widget_function() {

	// Display whatever it is you want to show.
	echo '<strong>Länk:</strong> [btn title="Knapp-text" link="url inkl. http://"]<br>';
	echo '<strong>Begär offert:</strong> [quotationbtn title="optional"]<br>';
	echo '<strong>Boka bord:</strong> [booktablebtn title="optional"]<br><br>';
	echo '<strong>Nyhetsbrev:</strong> [newsletterbtn title="optional"]<br><br>';
	echo '<strong>Shortcode-inställningar</strong><br>';
	echo 'för extern-länk: external="true"<br>';
	echo 'för extra luft runt knappar: margin="true"<br>';
	echo 'för stor knapp: big="true"<br><br>';
	echo '<strong>Exempel:</strong><br>';
	echo '[btn title="Google" link="http://www.google.com" external="true"]<br>';
	echo '[quotationbtn big="true"]<br>';
	echo '[quotationbtn title="Om annan text än: Begär offert"]';
}
