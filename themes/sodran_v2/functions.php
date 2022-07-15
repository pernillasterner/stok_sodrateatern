<?php
/**
 * sodran_v2 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sodran_v2
 */

if ( ! function_exists( 'sodran_v2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sodran_v2_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sodran_v2, use a find and replace
	 * to change 'sodran_v2' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sodran_v2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sodran_v2' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

  add_filter('show_admin_bar', '__return_false');

}
endif;
add_action( 'after_setup_theme', 'sodran_v2_setup' );


/**
 * Enqueue scripts and styles.
 */

function sodran_v2_change_register_scripts() {
	  wp_deregister_script( 'wp-embed' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/dist/js/jquery.min.js', array(), '3.3.1', true );

    wp_deregister_script( 'jquery-migrate' );
    wp_register_script( 'jquery-migrate', get_template_directory_uri() . '/dist/js/jquery-migrate.min.js', array(), '3.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'sodran_v2_change_register_scripts' );

function sodran_v2_scripts() {
	wp_enqueue_style( 'styles', get_template_directory_uri().'/dist/css/style.min.css', array(), '3.0.6' );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'bookatable', 'https://bda.bookatable.com/deploy/lbui.direct.min.js', array('jquery'), '3.0.8' );

	wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), '3.0.8', true );
	//wp_enqueue_script ( 'ajax_script', get_template_directory_uri() . '/dist/js/ajax.min.js', array('jquery','main'), false, true);
	
}
add_action( 'wp_enqueue_scripts', 'sodran_v2_scripts' );

add_action( 'wpcf7_enqueue_styles', function() { wp_deregister_style( 'contact-form-7' ); } );

// Custom functions that act independently of the theme templates.

require get_template_directory() . '/inc/extras.php';

/**
*  Set timezone to Stockholm
*/
date_default_timezone_set( 'UTC' );
setlocale(LC_ALL, "sv_SE.UTF-8");

// ADMIN
// Custom Post Type "Puffar"
require get_template_directory() . '/inc/cpt-puffar.php';

// Custom Post Type "Stories"
require get_template_directory() . '/inc/cpt-stories.php';

// Posts modifications
require get_template_directory() . '/inc/post-mod.php';

// Page modifications
require get_template_directory() . '/inc/page-mod.php';

// Dashboard modification
require get_template_directory() . '/inc/dashboard-mod.php';

// Files modification
require get_template_directory() . '/inc/files-mod.php';

// Security
require get_template_directory() . '/inc/security.php';

// Disable comments
require get_template_directory() . '/inc/disable-comments.php';

// Relevansi Search modification
require get_template_directory() . '/inc/search-mod.php';


// EDITOR
// Shortcodes
require get_template_directory() . '/inc/shortcodes.php';

// Tiny MCE
require get_template_directory() . '/inc/tinymce-mod.php';


// HELPERS
// Custom clean menu
require get_template_directory() . '/inc/custom-menu.php';

// SQL query for events
require get_template_directory() . '/inc/build-query.php';

// Tickster api ticket status
require get_template_directory() . '/inc/tickster-api.php';

// Youtube/Vimeo embed from url
require get_template_directory() . '/inc/get-embed-code.php';



/**
 * Papi
 */

 add_filter( 'papi/settings/directories', function () {
  return __DIR__ . '/page-types';
 } );

 add_filter( 'papi/settings/only_page_type_post', function () {
  return 'evenemang-page-type';
 } );

 add_filter( 'papi/settings/only_page_type_puff', function () {
  return 'puff-page-type';
 } );

add_filter( 'papi/settings/only_taxonomy_type_category', function () {
    return 'category-evenemang-taxonomy-type';
} );

 //Check page-type function
 function is_page_type($val, $id = NULL){
   $page_id = is_null($id) ? get_the_ID() : $id;
   $page_type = get_post_meta( $page_id, PAPI_PAGE_TYPE_KEY, true );
   $parent_page_type = get_post_meta( wp_get_post_parent_id( $page_id ), PAPI_PAGE_TYPE_KEY, true );

   if($val == $page_type) {
           return true;
    } else if ($val == $parent_page_type) {
           return true;
    } else  {
           return false;
    }
 }

 //Hide start-page-types, since they should only be used once
 function sodran_v2_hide_page_types($page_type) {
 	if( $page_type !== 'flexible-page-type') {
 		return false;
 	}
 	return true;
 }
 add_filter('papi/settings/show_page_type_page', 'sodran_v2_hide_page_types');


 add_filter('papi/settings/standard_page_type_page', function () {
   return false;
 });