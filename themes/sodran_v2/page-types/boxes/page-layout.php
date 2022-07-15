<?php
return [
  'title' => 'Sid-layout',
  papi_property( [
	  'title'    => 'Kolumner',
	  'slug'     => 'page_cols',
	  'type'     => 'dropdown',
	  'settings' => [
	      'items' => [
	        'Full bredd' => 'col-1',
	        '2 kolumner (bildspel / innehåll)' => 'col-2',
	        '3 kolumner (bildspel / innehåll / sidebar' => 'col-3'
	      ],
	      'placeholder' => 'Välj layout',
	      'select2' => false,
	      'required' => true
	  ]
	] ),
	papi_property( [
		'title' => 'Bakgrundsfärg',
		'slug' => 'page_bg',
		'type' => 'dropdown',
		'settings' => [
	      'items' => [
	        'Svart' => 'black',
	        'Vit' => 'white'
	      ],
	      'selected' => 'black',
	      'select2' => false
	  ],
	  'rules' => [
      [
        'operator' => '=',
        'value'    => 'col-1',
        'slug'     => 'page_cols'
      ]
    ]
	] ),
	papi_property( [
	  'title' => 'Bildspel',
	  'slug'  => 'page_slides',
	  'type'  => 'gallery',
    'rules' => [
      'relation' => 'OR',
      [
        'operator' => '=',
        'value'    => 'col-2',
        'slug'     => 'page_cols'
      ],
      [
        'operator' => '=',
        'value'    => 'col-3',
        'slug'     => 'page_cols'
      ]
    ]
	] ),
	papi_property( [
	  'title'   => 'Sidebar',
	  'type'    => 'group',
	  'slug'		=> 'page_sidebar',
	  'settings' => [
	    'items' => [
	      papi_property( [
	        'type'  		=> 'string',
	        'title' 		=> 'Title',
	        'slug'  		=> 'sidebar_title',
	        'default'  	=> 'Information'
	      ] ),
	      papi_property( [
	        'type'  => 'text',
	        'title' => 'Text',
	        'slug'  => 'sidebar_text'
	      ] ),
	      papi_property( [
	        'type'  => 'string',
	        'title' => 'Knapp-shortcode',
	        'description' => 'OBS! endast en knapp t.ex. [btn title="_TEXT_" link="_URL_" margin="true"]',
	        'slug'  => 'sidebar_btn'
	      ] ),
	    ]
	  ],
	  'rules' => [
      [
        'operator' => '=',
        'value'    => 'col-3',
        'slug'     => 'page_cols'
      ]
    ]
	] ),
	papi_property([
	  'type'  => 'string',
	  'title' => 'Ingress',
	  'slug'  => 'preamble'
	] ),
	papi_property([
    'type'     => 'editor',
    'title'    => 'Innehåll',
    'slug'     => 'page_content',
    'rules' => [
      'relation' => 'OR',
      [
        'operator' => '=',
        'value'    => 'col-2',
        'slug'     => 'page_cols'
      ],
      [
        'operator' => '=',
        'value'    => 'col-3',
        'slug'     => 'page_cols'
      ]
    ]
  ] )
];