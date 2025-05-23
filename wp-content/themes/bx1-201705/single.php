<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main">

      <?php while ( have_posts() ) : the_post(); ?>
         <?php get_template_part( 'content', 'single' ); ?>
      <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->
      <section>
      <?php while ( have_posts() ) : the_post();
      if ( in_category(3) ) { ?>

       <h2 class="section-title section-title--sport">News liées <span class="section-title-all"><a href="/category/sport/">Tout le sport</a></span></h2>

      <?php } else { ?>
         <h2 class="section-title section-title--news">News liées <span class="section-title-all"><a href="/news">Toute l'info</a></span></h2>

      <?php }endwhile; ?>

         <div class="row" data-equalizer data-options="equalize_on_stack: true">
            <?php echo do_shortcode('[wpv-view name="related-info-single-news"]'); ?>
         </div>
      </section>
      <section>
         <h2 class="section-title section-title--depeche">Fil d'actu <span class="section-title-all"><a href="/depeches">Toutes les dépêches</a></span></h2>
         <?php include 'depeches-accordion.php'; ?>
      </section>
   </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
