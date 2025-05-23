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

         <h1>@After</h1>

         <p><a href="../form_after" class="btn">Suggérer une adresse</a></p>

            <?php
              $argsNews = array(
                'post_type'=> 'adresse_after',
                'posts_per_page' => 10,
                'paged' => get_query_var('paged')
              );
              $queryNews = new WP_Query($argsNews);
              if($queryNews->have_posts()) : ?>

        <div class="articles insideScroll">
          <?php
            while ( $queryNews->have_posts() ) : $queryNews->the_post();
          ?>
            <article class="news__article post ">
              <a href="<?php the_permalink(); ?>">
                <figure>
                    <?php the_post_thumbnail('medium'); ?>
                </figure>
                <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              </a>
            </article>
          <?php endwhile; ?>
                  <div id="paginatescroll"><?php posts_nav_link(); ?></div>
        </div>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>
   </section>

<?php get_footer(); ?>
