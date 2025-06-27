<?php

/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<div id="primary">

  <main class="live">
    <?php while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
      <?php
      $value_video_source = get_option('video_source');
      $value_vimeolink    = get_option('vimeolink');
      if ($value_video_source == "vimeo") {
      ?>
        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php echo $value_vimeolink; ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>
      <?php
      } else {
      ?>
        <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}">
          <div id="videoLive"></div>
        </div>
        <script>
          document.addEventListener("gestcomVideo", function(e) {
            jwplayer("videoLive").setup({
              playlist: [{
                "sources": [{
                  "file": "https://<?php echo types_render_field('url-du-live'); ?>/playlist.m3u8"
                }, {
                  "file": "rmtps://<?php echo types_render_field('url-du-live'); ?>"
                }]
              }],
              primary: 'html5',
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
      <?php
      }
      ?>
    <?php endwhile; // end of the loop. 
    ?>

  </main>

  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed&display=swap" rel="stylesheet">
  <style>
    .button {
      background-color: #e2237a;
      border: none;
      color: #fff;
      padding: 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 45px;
      font-family: 'Asap Condensed', sans-serif;
      margin: 10px 90px;
      cursor: pointer;
      width: 400px;
      border-radius: 5px;
      float: left;
    }

    a.one:link {
      color: #fff;
    }

    a.one:hover {
      color: #fff;
    }

    a.one:visited {
      color: #fff;
    }
  </style>
  <div class="button">
    <a class="one" href="https://bx1.be/dernier-jt/?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>">Regardez le dernier JT</a>
  </div>
</div>

<link href="https://fonts.googleapis.com/css?family=Asap+Condensed&display=swap" rel="stylesheet">
<style>
  .button1 {
    background-color: #e2237a;
    border: none;
    color: #fff;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 45px;
    font-family: 'Asap Condensed', sans-serif;
    margin: 10px 90px;
    cursor: pointer;
    width: 400px;
    border-radius: 5px;
  }

  a.two:link {
    color: #fff;
  }

  a.two:hover {
    color: #fff;
  }

  a.two:visited {
    color: #fff;
  }
</style>
<div class="button1">
  <a class="two" href="https://bx1.be/emissions/?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>">Le replay des émissions</a>
</div>

</div><!-- #primary -->

<?php get_footer('v2'); ?>