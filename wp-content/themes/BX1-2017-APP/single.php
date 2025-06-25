<?php

/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>


<main>

  <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <span class="readLater" data-readlater="<?php the_ID(); ?>">À lire plus tard</span>

      <div class="socialShare">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
        <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
        <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp">Partager sur Whatsapp</a>
      </div>

      <div class="clearfix"></div>

      <h1><?php the_title(); ?></h1>

      <div class="date"><strong><?php echo get_the_date('d F Y'); ?></strong> - <?php echo get_the_date('H\hi'); ?></div>
      <ul class="tags">
        <?php the_tags('<li>', '</li><li>', '</li>') ?>
        <li><?php the_category('</li><li>'); ?></li>
      </ul>

      <div class="content">
        <?php
        $videoName = types_render_field('video-name-news', array('raw' => 'true'));
        if (!empty($videoName)) { ?>
          <div id="video"></div>
          <script>
            document.addEventListener("gestcomVideo", function(e) {
              jwplayer("video").setup({
                playlist: [{
                  sources: [{
                    file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + "/playlist.m3u8"
                  }, {
                    file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4"
                  }],
                  <?= get_subtitle_track(types_render_field('video-name-news')); ?>
                }],
                primary: 'html5',
                flashplayer: '<?php echo get_template_directory_uri(); ?>/js/jwplayer/jwplayer.flash.swf',
                width: '100%',
                aspectratio: '16:9',
                autostart: true,
                androidhls: true,
                <?php if (is_user_logged_in() && array_key_exists('nopub', $_COOKIE) && $_COOKIE['nopub'] == 'on'): //nopub 
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
                    schedule: {
                      adbreak1: {
                        offset: "pre",
                        <?php if (isset($the_term_id) && get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                          tag: '<?php echo types_render_termmeta('video-pre-roll', array('term_id' => $the_term_id)); ?>'
                        <?php else: ?>
                          tag: e.detail.vastUrl
                        <?php endif; ?>
                      }
                    }
                  }
                <?php endif; ?>
              })
            });
          </script>
        <?php } else {

          the_post_thumbnail();
        }  ?>

        <div class="content">
          <?php if (is_singular('adresse_after')) {
            echo '<p><strong>Adresse&nbsp;: </strong>' . types_render_field('adresse') . '</p>';
          } ?>
          <?php the_content(); ?>
        </div>

      </div>
    </article>

  <?php endwhile; // end of the loop. 
  ?>
  <div class="clearfix">
</main>

<?php get_footer(); ?>