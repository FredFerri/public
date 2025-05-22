<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

    <section class="news">

      <?php

      $argsNews = array(
	      'post_type'=> 'concours',
	      'posts_per_page' => 25,
	      'paged' => get_query_var('paged')
      );
      $queryNews = new WP_Query($argsNews);


      if ( $queryNews->have_posts() ) :
	      $count_posts = wp_count_posts()->publish;
          ?>
          <h1><?php post_type_archive_title(); ?></h1>

         <div class="articles">
            <?php echo do_shortcode('[wpv-view name="listing-concours-archive"]'); ?>
         </div>

         <?php //wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
   </section>

<?php get_footer('v2'); ?>
