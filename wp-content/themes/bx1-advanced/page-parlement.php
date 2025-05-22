<?php

/**
 * Template Name: Parlement
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main" role="main">

         <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <div id="video-live"></div>
            <script>
              jwplayer("video-live").setup({
                playlist: [{
                     image: "",
                     sources: [{
                         file: "rtmp://149.202.81.107:1935/live2/live.sdp"},{
                         file: "http://149.202.81.107:1935/live2/live.sdp/playlist.m3u8"
                     }]
                }],
                primary: "html5",
                width: "100%",
                aspectratio: "16:9",
                androidhls: true,
                advertising: {
                  client: 'vast',
                  schedule: {
                    adbreak1: {
                      offset: "pre",
                      tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                    },
                    adbreak2: {
                      offset: "post",
                      tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                    }
                  }
                }
              });
            </script>

         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
