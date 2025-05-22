<?php

/**
 * Template Name: Grille des programmes
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-12 columns">
      <main id="main" class="site-main" role="main">

         <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
              <h2>Grille des programmes</h2>
              </header><!-- .entry-header -->
              <div class="entry-content">
                <?php the_content(); ?>
              </div><!-- .entry-content -->
              <footer class="entry-footer">
                <?php edit_post_link( __( 'Edit', 'telebruxelles' ), '<span class="edit-link">', '</span>' ); ?>
              </footer><!-- .entry-footer -->
            </article><!-- #post-## -->


         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_footer(); ?>