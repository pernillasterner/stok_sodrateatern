<?php
/**
 * Custom post type: stories
 *
 * @package sodran_v2
 */
function sodran_v2_stories() {

	$labels = array(
		'name'                => 'Stories',
		'singular_name'       => 'Story',
		'menu_name'           => 'Södran Stories',
		'all_items'           => 'Alla stories',
		'view_item'           => 'Visa',
		'add_new_item'        => 'Lägg till ny story',
		'add_new'             => 'Skapa nytt',
		'edit_item'           => 'Redigera',
		'update_item'         => 'Uppdatera',
		'search_items'        => 'Sök',
		'not_found'           => 'Hittade inte',
		'not_found_in_trash'  => 'Hittade inte i papperskorgen',
	);
	$args = array(
		'label'               => 'stories',
		'description'         => 'Södran stories',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'stories', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sodran_v2_stories', 0 );

// Register Custom Taxonomy
function sodran_v2_stories_taxonomy() {

	$labels = array(
		'name'                       => 'Story kategorier',
		'singular_name'              => 'Story kategori',
		'menu_name'                  => 'Kategorier',
		'all_items'                  => 'Alla kategorier',
		'parent_item'                => 'Förälder',
		'parent_item_colon'          => 'Förälder:',
		'new_item_name'              => 'Namn',
		'add_new_item'               => 'Lägg till ny kategori',
		'edit_item'                  => 'Redigera',
		'update_item'                => 'Uppdatera',
		'separate_items_with_commas' => 'Sepparera med komma',
		'search_items'               => 'Sök',
		'add_or_remove_items'        => 'Lägg till eller ta bort',
		'choose_from_most_used'      => 'Välj från mest använda',
		'not_found'                  => 'Hittar inte',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
    'rewrite'                    => false
	);
	register_taxonomy( 'story_categories', array( 'stories' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'sodran_v2_stories_taxonomy', 0 );
