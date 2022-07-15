<?php

class Category_Evenemang_Taxonomy_Type extends Papi_Taxonomy_Type {

  public function meta() {
    return [
      'name'                  => 'Evenemang Kategori',
      'taxonomy'              => 'category',
      'redirect_after_create' => true
    ];
  }

  public function register() {
    $this->box('Meta / Sociala medier', array(
      papi_property([
        'type'     => 'image',
        'title'    => 'Bild',
        'slug'     => 'share_img'
      ]),
      papi_property([
        'type'     => 'text',
        'title'    => 'Text',
        'slug'     => 'share_desc'
      ])
    ));

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
	}
}
?>
