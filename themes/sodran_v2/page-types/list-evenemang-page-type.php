<?php
// Deprecated, don't work in this file, but don't remove it as it might be in use.

class List_Evenemang_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Evenemang - Lista',
      'description' => 'Listvy för Evenemang',
      'template'    => 'layouts/layout-list.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {
    $this->box( 'boxes/meta-data.php' );

  }
}
?>
