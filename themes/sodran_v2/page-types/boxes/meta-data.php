<?php
return [
  'title' => 'Meta / Sociala medier',
  'context' => 'side',
  'layout'    => 'vertical',
  'priority'  => 'low',
  papi_property([
    'type'     => 'image',
    'title'    => 'Bild',
    'description' => 'Om annan bild än "Utvald bild" ska användas vid delning',
    'slug'     => 'share_img'
  ]),
  papi_property([
    'type'     => 'text',
    'title'    => 'Text',
    'description' => 'Om annan text än Ingress ska användas vid delning',
    'slug'     => 'share_desc'
  ])
];