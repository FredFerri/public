<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <section id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main archives-news" role="main">

      <?php if ( have_posts() ) : ?>

         <header class="page-header">
            <h1 class="page-title section-title section-title--news">News</h1>
         </header><!-- .page-header -->

         <?php /* Start the Loop */ ?>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
         <?php while ( have_posts() ) : the_post(); ?>

            <div class="news large-6 medium-4 columns end">
               <a class="news__link-img" href="<?php the_permalink(); ?>">
                 <?php if ( !empty($videoFileName) ){ ?>
                 <span class="video-label video-label--news">Vidéo</span><span class="video-play"></span>
                 <?php } ?>
                  <?php echo do_shortcode('[url-pic-head]'); ?>
               </a>
               <div class="news__share"><?php echo share(); ?></div>

               <div class="">
                 <div class="small-3 large-2 left news__entry-date-wrap">
                   <time class="news__entry-date" data-equalizer-watch datetime="<?php the_time( 'Y-m-d' ); ?>" data-equalizer-watch><?php echo get_the_date('j/m'); ?></time>
                 </div>
                 <div class="small-9 large-10 left">
                   <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>">
                     <?php the_title(); ?></a>
                   </h3>
                 </div>
               </div>
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
