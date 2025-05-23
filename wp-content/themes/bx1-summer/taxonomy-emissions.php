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
      <main id="main" class="site-main">

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
         <?php
                     $my_terms = get_the_terms( $post->ID, 'emissions' );
                     if( $my_terms && !is_wp_error( $my_terms ) ) {
                         foreach( $my_terms as $term ) {
                             $termEmission   = $term->slug;
                         }
                     }
                     if( $termEmission == 'bx-foot' ) 
                        {
                           echo do_shortcode('[wpv-view name="derniere-emission-bxfoot"]');
                        }
                     else{
                        echo do_shortcode('[wpv-view name="derniere-emission"]');
                     }
                  ?>
         <?php //echo do_shortcode('[wpv-view name="derniere-emission"]'); ?>

         <?php /* Start the Loop */ ?>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">

         <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" class="news news--emissions large-6 columns">
               <span class"entry-date"><?php the_date('j F Y'); ?></span>
               <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </article>

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