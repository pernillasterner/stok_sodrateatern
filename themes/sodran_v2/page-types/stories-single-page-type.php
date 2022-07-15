<?php

class Stories_Single_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Stories',
      'template'    => 'single-stories.php',
      'post_type'   => 'stories'
    ];
  }

  public function remove() {
    return ['comments'];
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
      ] ),
      papi_property( [
        'title' => 'Dölj globala puffar',
        'slug'  => 'hide_global_puffs',
        'type'  => 'bool',
        'layout' => 'vertical'
      ] )
    ] );

    $this->box( 'boxes/flexible-sections.php' );

    $this->box( 'boxes/meta-data.php' );

    $this->box( 'boxes/button-shortcode-instruction.php' );
	}
}
?>
