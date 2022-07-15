<?php
/**
 *
 * @package sodran_v2
 */

 /**
* Add excerpt to pages
*/
function sodran_v2_add_excerpts_to_pages() {
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'sodran_v2_add_excerpts_to_pages');


//Protect postIDs from deleting
function sodran_v2_restrict_page_deletion($post_ID){
    $restricted_pages = array(212);
    if(in_array($post_ID, $restricted_pages)){
        echo "You are not authorized to delete this page.";
        exit;
    }
}
add_action('wp_trash_post', 'sodran_v2_restrict_page_deletion', 10, 1);
add_action('before_delete_post', 'sodran_v2_restrict_page_deletion', 10, 1);
