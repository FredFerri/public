<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<section class="news news--grille" id="infinitescroll"> 

    <h1>Votre Bruxelles</h1>
    <p><a href="../votrebxl" class="btn">Soumettre une photo</a></p>
      <div class="insideScroll">
      <?php 
        $args = array(
          'post_type' => 'votre-bruxelles',
          'post_status' => 'publish',
          'posts_per_page' => 50
        );
        $eq_query = new WP_Query($args);
        if($eq_query->have_posts()) : // The Loop
          while ($eq_query->have_posts()): $eq_query->the_post();
      ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
      <?php
        endwhile; ?>
        <div id="paginatescroll"><?php posts_nav_link(); ?></div>
        <?php
        wp_reset_query();
        endif;
      ?>
    </div>

  </section>

<?php get_footer(); ?>
