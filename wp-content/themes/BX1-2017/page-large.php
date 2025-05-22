<?php
/**
 * Template Name: Page large
 * Template Post Type: page
 *
 * @package TeleBruxelles
 */

get_header(); ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; ?>

<?php get_footer(); ?>
