<?php
/**
 * @package sodran_v2
 */



//add image size
add_image_size( 'small', 250, 250 );

add_image_size( 'card', 750, 750 );

add_image_size( 'xl', 1440, 1440 );

//Sanetize uploads
function sodran_v2_sanitize_filename_on_upload($filename)
{
	$prefix = 'st_';
	$ext = end(explode('.', $filename));
	$sanitized = preg_replace('/[^a-zA-Z0-9-_.]/', '', substr($filename, 0, -(strlen($ext) + 1)));
	$sanitized = str_replace('.', '-', $sanitized);
  return strtolower($prefix.$sanitized . '.' . $ext);
}
add_filter('sanitize_file_name', 'sodran_v2_sanitize_filename_on_upload', 10);