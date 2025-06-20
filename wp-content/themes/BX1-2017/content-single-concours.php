<?php

/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1><?php the_title(); ?></h1>

  <div class="content">
    <?php
    $videoName = types_render_field('video-name-news', array('raw' => 'true'));
    $videoFile = types_render_field('nom-du-fichier-video', array('raw' => 'true'));
    if (!empty($videoName)) { ?>
      <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
        <div id="video"></div>
      </div>
      <script>
        document.addEventListener("gestcomVideo", function(e) {
          jwplayer("video").setup({
            image: "<?php $image_news = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                    echo $image_news[0]; ?>",
            sources: [{
              file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4" + "/playlist.m3u8"
            }, {
              file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4"
            }],
            <?= get_subtitle_track(types_render_field('video-name-news')); ?>
            primary: 'html5',
            flashplayer: '<?php echo get_template_directory_uri(); ?>/js/jwplayer/jwplayer.flash.swf',
            width: '100%',
            aspectratio: '16:9',
            autostart: true,
            androidhls: true,
            <?php if (is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub 
            ?>
              advertising: false
            <?php else: ?>
              localization: {
                loadingAd: 'Chargement de la publicité',
                liveBroadcast: 'Direct'
              },
              advertising: {
                client: 'vast',
                admessage: 'Cette publicité se termine dans xx secondes',
                skipmessage: 'Continuer vers l\'article dans XX secondes',
                skiptext: 'Continuer',
                skipoffset: 5,
                <?php if (get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                  schedule: {
                    adbreak1: {
                      offset: "pre",
                      tag: '<?php echo types_render_termmeta('video-pre-roll', array('term_id' => $the_term_id)); ?>'
                    }
                  }
                <?php else: ?>

                  schedule: (e.detail.vastUrl != undefined && e.detail.vastUrl != null && e.detail.vastUrl != '' ? [{
                    tag: e.detail.vastUrl,
                    offset: "pre"
                  }, {
                    tag: e.detail.vastUrl.replace('vst.xml', 'vst2.xml'),
                    offset: "pre"
                  }] : [])

                <?php endif; ?>
              }
            <?php endif; ?>
          })
        });
      </script>
    <?php } else {

      the_post_thumbnail();
    }  ?>
    <div class="single-content-block" style="display: flex; flex-direction: row-reverse;">
      <div class="single-right-block">
        <div class="content">
          <?php if (is_singular('adresse_after')) {
            echo '<p><strong>Adresse&nbsp;: </strong>' . types_render_field('adresse') . '</p>';
          } ?>
          <?php the_content(); ?>
        </div>

        <!--           <div class="news news--related" style="margin-left: 40px;">
             <h2>Lire aussi&nbsp;:</h2>
             <?php echo do_shortcode('[wpv-view name="related-info-single-news"]'); ?>
          </div>   -->
      </div>
      <div class="single-left-block">
        <div class="meta">
          <h2>Partager l'article</h2>
          <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_dd"></a>
          </div>
          <div class="date"><strong><?php echo get_the_date('d F Y'); ?></strong> - <?php echo get_the_date('H\hi'); ?></div>
          <div class="date">Modifié le <strong><?php echo get_the_modified_date('d F Y'); ?></strong> - <?php echo get_the_modified_date('H\hi'); ?></div>
          <ul class="tags">
            <?php the_tags('<li>', '</li><li>', '</li>') ?>
            <li><?php the_category('</li><li>'); ?></li>
          </ul>
          <?php dynamic_sidebar('sidebar-3'); ?>
        </div>
      </div>
    </div>

  </div>

</article>