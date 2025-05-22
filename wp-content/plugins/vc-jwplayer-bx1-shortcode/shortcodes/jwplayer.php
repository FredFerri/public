<?php
/**
* File for creating Title Component
*
*/
 
/**
* Function for Adding Title Component on vc_init hook
*
* @param void
*
* @return void
*/
function vcas_component_bx1_jwplayer() {
    // Title
    vc_map(
        array(
            'name' => __( 'JW Player' ),
            'base' => 'vcas_jwplayer_bx1',
            'category' => __( 'Spécial BX1' ),
            'icon' => plugin_dir_path( __FILE__ ) . '/icon/jwplayer.png',
            'params' => array(
                array(
                    'type' => 'textfield',
                    //'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Nom de la vidéo' ),
                    'param_name' => 'videoname',
                    //'value' => __( 'EJLxxxxxxx' ),
                    'description' => __( 'Nom de la vidéo' ),
                ),
                array(
                    'type' => 'attach_image',
                    //'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Image prévisualisation' ),
                    'param_name' => 'image',
                    //'value' => '',
                    'description' => __( 'Image prévisualisation' ),
                ),
            )
        )
    );
}
add_action( 'vc_before_init', 'vcas_component_bx1_jwplayer' );
 
/**
* Function for displaying Title functionality
*
* @param array $atts    - the attributes of shortcode
* @param string $content - the content between the shortcodes tags
*
* @return string $html - the HTML content for this shortcode.
*/
function vcas_jwplayer_bx1_function( $atts, $content ) {
    $atts = shortcode_atts($atts, 'vcas_jwplayer_bx1');
    $ID   = uniqid();

    $html = '<div id="video' . $ID . '"></div>
    <script>
            jwplayer("video' . $ID . '").setup({
              image: "' . wp_get_attachment_url( $atts['image'] ) . '",
              sources: [{
                  file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "' . $atts['videoname'] . '" + ".mp4"},{
                  file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "' . $atts['videoname'] . '" + ".mp4" + "/playlist.m3u8"
              }],';
                $subtitle_file = "/data/sites/bx1.be/httpdocs/videofiles/".$atts['videoname'].".vtt";
                if (($value_show_subtitles == true && file_exists($subtitle_file)) || ($_GET["showvtt"] == 1 && file_exists($subtitle_file)))
                    {
                        $html .=  'tracks: [{
                            file: "/videofiles/" + "' . $atts['videoname'] . '" + ".vtt",
                            label: "Français",
                            kind: "captions",
                            "default": true
                        }],';
                    }
              $html .=  'width: "100%",
              aspectratio: "16:9",
              androidhls: true,
              advertising: {
                client: \'vast\',
                schedule: {
                        adbreak1: {
                          offset: "pre",
                          tag: \'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=\' + Math.floor(Date.now() / 1000)
                        },
                        adbreak2: {
                          offset: "post",
                          tag: \'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=\' + Math.floor(Date.now() / 1000)
                        }                 
                }
              }
            });
            </script>';


    //$html = '[bx1video fichier="' . $atts['videoname'] . '"]';
return $html;
}
add_shortcode( 'vcas_jwplayer_bx1', 'vcas_jwplayer_bx1_function' );