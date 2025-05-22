<?php
/**
 * Shortcodes
 *
 *
 */
function telebruxelles_register_shortcodes(){
    add_shortcode('url-pic-logo', 'url_pic_logo');
    add_shortcode('url-pic-square', 'url_pic_square');
    add_shortcode('url-pic-rect', 'url_pic_rect');
    add_shortcode('url-pic-head', 'url_pic_head');
    add_shortcode('url-pic-concours', 'url_pic_concours');
    add_shortcode('cat-img-url', 'cat_img_url');
    add_shortcode('share-post', 'share');
}
add_action( 'init', 'telebruxelles_register_shortcodes');

/* Resized images shortcodes */
function url_pic_logo($id) {
  global $post;
  $id = ($id) ? $id : $post->ID;

  if ( has_post_thumbnail($id)) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'Logo');
      return '<img src="'. $image_url[0].'" alt="'. get_the_title($id) .'">';
  }
}

function url_pic_square($id) {
  global $post;
  $id = ($id) ? $id : $post->ID;

  if ( has_post_thumbnail($id)) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'Square');
      return $image_url[0];
  }
}

function url_pic_rect($id) {
  global $post;
  $id = ($id) ? $id : $post->ID;

  if ( has_post_thumbnail($id)) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'Rectangle');
      return $image_url[0];
  }
}

function url_pic_head($id) {
  global $post;
  $id = ($id) ? $id : $post->ID;

  if ( has_post_thumbnail($id)) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'Header image');
      return '<img class="news__img" src="'. $image_url[0].'" alt="'. get_the_title($id) .'">';
  }
}

function url_pic_concours($id) {
  global $post;
  $id = ($id) ? $id : $post->ID;

  if ( has_post_thumbnail($id)) {
      $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'Concours');
      return $image_url[0];
  }
}

function cat_img_url($atts) {
  global $WP_Views, $wp_query;
  $term = $WP_Views -> get_current_taxonomy_term();
  $wp_query -> queried_object = $term;
  $filtered = apply_filters( 'taxonomy-images-queried-term-image-url', '', array(
    'image_size'   => 'Emissions'
    ) );
  $wp_query->queried_object = wp_reset_query(); // restore the original wp_query
  return '<img class="news__img" src="'. $filtered .'" alt="[wpv-taxonomy-title]">';
}

?>
