<?php
/**
 * @package TeleBruxelles
 */
?>

<?php
/**
 * @package TeleBruxelles
 */
?>
<script src="https://kit.fontawesome.com/f76d1d630e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div>
    <?php 
      $terms = get_the_terms( $post->ID, 'radio-type_emissions');
      foreach ( $terms as $term ) {
          $termID[]  = $term->slug;
          $termDSC[] = $term->description;
      }
      $the_term_id = $termID[0];
    if ($_GET["debug"] == 1)
    {
      echo $the_term_id;
    }
      ?>
    <div style="display:block;width: 100%; text-align: center;  height:150px"><img style="border-radius:10px 10px 0 0; height: 150px;" src="<?php echo get_template_directory_uri();?>/images/bannerradio/<?php echo $the_term_id; ?>.jpg"></div>
    <div style="width: 100%;margin:auto;font-weight: bold;text-align: center;padding-top:25px;padding-bottom:10px;border-radius: 0 0 10px 10px;color:#FFF;background: rgb(113,6,55);background: linear-gradient(180deg, rgba(113,6,55,1) 0%, rgba(235,31,124,1) 25%, rgba(235,31,124,1) 100%);">
      <div style="width: 60%;margin:auto;"><?php echo $termDSC[0];?></div>
    </div>
  </div>
  

  <?php 
  
  ?>

  <div class="content">
    
      <div class="content">
        <?php
       $videoName = types_render_field('video-chronique', array('raw'=>'true'));
       if ( !empty($videoName) ) { ?>
       <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}"><div id="videoLive"></div><div id="video"></div></div>
       <script>
           document.addEventListener("gestcomVideo", function(e) {
          jwplayer("video").setup({
            sources: [{
                file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-chronique'); ?>" + ".mp4" + "/playlist.m3u8"
            },{
                file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-chronique'); ?>" + ".mp4"}],
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
          })});
          </script>         
          <?php }else{

            //the_post_thumbnail();

          }  ?>

        <?php the_content(); ?>
      </div>

      <div class="meta">
        <h2>Infos sur le replay</h2>
        <table>
          <tr>
            <td>
              <span style="font-size: 24px; color: #EB1F7C;padding-left:10px;">
                <i class="fal fa-calendar-day"></i>
              </span>
            </td>
            <td>
              <span style="padding-left:10px; line-height: 24px;vertical-align: middle;font-family: sys-tt, sans-serif;font-weight: 400;font-style: normal;color: #EB1F7C;">
              <?php
                $date = get_post_meta($post->ID, 'wpcf-date-chronique', true);
                //$date = create_date(get_post_meta ($post->ID, 'wpcf-date-chronique', true));
              ?>
              <?php echo date("d/m/Y à H:i", $date);?>
            </span>
            </td>
          </tr>
          <tr>
            <td>
              <span style="font-size: 24px; color: #EB1F7C;padding-left:10px;">
                <i class="fal fa-clock"></i>
              </span>
            </td>
            <td>
              <span style="padding-left:10px; line-height: 24px;vertical-align: middle;font-family: sys-tt, sans-serif;font-weight: 400;font-style: normal;color: #EB1F7C;">
              <?php echo types_render_field('duree-chronique');?>
              </span>
            </td>
          </tr>
        </table>
        <h2>Émission parente</h2>
        <h2 style="display:none;">Suivre notre podcast</h2>
        <h2>Partager la chronique</h2>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_dd"></a>
        </div>
        <ul class="tags">
          <?php the_tags('<li>','</li><li>','</li>') ?>
          <li><?php the_category('</li><li>'); ?>
          <?php the_terms( $post->ID, 'type_emissions','<li>','</li><li>','</li>'); ?>
          <?php the_terms( $post->ID, 'invite','<li>','</li><li>','</li>'); ?></li>
        </ul>
        <?php dynamic_sidebar('sidebar-3'); ?>
      </div>

   </div>
</article>