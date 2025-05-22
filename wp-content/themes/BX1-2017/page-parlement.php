<?php

/**
 * Template Name: Parlement
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; ?>

         <?php while ( have_posts() ) : the_post(); ?>
            <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}"><div id="video-live"></div></div>
            <script>
              jwplayer("video-live").setup({
                playlist: [{
                     image: "",
                     sources: [{file: "https://59959724487e3.streamlock.net:443/live2/live.sdp/playlist.m3u8","type": "mp4"
                     },
                         {file: "rtmps://59959724487e3.streamlock.net:443/live2/live.sdp"}]
                }],
                primary: "html5",
                width: "100%",
                aspectratio: "16:9",
                androidhls: true,
                mute: false,
                <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub ?>
                advertising: false
                <?php else: ?>
                localization: {
                         loadingAd : 'Chargement de la publicité',
                         liveBroadcast : 'Direct'
                  },
                  advertising: {
                  client: 'vast',
                  admessage: 'Cette publicité se termine dans xx secondes',
                  skipmessage: 'Continuer vers l\'article dans XX secondes',
                  skiptext: 'Continuer',
                  skipoffset: 5,
                  <?php if(get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                      schedule: {
                          adbreak1: {
                                      offset: "pre",
                                      tag: '<?php echo types_render_termmeta('video-pre-roll',array('term_id'=>$the_term_id)); ?>'
                              }
                      }        
                  <?php else: ?>
                      
                      schedule: (e.detail.vastUrl!=undefined && e.detail.vastUrl!=null && e.detail.vastUrl!='' ? [{ tag: e.detail.vastUrl, offset: "pre" },{ tag: e.detail.vastUrl.replace('vst.xml','vst2.xml'), offset: "pre" }] : [])             
                          
                  <?php endif; ?>
                }
                <?php endif; ?>
              });
            </script>

         <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
