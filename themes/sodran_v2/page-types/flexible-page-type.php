<?php

class Flexible_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Flexibel sida',
      'description' => 'Sida för Södra Teatern',
      'template'    => 'layouts/layout-flexible.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box( 'boxes/page-layout.php' );

    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );

	}
}
?>
