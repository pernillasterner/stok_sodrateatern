<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Start_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Välkommen',
      'description' => 'Startsidan för Södra Teatern',
      'template'    => 'layouts/layout-start.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {
    $this->box( 'Globala-attribut', [
      'context' => 'side',
      'layout'  => 'vertical',
      papi_property( [
        'title' => 'Dölj globala tips',
        'slug'  => 'hide_global_posts',
        'type'  => 'bool',
        'layout' => 'vertical'
      ] )
    ] );

    $this->box('Bildspel', array(
	    papi_property([
		    'type'     => 'repeater',
		    'title'    => 'Slides',
		    'slug'     => 'slides',
		    'sidebar'  => false,
		    'settings' => [
	        'items' => [
            papi_property( [
              'type'  => 'text',
              'title' => 'Titel',
              'slug'  => 'slide_title'
            ]),
            papi_property( [
              'type'  => 'text',
              'title' => 'Ingress',
              'slug'  => 'slide_preamble'
            ]),
            papi_property( [
              'type'  => 'text',
              'title' => 'Knapp-shortcodes',
              'slug'  => 'slide_buttons'
            ]),
            papi_property( [
          		'type'     => 'image',
              'title'    => 'Bild',
              'slug'     => 'slide_image'
            ])
          ]
        ]
			])
		));

    $this->box('Södran Stories', array(
      papi_property([
        'type'     => 'string',
        'title'    => 'Alla Stories knapp-text',
        'slug'     => 'stories_btn'
      ]),
      papi_property([
        'type'     => 'post',
        'title'    => 'Stories sida',
        'description' => 'Välj den sida som knappen ska gå till',
        'slug'     => 'stories_page',
        'settings' => [
          'post_type' => 'page'
        ]
      ]),
			papi_property([
		    'title'    => 'Stories',
        'description' => 'max 4 poster, första posten blir stor',
		    'slug'     => 'stories',
        'type'     => 'relationship',
        'settings' => [
          'choose_max' => 4,
          'post_type'  => ['stories'],
          'show_sort_by' =>	false
        ]
      ])
		));

    $this->box('Puffar', array(
			papi_property([
		    'title'    => 'Puffar',
		    'slug'     => 'puffs',
		    'type'     => 'relationship',
		    'sidebar' => false,
		    'settings' => [
	        'post_type' => ['puff'],
	        'query'     => array(
            'puff_categories' => 'puff-start'
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
