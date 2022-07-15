<?php

class Puff_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Puff',
      'post_type'   => 'puff',
      'template'    => 'single-puff.php'
    ];
  }

  public function remove() {
    return ['editor'];
  }

  public function register() {
    $this->box( 'boxes/button-shortcode-instruction.php' );

    $this->box('Puff ingress', array(
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'description' => 'Visas när puffen visas i en box eller hero',
        'slug'  => 'preamble'
      ])
    ));

    $this->box('Puff video', array(
      papi_property([
        'type'  => 'string',
        'title' => 'Video url',
        'description' => 'Visas när endast om det är ett objekt i hero. Vimeo eller Youtube url.',
        'slug'  => 'video_url'
      ]),
      papi_property([
        'title' => 'Dölj titel',
        'description' => 'Om titel inte ska visas i hero',
        'slug'  => 'hide_title',
        'type'  => 'bool'
      ])      
    ));

    $this->box('Puff-knapp', array(
      /*papi_property([
        'title' => 'Knapp-text',
        'slug'  => 'button_text',
        'type'  => 'string'
      ]),*/
      papi_property([
        'title' => 'Knapp-länk',
        'description' => 'Anger var puffen ska länka när den visas som puff / box',
        'slug'  => 'button_link',
        'type'  => 'url'
      ]),
      papi_property( [
        'type'  => 'text',
        'title' => 'Knapp-shortcodes',
        'description' => 'Visas endast när puff används i hero',
        'slug'  => 'button_shortcodes'
      ])

    ));

    $this->box('Puff text', array(
      papi_property([
        'type'  => 'editor',
        'title' => 'Text',
        'description' => 'Visas när puffen visas som puff, ej i box eller hero',
        'slug'  => 'text'
      ])
    ));
	}
}
?>
