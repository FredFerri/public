<?php
/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1><?php the_title(); ?></h1>

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
        <h2>Partager l'événement</h2>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_dd"></a>
        </div>
        <ul class="tags">
          <?php the_tags('<li>','</li><li>','</li>') ?>
          <?php the_terms( $post->ID, 'type-d-evenement','<li>','</li><li>','</li>'); ?>
        </ul>
        <?php dynamic_sidebar('sidebar-3'); ?>
      </div>

   </div>
</article>