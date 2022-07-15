<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Start_Event_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Möten & Event - Start',
      'description' => 'Startsida för Möten & Event',
      'template'    => 'layouts/layout-start.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

  	$this->box('Startbild', array(
  		papi_property([
        'type'  => 'string',
        'title' => 'Titel',
        'slug'  => 'slide_title'
      ]),
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'slug'  => 'slide_preamble'
      ]),
      papi_property([
        'type'  => 'text',
        'title' => 'Knapp-shortcodes',
        'slug'  => 'slide_buttons'
      ]),
      papi_property([
     		'type'  => 'image',
        'title' => 'Bild',
        'slug'  => 'slide_image'
  		])
  	));

  	$this->box('Lokaler', array(
  		papi_property([
		    'title'     => 'Lokaler',
		    'slug'      => 'facilities',
		    'type'      => 'relationship',
		    'instruction'   => 'Välj de lokaler som du vill visa på Event & Möten startsidan',
		    'settings'  => [
		    	'query' => array(
		    		'post_parent' => 198
		    	)
		    ]
  		])
  	));

  	$this->box('Puffar', array(
	    papi_property([
		    'title'       => 'Puffar',
		    'slug'        => 'puffs',
		    'type'        => 'relationship',
		    'instruction' => 'Välj de puffar som du vill visa på Event & Möten startsidan. Observera info på puff-posten att dessa beter sig lite annorlunda.',
		    'settings' => [
	        'post_type' => ['puff'],
          'query'      => array(
            'puff_categories' => 'puff-event-moten'
          )
		    ]
			])
		));

    $this->box( 'boxes/flexible-sections.php' );
    
    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );
	}
}
?>
