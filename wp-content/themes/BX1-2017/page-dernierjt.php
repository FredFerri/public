<?php

/**
 * Template Name: Dernier JT
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<div class="dernierjt-container">

  <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?> ...</h1>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <?php
  // On affiche 1 post "émission", dans la catégorie "Journal 18h" ou "Journal 12h30"
  $argsNews = array(
    'post_type' => 'emission',
    'posts_per_page' => 1,
    'orderby' => array('date' => 'DESC'),
    'tax_query' => array(
      array(
        'taxonomy' => 'type_emissions',
        'field' => 'slug',
        'terms' => array('18h-journal')
      )
    )
  );
  $queryNews = new WP_Query($argsNews);
  if ($queryNews->have_posts()) : ?>
    <?php while ($queryNews->have_posts()) : $queryNews->the_post(); ?>
      <h2><?php the_title(); ?></h2>
      <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
        <div id="dernierJT"></div>
      </div>
      <script>
        document.addEventListener("gestcomVideo", function(e) {
          jwplayer("dernierJT").setup({
            playlist: [{
              sources: [{
                file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + "/playlist.m3u8"
              }, {
                file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"
              }]

              <?php
              // $value_show_subtitles = get_option('show_subtitles');
              // $subtitle_file = "/data/sites/bx1.be/httpdocs/videofiles/".types_render_field('nom-du-fichier-video').".vtt";
              // if (($value_show_subtitles == true && file_exists($subtitle_file)) || ($_GET["showvtt"] == 1 && file_exists($subtitle_file)))
              // {
              ?>
              //  ,
              //  tracks: [{
              //       file: "https://bx1.be/videofiles/" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".vtt",
              //       label: "Français",
              //       kind: "captions",
              //       "default": false
              //  }]
              <?php // } 
              ?>
            }],
            primary: 'html5',
            width: '100%',
            aspectratio: '16:9',
            autostart: true,
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
    <?php endwhile; ?>
  <?php wp_reset_postdata();
  endif; ?>

  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed&display=swap" rel="stylesheet">

  <div class="dernierjt-buttons">
    <div class="button">
      <a class="one" href="https://bx1.be/lives/direct-tv/?theme=classic">Suivez BX1 en direct</a>
    </div>

    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed&display=swap" rel="stylesheet">
    <style>

    </style>
    <div class="button1">
      <a class="two" href="https://bx1.be/type_emissions/18h-journal/">Tous les JT</a>
    </div>
  </div>
</div>
</div>
</div>


<?php get_footer('v2'); ?>