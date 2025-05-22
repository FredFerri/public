<?php

/**
 * Template Name: Technical Test Closed Caption DON'T USE IN PRODUCTION!
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<section class="news">
	<h1>SRT</h1>
	<div id="video_SRT"></div>
	<hr />
	<h1>VTT</h1>
	<div id="video_VTT"></div>
	<script>
		jwplayer("video_VTT").setup({
	            sources: [{
	                file: "https://59959724487e3.streamlock.net:443/vod/mp4:testweb_decodart.mp4" + "/playlist.m3u8",
	            },{
	                file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:testweb_decodart.mp4",
	            }],
                tracks: [{
                    file: "/videofiles/testweb_decodart.vtt",
                    label: "Français",
                    kind: "captions",
                    "default": true
                }],
	            androidhls: true,
	            hlshtml: true,
	            width: "100%",
	            aspectratio: "16:9",
	            androidhls: true,
	            autostart: false,
	            mute: true
	        });
		jwplayer("video_SRT").setup({
	            sources: [{
	                file: "https://59959724487e3.streamlock.net:443/vod/mp4:testweb_decodart_srt.mp4" + "/playlist.m3u8",
	            },{
	                file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:testweb_decodart_srt.mp4",
	            }],
                tracks: [{
                    file: "/videofiles/testweb_decodart_srt.srt",
                    label: "Français",
                    kind: "captions",
                    "default": true
                }],
	            androidhls: true,
	            hlshtml: true,
	            width: "100%",
	            aspectratio: "16:9",
	            androidhls: true,
	            autostart: false,
	            mute: true
	        });
	</script>
</section>

<section class="sideFil">
	<?php dynamic_sidebar('filinfo'); ?>
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>
