<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

  <section class="sideFil sideFil--big">

    <h1>Direct info</h1>

      <?php if ( have_posts() ) : ?>

          <ul>

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
                  <li>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="date"><?php echo get_the_date('d F Y - H\hi'); ?></p>
                  </li>
                <?php endwhile; ?>
              <?php wp_reset_postdata(); endif; ?>

            </ul>

         <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section><!-- #primary -->

   <section class="news news--mini">
      <?php
      // On affiche 3 news, en commençant par celles mises en avant, et ensuite par date de publication
      if(get_option('home_pres') == 'news'){$passe=1;};
      $argsNews = array(
        'post_type'=> 'post',
        'posts_per_page' => 3,
        'meta_key' => 'wpcf-featured-news',
        'orderby' => array( 'meta_value' => 'DESC', 'date' => 'DESC' )
      );
      $queryNews = new WP_Query($argsNews);
      if($queryNews->have_posts()) : ?>
        <?php
          while ( $queryNews->have_posts() ) : $queryNews->the_post();
          $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
          $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
          $sport = in_category('sport');
          $count++;
            if(get_option('home_pres') == 'news'){
              $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
            }
            else{
              $even_odd_class = ( ($count % 2) == 0 ) ? "even" : "odd";
            }
        ?>
          <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
            <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
            <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              <figure>
                <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                <?php the_post_thumbnail('medium'); ?>
              </figure>
            </a>
          </article>
        <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>
      <a href="../news" title="Voir Toutes les news" class="allLink allLink--mini">Toutes les news</a>
      <?php get_sidebar('sidebar-1'); ?>
    </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
