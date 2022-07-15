<?php
/**
 *
 * @package sodran_v2
 */


// Add Formats & Remove h4-h6 and pre

function sodran_v2_wp_tiny_mce_before_init($settings){

  // From http://tinymce.moxiecode.com/examples/example_24.php
  $style_formats = array(
      array('title' => 'Ingress', 'classes' => 'preamble', 'selector' => 'p' ),
      array('title' => 'Stor ingress ', 'classes' => 'preamble preamble--big', 'selector' => 'p' ),
      array('title' => 'Titel XS', 'classes' => 'title title--smallest', 'selector' => 'h2,h3,h4,h5,h6'  ),
      array('title' => 'Titel S', 'classes' => 'title title--small', 'selector' => 'h2,h3,h4,h5,h6'  ),
      array('title' => 'Titel M', 'classes' => 'title title--medium', 'selector' => 'h2,h3,h4,h5,h6'  ),
      array('title' => 'Titel L', 'classes' => 'title', 'selector' => 'h2,h3,h4,h5,h6'  ),
      array('title' => 'Titel XL', 'classes' => 'title title--big', 'selector' => 'h2,h3,h4,h5,h6'  ),
      array('title' => 'Titel XXL', 'classes' => 'title title--biggest', 'selector' => 'h2,h3,h4,h5,h6'  ),

  );
  $settings['style_formats'] = json_encode( $style_formats ); //Add subline format to Tiny MCEasdasd
  $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

  return $settings;
}
add_filter('tiny_mce_before_init',  'sodran_v2_wp_tiny_mce_before_init');


// Add Formats Dropdown Menu To MCE

if ( ! function_exists( 'sodran_v2_wp_tiny_mce_style_select' ) ) {
  function sodran_v2_wp_tiny_mce_style_select( $buttons ) {
    array_unshift( $buttons, 'styleselect' ); //Show formats
    return $buttons;
  }
}
add_filter( 'mce_buttons', 'sodran_v2_wp_tiny_mce_style_select' );

function sodran_v2_editor_styles() {
    add_editor_style( '/dist/css/admin.min.css' );
}
add_action( 'admin_init', 'sodran_v2_editor_styles' );
