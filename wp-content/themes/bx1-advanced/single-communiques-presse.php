<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

         <?php get_template_part( 'content', 'single' ); ?>

      <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
      <section>
         <h2 class="section-title section-title--depeche">Fil d'actu <span class="section-title-all"><a href="/depeches">Toutes les dépêches</a></span></h2>
         <?php include 'depeches-accordion.php'; ?>
      </section>
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
