<?php

/**
 * Template Name: HLS
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main" role="main">

         <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

            <h4>Test random video from Télé Bruxelles</h4>
            <div id="video-live"></div>

            <h4>Test video jwPalyer</h4>
            <div id="video-live2"></div>

            <h4>Test with code + video from jwPlayer [<a href="http://demo.jwplayer.com/homepage/">link</a>]</h4>
            <div id="video-live3"></div>

            <script>

              jwplayer("video-live").setup({
                  image: "<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>",
                  sources: [{
                      file: "rtmp://149.202.81.107:1935/vod/mp4:" + "20141007_KURDESITW2" + ".mp4"},{
                      file: "http://149.202.81.107:1935/vod/mp4:" + "20141007_KURDESITW2" + ".mp4" + "/playlist.m3u8"
                  }],
                  primary: "html5",
                  width: "100%",
                  aspectratio: "16:9",
                  androidhls: true
              });

               jwplayer("video-live2").setup({
                   playlist: [{
                       image: "",
                       sources: [{
                           file: "http://content.jwplatform.com/videos/HkauGhRi-640.mp4"
                       }]
                   }],
                   width: "100%",
                   aspectratio: "16:9"
               });


              jwplayer("video-live3").setup({
                image: "http://demo.jwplayer.com/homepage/homepage_preroll.jpg",
                sources: [{
                    file: "http://content.jwplatform.com/videos/HkauGhRi-640.mp4"
                  },{
                    file: "http://content.jwplatform.com/videos/HkauGhRi-1280.mp4",
                }],
                width: "100%",
                aspectratio: "16:9",
                repeat: true
              });

</script>

         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
