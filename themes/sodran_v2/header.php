<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sodran_v2
 */

?><!DOCTYPE html>
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="ie ie8"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="ie ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<link rel="profile" href="http://gmpg.org/xfn/11">

<title>
  <?php
    $headtitle;
    if(is_page_type('start-evenemang-page-type') || is_page_type('list-evenemang-page-type') ){
      $headtitle = 'På scen';
    } elseif(is_category()) {
      $headtitle = get_the_archive_title() . ' | På scen';
    } elseif(is_search()) {
      $headtitle = 'Sök';
    } elseif(is_404()) {
      $headtitle = 'Error';
    } else {
      $headtitle = get_the_title();
    }

  echo $headtitle . ' | ' . get_bloginfo('name');

  ?>
</title>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<?php
$custom_img = papi_get_field('share_img');

if(is_category()) {
  $custom_img = papi_get_term_field('share_img');
}

$og_img = array('');

if(!empty($custom_img)) {
  $og_img = wp_get_attachment_image_src( $custom_img->id , 'large', false, '' );
} elseif(!is_category()) {
  $og_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false, '' );
}

$og_img_url = $og_img[0];

if(empty($og_img_url)){
  $og_img_url = get_template_directory_uri() . '/dist/images/share_default.jpg';
}

$og_description = "Sveriges internationella scen för musik, teater och debatt";
$og_desc_share = papi_get_field('share_desc');
$og_desc_preamble = papi_get_field('preamble');
$og_desc_slide = papi_get_field('slide_preamble');
$og_desc_excerpt = get_the_excerpt();

if(is_category()) {
  $og_desc_share = papi_get_term_field('share_desc');
}

if(!empty($og_desc_share)) {
  $og_description = $og_desc_share;
} elseif(!empty($og_desc_preamble)) {
  $og_description = $og_desc_preamble;
} elseif(!empty($og_desc_slide) && !is_array($og_desc_slide)) {
  $og_description = $og_desc_slide;
} elseif(!empty($og_desc_excerpt)) {
  $og_description = $og_desc_excerpt;
}

$og_url = get_the_permalink();

?>
<meta property="og:title" content="<?= $headtitle . ' | ' . get_bloginfo('name'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $og_url; ?>">
<meta property="og:image" content="<?= $og_img_url; ?>">
<meta property="og:site_name" content="Södra Teatern">
<meta property="og:description" content="<?= $og_description; ?>">

<meta name="description" content="<?= $og_description; ?>">
<meta name="google" value="notranslate">

<script src="https://use.typekit.net/lfq6qhe.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>



<?php the_papi_option('header_scripts') ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!-- cookies -->
  <?php include(locate_template('modules/cookie-bar.php')); ?>




  <!-- mobile menu button -->
  <button class="js-expand-menu hamburger-btn hamburger-btn--mobile hide--sbp" aria-controls="menu" aria-expanded="false">
    <span class="visually-hidden">Meny</span>
    <div class="ham-wrap">
      <span class="hamburger"></span>
      <span class="hamburger-after"></span>
      <span class="hamburger-before"></span>
    </div>
  </button>

  <button class="js-popup search-btn search-btn--mobile hide--sbp" data-popup="popup--search">
    <span class="visually-hidden">Sök</span>
    <span class="icon icon--search-gray"></span>
  </button>


  <div id="menu">
  	<div class="menu-bar" role="menubar">

  		<div class="menu-bar__item">
  			<button class="js-expand-menu hamburger-btn" aria-controls="menu" aria-expanded="false">
          <span class="visually-hidden">Meny</span>
          <div class="ham-wrap">
            <span class="hamburger"></span>
            <span class="hamburger-after"></span>
            <span class="hamburger-before"></span>
          </div>
  			</button>
  		</div>
  		<div class="menu-bar__item">
  			<button class="js-popup search-btn" data-popup="popup--search"><span class="visually-hidden">Sök</span><span class="icon icon--search-gray"></span></button>
  		</div>

