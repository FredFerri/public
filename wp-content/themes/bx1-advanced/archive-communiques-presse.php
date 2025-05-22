<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <section id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main archives-<?php echo get_queried_object()->slug; ?>" role="main">

      <?php if ( have_posts() ) : ?>

         <header class="page-header">
            <h1 class="page-title section-title section-title--depeche"><?php post_type_archive_title(); ?></h1>
         </header><!-- .page-header -->

         <?php /* Start the Loop */ ?>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
         <?php while ( have_posts() ) : the_post(); ?>

            <div class="news news--depeches large-6 columns">
               <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>

         <?php endwhile; ?>
         </div>

         <?php wp_pagenavi(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

      </main><!-- #main -->
   </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
