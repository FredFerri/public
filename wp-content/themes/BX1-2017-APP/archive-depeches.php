<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<ul class="switch">
  <li><a href="../news/">Actualités</a></li>
  <li class="active"><a href="../depeches/">Direct info</a></li>
</ul>

  <section id="infinitescroll">

    <h1>Direct info</h1>

      <?php if ( have_posts() ) : ?>

          <ul class="directinfo insideScroll">

            <?php
              $argsNews = array(
                'post_type'=> 'depeches',
                'posts_per_page' => 25,
                'paged' => get_query_var('paged')
              );
              $queryNews = new WP_Query($argsNews);
              if($queryNews->have_posts()) : ?>
                <?php
                  while ( $queryNews->have_posts() ) : $queryNews->the_post();
                ?>
                  <li class="post">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="date"><?php echo get_the_date('d F Y - H\hi'); ?></p>
                  </li>
                <?php endwhile; ?>

                <div id="paginatescroll"><?php posts_nav_link(); ?></div>

              <?php wp_reset_postdata(); endif; ?>

            </ul>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section><!-- #primary -->

<?php get_footer(); ?>
