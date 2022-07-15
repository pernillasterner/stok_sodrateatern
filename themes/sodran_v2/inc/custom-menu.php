<?php
/**
 * sodran_v2 Theme Customizer.
 *
 * @package sodran_v2
 */


function sodran_v2_clean_custom_menu( $theme_location ) {
  global $post;
  $post_id = $post->ID;

    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul class="nav nav--'.$theme_location.'">' ."\n"; //open menu

        $count = 0;
        $submenu = false;
        $current_parent_id = "";


        //Loop through once to find current parent ID
        foreach( $menu_items as $menu_item) {
          $item_id = $menu_item->object_id;

          if($post_id == $item_id) {
            $current_parent_id = $menu_item->menu_item_parent;
            break;
          }
        }

        //Loop through it all
        foreach( $menu_items as $menu_item ) {
            $link = $menu_item->url;
            $title = $menu_item->title;
            $item_id = $menu_item->object_id;


            //FIRST LEVEL MENU ITEM
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;

                $menu_list .= '<li class="nav__item js-menu-item">' ."\n"; //open first li

                $parent_link = $link;
                $parent_title = $title;

                if( $post_id == $item_id || $current_parent_id == $parent_id ) {
                  $menu_list .= '<a href="'.$link.'" class="nav__link is-active">'.$title.'</a>' ."\n";

                } else {
                  $menu_list .= '<a href="'.$link.'" class="nav__link">'.$title.'</a>' ."\n";
                }
            }



            //SECOND LEVEL MENU ITEM
            if ( $parent_id == $menu_item->menu_item_parent ) {
                if ( !$submenu ) {
                    $submenu = true;

                    if($current_parent_id == $parent_id  ) {
                      $menu_list .= '<span class="nav__expand-btn js-expand" role="button" tabindex="0" aria-expanded="true" aria-controls="parent-'.$parent_id.'">';

                    } else {
                      $menu_list .= '<span class="nav__expand-btn js-expand" role="button" tabindex="0" aria-expanded="false" aria-controls="parent-'.$parent_id.'">';
                    }

                    $menu_list .= '<span class="closed visually-hidden">Visa undermeny</span>';
                    $menu_list .= '<span class="open visually-hidden">Dölj undermeny</span>';
                    $menu_list .= '</span>';

                    if($current_parent_id == $parent_id) {
                      $menu_list .= '<ul id="parent-'.$parent_id.'" class="nav nav--sub is-open" aria-hidden="false">' ."\n";

                    } else {
                      $menu_list .= '<ul id="parent-'.$parent_id.'" class="nav nav--sub" aria-hidden="true">' ."\n";

                    }
                }


                $menu_list .= '<li class="nav__item">' ."\n";

                if($post_id == $item_id) {
                  $menu_list .= '<a href="'.$link.'" class="nav__link is-active icon icon--current">'.$title.'</a>' ."\n";
                } else {
                  $menu_list .= '<a href="'.$link.'" class="nav__link">'.$title.'</a>' ."\n";
                }

                $menu_list .= '</li>' ."\n";


                if ( $menu_items[ $count + 1 ] && $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }

            }




            if ( $menu_items[ $count + 1 ] && $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) {
                $menu_list .= '</li>' ."\n"; //close first li
                $submenu = false;
            }

            $count++;
        }

        $menu_list .= '</ul>' ."\n"; //close menu

    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}
