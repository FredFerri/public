<?php
function bx1_carrousel_register_shortcode($atts) {
    $atts = shortcode_atts(['id' => ''], $atts);
    $id = $atts['id'];
    $all = get_option('bx1_carrousel_carousels', []);

    // DEBUG
    error_log("SHORTCODE APPELÉ - ID: " . $id);
    error_log(print_r($all, true));
	error_log('LISTE DES CARROUSELS : ' . print_r($all, true));
	
    if (!isset($all[$id])) return 'Carrousel introuvable.';

    return bx1_carrousel_render($all[$id]);
}

add_shortcode('bx1_carrousel', 'bx1_carrousel_register_shortcode');
