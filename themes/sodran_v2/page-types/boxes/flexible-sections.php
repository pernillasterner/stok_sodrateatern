<?php
return [
  'title' 		=> 'Flexibelt content',
  'layout'		=> 'vertical',
  'priority'	=> 'low',
  papi_property( [
	  'title'    => 'Sektioner',
	  'slug'     => 'flexible_section',
	  'type'     => 'flexible',
	  'settings' => [
	  	'layout'		=> 'row',
	  	'add_new_label' => 'Lägg till ny sektion',
	    'items' => [
	    	[
	        'title' => 'Utvalda puffar/sidor',
	        'slug'	=> 'puffs',
	        'items' => [
	        	papi_property( [
						  'title'    => 'Layout',
						  'slug'     => 'puffs_layout',
						  'type'     => 'radio',
						  'settings' => [
						  	'required' => true,
					      'items' => [
					        'Puffar' => 'puff',
					        'Boxar' => 'box'
					      ]
						  ]
						] ),
						papi_property( [
						  'title'    => 'Randig bakgrund',
						  'slug'     => 'puffs_stripes_bg',
						  'type'     => 'bool',
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'puff',
					        'slug'     => 'puffs_layout'
					      ]
					    ]
						] ),
						papi_property( [
						  'title'    => 'Stor första puff',
						  'slug'     => 'puffs_sticky',
						  'type'     => 'bool',
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'puff',
					        'slug'     => 'puffs_layout'
					      ]
					    ]
						] ),
						papi_property( [
						  'title'    => 'Kort färg',
						  'slug'     => 'puffs_color',
						  'type'     => 'radio',
						  'settings' => [
					      'items' => [
					        'Ljus' => 'light',
					        'Mörk' => 'dark'
					      ],
					      'selected' => 'light'
						  ],
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'puff',
					        'slug'     => 'puffs_layout'
					      ]
					    ]
						] ),
						papi_property( [
						  'title'    => 'Titel före puffar',
						  'slug'     => 'puffs_title',
						  'type'     => 'string',
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'puff',
					        'slug'     => 'puffs_layout'
					      ]
					    ]
						] ),
						papi_property( [
						  'title'    => 'Knappar (shortcodes) efter puffar',
						  'slug'     => 'puffs_buttons',
						  'type'     => 'string',
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'puff',
					        'slug'     => 'puffs_layout'
					      ]
					    ]
						] ),
		        papi_property( [
						  'title'    => 'Välj sidor/stories/puffar',
						  'slug'     => 'puffs_items',
						  'type'     => 'relationship',
						  'settings' => [
						    'limit'     => -1,
						    'post_type' => ['page', 'puff', 'stories']
						  ]
						] )
	        ]
	      ],
	      [
	        'title' => 'Utvalda evenemang',
	        'slug'	=> 'events',
	        'items' => [
          	papi_property( [
						  'title'    => 'Layout',
						  'slug'     => 'events_layout',
						  'type'     => 'radio',
						  'settings' => [
					      'items' => [
					        'Normal' => 'normal',
					        'Tips' => 'tips'
					      ],
					      'selected' => 'normal'
						  ]
						] ),
						papi_property( [
						  'title'    => 'Lista',
						  'slug'     => 'events_list',
						  'type'     => 'radio',
						  'settings' => [
					      'items' => [
					        'Närmast i tid' => 'now',
					        'Från vald kategori' => 'cat',
					        'Utvalda' => 'custom'
					      ],
					      'selected' => 'now'
						  ]
						] ),
						papi_property( [
						  'title'    => 'Antal',
						  'description' => 'min 1, max 12',
						  'slug'     => 'events_number',
						  'type'  => 'number',
						  'settings' => [
						    'step' => 1,
						    'min' => 1,
						    'max' => 12
						  ],
						  'rules' => [
					      [
					        'operator' => '!=',
					        'value'    => 'custom',
					        'slug'     => 'events_list'
					      ]
					    ]
						] ),
						papi_property( [
						  'title'    => 'Kategori',
						  'slug'     => 'events_category',
						  'type'     => 'term',
						  'settings' => [
						    'taxonomy' => 'category'
						  ],
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'cat',
					        'slug'     => 'events_list'
					      ]
					    ]
						] ),
		        papi_property( [
						  'title'    => 'Puffa evenemang',
						  'slug'     => 'events_items',
						  'type'     => 'relationship',
						  'settings' => [
						    'limit'     => -1,
						    'post_type' => ['post']
						  ],
						  'rules' => [
					      [
					        'operator' => '=',
					        'value'    => 'custom',
					        'slug'     => 'events_list'
					      ]
					    ]
						] )
	        ]
	      ],
	      [
	        'title' => 'Galleri',
	        'slug'	=> 'gallery',
	        'items' => [
	          papi_property( [
	            'type'  => 'gallery',
	            'title' => 'Bilder',
	            'sidebar' => false,
	            'slug'  => 'gallery_images'
	          ] )
	        ]
	      ],
	      [
	        'title' => 'Hero (slider)',
	        'slug'	=> 'hero',
	        'items' => [
						papi_property( [
						  'title'    => 'Slides',
						  'descirption' => 'Välj puffar',
						  'slug'     => 'hero_slides',
						  'type'     => 'relationship',
						  'settings' => [
						    'limit'     => -1,
						    'post_type' => 'puff'
						  ]
						] )
	        ]
	      ],
	      [
	        'title' => 'Text editor',
	        'slug'	=> 'editor',
	        'items' => [
	          papi_property( [
						  'title' => 'Editor',
						  'slug'  => 'editor',
						  'type'  => 'editor',
						  'sidebar' => false,
						  'settings' => [
						  	'drag_drop_upload' => false,
						  	'media_buttons' => false
						  ]
						] )
	        ]
	      ],
	      [
	      	'title' => 'Notis-banner',
	      	'slug' 	=> 'notice-banner',
	      	'items' => [
	      		papi_property( [
						  'title'    => 'Notis text',
						  'slug'     => 'notice_txt',
						  'type'     => 'string'
						] ),
						papi_property( [
						  'title'    => 'Notis länk',
						  'slug'     => 'notice_url',
						  'type'     => 'string'
						] )
	      	]
	      ],
	      [
	        'title' => 'Kontakt-personer',
	        'slug'	=> 'contact',
	        'items' => [
	        	papi_property([
					    'type'     => 'repeater',
					    'title'    => 'Person',
					    'slug'     => 'persons',
					    'sidebar' => false,
					    'settings' => [
					    	'layout' => 'row',
					    	'add_new_label' => 'Lägg till ny person',
				        'items' => [
				        	papi_property( [
			          		'type'     => 'image',
			              'title'    => 'Bild',
			              'slug'     => 'person_img',
			              'sidebar' => false,
			            ]),
			            papi_property( [
			              'type'  => 'editor',
			              'title' => 'Övrigt',
			              'slug'  => 'person_content',
			              'sidebar' => false,
			              'settings' => [
									    'media_buttons'	=> false,
									    'drag_drop_upload' => false
									  ]
			            ])
			          ]
			        ]
						])
	        ]
	      ],
	      [
	      	'title' => 'Mat-meny',
	      	'slug' 	=> 'food-menu',
	      	'items' => [
	      		papi_property( [
              'type'  => 'string',
              'title' => 'Meny titel',
              'slug'  => 'menu_heading'
            ]),
	      		papi_property([
			        'type'     => 'repeater',
			        'title'    => 'Meny',
			        'slug'     => 'menu',
			        'settings' => [
			          'items' => [
			            papi_property( [
			              'type'  => 'string',
			              'title' => 'Titel',
			              'slug'  => 'title'
			            ]),
			            papi_property( [
			              'type'  => 'text',
			              'title' => 'Text',
			              'slug'  => 'text'
			            ]),
			            papi_property( [
			              'type'  => 'text',
			              'title' => 'Sub-text',
			              'slug'  => 'text_sub'
			            ])
			          ]
			        ]
			      ])
	      	]
	      ]
	    ]
	  ]
	] )
];