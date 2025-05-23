<?php

/* Retrait des émojis */
/*add_action( 'init', 'disable_wp_emojicons' );
function disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
  add_filter( 'emoji_svg_url', '__return_false' );
}*/

require_once('inc/widgets.php');
require_once('inc/shortcodes.php');
require_once('inc/functions/image.php');

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype($output) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
    global $post;
    if (!is_singular()) //if it is not a post or a page
        return;
    echo '<meta property="fb:app_id" content="133949403437045" />';
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:url" content="' . get_permalink() . '"/>';
    echo '<meta property="og:site_name" content="BX1"/>';
    if (!has_post_thumbnail($post->ID)) { //the post does not have featured image, use a default image
        $default_image = "https://bx1.be/wp-content/themes/BX1-2017/img/logo.png"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    } else {
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
        echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '"/>';
    }
    echo "
";
}
add_action('wp_head', 'insert_fb_in_head', 5);


if (!function_exists('bx1_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function bx1_setup() {

        /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on TeleBruxelles, use a find and replace
    * to change 'telebruxelles' to the name of your theme in all the template files
    */
        load_theme_textdomain('telebruxelles', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
        //add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in 2 locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu'),
            'second' => __('Second Menu'),
            'footer1' => __('Footer 1'),
            'footer2' => __('Footer 2'),
            'footer3' => __('Footer 3'),
            'footer4' => __('Footer 4'),
            'app' => __('App')
        ));

        /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));

        /*
    * Enable support for Post Formats.
    * See http://codex.wordpress.org/Post_Formats
    */
        // add_theme_support( 'post-formats', array(
        //    'aside', 'image', 'video', 'quote', 'link'
        // ) );
    }
