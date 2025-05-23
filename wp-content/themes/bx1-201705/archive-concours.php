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
            <h1 class="page-title section-title"><?php post_type_archive_title(); ?></h1>
         </header><!-- .page-header -->

         <?php /* Start the Loop */ ?>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
         <?php echo do_shortcode('[wpv-view name="listing-concours-archive"]'); ?>
         </div>

         <?php wp_pagenavi(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

      </main><!-- #main -->
   </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
