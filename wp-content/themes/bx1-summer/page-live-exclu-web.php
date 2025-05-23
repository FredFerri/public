<?php

/**
 * Template Name: Live Exclu Web
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
            jwplayer("video-live").setup({
              playlist: [{
                "sources": [{
                  "file": "http://hls-origin01-bruzz.cdn02.rambla.be/adliveorigin-bruzz/_definst_/ApjBKP.smil/playlist.m3u8"
                }]
              }],
              primary: 'html5',
              flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
              width: '100%',
              aspectratio: '16:9',
              autostart: true,
              androidhls: true,
              advertising: {
                client: 'vast',
                schedule: {
                  adbreak1: {
                    offset: 'pre',
                    tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                  },
                  adbreak2: {
                    offset: 'post',
                    tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                  }
                }
              }
            })
            </script>

         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
