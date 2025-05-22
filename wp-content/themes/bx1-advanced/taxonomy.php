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
      <main id="main" class="site-main" role="main">

      <?php if ( have_posts() ) : ?>

         <header class="page-header">
            <h1 class="section-title section-title--emissions">Émissions</h1>

            <h2><?php echo single_cat_title( '', false ); ?></h2>


            <?php
               $image_url = apply_filters( 'taxonomy-images-queried-term-image-url', '', array(
                  'image_size' => 'full'
               ) );
            ?>
               <img src="<?php echo $image_url; ?>" alt="">
            <?php
               // Show an optional term description.
               $term_description = term_description();
               if ( ! empty( $term_description ) ) :
                  printf( '<div class="taxonomy-description">%s</div>', $term_description );
               endif;
            ?>
         </header><!-- .page-header -->

         <?php /* Start the Loop */ ?>
         <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <header class="entry-header">
                  <?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
               </header><!-- .entry-header -->
            </article><!-- #post-## -->

         <?php endwhile; ?>

         <?php telebruxelles_paging_nav(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

      </main><!-- #main -->
   </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>