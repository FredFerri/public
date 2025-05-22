<?php
/**
 * TeleBruxelles functions and definitions
 *
 * @package TeleBruxelles
 */

require_once('inc/widgets.php');
require_once('inc/shortcodes.php');


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
   $content_width = 640; /* pixels */
}

if ( ! function_exists( 'telebruxelles_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function telebruxelles_setup() {

   /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on TeleBruxelles, use a find and replace
    * to change 'telebruxelles' to the name of your theme in all the template files
    */
   load_theme_textdomain( 'telebruxelles', get_template_directory() . '/languages' );

   // Add default posts and comments RSS feed links to head.
   add_theme_support( 'automatic-feed-links' );

   /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
   //add_theme_support( 'post-thumbnails' );

   // This theme uses wp_nav_menu() in one location.
   register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'telebruxelles' ),
   ) );

   /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
   add_theme_support( 'html5', array(
      'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
   ) );

   /*
    * Enable support for Post Formats.
    * See http://codex.wordpress.org/Post_Formats
    */
   // add_theme_support( 'post-formats', array(
   //    'aside', 'image', 'video', 'quote', 'link'
   // ) );
}
endif; // telebruxelles_setup
add_action( 'after_setup_theme', 'telebruxelles_setup' );

/**
 * Unregister all widgets.
 */
 function unregister_default_widgets() {
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function telebruxelles_widgets_init() {
   register_sidebar( array(
      'id'            => 'sidebar-1',
      'name'          => __( 'Sidebar', 'telebruxelles' ),
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h2 class="section-title section-title--sidebar">',
      'after_title'   => '</h2>',
   ) );
    register_sidebar(array(
      'id'            => 'info-bar',
      'name'          => __( 'Barre info', 'telebruxelles' ),
      'description'   => __( 'Barre info', 'telebruxelles' ),
      'before_widget' => '<div class="row"><div id="%1$s" class="widget %2$s large-12 columns">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h2 class="hide">',
      'after_title'   => '</h2>'
    ) );
}
add_action( 'widgets_init', 'telebruxelles_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function telebruxelles_scripts() {
   wp_enqueue_style( 'telebruxelles-style', get_stylesheet_uri() );

   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
   }
}
add_action( 'wp_enqueue_scripts', 'telebruxelles_scripts' );



/**
 * Custom active class.
 */
function my_page_css_class( $css_class, $page ) {
    global $post;
    if ( $post->ID == $page->ID ) {
        $css_class[] = 'active';
    }
    return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );



/**
 * Add custom parent class for menu item.
 */
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

  $parents = array();
  foreach ( $items as $item ) {
    if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
      $parents[] = $item->menu_item_parent;
    }
  }

  foreach ( $items as $item ) {
    if ( in_array( $item->ID, $parents ) ) {
      $item->classes[] = 'has-dropdown not-click';
    }
  }

  return $items;
}



/**
 * Add custom class for ul.sub-menu.
 */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu dropdown\">\n";
  }
}


/**
 * Enable Featured Image.
 */
add_theme_support('post-thumbnails');



/**
 * Custom image size.
 */
function telebruxelles_custom_image () {
  add_image_size( 'Logo', 150, 150, false );
  add_image_size( 'Square', 600, 600, true );
  add_image_size( 'Rectangle', 356, 175, false );
  add_image_size( 'Header image', 384, 216, true );
  add_image_size( 'Widget info image', 784, 441, true );
  add_image_size( 'Emissions', 380, 148, true );
  add_image_size( 'Concours', 250, 350, true );
}
add_action( 'after_setup_theme', 'telebruxelles_custom_image' );

function my_auto_excerpt_more( $more ) {
  return ' <span class="more-link-ellipsis">&hellip; </span><a href="' . get_permalink() . '" class="more-link more-link--depeches">lire plus</a>';
}
add_filter( 'excerpt_more', 'my_auto_excerpt_more' );



/**
 * Share
 *
 */
function share(){
  global $post;
  $html = '<ul class="social-share inline-list">
              <li class="twitter">
                  <a target="_blank" href="http://twitter.com/home?status=' . urlencode(get_the_title()) . '%20' . get_permalink() . '" class="hero-btn-twitter">
                    <svg class="footer__icon"><use xlink:href="#icon-twitter" /></svg>
                  </a>
              </li>
              <li class="fb">
                  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '" class="hero-btn-facebook">
                    <svg class="footer__icon"><use xlink:href="#icon-facebook" /></svg>
                  </a>
              </li>
              <li class="gplus">
                  <a target="_blank" href="https://plus.google.com/share?url=' . get_permalink() . '" title="Partager sur Google Plus" class="hero-btn-gplus">
                    <svg class="footer__icon"><use xlink:href="#icon-gplus" /></svg>
                   </a>
              </li>
          </ul>';
  return $html;
}


add_filter( 'taxonomy-images-disable-public-css', '__return_true' );

add_action('wp_enqueue_scripts', 'remove_useless_stuff', 20);
function remove_useless_stuff() {
    if (!is_admin()) {
        wp_dequeue_style('views-pagination-style');
        wp_dequeue_style('cookielawinfo-style');
        wp_dequeue_script('views-pagination-script');
        wp_dequeue_script('jquery-ui-datepicker');
    }
}



/**
 * Used by hook: 'customize_preview_init'
 *
 * @see add_action('customize_preview_init',$func)
 */
function mytheme_customizer_live_preview()
{
  wp_enqueue_script(
    'mytheme-themecustomizer',      //Give the script an ID
    get_template_directory_uri().'/js/theme-customizer.js',//Point to file
    array( 'jquery','customize-preview' ),  //Define dependencies
    '',           //Define a version (optional)
    true            //Put script in footer?
  );
}
add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );

remove_action('wp_head', 'wp_generator');
