<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

    <section class="news" id="infinitescroll">

      <?php if ( have_posts() ) : ?>

         <h1><?php post_type_archive_title(); ?></h1>

         <div class="articles insideScroll">
            <?php echo do_shortcode('[wpv-view name="listing-concours-archive"]'); ?>
            <!--- <div id="paginatescroll"><?php posts_nav_link(); ?></div> --->
         </div>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

<?php get_footer(); ?>
