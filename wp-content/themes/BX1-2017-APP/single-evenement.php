<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

      <main>
         <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

         <div class="socialShare">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
                 <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
                 <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp">Partager sur Whatsapp</a>
         </div>
         
            	<div class="clearfix"></div>

  <h1><?php the_title(); ?></h1>

   <ul class="tags">
          <?php the_tags('<li>','</li><li>','</li>') ?>
          <?php the_terms( $post->ID, 'type-d-evenement','<li>','</li><li>','</li>'); ?>
        </ul>

  <div class="content">
    <?php the_post_thumbnail(); ?>

      <div class="meta">
        <h2>Lieu et dates</h2>
        <div class="date"><?php echo types_render_field('lieu'); ?></div>
        <div class="date">
          <strong>
            <?php
              $date_debut = types_render_field('date-de-debut',array('format'=>'d/m/Y'));
              $date_fin = types_render_field('date-de-fin',array('format'=>'d/m/Y'));
              if($date_debut == $date_fin):
            ?>
              Le <?php echo types_render_field('date-de-debut',array('format'=>'d/m/Y')); ?> de <?php echo types_render_field('date-de-debut',array('format'=>'H:i')); ?> à <?php echo types_render_field('date-de-fin',array('format'=>'H:i')); ?>
            <?php else : ?>
              Du <?php echo types_render_field('date-de-debut',array('format'=>'d/m/Y \à H:i')); ?><br />
              au <?php echo types_render_field('date-de-fin',array('format'=>'d/m/Y \à H:i')); ?>
            <?php endif; ?>
          </strong>
        </div>
        
      </div>

   </div>
</article>
         <?php endwhile; // end of the loop. ?>
         <div class="clearfix">
      </main>
      
<?php get_footer(); ?>
