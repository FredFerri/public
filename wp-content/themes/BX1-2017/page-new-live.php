<?php

/**
 * Template Name: Test Streaming
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<section class="news">
    <?php
    $value_video_source = get_option('video_source');
    $value_vimeolink    = get_option('vimeolink');
        if($value_video_source == "vimeo"){
            ?>
            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php echo $value_vimeolink; ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>
        <?php
        }
        else{ 
            ?>
    <div id="video-live"></div>
    <script>
        jwplayer("video-live").setup({
            playlist: [{
                "sources": [{
                    "file": "rtmps://59959724487e3.streamlock.net:443/stream/live"
                }, {
                    "file": "https://59959724487e3.streamlock.net:443/stream/live/playlist.m3u8", type:"mp4"
                }]
            }],
            primary: 'html5',
            width: '100%',
            aspectratio: '16:9',
            autostart: true,
            androidhls: true,
        })
    </script>
    <?php
        }
        ?>
</section>

<section class="sideFil">
  <?php dynamic_sidebar('filinfo2'); ?>
  <?php dynamic_sidebar('sidebar-3'); ?>
</section>

<?php get_footer('v2'); ?>
