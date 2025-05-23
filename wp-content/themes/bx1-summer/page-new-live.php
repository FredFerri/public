<?php

/**
 * Template Name: New Live Stream
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main">

         <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <div id="video-live"></div>
            <script>
            if (navigator.userAgent.match(/android/i) != null){
              jwplayer("video-live").setup({
                file: "http://149.202.81.107:1935/stream/live/playlist.m3u8",
                type: "mp4",
                primary: "html5"
              });
            } else {
            jwplayer("video-live").setup({
              playlist: [{
                image: "http://content.bitsontherun.com/thumbs/gSzpo2wh-480.jpg",
                sources: [{
                  file: "rtmp://149.202.81.107:1935/stream/live"
                },{
                  file: "http://149.202.81.107:1935/stream/live/playlist.m3u8",type: "mp4"
                }]
              }],
              primary: "flash"
            });
            }
            </script>
            

         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
