<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */



get_header('v2'); ?>

      <main class="single-main" style="display: flex; justify-content: space-between; width: 100%;">
         <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'single' ); ?>
         <?php endwhile; // end of the loop. ?>
         <div class="clearfix">
      </main>
      <p></p>


<?php get_footer('v2'); ?>
