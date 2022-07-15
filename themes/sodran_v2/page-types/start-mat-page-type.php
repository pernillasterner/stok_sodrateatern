<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Start_Mat_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Mat & Dryck - Start',
      'description' => 'Startsida för Mat & Dryck',
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

  	$this->box('Menyer', array(
  		papi_property([
		    'title'     => 'Menyer',
		    'slug'      => 'menues',
		    'type'      => 'relationship',
		    'instruction'   => 'Välj de menyer som du vill visa på Mat & Bar startsidan',
		    'settings'  => [
		    	'query' => array(
		    		'post_parent' => 192
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
          'show_max'   => -1,
          'choose_max' => -1,
          'query'      => array(
            'puff_categories' => 'puff-mat-dryck'
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
