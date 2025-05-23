<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>
   <div id="primary" class="content-area large-12 columns">
      <main id="main" class="site-main">

      <?php while ( have_posts() ) : the_post(); ?>

         <?php get_template_part( 'content', 'mobilite-single' ); ?>

      <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
