<?php
/**
 *
 * @package sodran_v2
 */
 
//Add menu order to post-types
function sodran_v2_post_menu_order()
{
	add_post_type_support( 'post', 'page-attributes' );
	add_post_type_support( 'puff', 'page-attributes' );
}
add_action( 'init', 'sodran_v2_post_menu_order' );


// Rename post
function sodran_v2_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Evenemang';
    $submenu['edit.php'][5][0] = 'Alla Evenemang';
    echo '';
}
function sodran_v2_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Evenemang';
    $labels->singular_name = 'Evenemang';
    $labels->add_new_item = 'Nytt Evenemang';
    $labels->edit_item = 'Evenemang';
    $labels->new_item = 'Evenemang';
    $labels->search_items = 'Sök Evenemang';
    $labels->not_found = 'Inget Evenemang hittades';
    $labels->not_found_in_trash = 'Inget Evenemang hittades i Papperskorgen';
    $labels->all_items = 'All Evenemang';
    $labels->menu_name = 'Evenemang';
    $labels->name_admin_bar = 'Evenemang';
}

add_action( 'admin_menu', 'sodran_v2_change_post_label' );
add_action( 'init', 'sodran_v2_change_post_object' );


// Disable tags public
function sodran_v2_post_tags_disable( $args, $name, $object_type ) {
    // if it's no the "tag" taxonomy, don't make changes
    if ( 'post_tag' !== $name ) {
        return $args;
    }

    // override the specific arguments to remove the archive from the front-end
    $args['public'] = FALSE;
    $args['publicly_queryable'] = FALSE;

    // return the modified arguments
    return $args;
}

add_filter( 'register_taxonomy_args', 'sodran_v2_post_tags_disable', 10, 3 );


// Add archive status to post
function sodran_v2_custom_post_status(){
     register_post_status( 'archive', array(
          'label'                     => _x( 'Arkiverade', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => true,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Arkiverade <span class="count">(%s)</span>', 'Arkiverade <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'sodran_v2_custom_post_status' );

function sodran_v2_append_post_status_list(){
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'post'){
          if($post->post_status == 'archive'){
               $complete = " selected='selected'";
               $label = "<span id='post-status-display'> Arkiverad</span>";
          }

          $optionStr = "<option value='archive' ".$complete.">Arkiverad</option>";

          echo '
          <script>
          jQuery(document).ready(function($){
               $("select#post_status").append($("'.$optionStr.'"));
               $(".misc-pub-section #post-status-display").append("'.$label.'");
          });
          </script>
          ';

     }
}
add_action('admin_footer-post.php', 'sodran_v2_append_post_status_list');

