<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class Empty_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Tom - Sida',
      'description' => 'Tom sidmall som kan användas för Typeform kampanjer',
      'template'    => 'layouts/layout-col1.php',
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
    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );

	}
}

?>
