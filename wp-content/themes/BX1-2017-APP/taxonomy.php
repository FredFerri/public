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

         <h1 class="section-title section-title--emissions"><?php echo single_cat_title( '', false ); ?></h1>

         <?php while ( have_posts() ) : the_post(); ?>

            <article class="news__article post <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
              <a href="<?php the_permalink(); ?>">
                <figure>
                    <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                    <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                    <?php the_post_thumbnail('medium'); ?>
                </figure>
                <h3><?php the_title(); ?></h3>
              </a>
            </article>

         <?php endwhile; ?>

         <div id="paginatescroll"><?php posts_nav_link(); ?></div>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo'); ?>
      <?php get_sidebar('sidebar-1'); ?>
   </section>

<?php get_footer(); ?>