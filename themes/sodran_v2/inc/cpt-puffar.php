<?php
/**
 * Custom post type: puffar
 *
 * @package sodran_v2
 */
function sodran_v2_puffar() {

	$labels = array(
		'name'                => 'Puffar',
		'singular_name'       => 'Puff',
		'menu_name'           => 'Puffar',
		'all_items'           => 'Alla puffar',
		'view_item'           => 'Visa',
		'add_new_item'        => 'Lägg till ny puff',
		'add_new'             => 'Skapa nytt',
		'edit_item'           => 'Redigera',
		'update_item'         => 'Uppdatera',
		'search_items'        => 'Sök',
		'not_found'           => 'Hittade inte',
		'not_found_in_trash'  => 'Hittade inte i papperskorgen',
	);
	$args = array(
		'label'               => 'puff',
		'description'         => 'Puffar som kan användas på angivna platser på andra sidor',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail'),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'puff', $args );

}

// Hook into the 'init' action
add_action( 'init', 'sodran_v2_puffar', 0 );

// Register Custom Taxonomy
function sodran_v2_puff_taxonomy() {

	$labels = array(
		'name'                       => 'Puff kategorier',
		'singular_name'              => 'Puff kategori',
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
	);
	register_taxonomy( 'puff_categories', array( 'puff' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'sodran_v2_puff_taxonomy', 0 );
