<?php

class Global_Option_Type extends Papi_Option_Type {

  public function meta() {
    return [
      'menu' => 'options-general.php',
      'name' => 'Globala inställningar',
      'capability' => 'edit_pages'
    ];
  }


  public function register() {
    $this->box( 'Globala attribut', [
      papi_property( [
        'title' => 'Tickster API-nyckel',
        'slug'  => 'tickster_api',
        'type'  => 'string'
      ] ),
      papi_property( [
        'title' => 'Header scripts',
        'slug'  => 'header_scripts',
        'type'  => 'text',
        'settings' => [
          'allow_html' => true
        ]
      ] ),
      papi_property( [
        'title' => 'Footer scripts',
        'slug'  => 'footer_scripts',
        'type'  => 'text',
        'settings' => [
          'allow_html' => true
        ]
      ] )
    ] );

    $this->box( 'Nyhetsbrev', [
      papi_property( [
        'title' => 'Ajax url',
        'slug'  => 'newsletter_url',
        'type'  => 'string'
      ] ),
      papi_property( [
        'title' => 'Titel',
        'slug'  => 'newsletter_title',
        'type'  => 'string'
      ] ),
      papi_property( [
        'title' => 'Text',
        'slug'  => 'newsletter_txt',
        'type'  => 'text',
        'settings' => [
          'allow_html' => true
        ]
      ] ),
      papi_property( [
        'title' => 'Skicka-knapp text',
        'slug'  => 'newsletter_btn',
        'type'  => 'string'
      ] ),
      papi_property( [
        'title' => 'Tack-text',
        'slug'  => 'newsletter_success',
        'type'  => 'string'
      ] ),
      papi_property( [
        'title' => 'Nyhetsbrev listor',
        'slug'  => 'newsletter_lists',
        'type'  => 'repeater',
        'settings' => [
          'items' => [
            papi_property( [
              'type'  => 'string',
              'title' => 'Title',
              'slug'  => 'list_name'
            ] ),
            papi_property( [
              'type'  => 'string',
              'title' => 'List ID',
              'slug'  => 'list_id'
            ] ),
          ]
        ]
      ] )
    ] );

    $this->box('Globala tips', array(
      papi_property([
        'type'  => 'relationship',
        'title' => 'Evenemang-tips!',
        'description' => 'Välj 4 evenemang',
        'slug'  => 'tips_post',
        'settings'  => [
          'limit' => 4,
          'post_type' => ['post']
        ]
      ]),
      papi_property( [
        'title'    => 'Tips på sidor',
        'slug'     => 'tips_page',
        'description' => 'Visas bl.a. inne på en "Södran stories"-post',
        'type'     => 'repeater',
        'settings' => [
          'items' => [
            papi_property( [
              'type'  => 'post',
              'title' => 'Välj valfri sida/story',
              'slug'  => 'tips_page_post',
              'settings' => [
                'post_type' => ['page','stories']
              ]
            ] ),
            papi_property( [
              'type'     => 'string',
              'title'    => 'Egen titel (frivillig)',
              'slug'     => 'tips_page_title'
            ] ),
            papi_property( [
              'type'     => 'string',
              'title'    => 'Egen ingress (frivillig)',
              'slug'     => 'tips_page_preamble'
            ] )
          ]
        ]
      ] )
    ));


    $this->box( 'Cookie-bar', [
      papi_property( [
        'title' => 'Innehåll',
        'slug'  => 'cookie_content',
        'type'  => 'editor'
      ] ),
      papi_property( [
        'title' => 'Knapp-text',
        'slug'  => 'cookie_btn',
        'type'  => 'string'
      ] ),
    ] );
  }
}
