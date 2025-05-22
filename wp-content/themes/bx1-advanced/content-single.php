<?php
/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header">
      <div class="entry-meta">
         <?php telebruxelles_posted_on(); ?>
      </div><!-- .entry-meta -->
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      <?php echo share(); ?>
   </header><!-- .entry-header -->

   <div class="entry-content">
      <?php
         $videoName = types_render_field('video-name-news', array('raw'=>'true'));
         if ( !empty($videoName) ) { ?>
         <div id="video"></div>
         <script>
            jwplayer("video").setup({
              image: "<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>",
              sources: [{
                  file: "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4"},{
                  file: "http://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4" + "/playlist.m3u8"
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
      <?php the_content(); ?>
   </div><!-- .entry-content -->
</article><!-- #post-## -->
