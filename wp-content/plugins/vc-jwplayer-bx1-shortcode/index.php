<?php
/**
* Plugin Name: Visual Composer Addon - JW Player BX1
* Plugin URI: http://infinite-it.be/dev/bx1vc.php
* Description: This plugin add custom JW Player Shortcode for BX1 to Visual Composer.
* Version: 1.0
* Author: DE NAEYER Bruno
* Author URI: http://www.infinite-it.be
*/
 
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You shouldnt be here' );
}
 
/**
* Function when plugin is activated
*
* @param void
*
* @return void
*/
function vcas_plugin_active(){
    // checking if visual composer is active
    if ( ! is_plugin_active( 'js_composer/js_composer.php' ) ) {
        wp_die( 'Please activate Visual Composer, and try again' );
    }
}
register_activation_hook( __FILE__ , 'vcas_plugin_active' );
 
//Including file that manages all template
require_once plugin_dir_path( __FILE__ ) . 'vcas-admin.php';