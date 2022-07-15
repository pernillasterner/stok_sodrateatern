<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Mat_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Mat & Dryck - Meny',
      'description' => 'Sida för Menyer som finns under Mat & Dryck',
      'template'    => 'layouts/layout-col2.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box('Meny intro', array(
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'slug'  => 'preamble'
      ]),
      papi_property([
        'type'     => 'editor',
        'title'    => 'Text',
        'slug'     => 'content'
      ]),
      papi_property([
        'type'     => 'repeater',
        'title'    => 'Öppettider',
        'slug'     => 'open_hours',
        'settings' => [
          'items' => [
            papi_property( [
              'type'  => 'string',
              'title' => 'Dag',
              'slug'  => 'day'
            ]),
            papi_property( [
              'type'  => 'string',
              'title' => 'Tid',
              'slug'  => 'time'
            ])
          ]
        ]
      ]),
      papi_property([
        'title'     => 'Dölj "boka bord"-knapp',
        'slug'      => 'hide_button',
        'type'      => 'bool'
      ]),
      papi_property([
        'type'  => 'string',
        'title' => 'Meny title',
        'slug'  => 'm_title'
      ])
    ));

    $this->box('Bildspel', array(
      papi_property([
        'title' => 'Slides',
        'slug'  => 'slides',
        'type'  => 'gallery'
      ])
    ));

    $this->box('Meny', array(
      papi_property([
        'type'     => 'repeater',
        'title'    => 'Meny',
        'slug'     => 'menu',
        'settings' => [
          'items' => [
            papi_property( [
              'type'  => 'string',
              'title' => 'Titel',
              'slug'  => 'title'
            ]),
            papi_property( [
              'type'  => 'text',
              'title' => 'Text',
              'slug'  => 'text'
            ]),
            papi_property( [
              'type'  => 'text',
              'title' => 'Sub-text',
              'slug'  => 'text_sub'
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
