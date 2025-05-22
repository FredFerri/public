<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

  <main>

    <?php while ( have_posts() ) : the_post(); ?>

       <?php get_template_part( 'content', 'depeches' ); ?>

    <?php endwhile; // end of the loop. ?>

    <div class="clearfix">
  </main>

<?php get_footer('v2'); ?>
