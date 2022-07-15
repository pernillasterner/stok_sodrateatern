<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Event_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Möten & Event - Lokal',
      'description' => 'Sida för Lokaler som finns under Möten & Event',
      'template'    => 'layouts/layout-col3.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box('Lokal info', array(
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'slug'  => 'preamble'
      ]),
      papi_property([
        'type'     => 'editor',
        'title'    => 'Brödtext',
        'slug'     => 'content'
      ])
    ));

    $this->box('Bildspel', array(
      papi_property([
        'title' => 'Slides',
        'slug'  => 'slides',
        'type'  => 'gallery'
      ])
    ));

  	$this->box('Information om lokalen', array(
  		papi_property([
		    'title'     => 'Info',
		    'slug'      => 'info',
		    'type'      => 'text',
		    'sidebar'   => false
		  ])
  	));

    $this->box('Kategorier', array(
      papi_property([
        'title'    => 'Kategorier',
        'slug'     => 'event_categories',
        'type'     => 'checkbox',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            'Privat' => 'Privat',
            'Företag' => 'Företag'
          ]
        ]
      ])
    ));

    $this->box('Antal personer i lokalen', array(
      papi_property([
        'title'    => 'Taggar',
        'slug'     => 'event_tags',
        'type'     => 'checkbox',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            '0 > 8' => '8',
            '0 > 20' => '20',
            '0 > 100' => '100',
            '0 > 250' => '250',
            '0 > 414' => '414',
            '0 > 600' => '600',
          ]
        ]
      ])
    ));

    $this->box('Taggar', array(
      papi_property([
        'title'    => 'Taggar',
        'slug'     => 'event_tags',
        'type'     => 'checkbox',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            'Mingel' => 'mingel',
            'Bio' => 'bio',
            'U-bord' => 'ubord',
            'Middag' => 'middag',
            'Skol' => 'skol',
            'Rund' => 'rund',
            'Styrelse' => 'styrelse',
            'Dj-utrustning' => 'dj',
            'Scen' => 'scen',
            'Liveband' => 'liveband'
          ]
        ]
      ])
    ));


    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );

  }
}
?>
