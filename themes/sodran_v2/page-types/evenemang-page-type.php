<?php

class Evenemang_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Evenemang',
      'template'    => 'layouts/layout-col3.php',
      'post_type'   => 'post'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box('Event innehåll', array(
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
        'type'  => 'gallery',
        'sidebar'   => false
      ])
    ));

  	$this->box('Information om biljetter', array(
  		papi_property([
		    'title'     => 'Info',
		    'slug'      => 'info',
		    'type'      => 'text',
		    'sidebar'   => false
  		])
  	));

    $this->box('Event länkar', array(
      papi_property([
        'type'     => 'repeater',
        'title'    => 'Länkar',
        'slug'     => 'links',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            papi_property( [
              'type'     => 'dropdown',
              'title'    => 'Länktyp',
              'slug'     => 'link_type',
              'settings' => [
                'items' => [
                  'Hemsida'            => 'homepage',
                  'Facebbok'           => 'facebook',
                  'Twitter'            => 'twitter',
                  'Instagram'          => 'instagram',
                  'iTunes'             => 'itunes',
                  'Spotify (URI)'      => 'spotify',
                  'Youtube (ID)'       => 'youtube',
                  'Vimeo (ID)'         => 'vimeo'
                ]
              ]
            ]),
            papi_property( [
              'type'  => 'string',
              'title' => 'Länk',
              'slug'  => 'link'
            ])
          ]
        ]
      ])
    ));

    $this->box('Köp-länk', array(
      papi_property([
        'title'     => 'Köp-länk',
        'slug'      => 'tickets_link',
        'type'      => 'url'
      ])
    ));

    $this->box('Event speldatum', array(
      papi_property([
        'type'     => 'repeater',
        'title'    => 'Speldatum',
        'slug'     => 'dates',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            papi_property( [
              'type'     => 'datetime',
              'title'    => 'Datum & tid, kronologiskt',
              'slug'     => 'date_time',
              'settings' => [
                'format'       => 'YYYY-MM-DD HH:mm:ss',
                'use_24_hours' => true
              ]
            ]),
            papi_property( [
              'type'  => 'dropdown',
              'title' => 'Plats',
              'slug'  => 'location',
              'settings' => [
                'items' => [
                  'Hela huset'                => 'Hela huset',
                  'Stora Scen'                => 'Stora Scen',
                  'Kristallen'                 => 'Kristallen',
                  'Kägelbanan'                => 'Kägelbanan',
                  'Mosebacketerrassen'        => 'Mosebacke-terrassen',
                  'Restaurang Mosebacke'   => 'Restaurang Mosebacke',
                  'Annan plats*'              => 'other_location'
                ]
              ]
            ]),
            papi_property( [
              'type'  => 'string',
              'title' => 'Annan plats*',
              'slug'  => 'other_location'
            ]),
            papi_property( [
              'title'     => 'Biljett-länk',
              'slug'      => 'buy_link',
              'type'      => 'url'
            ]),
            papi_property( [
              'title'     => 'Slutsålt?',
              'slug'      => 'sold_out',
              'type'      => 'bool'
            ])
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
