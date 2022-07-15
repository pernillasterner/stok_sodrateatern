<?php

class Start_Evenemang_Page_Type extends Papi_Page_Type {

  public function meta() {
    return [
      'name'        => 'Evenemang - Start',
      'description' => 'Startsida för Evenemang',
      'template'    => 'layouts/layout-evenemang.php'
    ];
  }

  public function remove() {
    return ['editor', 'comments', 'excerpt'];
  }

  public function register() {

    $this->box('Bildspel', array(
      papi_property( [
        'title'    => 'Notis text',
        'slug'     => 'notice_txt',
        'type'     => 'string'
      ] ),
      papi_property( [
        'title'    => 'Notis länk',
        'slug'     => 'notice_url',
        'type'     => 'string'
      ] ),
      papi_property([
        'type'     => 'repeater',
        'title'    => 'Slide',
        'slug'     => 'slides',
        'sidebar'  => false,
        'settings' => [
          'items' => [
            papi_property( [
              'type'  => 'image',
              'title' => 'Bild',
              'slug'  => 'slide_image'
            ]),
            papi_property( [
              'type'  => 'post',
              'title' => 'Evenemang post',
              'slug'  => 'slide_post',
              'settings' => [
                'post_type' => 'post'
              ]
            ])
          ]
        ]
      ])
    ));

    $this->box( 'boxes/meta-data.php' );

	}
}
?>
