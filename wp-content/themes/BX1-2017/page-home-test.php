<?php
/**
 * Template Name: Page home test
 *
 *
 * @package TeleBruxelles
 */
get_header(); ?>
  <?php echo get_the_content(); ?>
  <?php // Si pas d'option d'affichage, ou si affichage est sur "Actualités"
  $presentation = get_option('home_pres');
  // var_dump($presentation);
  ?>
      <section class="news">
      <?php // Si option de presentation est sur "News"
if ( get_option( 'home_pres' ) == 'classic' || $presentation == 'classic' ) :

    // Nom unique pour le transient
    $transient_name = 'home_query_news_big';

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
                  'terms'            => array( 'oui' ),
                  'include_children' => false,
              ),
              // Exclure les articles exclusifs au blog
              array(
                  'taxonomy'         => 'exclusif-blog',
                  'field'            => 'slug',
                  'terms'            => array( 'oui' ),
                  'operator'         => 'NOT IN',
                  'include_children' => false,
              ),
          ),
      );

      $queryNews = new WP_Query($argsNews);
    
      // Mettre en cache les résultats pendant 5 minutes
      set_transient($transient_name, $queryNews, 5 * MINUTE_IN_SECONDS);
    }


    // Vérifier s'il y a des articles
    if ( $queryNews->have_posts() ) :
        while ( $queryNews->have_posts() ) : $queryNews->the_post();
            // Récupérer les métadonnées et taxonomies nécessaires
            $videoFileName = get_post_meta( get_the_ID(), 'wpcf-video-name-news', true );
            $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
            $is_flash_news = in_array('oui', $flash_terms);
            $sport         = has_category( 'sport' );
            $redaction     = has_category( 'dossiers-redaction' );
            $bonus         = has_category( 'bx1-bonus' );
            $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
            $is_exclusif   = in_array( 'oui', $exclusif_terms );

            ?>
            <section class="news news--big">
                <article class="news__article article__large <?php if ( $videoFileName != '' ) { echo 'news__article--video'; } ?>" style="width:100%">
                    <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
                        <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date( 'd F Y' ); ?></span></h3>
                        <figure>
                            <?php if ( $is_flash_news ) : ?><span class="flash">Flash info</span><?php endif; ?>
                            <?php if ( $sport ) : ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                            <?php if ( $redaction ) : ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                            <?php if ( $bonus ) : ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                            <?php if ( $is_exclusif ) : ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                            <?php the_post_thumbnail( 'Big News' ); ?>
                        </figure>
                    </a>
                </article>
            </section>
            <?php
        endwhile;
        wp_reset_postdata();
        endif;
    endif;

      // On affiche 10 news, en commençant par celles mises en avant, et ensuite par date de publication
      // Si 1 news est affichée en grand, on passe la 1re news
    // Déterminer s'il faut passer le premier article
    $passe = 0;
    if ( get_option( 'home_pres' ) == 'classic' || get_option( 'home_pres' ) == 'classic' ) {
        $passe = 1;
    }

    // Nom unique pour le transient
    $transient_name = 'home_query_news_list';

    // Tenter de récupérer la requête mise en cache
    $queryNews = get_transient($transient_name);

    if (false === $queryNews) {

      // Arguments de la requête
      $argsNews = array(
          'post_type'      => array( 'post', 'ireport' ),
          'posts_per_page' => 10,
          'offset'         => $passe,
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
          'featured_news_order' => true,
      );

      $queryNews = new WP_Query($argsNews);
      
      // Mettre en cache les résultats pendant 5 minutes
      set_transient($transient_name, $queryNews, 5 * MINUTE_IN_SECONDS);
    }

    ?>
    <section class="news-top-block">
      
    <?php

    // Vérifier s'il y a des articles
    if ( $queryNews->have_posts() ) :
        $count = 0;
        while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta( get_the_ID(), 'wpcf-video-name-news', true );
            $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
            $is_flash_news = in_array('oui', $flash_terms);
            $sport         = has_category( 'sport' );
            $redaction     = has_category( 'dossiers-redaction' );
            $bonus         = has_category( 'bx1-bonus' );
            $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
            $is_exclusif   = in_array( 'oui', $exclusif_terms );
            $count++;

            // Déterminer la classe pair/impair
            if ( get_option( 'home_pres' ) == 'news' || get_option( 'home_pres' ) == 'news2' || get_option( 'home_pres' ) == 'classic' || $presentation == 'news2' ) {
                $even_odd_class = ( ( $count % 2 ) == 0 ) ? 'odd' : 'even';
            } else {
                $even_odd_class = ( ( $count % 2 ) == 0 ) ? 'even' : 'odd';
            }
            ?>
            <article class="news__article <?php if ( $videoFileName != '' ) { echo 'news__article--video '; } echo $even_odd_class; ?>">
                <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
                    <h3 class="articletitre"><?php the_title(); ?> <span class="date"><?php echo get_the_date( 'd F Y' ); ?></span></h3>
                    <figure>
                        <?php if ( $is_flash_news ) : ?><span class="flash">Flash info</span><?php endif; ?>
                        <?php if ( $sport ) : ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                        <?php if ( $redaction ) : ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                        <?php if ( $bonus ) : ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                        <?php if ( $is_exclusif ) : ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </figure>
                </a>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
    <a href="../news/page/2" title="Voir la suite des actualités" class="allLink">Lire la suite</a>

    </section>
  </section>
    <section class="sideFil">
      <?php dynamic_sidebar('filinfo'); ?>
      <?php get_sidebar('sidebar-1'); ?> 
    </section>


  <?php // Si affichage est sur "Direct TV"
  if(get_option('home_site') == 'tv'): ?>
    <section class="news news--direct">
      <h3>BX1 TV en direct</h3>
       <div onmouseover="if(typeof alreadyHover === 'undefined'){jwplayer().setVolume(100);alreadyHover=1;}"><div id="liveHome__video"></div></div>
        <script>
        document.addEventListener("gestcomVideo", function(e) {
        jwplayer("liveHome__video").setup({
          playlist: [{
            "sources": [{
              "file": "https://59959724487e3.streamlock.net:443/live/live.sdp/playlist.m3u8","type": "mp4"
            },{
              "file": "rtmps://59959724487e3.streamlock.net:443/live/live.sdp"
            }]
          }],
          primary: 'html5',
          width: '100%',
          aspectratio: '16:9',
          autostart: true,
          androidhls: true,
          <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub ?>
          advertising: false
          <?php else: ?>
          advertising: {
                  client: 'vast',
                  schedule: {
                          adbreak1: {
                            offset: "pre",
                            <?php if(get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                            tag: '<?php echo types_render_termmeta('video-pre-roll',array('term_id'=>$the_term_id)); ?>'
                            <?php else: ?>
                            tag: e.detail.vastUrl
                            <?php endif; ?>
                          }             
                  }
                }
          <?php endif; ?>
        })
        });
      </script>
      <div class="articles">
      <?php
      // On affiche 6 news, en commençant par celles mises en avant, et ensuite par date de publication
      $argsNews = array(
        'post_type'      => array( 'post', 'ireport' ),
        'posts_per_page' => 6,
        'offset'         => $passe,
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
        'featured_news_order' => true,
    );

    // Exécuter la requête
    $queryNews = new WP_Query( $argsNews );

    // Vérifier s'il y a des articles
    if ( $queryNews->have_posts() ) :
        $count = 0;
        while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta( get_the_ID(), 'wpcf-video-name-news', true );
            $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
            $is_flash_news = in_array('oui', $flash_terms);
            $sport         = has_category( 'sport' );
            $redaction     = has_category( 'dossiers-redaction' );
            $bonus         = has_category( 'bx1-bonus' );
            $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
            $is_exclusif   = in_array( 'oui', $exclusif_terms );
          $count++;
          $even_odd_class = ( ($count % 2) == 0 ) ? "even" : "odd";
        ?>
          <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
          <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
            <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              <figure>
                <?php if($is_flash_news): ?><span class="flash">Flash info</span><?php endif; ?>
                <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                <?php if($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                <?php the_post_thumbnail('medium'); ?>
              </figure>
            </a>
          </article>
        <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>
      <a href="../news" title="Voir Toutes les news" class="allLink">Toutes les news</a>
    </div>
    </section>
    <section class="sideFil">
      <?php dynamic_sidebar('filinfo'); ?>
      <?php get_sidebar('sidebar-1'); ?>
    </section>
  <?php endif; ?>
  <?php // Si affichage est sur "Fil info"
  if(get_option('home_site') == 'fil'): ?>
    <section class="sideFil sideFil--big">
      <?php dynamic_sidebar('filinfo'); ?>
      <a href="../depeches" title="Voir toutes les dépèches" class="allLink allLink--fil">Tout le Direct info</a>
    </section>
    <section class="news news--mini">
      <?php
      // On affiche 3 news, en commençant par celles mises en avant, et ensuite par date de publication
      if(get_option('home_pres') == 'news'){$passe=1;};
      $argsNews = array(
        'post_type'      => array( 'post' ),
        'posts_per_page' => 3,
        'offset'         => $passe,
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
        'featured_news_order' => true,
    );

    // Exécuter la requête
    $queryNews = new WP_Query( $argsNews );

    // Vérifier s'il y a des articles
    if ( $queryNews->have_posts() ) :
        $count = 0;
        while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta( get_the_ID(), 'wpcf-video-name-news', true );
            $flash_terms = wp_get_post_terms(get_the_ID(), 'flash_news', array('fields' => 'slugs'));
            $is_flash_news = in_array('oui', $flash_terms);
            $sport         = has_category( 'sport' );
            $redaction     = has_category( 'dossiers-redaction' );
            $bonus         = has_category( 'bx1-bonus' );
            $exclusif_terms = wp_get_post_terms( get_the_ID(), 'exclusif-blog', array( 'fields' => 'slugs' ) );
            $is_exclusif   = in_array( 'oui', $exclusif_terms );
          $count++;
            if(get_option('home_pres') == 'news' || (get_option('home_pres') == 'news2' || $presentation == "news2")){
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
                <?php if($is_flash_news): ?><span class="flash">Flash info</span><?php endif; ?>
                <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                <?php if($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                <?php the_post_thumbnail('medium'); ?>
              </figure>
            </a>
          </article>
        <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>
      <a href="../news" title="Voir Toutes les news" class="allLink allLink--mini">Toutes les news</a>
      <?php get_sidebar('sidebar-1'); ?>
    </section>
  <?php endif; ?>
<?php get_footer(); ?>
