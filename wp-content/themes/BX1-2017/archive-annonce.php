<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

  <section class="sideFil sideFil--big">

      <?php if ( have_posts() ) : ?>

         <h1><?php post_type_archive_title(); ?></h1>

         <ul>

            <?php
              $argsNews = array(
                'post_type'=> 'annonce',
                'posts_per_page' => 25,
                'paged' => get_query_var('paged')
              );
              $queryNews = new WP_Query($argsNews);
              if($queryNews->have_posts()) : ?>
                <?php
                  while ( $queryNews->have_posts() ) : $queryNews->the_post();
                ?>
                  <li>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="date"><?php echo get_the_date('d F Y'); ?></p>
                  </li>
                <?php endwhile; ?>
              <?php wp_reset_postdata(); endif; ?>

         </ul>

         <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>

<?php get_footer('v2'); ?>
