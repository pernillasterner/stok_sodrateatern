<?php
/**
 * @package sodran_v2
 */

// disable  xmlrpc
add_filter('xmlrpc_enabled', '__return_false');



//Hide Wordpress version
function sodran_v2_remove_version()
{
  return '';
}
add_filter('the_generator', 'sodran_v2_remove_version');

//Wrong password or username
function sodran_v2_wrong_login()
{
  return 'Wrong username or password';
}
add_filter('login_errors', 'sodran_v2_wrong_login');


// Disable rest api for external rewuests
// NOTE: does not work on live, kills contact form as 127.0.0.1 is not correct on live
/*
function restrict_rest_api_to_localhost() {
    $whitelist = array('127.0.0.1', "::1");

    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        die('REST API is disabled.');
    }
}
add_action( 'rest_api_init', 'restrict_rest_api_to_localhost', 1 );
*/