<?php

class Stories_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Stories - Listnings Sida',
      'description' => 'Sidmall som användas för att lista Stories',
      'template'    => 'layouts/layout-stories.php',
      'post_type'   => 'page'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {
    $this->box('Sid-attribut', array(
      papi_property([
        'type'     => 'post',
        'title'    => 'Sticky',
        'slug'     => 'sticky_post',
        'settings' => [
          'post_type' => 'stories'
        ]
      ] ),
      papi_property([
        'type'  => 'string',
        'title' => 'Ingress',
        'slug'  => 'preamble'
      ] )
    ));

    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );
	}
}
?>
