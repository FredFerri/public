<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

      <main>
         <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

         <div class="socialShare">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
                 <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
                 <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp">Partager sur Whatsapp</a>
         </div>

        <div class="clearfix"></div>

  <h1><?php the_title(); ?></h1>

              	<?php
            $heure = '';
            if(types_render_field('horaire-debut') == ''){
              $heure = get_the_date('d F Y à H:i');
            }
            else{
              $heure = types_render_field('horaire-debut',array('format'=>'d F Y \d\e H:i')).' à '.types_render_field('horaire-fin',array('format'=>'H:i'));
            }
          ?>
        <div class="date">Diffusion : <?php echo($heure); ?></div>

                <ul class="tags">
          <?php the_tags('<li>','</li><li>','</li>') ?>
          <li><?php the_category('</li><li>'); ?>
          <?php the_terms( $post->ID, 'type_emissions','<li>','</li><li>','</li>'); ?>
          <?php the_terms( $post->ID, 'invite','<li>','</li><li>','</li>'); ?></li>
        </ul>

  <?php 
  $terms = get_the_terms( $post->ID, 'type_emissions');
  foreach ( $terms as $term ) {
      $termID[] = $term->term_id;
  }
  $the_term_id = $termID[0];
  ?>

  <div class="content">
    <?php
       $videoName = types_render_field('nom-du-fichier-video', array('raw'=>'true'));
       if ( !empty($videoName) ) { ?>
       <div id="video"></div>
       <script>
          document.addEventListener("gestcomVideo", function(e) {
          jwplayer("video").setup({
            sources: [{
                file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4" + "/playlist.m3u8"
            },{
                file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"}],
                <?php 
                $subtitle_file = "/data/sites/bx1.be/httpdocs/videofiles/".types_render_field('nom-du-fichier-video').".vtt";
                if (($value_show_subtitles == true && file_exists($subtitle_file)) || ($_GET["showvtt"] == 1 && file_exists($subtitle_file)))
                {?>
                  tracks: [{
                    file: "/videofiles/" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".vtt",
                    label: "Français",
                    kind: "captions",
                    "default": true
                  }],
                <?php }?>
            androidhls: true,
            hlshtml: true,
            width: "100%",
            aspectratio: "16:9",
            androidhls: true,
            autostart: true,
            mute: false,
            <?php 
            //$PUB = 'off';
            if((is_user_logged_in() && $_COOKIE['nopub'] == 'on' || types_render_field('no-pre-roll') == '1')||  $PUB == 'off'): //nopub ?>
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
                  schedule: {
                          adbreak1: {
                            offset: "pre",
                            <?php if(get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                            tag: '<?php echo types_render_termmeta('video-pre-roll',array('term_id'=>$the_term_id)); ?>'
                            <?php else: ?>
                            tag: e.detail.vastUrl
                            <?php endif; ?>
                          }             
                  }
                }
            <?php endif; ?>
          })});
          </script>         
          <?php }else{

            the_post_thumbnail();

          }  ?>

      <div class="content">
      	<?php the_content(); ?>
      </div>

   </div>
</article>
         <?php endwhile; // end of the loop. ?>
         <div class="clearfix">
      </main>
      
<?php get_footer(); ?>