endif; // telebruxelles_setup
add_action('after_setup_theme', 'bx1_setup');

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
function bx1_widgets_init() {
    register_sidebar(array(
        'id'            => 'sidebar-1',
        'name'          => __('Sidebar', 'teleBruxelles'),
        'description'   => __('Sidebar 1', 'teleBruxelles'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="section-title section-title--sidebar">',
        'after_title'   => '</h2>',
    ));
    $twitter = 'twitterUnder';
    if (get_option('twitter_pos') == 'inside') {
        $twitter = 'twitterInside';
    }
    register_sidebar(array(
        'id'            => 'filinfo',
        'name'          => __('Fil info', 'teleBruxelles'),
        'description'   => __('Fil info', 'teleBruxelles'),
        'before_widget' => '<div class="filinfo ' . $twitter . '">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
    register_sidebar(array(
        'id'            => 'footer',
        'name'          => __('Footer', 'teleBruxelles'),
        'description'   => __('Footer', 'teleBruxelles'),
        'before_widget' => '',
        'after_widget'  => '',
    ));
    register_sidebar(array(
        'id'            => 'footer2',
        'name'          => __('Footer 2', 'teleBruxelles'),
        'description'   => __('Footer 2', 'teleBruxelles'),
        'before_widget' => '',
        'after_widget'  => '',
    ));


    register_sidebar(array(
        'id'            => 'filinfo2',
        'name'          => __('Fil info 2', 'teleBruxelles'),
        'description'   => __('Fil info 2', 'teleBruxelles'),
        'before_widget' => '<div style="position:relative;" class="filinfo ' . $twitter . '">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'id'            => 'sidebar-3',
        'name'          => __('Sidebar 3', 'teleBruxelles'),
        'description'   => __('Sidebar 3', 'teleBruxelles'),
        'before_widget' => '<div style="position:relative;" class="filinfo ' . $twitter . '">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}
add_action('widgets_init', 'bx1_widgets_init');




/**
 * Enqueue scripts and styles.
 */
function telebruxelles_scripts() {
    wp_enqueue_style('telebruxelles-style', get_stylesheet_uri());

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'telebruxelles_scripts');



/**
 * Custom active class.
 */
function my_page_css_class($css_class, $page) {
    global $post;
    if ($post->ID == $page->ID) {
        $css_class[] = 'active';
    }
    return $css_class;
}
add_filter('page_css_class', 'my_page_css_class', 10, 2);



/**
 * Add custom parent class for menu item.
 */
add_filter('wp_nav_menu_objects', 'add_menu_parent_class');
function add_menu_parent_class($items) {

    $parents = array();
    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'has-dropdown not-click';
        }
    }

    return $items;
}


/**
 * Enable Featured Image.
 */
add_theme_support('post-thumbnails');



/**
 * Custom image size.
 */
function telebruxelles_custom_image() {
    add_image_size('Logo', 150, 150, false);
    add_image_size('Big News', 1280, 1280, false);
    add_image_size('Square', 600, 600, true);
    add_image_size('Rectangle', 356, 175, false);
    add_image_size('Header image', 384, 216, true);
    add_image_size('Widget info image', 784, 441, true);
    add_image_size('Emissions', 380, 148, true);
    add_image_size('Concours', 250, 350, true);
    add_image_size('Newsletter', 260, 99999, false);
    add_image_size('Mire', 96, 96, true);
    add_image_size('FacebookHeader', 1350, 759, true);
}
add_action('after_setup_theme', 'telebruxelles_custom_image');

function my_auto_excerpt_more($more) {
    return ' <span class="more-link-ellipsis">&hellip; </span><a href="' . get_permalink() . '" class="more-link more-link--depeches">lire plus</a>';
}
add_filter('excerpt_more', 'my_auto_excerpt_more');



/**
 * Share
 *
 */
function share() {
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


add_filter('taxonomy-images-disable-public-css', '__return_true');

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
function mytheme_customizer_live_preview() {
    wp_enqueue_script(
        'mytheme-themecustomizer',      //Give the script an ID
        get_template_directory_uri() . '/js/theme-customizer.js', //Point to file
        array('jquery', 'customize-preview'),  //Define dependencies
        '',           //Define a version (optional)
        true            //Put script in footer?
    );
}
add_action('customize_preview_init', 'mytheme_customizer_live_preview');









// Add Shortcode
function twitter_feed($atts) {
    // Attributes
    $twitter_feed_atts = shortcode_atts(
        array(
            'tweetnumber' => '6',
            'hashtag' => '',
        ),
        $atts
    );

    $output = display_twitter($twitter_feed_atts['tweetnumber'], $twitter_feed_atts['hashtag']);
    return $output;
}
add_shortcode('twitterfeed', 'twitter_feed');

add_action('rest_api_init', 'slug_register_post_video');
function slug_register_post_video() {
    register_rest_field(
        'post',
        'wpcf-video-name-news',
        array(
            'get_callback' => 'slug_get_field',
            'update_callback' => null,
            'schema' => null,
        )
    );
}
add_action('rest_api_init', 'slug_register_post_featured');
function slug_register_post_featured() {
    register_rest_field(
        'post',
        'wpcf-featured-news',
        array(
            'get_callback' => 'slug_get_field',
            'update_callback' => null,
            'schema' => null,
        )
    );
}
add_action('rest_api_init', 'slug_register_post_flash');
function slug_register_post_flash() {
    register_rest_field(
        'post',
        'wpcf-flash-news',
        array(
            'get_callback' => 'slug_get_field',
            'update_callback' => null,
            'schema' => null,
        )
    );
}
function slug_get_field($object, $field_name, $request) {
    return get_post_meta($object['id'], $field_name, true);
}

/* Page des options custom dans l'admin */
add_action('admin_menu', 'add_global_custom_options');
function add_global_custom_options() {
    add_menu_page('Options de présentation BX1', 'Options de présentation BX1', 'manage_categories', 'bx1-options', 'bx1_admin_options', '', 75);
}
function bx1_load_scripts() {
    wp_enqueue_script('admin_wp', '/wp-content/themes/BX1-2017/js/admin_wp.js');
}
add_action('admin_enqueue_scripts', 'bx1_load_scripts');
function bx1_admin_options() {
    if (isset($_POST['show_meteo'])) {
        update_option('show_meteo', $_POST['show_meteo']);
        $value_show_meteo = $_POST['show_meteo'];
    }
    $value_show_meteo = get_option('show_meteo');

    if (isset($_POST['video_source'])) {
        update_option('video_source', $_POST['video_source']);
        $value_svideo_source = $_POST['video_source'];
    }
    $value_video_source = get_option('video_source');

    if (isset($_POST['vimeolink'])) {
        update_option('vimeolink', $_POST['vimeolink']);
        $value_vimeolink = $_POST['vimeolink'];
    }
    $value_vimeolink = get_option('vimeolink');

    if (isset($_POST['show_subtitles'])) {
        update_option('show_subtitles', $_POST['show_subtitles']);
        $value_show_subtitles = $_POST['show_subtitles'];
    }
    $value_show_subtitles = get_option('show_subtitles');

    if (isset($_POST['show_pubmobile'])) {
        update_option('show_pubmobile', $_POST['show_pubmobile']);
        $value_show_pubmobile = $_POST['show_pubmobile'];
    }
    $value_show_pubmobile = get_option('show_pubmobile');

    if (isset($_POST['home_site'])) {
        update_option('home_site', $_POST['home_site']);
        $value_home_site = $_POST['home_site'];
    }
    $value_home_site = get_option('home_site');

    if (isset($_POST['home_app'])) {
        update_option('home_app', $_POST['home_app']);
        $value_home_app = $_POST['home_app'];
    }
    $value_home_app = get_option('home_app');

    if (isset($_POST['home_pres'])) {
        update_option('home_pres', $_POST['home_pres']);
        $value_home_pres = $_POST['home_pres'];
    }
    $value_home_pres = get_option('home_pres');

    if (isset($_POST['twitter_pos'])) {
        update_option('twitter_pos', $_POST['twitter_pos']);
        $value_twitter_pos = $_POST['twitter_pos'];
    }
    $value_twitter_pos = get_option('twitter_pos');

    echo '<h1>Options de présentation BX1</h1><br/>';
    echo '<form method="POST">';

    echo '<h2>Affichage de la page d\'accueil</h2>';

    echo '<label for="show_meteo" style="width:150px;display:inline-block;">Afficher la météo</label>';
    echo '<select id="show_meteo" name="show_meteo" style="width:250px;display:inline-block;"><option value="true" ' . (($value_show_meteo == 'true') ? 'selected="selected"' : '') . '>Activé</option><option value="false" ' . (($value_show_meteo == 'false') ? 'selected="selected"' : '') . '>Désactivé</option></select>&nbsp;&nbsp;Fichiers Météo pour diagnostic : <a href="https://bx1.be/wp-content/themes/BX1-2017/cache/cache.meteo.json" download="xml-de-BX1.xml">BX1</a> - <a href="https://api.openweathermap.org/data/2.5/forecast/daily?q=Brussels,be&units=metric&cnt=4&appid=ea18c0706135505149200c3836f29800" target="_blank" download="xml-de-IRM.xml">OpenWeatherMap</a> (à enregistrer et à joindre au ticket <a href="mailto:support@bx1.be?subject=Probleme%20Meteo">GLPI</a>)';

    echo '<br/><label for="show_meteo" style="width:150px;display:inline-block;">Activer la publicité sur mobile</label>';
    echo '<select id="show_pubmobile" name="show_pubmobile" style="width:250px;display:inline-block;"><option value="true" ' . (($value_show_pubmobile == 'true') ? 'selected="selected"' : '') . '>Activé</option><option value="false" ' . (($value_show_pubmobile == 'false') ? 'selected="selected"' : '') . '>Désactivé</option></select>';

    echo '<br/><label for="video_source" style="width:150px;display:inline-block;">Source video Live</label>';
    echo '<select id="video_source" name="video_source" style="width:250px;display:inline-block;"><option value="vimeo" ' . (($value_video_source == 'vimeo') ? 'selected="selected"' : '') . '>Vimeo</option><option value="wowza" ' . (($value_video_source == 'wowza') ? 'selected="selected"' : '') . '>Wowza</option></select>';

    echo '<br/><label for="video_source" style="width:150px;display:inline-block;">Lien live Vimeo</label>';
    echo '<input id="vimeolink" name="vimeolink" style="width:250px;display:inline-block;" value="' . $value_vimeolink . '">';

    echo '<br/><label for="show_meteo" style="width:150px;display:inline-block;">Activer les sous-titres sur le site</label>';
    echo '<select id="show_subtitles" name="show_subtitles" style="width:250px;display:inline-block;"><option value="true" ' . (($value_show_subtitles == 'true') ? 'selected="selected"' : '') . '>Activé</option><option value="false" ' . (($value_show_subtitles == 'false') ? 'selected="selected"' : '') . '>Désactivé</option></select>';

    echo '<br/><label for="home_site" style="width:150px;display:inline-block;">Contenu</label>';
    echo '<select id="home_site" name="home_site" style="width:250px;display:inline-block;"><option value="actu" ' . (($value_home_site == 'actu') ? 'selected="selected"' : '') . '>Actualités</option><option value="fil" ' . (($value_home_site == 'fil') ? 'selected="selected"' : '') . '>Direct info</option><option value="tv" ' . (($value_home_site == 'tv') ? 'selected="selected"' : '') . '>Direct TV</option></select>';

    echo '<br/><label for="home_pres" style="width:150px;display:inline-block;">Présentation</label>';
    echo '<select id="home_pres" name="home_pres" style="width:250px;display:inline-block;"><option value="classic" ' . (($value_home_pres == 'classic') ? 'selected="selected"' : '') . '>Classique</option><option value="news" ' . (($value_home_pres == 'news') ? 'selected="selected"' : '') . '>1re news en avant (3 colones)</option><option value="news2" ' . (($value_home_pres == 'news2') ? 'selected="selected"' : '') . '>1re news en avant (2 colones) - NE PAS ACTIVER !!</option></select>';

    /*echo '<br/><br/><label for="home_app" style="width:150px;display:inline-block;">Application</label>';
    echo '<select id="home_app" name="home_app" style="width:250px;display:inline-block;"><option value="actu" '.(($value_home_app=='actu')?'selected="selected"':'').'>Actualités</option><option value="fil" '.(($value_home_app=='fil')?'selected="selected"':'').'>Direct info</option><option value="tv" '.(($value_home_app=='tv')?'selected="selected"':'').'>Direct TV</option></select>';*/

    echo '<br/><br/><h2>Flux Twitter</h2>';

    echo '<label for="twitter_pos" style="width:150px;display:inline-block;">Position</label>';
    echo '<select id="twitter_pos" name="twitter_pos" style="width:250px;display:inline-block;"><option value="under" ' . (($value_twitter_pos == 'under') ? 'selected="selected"' : '') . '>Sous le fil info</option><option value="inside" ' . (($value_twitter_pos == 'inside') ? 'selected="selected"' : '') . '>Dans le fil info, 3e position</option><option value="hidden" ' . (($value_twitter_pos == 'hidden') ? 'selected="selected"' : '') . '>Désactivé</option></select>';

    echo '<br/><br/><div><div style="width:150px;display:inline-block;"></div><input style="width:250px;display:inline-block;" type="submit" value="Enregistrer les options" class="button button-primary button-large"></div>';
    echo '</form>';
}

if (is_user_logged_in()) {
    add_filter('body_class', 'add_role_to_body');
    add_filter('admin_body_class', 'add_role_to_body');
}
function add_role_to_body($classes) {
    $current_user = new WP_User(get_current_user_id());
    $user_role = array_shift($current_user->roles);
    if (is_admin()) {
        $classes .= 'role-' . $user_role;
    } else {
        $classes[] = 'role-' . $user_role;
    }
    return $classes;
}

// ajout des taxos dans la rest api
function bx1_add_tax_to_api() {
    $mytax = get_taxonomy('type_emissions');
    $mytax->show_in_rest = true;
    $mytax = get_taxonomy('invite');
    $mytax->show_in_rest = true;
    $mytax = get_taxonomy('type-d-evenement');
    $mytax->show_in_rest = true;
}
add_action('init', 'bx1_add_tax_to_api', 30);

function bx1_template_redirect() {
    if (is_singular('dossier') || is_singular('blog')) {
        global $wp_query;
        $page = (int)$wp_query->get('page');
        if ($page > 1) {
            $query->set('page', 1);
            $query->set('paged', $page);
        }
        remove_action('template_redirect', 'redirect_canonical');
    }
}
add_action('template_redirect', 'bx1_template_redirect', 0);

/* Ajout des médias de Gravity Forms à la library Wordpress */
add_action('gform_after_create_post', 'gf_add_to_media_library', 10, 3);

/**
 * Save file upload fields under custom post field to the library
 *
 * @param    $post_id  The post identifier
 * @param    $entry     The entry
 * @param    $form      The form
 */
function gf_add_to_media_library($post_id, $entry, $form) {
    foreach ($form['fields'] as $field) {

        //get media upload dir
        $uploads = wp_upload_dir();
        $uploads_dir = $uploads['path'];
        $uploads_url = $uploads['url'];

        //if its a custom field with input type file upload. 
        if ($field['type'] == 'post_custom_field' && $field['inputType'] == 'fileupload') {
            $entry_id = $field['id'];
            $files = rgar($entry, $entry_id);
            $custom_field = $field['wpcf-fichiers']; //custom field key

            //if file field is not empty or not []
            if ($files !== '' && $files !== "[]") {

                $patterns = ['[', ']', '"']; //get rid of crap
                $file_entry = str_replace($patterns, '', $files);
                $files = explode(',', $file_entry);

                foreach ($files as $file) {
                    //each file is a url
                    //get the filename from end of url in match[1]
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    //add to media library
                    //WordPress API for image uploads.
                    include_once(ABSPATH . 'wp-admin/includes/image.php');
                    include_once(ABSPATH . 'wp-admin/includes/file.php');
                    include_once(ABSPATH . 'wp-admin/includes/media.php');

                    $new_url = stripslashes($file);
                    $result = media_sideload_image($new_url, $post_id, $filename, 'src');
                    //saving the image to field or thumbnail

                    if (strpos($field['cssClass'], 'thumb') === false) {
                        $attachment_ids[] = (int)  get_attachment_id_from_src($result);
                    } else {
                        set_post_thumbnail($post_id, (int)  get_attachment_id_from_src($result));
                    }
                } //end foreach file
                if (isset($attachment_ids)) {
                    update_post_meta($post_id, $custom_field, $attachment_ids);
                }
            } //end if files not empty
        } //end if custom field of uploadfile
    }
} //end for each form field

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

// Multiselect dropdown category

add_filter('wp_dropdown_cats', 'wp_dropdown_cats_multiple', 10, 2);
function wp_dropdown_cats_multiple($output, $r) {
    if (isset($r['multiple']) && $r['multiple']) {
        $output = preg_replace('/^<select/i', '<select multiple', $output);
        $output = str_replace("name='{$r['name']}'", "name='{$r['name']}[]'", $output);
        foreach (array_map('trim', explode(",", $r['selected'])) as $value)
            $output = str_replace("value=\"{$value}\"", "value=\"{$value}\" selected", $output);
    }
    return $output;
}

// Custom maintenance page
add_filter('wpmm_text', 'wdm_text');
function wdm_text($text) {
    $text = '<div class="wdm-wrap" style="line-height:1.4;font-size:0.75em;"><p>L’été se termine doucement, BX1 en profite pour mettre à jour son site internet, et l’embellir en vue de la prochaine saison !<br/>Retrouvez toutes les informations en direct et le meilleur de l’actualité bruxelloise dans quelques heures sur votre nouveau BX1.be<br/><br/></p><script src="https://bx1.be/wp-content/themes/BX1-2017/js/jwplayer/jwplayer.js"></script>
<script>jwplayer.key="uV+9Z88Ot1pSaRYTCyutEuffNeCwl8SCX1R0uQ==";</script>
<script src="https://content.jwplatform.com/libraries/Neb1cMqn.js"></script><p><div onmouseover="jwplayer().setVolume(100)"><div id="videoLive"></div></p></div>
<script>jwplayer("videoLive").setup({playlist:[{sources:[{file:"rtmps://59959724487e3.streamlock.net:443/stream/live"},{file:"https://59959724487e3.streamlock.net:443/stream/live/playlist.m3u8",type:"mp4"}]}],primary:"html5",flashplayer:"https://bx1.be/wp-content/themes/BX1-2017/js/jwplayer/jwplayer.flash.swf",width:"100%",aspectratio:"16:9",autostart:true,androidhls:true,autostart:true,mute:true,advertising:{client:"vast",schedule:{adbreak1:{offset:"pre",tag:"https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t="+Math.floor(Date.now()/1000)},adbreak2:{offset:"post",tag:"https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t="+Math.floor(Date.now()/1000)}}}});</script><p><br/>Plus d’infos sur <a href="https://www.facebook.com/BX1officiel/">Facebook</a><br/> L’actualité en direct sur <a href="https://twitter.com/BX1_Actu">Twitter</a><br/>Nos vidéos sur <a href="https://www.youtube.com/user/TeleBruxelles">Youtube</a></p><p><br/><br/>Pour capter BX1 TV : TNT canal 55 (746 Mhz en polarisation verticale) | Proximus TV : Canal 25 | VOO et SFR : Canal 61</p></div>';
    return $text;
}


// remplacement des guillemets dans les titres Yoast SEO pour Facebook
// Déclarer str_replace_first et str_replace_second en dehors de la fonction my_opengraph_title pour éviter les redéclarations.
if (!function_exists('str_replace_first')) {
    function str_replace_first($from, $to, $subject) {
        $from = '/' . preg_quote($from, '/') . '/';
        return preg_replace($from, $to, $subject, 1);
    }
}

if (!function_exists('str_replace_second')) {
    function str_replace_second($from, $to, $subject) {
        $from = '/' . preg_quote($from, '/') . '/';
        return preg_replace($from, $to, $subject, 2);
    }
}

// Ajouter le filtre wpseo_opengraph_title
add_filter('wpseo_opengraph_title', 'my_opengraph_title');
function my_opengraph_title($title) {
    $title = str_replace_first('&quot;', '« ', $title);
    $title = str_replace_second('&quot;', ' »', $title);
    return $title;
}

// Autres inclusions et suppressions d'actions
include_once('daletmeta-admin-menu.php');
remove_action('wp_head', 'wp_generator');


// Fonction gérant le fonctionnement des shortcodes d'ajout de vidéo
function shortcode_video_insert($args) {

    // Échapper les valeurs pour la sécurité
    $video_title = esc_js($args['video_title']);
    if (isset($args['video_img'])) {
        $video_cover_img = esc_js($args['video_img']);
    } else {
        $video_cover_img = '';
    }
    $video_subtitle = '';
    $video_container_id = 'video-' . uniqid();
    if (!empty($video_title)) { ?>
        <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
            <div id="video"></div>
        </div>
        <?php
        ob_start();
        ?>
        <div class="video-container">
            <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer('<?php echo $video_container_id; ?>').setVolume(100);alreadyHover=1;}">
                <div id="<?php echo $video_container_id; ?>"></div>
            </div>
        </div>
        <script>
            document.addEventListener("gestcomVideo", function(e) {
                var video_title = "<?php echo $video_title; ?>";
                var video_container_id = "<?php echo $video_container_id; ?>";
                var video_subtitle = '';
                var file = "https://59959724487e3.streamlock.net:443/vod/mp4:" + video_title + ".mp4";
                var filePlaylist = "https://59959724487e3.streamlock.net:443/vod/mp4:" + video_title + ".mp4" + "/playlist.m3u8";
                jwplayer(video_container_id).setup({
                    image: "<?php echo ($video_cover_img); ?>",
                    sources: [{
                        file: filePlaylist
                    }, {
                        file: file
                    }],
                    <?php
                    $subtitle_file = "/data/sites/bx1.be/httpdocs/videofiles/" . $video_subtitle . ".vtt";
                    if (($value_show_subtitles == true && file_exists($subtitle_file)) || ($_GET["showvtt"] == 1 && file_exists($subtitle_file))) { ?>
                        tracks: [{
                            file: "/videofiles/" + video_title + ".vtt",
                            label: "Français",
                            kind: "captions",
                            "default": true
                        }],
                    <?php } ?>
                    primary: 'html5',
                    flashplayer: '<?php echo get_template_directory_uri(); ?>/js/jwplayer/jwplayer.flash.swf',
                    width: '100%',
                    aspectratio: '16:9',
                    autostart: false,
                    androidhls: true,
                    <?php if (is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub 
                    ?>
                        advertising: false
                    <?php else: ?>
                        localization: {
                            loadingAd: 'Chargement de la publicité',
                            liveBroadcast: 'Direct'
                        },
                        advertising: {
                            client: 'vast',
                            admessage: 'Cette publicité se termine dans xx secondes',
                            skipmessage: 'Continuer vers l\'article dans XX secondes',
                            skiptext: 'Continuer',
                            skipoffset: 5,
                            schedule: {
                                adbreak1: {
                                    offset: "pre",
                                    <?php if (get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                                        tag: '<?php echo types_render_termmeta('video-pre-roll', array('term_id' => $the_term_id)); ?>'
                                    <?php else: ?>
                                        tag: e.detail.vastUrl
                                    <?php endif; ?>
                                }
                            }
                        }
                    <?php endif; ?>
                })

            });
        </script>
    <?php
        return ob_get_clean();
    }
}
add_shortcode('insert_video', 'shortcode_video_insert');


// Fonctions d'ajout du bouton "Copier le shortcode" dans l'admin WP des articles
function custom_video_shortcode_meta_box() {
    add_meta_box(
        'custom_video_shortcode',
        __('Shortcode d\'insertion de vidéo', 'textdomain'),
        'render_video_shortcode_meta_box',
        ['post', 'page'], // Types de contenu où l'on veut voir apparaître ce bouton
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'custom_video_shortcode_meta_box');

function render_video_shortcode_meta_box() {
    ?>
    <button id="copy_shortcode_button" class="button button-primary"><?php _e('Copier le shortcode', 'textdomain'); ?></button>
    <p id="copy_shortcode_message" style="display:none;color:green;"><?php _e('Le shortcode a bien été copié dans votre presse-papier !', 'textdomain'); ?></p>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var button = document.getElementById('copy_shortcode_button');
            var message = document.getElementById('copy_shortcode_message');

            button.addEventListener('click', function(event) {
                event.preventDefault(); // Empêche le rechargement de la page

                var shortcode = '[insert_video video_title="" video_img=""]';

                // Copier le shortcode dans le presse-papier
                var tempInput = document.createElement('textarea');
                tempInput.style.position = 'absolute';
                tempInput.style.left = '-9999px';
                tempInput.value = shortcode;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

                // Afficher le message de succès
                message.style.display = 'block';
                setTimeout(function() {
                    message.style.display = 'none';
                }, 3000); // Le message disparaît après 3 secondes
            });
        });
    </script>
<?php
}

function enqueue_chartjs() {
    wp_enqueue_script('chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_chartjs');

// Enregistrement de la taxonomie 'exclusif'
function register_exclusif_blog_taxonomy() {
    $labels = array(
        'name'              => _x('Exclusif blog', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Exclusif blog', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Rechercher des Exclusifs blog', 'textdomain'),
        'all_items'         => __('Tous les Exclusifs blog', 'textdomain'),
        'parent_item'       => __('Exclusif blog Parent', 'textdomain'),
        'parent_item_colon' => __('Exclusif blog Parent:', 'textdomain'),
        'edit_item'         => __('Éditer Exclusif blog', 'textdomain'),
        'update_item'       => __('Mettre à jour Exclusif blog', 'textdomain'),
        'add_new_item'      => __('Ajouter un Nouveau Exclusif blog', 'textdomain'),
        'new_item_name'     => __('Nom du Nouvel Exclusif blog', 'textdomain'),
        'menu_name'         => __('Exclusifs blog', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true, // Comme les catégories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'exclusif'),
    );

    register_taxonomy('exclusif-blog', array('post', 'ireport'), $args);
}
add_action('init', 'register_exclusif_blog_taxonomy');

// Enregistrement de la taxonomie 'featured_news'
function register_featured_news_taxonomy() {
    $labels = array(
        'name'              => _x('Mises en Avant', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Mise en Avant', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Rechercher des Mises en Avant', 'textdomain'),
        'all_items'         => __('Toutes les Mises en Avant', 'textdomain'),
        'parent_item'       => __('Mise en Avant Parent', 'textdomain'),
        'parent_item_colon' => __('Mise en Avant Parent:', 'textdomain'),
        'edit_item'         => __('Éditer Mise en Avant', 'textdomain'),
        'update_item'       => __('Mettre à jour Mise en Avant', 'textdomain'),
        'add_new_item'      => __('Ajouter une Nouvelle Mise en Avant', 'textdomain'),
        'new_item_name'     => __('Nom de la Nouvelle Mise en Avant', 'textdomain'),
        'menu_name'         => __('Mises en Avant', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true, // Comme les catégories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'mise-en-avant'),
    );

    register_taxonomy('featured_news', array('post', 'ireport'), $args);
}
add_action('init', 'register_featured_news_taxonomy');

// Enregistrement de la taxonomie 'flash_news'
function register_flash_news_taxonomy() {
    $labels = array(
        'name'              => _x('Flash Infos', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Flash Info', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Rechercher des Flash Infos', 'textdomain'),
        'all_items'         => __('Toutes les Flash Infos', 'textdomain'),
        'parent_item'       => __('Flash Info Parent', 'textdomain'),
        'parent_item_colon' => __('Flash Info Parent:', 'textdomain'),
        'edit_item'         => __('Éditer Flash Info', 'textdomain'),
        'update_item'       => __('Mettre à jour Flash Info', 'textdomain'),
        'add_new_item'      => __('Ajouter une Nouvelle Flash Info', 'textdomain'),
        'new_item_name'     => __('Nom de la Nouvelle Flash Info', 'textdomain'),
        'menu_name'         => __('Flash Infos', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'flash-info'),
    );

    register_taxonomy('flash_news', array('post', 'ireport'), $args);
}
add_action('init', 'register_flash_news_taxonomy');

function order_by_featured_taxonomy($clauses, $wp_query) {
    global $wpdb;

    // Vérifiez que nous sommes dans la requête concernée
    if (isset($wp_query->query_vars['featured_news_order']) && $wp_query->query_vars['featured_news_order']) {
        // Joindre la table de taxonomie
        $clauses['join'] .= "
            LEFT JOIN (
                SELECT object_id, term_taxonomy_id
                FROM {$wpdb->term_relationships}
            ) AS tr ON ({$wpdb->posts}.ID = tr.object_id)
            LEFT JOIN {$wpdb->term_taxonomy} AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
            LEFT JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id)
        ";

        // Ajouter l'ordre
        $clauses['orderby'] = "MAX(CASE WHEN t.slug = 'oui' THEN 1 ELSE 0 END) DESC, {$wpdb->posts}.post_date DESC";
        $clauses['groupby'] = "{$wpdb->posts}.ID";
    }

    return $clauses;
}
add_filter('posts_clauses', 'order_by_featured_taxonomy', 10, 2);

function custom_admin_css() {
    echo '<style>
        div[data-wpt-id="wpcf-info-bx1"],
        div[data-wpt-id="wpcf-exclusif-blog"],
        div[data-wpt-id="wpcf-flash-news"] {
            display: none;
        }
    </style>';
}
add_action('admin_head', 'custom_admin_css');


// Désactiver les tailles par défaut générées automatiquement par WordPress pour chaque image uploadée
function disable_specific_image_sizes($sizes) {
    // unset($sizes['thumbnail']);      // Petite taille (paramètre 'Taille de la miniature' dans Réglages > Médias)
    // unset($sizes['medium']);         // Taille moyenne
    unset($sizes['medium_large']);   // Taille intermédiaire large (ajoutée depuis WordPress 4.4)
    // unset($sizes['large']);          // Grande taille
    // unset($sizes['1536x1536']);      // Taille 2x pour les écrans Retina
    unset($sizes['2048x2048']);      // Taille pleine résolution pour les écrans Retina

    // Ajouter d'autres tailles personnalisées à désactiver si nécessaire
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_specific_image_sizes');


// Ajout automatique du paramètre theme=classic en fin d'URL sur l'ensemble du site
function add_theme_param_to_url() {
    // Vérifiez si le paramètre 'theme' est déjà présent dans l'URL.
    if (!isset($_GET['theme'])) {
        // Récupérez l'URL actuelle.
        $current_url = home_url(add_query_arg([], $_SERVER['REQUEST_URI']));

        if ($current_url != 'https://bx1.be/wp-content/themes/BX1-2017/font/FuturaStdBook.otf') {
            // Ajoutez le paramètre 'theme=classic' à l'URL.
            $new_url = add_query_arg('theme', 'classic', $current_url);

            // Redirigez vers la nouvelle URL avec le paramètre ajouté.
            wp_redirect($new_url);
            exit;
        }
    }
}
add_action('template_redirect', 'add_theme_param_to_url');


// Création d'un flux RSS
function ajouter_flux_lastarticle() {
    add_feed('lastarticle', 'generer_flux_lastarticle');
}
add_action('init', 'ajouter_flux_lastarticle');


function generer_flux_lastarticle() {
    header('Content-Type: application/rss+xml; charset=' . get_option('blog_charset'), true);

    $args = array(
        'post_type'      => array('post', 'ireport'),
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => array(
            'relation' => 'AND',
            // Inclure seulement les articles mis en avant
            array(
                'taxonomy'         => 'featured_news',
                'field'            => 'slug',
                'terms'            => array('oui'),
                'include_children' => false,
            ),
            // Exclure les articles exclusifs au blog
            array(
                'taxonomy'         => 'exclusif-blog',
                'field'            => 'slug',
                'terms'            => array('oui'),
                'operator'         => 'NOT IN',
                'include_children' => false,
            ),
        ),
    );

    $articles = new WP_Query($args);

    echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . '>';
?>
    <rss version="2.0">
        <channel>
            <title><?php bloginfo_rss('name'); ?> - Dernier article</title>
            <link>https://bx1.be/articlemireradio/?feed=lastarticle</link>
            <description>Le dernier article publié sur bx1.be</description>
            <language>fr</language>
            <pubDate><?php echo mysql2date('r', get_lastpostmodified('GMT'), false); ?></pubDate>
            <lastBuildDate><?php echo mysql2date('r', get_lastpostmodified('GMT'), false); ?></lastBuildDate>

            <?php if ($articles->have_posts()) : ?>
                <?php while ($articles->have_posts()) : $articles->the_post(); ?>
                    <item>
                        <title><?php the_title_rss(); ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date('r', get_the_date('Y-m-d H:i:s'), false); ?></pubDate>
                        <guid><?php the_guid(); ?></guid>
                    </item>
                <?php endwhile; ?>
            <?php endif; ?>

        </channel>
    </rss>
    <?php
    wp_reset_postdata();
}

function ajouter_rewrite_flux_lastarticle() {
    add_rewrite_rule(
        '^articlemireradio/lastarticle/?$', // URL personnalisée
        'index.php?feed=lastarticle',      // Redirection interne
        'top'
    );
}
add_action('init', 'ajouter_rewrite_flux_lastarticle');

// Fonction qui permet de précharger l'image (thumbnail) de l'article en vedette (dans un soucis d'amélioration des temps de chargement)
function customize_post_thumbnail_html($html, $post_id, $post_thumbnail_id) {
    // Vérifier si c'est une page d'article ou tout autre condition spécifique
    if (has_post_thumbnail()) {
        // Ajoutez les attributs nécessaires à l'image
        $html = str_replace('<img', '<img loading="eager" decoding="async"', $html);
    }

    return $html;
}
add_filter('post_thumbnail_html', 'customize_post_thumbnail_html', 10, 3);


// Règle de politique CORS
// function ajouter_cors_headers() {
//     header("Access-Control-Allow-Origin: *");
// }
// add_action('send_headers', 'ajouter_cors_headers');


class Video_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'video_widget',
            __('Vidéo Dernier JT', 'text_domain'),
            array('description' => __('Player chargeant le dernier JT', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        // echo $args['before_title'] . __('Dernier JT', 'text_domain') . $args['after_title'];

        // Code du player vidéo
        $argsNews = array(
            'post_type' => 'emission',
            'posts_per_page' => 1,
            'orderby' => array('date' => 'DESC'),
            'tax_query' => array(
                array(
                    'taxonomy' => 'type_emissions',
                    'field' => 'slug',
                    'terms' => array('18h-journal')
                )
            )
        );

        $queryNews = new WP_Query($argsNews);
        if ($queryNews->have_posts()) :
            while ($queryNews->have_posts()) : $queryNews->the_post();
    ?>
                <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
                    <div id="dernierJT"></div>
                </div>
                <script>
                    document.addEventListener("gestcomVideo", function(e) {
                        jwplayer("dernierJT").setup({
                            playlist: [{
                                sources: [{
                                    file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + "/playlist.m3u8"
                                }, {
                                    file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"
                                }]
                            }],
                            primary: 'html5',
                            width: '100%',
                            aspectratio: '16:9',
                            autostart: true,
                            mute: true
                        });
                    });
                </script>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;

        echo $args['after_widget'];
    }

    public function form($instance) {
        echo '<p>' . __('Aucune option pour ce widget.', 'text_domain') . '</p>';
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }
}

// Enregistrer le widget
function register_video_widget() {
    register_widget('Video_Widget');
}
add_action('widgets_init', 'register_video_widget');



/////////////////////



class Emission_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'emission_widget',
            __('Vidéo Dernière émission', 'text_domain'),
            array('description' => __('Player chargeant la dernière émission', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        // echo $args['before_title'] . __('Dernière émission', 'text_domain') . $args['after_title'];

        // Code du player vidéo
        $argsNews = array(
            'post_type' => 'emission',
            'posts_per_page' => 1,
            'orderby' => array('date' => 'DESC'),
        );

        $queryNews = new WP_Query($argsNews);
        if ($queryNews->have_posts()) :
            while ($queryNews->have_posts()) : $queryNews->the_post();
            ?>
                <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
                    <div id="derniereEmission"></div>
                </div>
                <script>
                    document.addEventListener("gestcomVideo", function(e) {
                        jwplayer("derniereEmission").setup({
                            playlist: [{
                                sources: [{
                                    file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + "/playlist.m3u8"
                                }, {
                                    file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"
                                }]
                            }],
                            primary: 'html5',
                            width: '100%',
                            aspectratio: '16:9',
                            autostart: true,
                            mute: true
                        });
                    });
                </script>
<?php
            endwhile;
            wp_reset_postdata();
        endif;

        echo $args['after_widget'];
    }

    public function form($instance) {
        echo '<p>' . __('Aucune option pour ce widget.', 'text_domain') . '</p>';
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }
}

// Enregistrer le widget
function register_emission_widget() {
    register_widget('Emission_Widget');
}
add_action('widgets_init', 'register_emission_widget');
