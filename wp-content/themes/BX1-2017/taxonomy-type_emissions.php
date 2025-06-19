<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); 


  if (is_tax('type_emissions', 'hockey-indoor')):

      // Si il y a au moins 2 lives (donc au moins le direct tv + un live web), on passe le 1er (le direct tv) et on affiche le 2e uniquement
      $argsVideo = array(
        'post_type'=> array('lives'),
        'posts_per_page' => 1,
        'orderby' => array('date' => 'DESC'),
        'offset' => '1'
      );
      $queryVideo = new WP_Query($argsVideo);
      if($queryVideo->have_posts()) :
        while ( $queryVideo->have_posts() ) : $queryVideo->the_post();
    ?>

    <section class="live">
      <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}"><div id="videoLive"></div></div>
            <script>
        document.addEventListener("gestcomVideo", function(e) {
        jwplayer("videoLive").setup({
          playlist: [{
                   "sources": [{
                     "file": "https://<?php echo types_render_field('url-du-live'); ?>/playlist.m3u8"
                   },{
                     "file": "rmtps://<?php echo types_render_field('url-du-live'); ?>"
                   }]
                 }],
          primary: 'html5',
          width: '100%',
          aspectratio: '16:9',
          autostart: true,
          androidhls: true,
          <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub ?>
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
        })
        });
      </script>
      
    </section>

  <?php endwhile; wp_reset_postdata(); endif; endif; ?>

    <section class="news">

      <?php if ( have_posts() ) : ?>

            <h1><?php echo single_cat_title( '', false ); ?></h1>

            <?php
               $image_url = apply_filters( 'taxonomy-images-queried-term-image-url', '', array(
                  'image_size' => 'full'
               ) );
            ?>
               <img src="<?php echo $image_url; ?>" alt="">
            <?php
               // Show an optional term description.
               $term_description = term_description();
               if ( ! empty( $term_description ) ) :
                  printf( '<div class="taxonomy-description">%s</div>', $term_description );
               endif;
            ?>
      <div class="articles">
         <?php 
            while ( have_posts() ) : the_post();
            $count++;
               if(get_option('home_pres') == 'news'){
                 $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
               }
               else{
                 $even_odd_class = ( ($count % 2) == 0 ) ? "even" : "odd";
               }
            $heure = '';
            if(types_render_field('horaire-debut') == ''){
              $heure = get_the_date('d F Y à H:i');
            }
            else{
              $heure = types_render_field('horaire-debut',array('format'=>'d F Y \d\e H:i')).' à '.types_render_field('horaire-fin',array('format'=>'H:i'));
            }
            if(types_render_field('n-afficher-que-sur-la-grille') != '1' && types_render_field('nom-du-fichier-video') != ''){
         ?>

            <article class="news__article <?php echo $even_odd_class; ?>">
              <a href="<?php the_permalink(); ?>" title="Voir l'émission <?php the_title(); ?>">
                 <figure>
                   <?php
                      $terms = get_the_terms( $post->ID, 'type_emissions' );
                      $featured_img_url = get_the_post_thumbnail(get_the_ID(),'Emissions');
                      echo $featured_img_url;
                     /*
                      foreach ($terms as $term){
                          $image = apply_filters( 'taxonomy-images-get-terms', '', array(
                              'taxonomy' => 'type_emissions',
                                  'term_args' => array(
                                      'slug' => $term->slug,
                                      )
                              ) 
                          );
                          foreach( (array) $image as $img){
                              echo wp_get_attachment_image( $img->image_id, 'Emissions');
                          }
                      }*/
                    ?>
                 </figure>
                 <h3><?php the_title(); ?> <span class="date"><?php echo $heure; ?> ..</span></h3>
               </a>
            </article>

         <?php } endwhile; ?>

         <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </div>

   </section><!-- #primary -->

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
   </section>

<?php get_footer('v2'); ?>