<?php
$outputStr = '<strong>Länk:</strong><br>[btn title="_knapp-text_" link="_url_"]<br><br>';
$outputStr .= '<strong>Begär offert:</strong><br>[quotationbtn]<br><br>';
$outputStr .= '<strong>Boka bord:</strong><br>[booktablebtn]<br><br>';
$outputStr .= '<strong>Nyhetsbrev:</strong><br>[newsletterbtn]<br><br>';
$outputStr .= '<strong>Shortcode-inställningar</strong><br><br>';
$outputStr .= 'Ange alltid url med http(s)://<br><br>';
$outputStr .= 'Om extern-länk: external="true"<br><br>';
$outputStr .= 'Mer luft runt knappar: margin="true"<br><br>';
$outputStr .= 'Stor knapp: big="true"<br><br>';
$outputStr .= 'Egen titel: title="Text"<br><br>';
$outputStr .= '<strong>Exempel:</strong><br>';
$outputStr .= '[btn title="Google" link="http://www.google.com" external="true"]<br>';

return [
  'title' => 'Shortcodes instruktioner',
  'context' => 'side',
  'layout'		=> 'vertical',
  'priority'	=> 'low',
  papi_property( [
	  'title'    => '',
	  'type'     => 'html',
	  'settings' => [
	    'html' => $outputStr
	  ]
	] )
];
