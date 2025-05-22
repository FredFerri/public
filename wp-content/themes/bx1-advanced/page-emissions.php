<?php

/**
 * Template Name: Émissions
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main" role="main">

         <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
              <h2 class="section-title section-title--emissions">Émissions</h2>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <?php the_content(); ?>
              </div><!-- .entry-content -->
            </article><!-- #post-## -->

         <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
