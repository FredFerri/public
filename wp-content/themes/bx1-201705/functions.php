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
  add_image_size( 'Newsletter', 260, 99999, false );
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









// Add Shortcode
function twitter_feed( $atts ) {
  // Attributes
  $twitter_feed_atts = shortcode_atts(
    array(
      'tweetnumber' => '6',
      'hashtag' => '',
    ),
    $atts );

  $output = display_twitter( $twitter_feed_atts[ 'tweetnumber' ], $twitter_feed_atts[ 'hashtag' ]);
  return $output;
}
add_shortcode( 'twitterfeed', 'twitter_feed' );









add_shortcode('gallery', 'my_gallery_shortcode');
function my_gallery_shortcode($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) )
      $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
  }

  // Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ( $output != '' )
    return $output;

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
      unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'li',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);
  if ( 'RAND' == $order )
    $orderby = 'none';

  if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag = tag_escape($itemtag);
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) )
  $itemtag = 'li';

  $selector = "gallery-{$instance}";

  $gallery_style = $gallery_div = '';

  $size_class = sanitize_html_class( $size );
  $gallery_div = "<ul class='clearing-thumbs small-block-grid-2 medium-block-grid-3 large-block-grid-{$columns}' data-clearing>";
  $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {
    $link = '<a href="'.wp_get_attachment_url($id).'"><img data-caption="'. wptexturize($attachment->post_excerpt) .'" src="'.wp_get_attachment_thumb_url($id).'" alt="" /></a>';
    $output .= "<{$itemtag}>";
    $output .= "$link";
    $output .= "</{$itemtag}>";
  }

  $output .= "</ul>\n";

  return $output;
}

remove_action('wp_head', 'wp_generator');

// Custom maintenance page
add_filter('wpmm_text', 'wdm_text');
function wdm_text($text){
    $text = '<div class="wdm-wrap" style="line-height:1.4;font-size:0.75em;"><p>L’été se termine doucement, BX1 en profite pour mettre à jour son site internet, et l’embellir en vue de la prochaine saison !<br/>Retrouvez toutes les informations en direct et le meilleur de l’actualité bruxelloise dans quelques heures sur votre nouveau BX1.be<br/><br/></p><script src="https://bx1.developpement.defimedia.be/wp-content/themes/BX1-2017/js/jwplayer/jwplayer.js"></script>
<script>jwplayer.key="uV+9Z88Ot1pSaRYTCyutEuffNeCwl8SCX1R0uQ==";</script>
<script src="https://content.jwplatform.com/libraries/Neb1cMqn.js"></script><p><div onmouseover="jwplayer().setVolume(100)"><div id="videoLive"></div></p></div>
<script>jwplayer("videoLive").setup({playlist:[{sources:[{file:"rtmp://149.202.81.107:1935/stream/live"},{file:"rtmp://149.202.81.107:1935/stream/live/playlist.m3u8",type:"mp4"}]}],primary:"html5",flashplayer:"https://bx1.be/wp-content/themes/BX1-2017/js/jwplayer/jwplayer.flash.swf",width:"100%",aspectratio:"16:9",autostart:true,androidhls:true,autostart:true,mute:true,advertising:{client:"vast",schedule:{adbreak1:{offset:"pre",tag:"https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t="+Math.floor(Date.now()/1000)},adbreak2:{offset:"post",tag:"https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t="+Math.floor(Date.now()/1000)}}}});</script><p><br/>Plus d’infos sur <a href="https://www.facebook.com/BX1officiel/">Facebook</a><br/> L’actualité en direct sur <a href="https://twitter.com/BX1_Actu">Twitter</a><br/>Nos vidéos sur <a href="https://www.youtube.com/user/TeleBruxelles">Youtube</a></p><p><br/><br/>Pour capter BX1 TV : TNT canal 55 (746 Mhz en polarisation verticale) | Proximus TV : Canal 25 | VOO et SFR : Canal 61</p></div>';
    return $text;
}