<?php if( is_page_type('evenemang-page-type') && !is_search() ) : ?>
      <div class="menu-bar__item">
          <button class="js-expand-related related-btn" aria-controls="related" aria-expanded="false">
              <span class="visually-hidden">Relaterade artister</span>
              <span class="icon icon--related-gray"></span>
          </button>
      </div>
<?php endif; ?>

  		<div class="menu-bar__item menu-bar__item--stretch breadcrumbs" role="navigation" aria-label="Du är här:">
  			<div class="breadcrumbs__wrapper">
          <?php
            global $post;
            if ( is_page() && $post->post_parent ) :
          ?>
            <a class="breadcrumbs__link" href="<?= get_the_permalink( $post->post_parent ); ?>"><?= get_the_title( $post->post_parent ); ?> </a>
            <span class="breadcrumbs__link is-active"> / </span>
          <?php elseif( is_page_type('evenemang-page-type') && !is_search() ) : ?>
            <a class="breadcrumbs__link" href="<?= get_bloginfo('url'); ?>/evenemang/">På scen</a>
            <span class="breadcrumbs__link is-active"> / </span>
          <?php elseif( is_singular('stories') && !is_search() ) : ?>
            <a class="breadcrumbs__link" href="<?= get_bloginfo('url'); ?>/sodran-stories/">Södran stories</a>
            <span class="breadcrumbs__link is-active"> / </span>
          <?php endif; ?>

          <?php if(is_search()) : ?>
            <span class="breadcrumbs__link is-active">
    						<span class="visually-hidden">Aktuell sida:</span>
    						Sök
    				</span>
          <?php elseif(is_category()) : ?>
            <span class="breadcrumbs__link is-active">
                <span class="visually-hidden">Aktuell sida:</span>
                <?= get_the_archive_title(); ?>
            </span>
          <?php else : ?>
    				<span class="breadcrumbs__link is-active">
    						<span class="visually-hidden">Aktuell sida:</span>
    						<?= get_the_title($post->ID); ?>
    				</span>
          <?php endif; ?>

  			</div>
  		</div>
  	</div>

  	<nav id="js-menu-content" class="menu-content" aria-hidden="true" role="menu">

  		<div class="menu-content__wrapper">

        <?php sodran_v2_clean_custom_menu('primary'); ?>

  			<ul class="nav">
          <?php
            $secondary_menu = wp_get_nav_menu_items('Secondary Navigation');
            foreach($secondary_menu as $item) :
              if(!$item->menu_item_parent) :
                $target = !empty( $item->target) ? 'target="' . $item->target . '"' : '';
                $classes = !empty( $item->classes) ? implode(' ', $item->classes) : '';
          ?>
  				    <li class="nav__item js-menu-item">
                <a class="nav__link <?=$classes?>" 
                    href="<?= $item->url; ?>" 
                    <?=$target?> 
                >
                      <?= $item->title; ?>
                </a>
              </li>
          <?php
              endif;
            endforeach;
          ?>
  			</ul>

  	</div>

    <!-- footer -->
    <div class="menu-content__footer">
        <a href="tel:+46848004400" class="link--tel" rel="nofollow noreferrer">
          <span class="visually-hidden">Ring oss på:</span>08-480 044 00
        </a>
        <?php if( is_page_type('start-mat-page-type') || is_page_type('mat-page-type') ) : ?>
          <a href="https://www.facebook.com/MosebackeEtablissement" class="link--social icon icon--facebook">
            <span class="visually-hidden">Besök oss på Facebook</span>
          </a>
          <a href="https://www.instagram.com/mosebackeetablissement/" class="link--social icon icon--instagram">
            <span class="visually-hidden">Besök oss på Instagram</span>
          </a>
        <?php else: ?>
          <a href="https://www.facebook.com/SodraTeatern/" class="link--social icon icon--facebook">
            <span class="visually-hidden">Besök oss på Facebook</span>
          </a>
          <a href="https://twitter.com/sodrateatern" class="link--social icon icon--twitter">
            <span class="visually-hidden">Besök oss på Twitter</span>
          </a>
          <a href="http://instagram.com/sodra_teatern/" class="link--social icon icon--instagram">
            <span class="visually-hidden">Besök oss på Instagram</span>
          </a>
        <?php endif; ?>
        <a href="mailto:info@sodrateatern.com" class="link--social icon icon--mail">
          <span class="visually-hidden">Maila oss</span>
        </a>
    </div>


    </nav>
  </div>

  <?php if(is_page_type('start-evenemang-page-type') || is_page_type('list-evenemang-page-type') || is_category()) :
    //DO NOT under any circumstance put the sort-view inside #container, it'll get messe up because of select2
  ?>

  <div class="sort-view sort-view--mobile hide--mbp">
  	<button class="sort-view__btn js-toggle-sv-controls" aria-expanded="false" aria-controls="sv-controls">
  		<span class="closed">Sortera</span>
  		<span class="open">Klar</span>
  	</button>

  	<div id="sv-controls" class="sort-view__wrapper" aria-hidden="true">
  		<div class="sort">
  			<label class="sort__item">
  				<span class="visually-hidden">Välj föreställning</span>
  				<select id="js-control-sort--name" class="sort__select js-goto-url">
  					<option value="all" selected="selected">Alla föreställningar</option>

            <?php
              $titles = sodran_v2_get_evenemang_titles();
              foreach($titles as $title) :
            ?>
    					<option value="<?= get_the_permalink($title->post_id);?>"><?= $title->post_title;?></option>
            <?php endforeach; ?>
  				</select>
  				<span class="sort__input-icon icon icon--pointer-d"></span>
  			</label>


        <?php if(is_page_type('list-evenemang-page-type')) : // Deprecated but might still be in use?>

          <label class="sort__item">
            <span class="visually-hidden">Välj genre</span>
            <select id="js-control-sort--genre" class="sort__select">
              <option value="all">Alla genres</option>
              <?php
                $categories = get_terms(array('taxonomy' => 'category'));
                foreach($categories as $cat) :
                  $cat_name = $cat->name;
              ?>
                <option value="<?= $cat->term_id; ?>"><?= $cat_name; ?></option>

              <?php endforeach; ?>
            </select>
            <span class="sort__input-icon icon icon--pointer-d"></span>
          </label>
        <?php else : ?>
          <label class="sort__item">
            <span class="visually-hidden">Välj genre</span>
            <select id="js-control-sort--genre" class="sort__select js-goto-url">
              <?php $selected = ( is_page_type('start-evenemang-page-type') ) ? 'selected="selected"' : null; ?> 

              <option value="<?php echo get_bloginfo('url') .'/'. get_option( 'category_base' );?>" <?=$selected ?> >Alla genres</option>

              <?php
                $categories = get_terms(array('taxonomy' => 'category'));
                foreach($categories as $cat) :
                  $cat_name = $cat->name;
                  $selected = (get_queried_object_id() == $cat->term_id) ? 'selected="selected"' : null;

              ?>
                <option value="<?= get_category_link($cat->term_id); ?>" <?=$selected ?> ><?= $cat_name; ?></option>
              <?php endforeach; ?>
            </select>
            <span class="sort__input-icon icon icon--pointer-d"></span>
          </label>
        <?php endif; ?>



  			<label class="sort__item">
          <div class="sort__date">
            <?php
              $startDate = date("Y-m-d", mktime(0, 0, 0, date('m')-1, 1, date('Y')));
              $endDate = date("Y-m-d", mktime(0, 0, 0, date('m')+13, 1, date('Y')));
            ?>
            <span class="visually-hidden">Välj datum</span>
            <input id="js-control-sort--date" type="date" class="sort__input" min="<?= $startDate; ?>" max="<?= $endDate; ?>">
            <span class="sort__input-icon icon icon--calendar"></span>
          </div>
        </label>
  		</div>



      <?php if(is_page_type('list-evenemang-page-type')) : ?>
        <div class="view" aria-label="Visa som:">
          <a href="<?= get_bloginfo('url'); ?>/evenemang/" class="view__link icon icon--grid-inv">Bilder</a>
          <span class="view__link is-active icon icon--list-inv"><span class="visually-hidden">Aktuell vy: </span>Lista</span>
        </div>
      <?php else : ?>
        <div class="view" aria-label="Visa som:">
          <!-- TODO: control with ajax, toggle: is-active -->
          <button class="view__link icon icon--grid-inv js-sort-view" data-view="default" aria-pressed="false">Bilder</button>
          <button class="view__link icon icon--list-inv js-sort-view" data-view="list" aria-pressed="false">Lista</button>
        </div>
      <?php endif; ?>

  	</div>
  </div>

  <div id="selectparent" class="sort-view hide--mbp-max">
  	<div class="sort-view__wrapper table">
  		<div class="sort cell">
  			<span class="sort__title title title--small hide--lbp-max">Sortera:</span>

        <div class="sort__item">
    			<label class="visually-hidden" for="js-sort--name">
    				Välj föreställning
          </label>
  				<select id="js-sort--name" class="js-goto-url sort__select">
  					<option value="all" selected="selected">Alla föreställningar</option>
            <?php
              $titles = sodran_v2_get_evenemang_titles();
              foreach($titles as $title) :
            ?>
    					<option value="<?= get_the_permalink($title->post_id);?>"><?= $title->post_title;?></option>
            <?php endforeach; ?>
  				</select>
        </div>
    			

  			
        <div class="sort__item">
          <?php if(is_page_type('list-evenemang-page-type')) : // Deprecated but might still be in use?>

            <label class="visually-hidden" for="js-sort--genre">
              Välj genre
            </label>
            <select id="js-sort--genre">
              <option value="all">Alla genres</option>

              <?php
                $categories = get_terms(array('taxonomy' => 'category'));
                foreach($categories as $cat) :
                  $cat_name = $cat->name;
              ?>
                <option value="<?= $cat->term_id; ?>"><?= $cat_name; ?></option>
              <?php endforeach; ?>
            </select>

          <?php else : ?>

            <label class="visually-hidden" for="js-sort--genre">
              Välj genre
            </label>
            <select id="js-sort--genre" class="js-goto-url sort__select">
              <?php $selected = ( is_page_type('start-evenemang-page-type') ) ? 'selected="selected"' : null; ?> 
              <option value="<?php echo get_bloginfo('url') .'/'. get_option( 'category_base' );?>" <?=$selected ?> >Alla genres</option>
              
              <?php
                $categories = get_terms(array('taxonomy' => 'category'));
                foreach($categories as $cat) :
                  $cat_name = $cat->name;
                  $selected = (get_queried_object_id() == $cat->term_id) ? 'selected="selected"' : null;

              ?>
                <option value="<?= get_category_link($cat->term_id); ?>" <?=$selected ?> ><?= $cat_name; ?></option>

              <?php endforeach; ?>
            </select> 
              
          <?php endif; ?>
          
        </div>

        <div class="sort__item">
          <div class="sort__date">
            <label class="visually-hidden" for="js-sort--date">
              Välj datum, inmatningsformat är ÅÅÅÅ-MM-DD
            </label>

            <input id="js-sort--date" type="text" class="sort__input" placeholder="Välj datum">
            <span class="sort__input-icon icon icon--pointer-d"></span>
          </div>
        </div>
  		</div>

      <?php if(is_page_type('list-evenemang-page-type')) : ?>
        <div class="view cell" aria-label="Visa som:">
          <a href="<?= get_bloginfo('url'); ?>/evenemang/" class="view__link icon icon--grid-inv">Bilder</a>
          <span class="view__link is-active icon icon--list-inv"><span class="visually-hidden">Aktuell vy: </span>Lista</span>
        </div>
      <?php else : ?>
        <div class="view cell" aria-label="Visa som:">
          <!-- TODO: control with ajax, toggle: is-active -->
          <button class="view__link icon icon--grid-inv js-sort-view" data-view="default" aria-pressed="false">Bilder</button>
          <button class="view__link icon icon--list-inv js-sort-view" data-view="list" aria-pressed="false">Lista</button>
        </div>
      <?php endif; ?>
  	</div>
  </div>

  <?php endif; ?>
