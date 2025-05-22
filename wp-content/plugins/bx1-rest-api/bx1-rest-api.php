<?php
/*
Plugin Name: BX1 - Rest API complements
Version: 0.1
Author: Marie Detroz (defimedia)
Author URI: https://www.defimedia.be/
License: GPL2
*/

if (!class_exists('BX1_WP_REST_Latest_News_Controller')) {
  require_once dirname(__FILE__) . '/lib/endpoints/class-bx1-wp-rest-latest-news-controller.php';
}
if (!class_exists('BX1_WP_REST_Events_Controller')) {
  require_once dirname(__FILE__) . '/lib/endpoints/class-bx1-wp-rest-events-controller.php';
}
if (!class_exists('BX1_WP_REST_Day_Emissions_Controller')) {
  require_once dirname(__FILE__) . '/lib/endpoints/class-bx1-wp-rest-day-emissions-controller.php';
}

add_action('rest_api_init', 'bx1_create_api_posts_meta_field');
function bx1_create_api_posts_meta_field() {
  // Controleur de la liste des derniers posts
  $controllerNews = new BX1_WP_REST_Latest_News_Controller();
  $controllerNews->register_routes();

  // Controleur de la liste des events entre deux dates
  $controllerEvents = new BX1_WP_REST_Events_Controller();
  $controllerEvents->register_routes();

  // Controleur de la liste des émissions du jour
  $controllerEmissions = new BX1_WP_REST_Day_Emissions_Controller();
  $controllerEmissions->register_routes();


  // Posts de type de contenus "Adresse @After"
  _bx1_register_rest_field_wcpf_nom('adresse_after');
  _bx1_register_rest_field_wcpf_prenom('adresse_after');
  _bx1_register_rest_field_wcpf_e_mail('adresse_after');
  _bx1_register_rest_field_wcpf_adresse('adresse_after');

  // Posts de type de contenus "Annonce"
  _bx1_register_rest_field_wpcf_press_file('annonce');

  // Posts de type de contenus "Concours"
  _bx1_register_rest_field_wpcf_date_fin_concours('concours');
  _bx1_register_rest_field_wpcf_video_concours('concours');

  // Posts de type de contenus "Emission"
  _bx1_register_rest_field_wpcf_featured_news('emission');
  _bx1_register_rest_field_wpcf_featured_horaire_debut('emission');
  _bx1_register_rest_field_wpcf_featured_horaire_fin('emission');
  _bx1_register_rest_field_wcpf_nom_du_fichier_video('emission');

  // Posts de type de contenus "Event"
  _bx1_register_rest_field_wcpf_date_de_debut('evenement');
  _bx1_register_rest_field_wcpf_date_de_fin('evenement');
  _bx1_register_rest_field_wcpf_lieu('evenement');
  _bx1_register_rest_field_type_d_evenement('evenement');

  // Posts de type de contenus "iReport"
  _bx1_register_rest_field_wpcf_featured_news('ireport');
  _bx1_register_rest_field_wcpf_nom('ireport');
  _bx1_register_rest_field_wcpf_prenom('ireport');
  _bx1_register_rest_field_wcpf_e_mail('ireport');
  _bx1_register_rest_field_wcpf_lieu('ireport');
  _bx1_register_rest_field_wpcf_video_link('ireport');
  _bx1_register_rest_field_wpcf_contenu_after('ireport');
  _bx1_register_rest_field_wpcf_fichiers('ireport');

  // Posts de type de contenus "Lives"
  _bx1_register_rest_field_wpcf_url_du_live('lives');
  _bx1_register_rest_field_wpcf_url_live_android('lives');
  _bx1_register_rest_field_wpcf_url_live_ios('lives');

  // Posts de type de contenus "Post"
  _bx1_register_rest_field_wpcf_featured_news('post');

  // Posts de type de contenus "Votre Bruxelles"
  _bx1_register_rest_field_wpcf_featured_news('votre-bruxelles');
  _bx1_register_rest_field_wcpf_nom('votre-bruxelles');
  _bx1_register_rest_field_wcpf_prenom('votre-bruxelles');
  _bx1_register_rest_field_wcpf_e_mail('votre-bruxelles');
  _bx1_register_rest_field_wcpf_lieu('votre-bruxelles');

  // Taxonomie "Type d'émissions"
  register_rest_field('type_emissions', 'mediaurl', array(
    'get_callback'    => function($object) {
      $images = get_option('taxonomy_image_plugin');
      $img_url = (!empty($images[$object['id']])) ? wp_get_attachment_url($images[$object['id']]) : '';
      return $img_url;
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "type-d-evenement"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_type_d_evenement($post_type) {
  register_rest_field($post_type, 'event-types', array(
    'get_callback'    => function($object) {
      $event_types = array();
      if (!empty($object['type-d-evenement']) && is_array($object['type-d-evenement'])) {
        foreach ($object['type-d-evenement'] as $term_id) {
          if ($term = get_term($term_id)) {
            $event_types[$term_id] = $term->name;
          }
        }
      }
      return $event_types;
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-adresse"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_adresse($post_type) {
  register_rest_field($post_type, 'adresse', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-adresse', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-adresse', 'textfield', true);
    },
    'schema'          => array(
      'description'   => 'Adresse of the post "@After"',
      'type'          => 'string',
      'context'       => array('view', 'edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-contenu-after"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_contenu_after($post_type) {
  register_rest_field($post_type, 'broadcast', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-contenu-after', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-contenu-after', 'textfield', false);
    },
    'schema'          => array(
      'description'   => 'Broadcast of the post',
      'type'          => 'string',
      'context'       => array('view', 'edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-date-de-debut"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_date_de_debut($post_type) {
  register_rest_field($post_type, 'startdate', array(
    'get_callback'    => function($object) {
      return _bx1_get_post_meta_date($object, 'wpcf-date-de-debut', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-date-de-fin"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_date_de_fin($post_type) {
  register_rest_field($post_type, 'enddate', array(
    'get_callback'    => function($object) {
      return _bx1_get_post_meta_date($object, 'wpcf-date-de-fin', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-date-de-fin-concours"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_date_fin_concours($post_type) {
  register_rest_field($post_type, 'enddate', array(
    'get_callback'    => function($object) {
      return _bx1_get_post_meta_date($object, 'wpcf-date-fin-concours', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-e-mail"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_e_mail($post_type) {
  register_rest_field($post_type, 'email', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-e-mail', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-e-mail', 'email', true);
    },
    'schema'          => array(
      'description'   => 'Email of the post author',
      'type'          => 'string',
      'context'       => array('edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-featured-news"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_featured_news($post_type) {
  if (!empty($post_type)) {
    register_rest_field($post_type, 'featured_news', array(
      'get_callback'    => function($object) {
        $featured = get_post_meta($object['id'], 'wpcf-featured-news', true);
        return (!empty($featured)) ? TRUE : FALSE;
      },
      'update_callback' => null,
      'schema'          => null
    ));
  }
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-fichiers"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_fichiers($post_type) {
  register_rest_field($post_type, 'medias', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-fichiers', false);
    },
    'update_callback' => function($values, $object, $name) {
      if (!$values || !is_array($values)) {
        /*return new WP_Error(
          'rest_cannot_update',
          sprintf(__('Sorry, you are not allowed to edit the %s custom field.'), $name),
          array(
            'key' => $name,
            'status' => rest_authorization_required_code()
          )
        ); // N'empêche pas l'enregistrement du ireport... */
        return;
      }

      foreach ($values as $value) {
        $value = sanitize_text_field($value);
        if (!empty($value) && filter_var($value, FILTER_VALIDATE_URL)) {
          add_post_meta($object->ID, "wpcf-fichiers", $value);
        }
      }
    },
    'schema'          => array(
      'description'   => 'Medias of the post',
      'type'          => 'object',
      'context'       => array('view', 'edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-horaire-debut"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_featured_horaire_debut($post_type) {
  register_rest_field($post_type, 'startdate', array(
    'get_callback'    => function($object) {
      return _bx1_get_post_meta_date($object, 'wpcf-horaire-debut', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-horaire-fin"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_featured_horaire_fin($post_type) {
  register_rest_field($post_type, 'enddate', array(
    'get_callback'    => function($object) {
      return _bx1_get_post_meta_date($object, 'wpcf-horaire-fin', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-lieu"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_lieu($post_type) {
  register_rest_field($post_type, 'location', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-lieu', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-lieu', 'textfield', true);
    },
    'schema'          => array(
      'description'   => 'Location of the post',
      'type'          => 'string',
      'context'       => array('view', 'edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-nom"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_nom($post_type) {
  register_rest_field($post_type, 'lastname', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-nom', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-nom', 'textfield', true);
    },
    'schema'          => array(
      'description'   => 'Last name of the post author',
      'type'          => 'string',
      'context'       => array('edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-nom-du-fichier-video"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_nom_du_fichier_video($post_type) {
  register_rest_field($post_type, 'videoname', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-nom-du-fichier-video', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-prenom"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wcpf_prenom($post_type) {
  register_rest_field($post_type, 'firstname', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-prenom', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-prenom', 'textfield', true);
    },
    'schema'          => array(
      'description'   => 'First name of the post author',
      'type'          => 'string',
      'context'       => array('edit')
    )
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-press-file"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_press_file($post_type) {
  register_rest_field($post_type, 'pressfile', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-press-file', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-url-du-live"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_url_du_live($post_type) {
  register_rest_field($post_type, 'liveurl', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-url-du-live', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-url-live-android"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_url_live_android($post_type) {
  register_rest_field($post_type, 'liveurlandroid', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-url-live-android', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-url-live-ios"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_url_live_ios($post_type) {
  register_rest_field($post_type, 'liveurlios', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-url-live-ios', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-video-concours"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_video_concours($post_type) {
  register_rest_field($post_type, 'videoname', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-video-concours', true);
    },
    'update_callback' => null,
    'schema'          => null
  ));
}

/**
 * Crée un "register_rest_field" pour le champ "wpcf-video-link"
 * du le type de contenus $post_type passé en paramètre.
 *
 * @param string $post_type
 *  Le type de contenu.
 */
function _bx1_register_rest_field_wpcf_video_link($post_type) {
  register_rest_field($post_type, 'videolink', array(
    'get_callback'    => function($object) {
      return get_post_meta($object['id'], 'wpcf-video-link', true);
    },
    'update_callback' => function($value, $object, $name) {
      return _bx1_update_post_meta_field($value, $object, $name, 'wpcf-video-link', 'url', false);
    },
    'schema'          => array(
      'description'   => 'Broadcast of the post',
      'type'          => 'string',
      'context'       => array('view', 'edit')
    )
  ));
}

function _bx1_get_post_meta_date($object, $field_name, $single = false) {
  $dateGMT = '';
  if ($timestamp = get_post_meta($object['id'], $field_name, $single)) {
    $dateGMT = gmdate("Y-m-d\TH:i:s", $timestamp);
  }
  return $dateGMT;
}

function _bx1_update_post_meta_field($value, $object, $name, $field_name, $field_type, $required = false) {
  $value = sanitize_text_field($value);
  if (!$value || ($required && empty($value))
      || ($field_type === 'email' && !is_email($value))
      || ($field_type === 'textfield' && !is_string($value))
      || ($field_type === 'url' && (filter_var($value, FILTER_VALIDATE_URL) === FALSE))
  ) {
    /*return new WP_Error(
      'rest_cannot_update',
      sprintf(__('Sorry, you are not allowed to edit the %s custom field.'), $name),
      array(
        'key' => $name,
        'status' => rest_authorization_required_code()
      )
    ); // N'empêche pas l'enregistrement du ireport... */
    return;
  }

  return update_post_meta($object->ID, $field_name, $value);
}
