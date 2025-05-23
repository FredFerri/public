<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package TeleBruxelles
 */
// Add Shortcode
$shortcodevideo = 1;
function BX1ShowVideo($atts) {
  $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
  $ID   = uniqid();
  $fichier  = $atts[fichier];
  return '<div id="video'.$ID.'"></div>
    <script>
            jwplayer("video'.$ID.'").setup({
              image: "'.$image_news[0].'",
              sources: [{
                  file: "rtmp://149.202.81.107:1935/vod/mp4:" + "'.$fichier.'" + ".mp4"},{
                  file: "http://149.202.81.107:1935/vod/mp4:" + "'.$fichier.'" + ".mp4" + "/playlist.m3u8", type : "mp4"
              }],
              primary: "html5",
              width: "100%",
              aspectratio: "16:9",
              androidhls: true,
              advertising: {
                client: \'vast\',
                schedule: {
                        adbreak1: {
                          offset: "pre",
                          tag: \'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=\' + Math.floor(Date.now() / 1000)
                        },
                        adbreak2: {
                          offset: "post",
                          tag: \'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=\' + Math.floor(Date.now() / 1000)
                        }                 
                }
              }
            });
            </script>';
  $shortcodevideo++;
}
add_shortcode('bx1video', 'BX1ShowVideo');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header" style="border-bottom: 4px solid #FF2E4D;margin-bottom: 15px;">
    <?php the_title( '<h1 class="entry-title"><a href="/mobilite/">Mobilité</a> > ', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
  <?php
         $videoName = types_render_field('video-name-mobilite', array('raw'=>'true'));
         if ( !empty($videoName) ) { ?>
         <div id="video"></div>
         <script>
            jwplayer("video").setup({
              image: "<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>",
              sources: [{
                  file: "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-mobilite'); ?>" + ".mp4"},{
                  file: "http://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-mobilite'); ?>" + ".mp4" + "/playlist.m3u8", type : "mp4"
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
      <?php }  ?>
    <?php 
    the_content(); ?>
    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'telebruxelles' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->
  <footer class="entry-footer">
    <?php edit_post_link( __( 'Edit', 'telebruxelles' ), '<span class="edit-link">', '</span>' ); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->
