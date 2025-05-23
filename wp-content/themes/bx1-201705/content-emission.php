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
         $videoName = types_render_field('nom-du-fichier-video', array('raw'=>'true'));
         if ( !empty($videoName) ) { ?>
         <div id="video"></div>
         <script>
            jwplayer("video").setup({
                playlist: [{
                    image: "<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>",
                    sources: [{
                        file: "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"},{
                        file: "http://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4" + "/playlist.m3u8"
                    }]
                }],
                primary: "html5",
                width: "100%",
                aspectratio: "16:9",
                androidhls: true,
                advertising: {
                client: 'vast',
                <?php
			            $my_terms = get_the_terms( $post->ID, 'emissions' );
			            if( $my_terms && !is_wp_error( $my_terms ) ) {
			                foreach( $my_terms as $term ) {
			                    $termEmission   = $term->slug;
			                }
			            }
			            if( $termEmission == 'bx-foot' ) {
			            	?>
					               schedule: {
					                        adbreak1: {
					                          offset: "pre",
					                          tag: 'http://bx1.be/ads/BX1Campaign2.xml',
					                          
					                        },
					                        adbreak2: {
					                          offset: "post",
					                          tag: 'http://bx1.be/ads/BX1Campaign2.xml'
					                        }                 
					                },
			            <?php
			        		}
			        	else{
			        	?>
			        		schedule: {
				                        adbreak1: {
				                          offset: "pre",
				                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
				                        },
				                        adbreak2: {
				                          offset: "post",
				                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
				                        }                 
				                },
			        		<?php }
			         ?>
              'skipoffset':4,  
					                          'skiptext':'Passer',
					                          'skipmessage': 'Publicité. Votre vidéo commence dans XX secondes.'
              }
            });
         </script>
      <?php }  ?>
      <?php the_content(); ?>
   </div><!-- .entry-content -->
</article><!-- #post-## -->