<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Standard_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Standard - Sida',
      'description' => 'Generell sidmall som ska användas när övriga sidmallas inte är det du letar efter',
      'template'    => 'layouts/layout-col2.php',
      'post_type'   => 'page'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box('Intro', array(
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'slug'  => 'preamble'
      ]),
      papi_property([
        'type'     => 'editor',
        'title'    => 'Text',
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

    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );
	}
}
?>
