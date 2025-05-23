<?php get_header(); ?>

<h2>Actualités</h2>

<div class="articles">

<?php

    // Nom unique pour le transient
    $transient_name = 'home_query_news_big_app_v2';

    // Tenter de récupérer la requête mise en cache
    $queryNews = get_transient($transient_name);

    if (false === $queryNews) {

      // Arguments de la requête
      $argsNews = array(
          'post_type'      => array( 'post', 'ireport' ),
          'posts_per_page' => 1,
          'orderby'        => 'date',
          'order'          => 'DESC',
          'tax_query'      => array(
              'relation' => 'AND',
              // Inclure seulement les articles mis en avant
              array(
                  'taxonomy'         => 'featured_news',
                  'field'            => 'slug',
                  'terms'            => array( 'oui' )
              ),
              // Exclure les articles exclusifs
              array(
                  'taxonomy'         => 'exclusif-blog',
                  'field'            => 'slug',
                  'terms'            => array( 'oui' ),
                  'operator'         => 'NOT IN'
              ),
          ),
      );

      // Exécuter la requête
      $queryNews = new WP_Query( $argsNews );
      // var_dump($queryNews);
      // var_dump($queryNews->have_posts());

      set_transient($transient_name, $queryNews, 2 * MINUTE_IN_SECONDS);
    }

      // Vérifier s'il y a des articles
      if ( $queryNews->have_posts() ) :
          while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
            $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
            $is_flash_news = in_array('oui', $flash_terms);
            $sport = has_category('sport');
            $redaction = has_category('dossiers-redaction');
            $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
            $is_exclusif   = in_array( 'oui', $exclusif_terms );
            $count++;
            $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
            ?>

            <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
                <a href="<?php the_permalink(); ?>">
                  <figure>
                      <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                      <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                      <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                      <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                      <?php the_post_thumbnail('medium'); ?>
                  </figure>
                  <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
                </a>
                <span class="readLater" data-readlater="<?php echo $post->ID; ?>">À lire plus tard</span>
              </article>
            <?php endwhile; ?>
          <?php // wp_reset_postdata();
          endif; 


      // Nom unique pour le transient
      $transient_name = 'home_query_news_list_app_v2';

      // Tenter de récupérer la requête mise en cache
      $queryNews = get_transient($transient_name);

      if (false === $queryNews) {

        // Arguments de la requête
        $argsNews = array(
          'post_type'      => array( 'post', 'ireport' ),
          'posts_per_page' => 9,
          'offset'         => 1,
          'orderby'        => 'date',
          'order'          => 'DESC',
          'tax_query'      => array(
              'relation' => 'AND',
              // Exclure les articles exclusifs
              array(
                  'taxonomy'         => 'exclusif-blog',
                  'field'            => 'slug',
                  'terms'            => array( 'oui' ),
                  'operator'         => 'NOT IN'
              ),
          ),
          // Activer le tri personnalisé pour afficher les articles mis en avant en premier
          // 'featured_news_order' => true,
        );

        $queryNews = new WP_Query($argsNews);

        // Mettre en cache les résultats pendant 2 minutes
        set_transient($transient_name, $queryNews, 2 * MINUTE_IN_SECONDS);

      }
      
      if($queryNews->have_posts()) : ?>
        <?php
          while ( $queryNews->have_posts() ) : $queryNews->the_post();
          $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
          $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
          $is_flash_news = in_array('oui', $flash_terms);
          $sport = has_category('sport');
          $redaction = has_category('dossiers-redaction');
          $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
          $is_exclusif   = in_array( 'oui', $exclusif_terms );
          $count++;
          $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
        ?>
          <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
            <a href="<?php the_permalink(); ?>">
              <figure>
                  <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                  <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                  <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                  <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                  <?php the_post_thumbnail('medium'); ?>
              </figure>
              <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
            </a>
            <span class="readLater" data-readlater="<?php echo $post->ID; ?>">À lire plus tard</span>
          </article>
        <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>
</div>

<a href="./news/page/2/" class="btn">Plus d'actualités</a>

<h2>Direct info</h2>

<ul class="directinfo">
  <?php echo do_shortcode('[wpv-view name="fil-info"]'); ?>
</ul>
<a href="./depeches/" class="btn">Tout le direct info</a>

<?php get_footer(); ?>