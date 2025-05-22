<?php
/**
 * Plugin Name: bx1_carrousel
 */

define('MCAROUSEL_PATH', plugin_dir_path(__FILE__));

require_once MCAROUSEL_PATH . 'admin-page.php';
require_once MCAROUSEL_PATH . 'shortcodes.php';
require_once MCAROUSEL_PATH . 'render.php';

function bx1_carrousel_enqueue_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_style('bx1-carrousel-style', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
    wp_enqueue_script('bx1-carrousel-script', plugin_dir_url(__FILE__) . 'script.js');
}
add_action('wp_enqueue_scripts', 'bx1_carrousel_enqueue_assets');

