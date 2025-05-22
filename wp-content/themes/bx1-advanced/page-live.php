<?php

/**
 * Template Name: Live
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
                         file: "rtmp://149.202.81.107:1935/live/live.sdp"},{
                         file: "http://149.202.81.107:1935/live/live.sdp/playlist.m3u8"
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
         <section>
            <h2 class="section-title section-title--news">L’info en images <span class="section-title-all"><a href="/news">Toute l'info</a></s
pan></h2>

            <?php dynamic_sidebar( 'info-bar' ); ?>

            <div class="row" data-equalizer data-options="equalize_on_stack: true">
               <?php echo do_shortcode('[wpv-view name="news-homepage"]'); ?>
            </div>
         </section>

         <section>
            <h2 class="section-title section-title--depeche">Fil d'actu <span class="section-title-all"><a href="/depeches">Toutes les dépêche
s</a></span></h2>
            <?php include 'depeches-accordion.php'; ?>
         </section>
      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
