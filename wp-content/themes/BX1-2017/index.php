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

get_header('v2'); ?>

   <section class="news">

      <?php
      // On inclu les iReporter dans les news et on affiche les featured en 1er
      // Arguments de la requête
      $argsNews = array(
          'post_type'      => array( 'post', 'ireport' ),
          'orderby'        => 'date',
          'order'          => 'DESC',
          'tax_query'      => array(
              'relation' => 'AND',
              // Exclure les articles exclusifs
              array(
                  'taxonomy'         => 'exclusif-blog',
                  'field'            => 'slug',
                  'terms'            => array( 'oui' ),
                  'operator'         => 'NOT IN',
                  'include_children' => false,
              ),
          ),
          // Activer le tri personnalisé pour afficher les articles mis en avant en premier
          // 'featured_news_order' => true,
          'paged' => get_query_var('paged')
      );

      $queryNews = new WP_Query($argsNews);
      
      // Mettre en cache les résultats pendant 5 minutes
      set_transient($transient_name, $queryNews, 2 * MINUTE_IN_SECONDS);
      ?>

      <?php if ( have_posts() ) : ?>
            
        <h1>Actualités</h1>

        <div class="articles">
          <?php
            while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
            $flash    = wp_get_post_terms($post->ID, 'flash_news', array('fields' => 'slugs'));
            $sport          = has_category('sport', $post);
            $redaction      = has_category('dossiers-redaction', $post);
            $bonus          = has_category('bx1-bonus', $post);
            $exclusif       = in_array('oui', wp_get_post_terms($post->ID, 'exclusif-blog', array('fields' => 'slugs')));
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
                <figure>
                  <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                  <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                  <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                  <?php if($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                  <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                  <?php the_post_thumbnail('medium'); ?>
                </figure>
                <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              </a>
            </article>
          <?php endwhile; ?>
        </div>

        <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

    </section>

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <div id="pubAside">

        <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): ?>
          <!-- Nopub activé -->
        <?php else: ?>
           <!-- ads - zone images publicitaires bannering_imu -->
         <div id="gestcom_56"></div>
        <?php endif; ?>
      </div>      
      <?php dynamic_sidebar('sidebar-3'); ?>
   </section>

<?php get_footer('v2'); ?>
