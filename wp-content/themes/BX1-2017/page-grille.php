<?php

/**
 * Template Name: Grille des programmes
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

  <section class="news news--grille"> 

    <h1><?php the_title(); ?></h1>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php the_content() ?>

    <?php endwhile; // end of the loop. ?>

    <?php
      $day = mktime(0,0,0,date('n'),date('j'),date('Y')); //$day = aujourd'hui pour commencer
    ?>
    <ul class="onglets">
      <?php for ($i=1;$i<=7;$i++): ?>
        <li><a href="#grille<?php echo $i; ?>" <?php if($i==1): ?>class="active"<?php endif; ?>><?php echo date('d/m/Y',$day); ?></a></li>
        <?php $day = strtotime('+1 day', $day); ?>
      <?php endfor; ?>
    </ul>

    <?php
      $day = mktime(0,0,0,date('n'),date('j'),date('Y')); //$day = aujourd'hui pour commencer
    ?>
    <?php for ($i=1;$i<=7;$i++): ?>
      <div class="grille" id="grille<?php echo $i; ?>" <?php if($i==1): ?>style="display:block;"<?php endif; ?>>
        <h2><?php echo date('d/m/Y',$day); ?></h2>
        <ul class="grid">
          <?php 
            $args = array(
              'post_type' => 'emission',
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'meta_query' => array(
                'relation' => 'AND',
                  array(
                     'key' => 'wpcf-horaire-debut',
                     'value' => $day,
                     'compare' => '>=',
                 ),
                 array(
                     'key' => 'wpcf-horaire-debut',
                     'value' => strtotime('+1 day', $day),
                     'compare' => '<',
                 )
               ),
              'meta_key' => 'wpcf-horaire-debut',
              'orderby' => array( 'meta_value' => 'ASC')
            );
            $eq_query = new WP_Query($args);
            if($eq_query->have_posts()) : // The Loop
              while ($eq_query->have_posts()): $eq_query->the_post();
          ?>
          <li class="grid__row <?php if(types_render_field('featured-news') == '1'): ?>grid__row--featured<?php endif; ?>">
            <div class="grid__row__hour">
              <?php echo types_render_field('horaire-debut',array('format'=>'H:i')); ?><br />
              <?php echo types_render_field('horaire-fin',array('format'=>'H:i')); ?>
            </div>
            <div class="grid__row__prog">
              <?php if(types_render_field('n-afficher-que-sur-la-grille') == '1'): ?>
                <?php the_title(); ?>
              <?php else : ?>
                <a href="<?php the_permalink(); ?>" title="En savoir plus sur l'émission <?php the_title(); ?>"><?php the_title(); ?></a>
              <?php endif; ?>
            </div>
            <div class="grid__row__imag">
              <a href="<?php the_permalink(); ?>" title="En savoir plus sur l'émission <?php the_title(); ?>">
                <figure>
                 <?php
                  $terms = get_the_terms( $post->ID, 'type_emissions' );
                  foreach ($terms as $term){
                      $image = apply_filters( 'taxonomy-images-get-terms', '', array(
                          'taxonomy' => 'type_emissions',
                              'term_args' => array(
                                  'slug' => $term->slug,
                                  )
                          ) 
                      );
                      foreach( (array) $image as $img){
                          echo wp_get_attachment_image( $img->image_id, 'Logo');
                      }
                  }
                 ?>
                </figure>
              </a>
            </div>
          </li>
          <?php
            endwhile;
            wp_reset_query();
            endif;
          ?>
        </ul>
      </div>
      <?php $day = strtotime('+1 day', $day); ?>
    <?php endfor; ?>

  </section>

  <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
  </section>

<?php get_footer('v2'); ?>