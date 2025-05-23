<?php

/**
 * Template Name: Mobilité
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

    <section class="news">
      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>

      <div class="socialShare">
                 <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
                 <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
                 <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp">Partager sur Whatsapp</a>
              </div>

      <h2>État du trafic bruxellois en temps réel</h2>
      
      <iframe src="<?php echo get_template_directory_uri();?>/trafic_for_app.html" width="100%" height="350" frameborder="0"></iframe>

      <h2>Les travaux en cours à Bruxelles-Capitale</h2>

      <iframe src="https://opendata.bruxelles.be/explore/embed/dataset/evenements-trafic-travaux/map/?location=12,50.84499,4.35359&static=false&datasetcard=false" width="100%" height="350" frameborder="0"></iframe>

    </section>

<?php get_footer(); ?>

