<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

    <section class="news" id="infinitescroll">

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

            <article class="news__article <?php echo $even_odd_class; ?> post">
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
                 <h3><?php the_title(); ?> <span class="date"><?php echo $heure; ?></span></h3>
               </a>
            </article>

         <?php } endwhile; ?>

         <div id="paginatescroll"><?php posts_nav_link(); ?></div>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </div>

   </section><!-- #primary -->

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo'); ?>
      <?php get_sidebar('sidebar-1'); ?>
   </section>

<?php get_footer(); ?>