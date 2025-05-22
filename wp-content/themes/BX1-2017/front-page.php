<?php

/**
 * Template Name: Accueil V2
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>
  <?php echo get_the_content(); ?>
  <?php // Si pas d'option d'affichage, ou si affichage est sur "Actualités"
  $presentation = get_option('home_pres');
  // var_dump($presentation);
  ?>

  <style type="text/css">

    /* Règles générales */


  /* Header */



  /* Homepage */

  .news {
    margin-left: 0;
  } 

  .secondMenu nav li a {
    color: #fff !important;
  } 

  .news__article .articletitre {
    max-width: 95%;
  }

  .pubTop {
    position: relative;
    left: 120px;
  } 

  #menu-home-v2_menu_dossiers {
    padding: 0;
    margin: 0;
  }

  #menu-home-v2_menu_dossiers li {
    background-color: #D51C70;
    padding: 3px 0px 3px 10px;
    margin-bottom: 1px;
    list-style: none;
    width: auto !important;
  }

  #menu-home-v2_menu_dossiers li a {
    color: #fff;
  }

  #menu-home-v2_menu_dossiers li a:hover {
    text-decoration: none;
    text-shadow: 1px 1px 33px #fff;
  }

  .nav-menu-dossiers {
    width: 295px;
    padding-right: 25px;
  }

  .nav-menu-dossiers_title {
    background-color: #e3e3e3;
    padding: 3px 0px 3px 10px;
    font-weight: bold;
  }   

  .news__article h3 {
    margin-top: 0.5em;
    margin-bottom: 0 !important;
    color: #000;
  }

  .news__article.even, .news__article:nth-child(2n) {
    margin-right: 8px;
  }

  .news--big {
    position: relative;
    top: -46px;
  }

  #block-18, #block-20, #block-28 {
    display: none;
  } 

  #page .inside {
    display: flex;
    justify-content: space-between;
  }

  #page .inside .bx1_carrousel-main:last-child {
    margin-bottom: 0 !important;
  } 


  /* Sidebar */

  .sidebar-socials_responsive {
    display: none;
  }

  .sidebar-socials {
    position: absolute;
    right: -55px;
    width: 25px;
  }

  .sidebar-socials li img {
    width: 25px;
  }

  .sidebar-socials li {
    margin-top: 0;
    margin-bottom: 10px;
    border-bottom: none !important;
  } 

  .btn-direct-info {
    margin: 12px 0;
    background-color: #EB1F7C;
    padding: 2px 10px;
  }

  .btn-direct-info a {
    color: #fff;
  }

  .btn-direct-info a:hover {
    text-decoration: none;
    text-shadow: 1px 1px 33px #fff;
  } 


  /* Footer */

  .footerEnd {
    text-align: center;
  }

  .footerEnd .inside {
    display: initial !important;
  }

  .footerPartners .inside {
    display: flex;
    justify-content: center !important;
  } 


  /* Media Queries */
  @media screen and (max-width: 1560px) {
    /* Header */
    .header-bottom { width: 1020px; }
    .siteHeader .inside { width: 1020px !important; }
    .openMenu, .openSearch, .siteHeader__iReporter { margin: 0 !important; }

    /* Homepage */
    .pubTop { left: 0px; }
    .news { width: 650px !important; }
    .nav-menu-dossiers { padding-right: 38px; }
  }

  @media screen and (max-width: 1060px) {
    /* Header */
    #menu-home-v2_menu { display: none; }
    .header-bottom {
      width: auto;
      flex-direction: column;
      align-items: center;
    }
    .siteHeader { height: 95px; padding-top: 0; }
    .realHeader { display: flex; }
    .logo img { width: 75px !important; }
    .openMenu { font-size: 13px !important; }
    .openMenu span { width: 38px; margin-bottom: 10px !important; }
    .siteHeader .inside { width: auto !important; }

    /* Homepage */
    .pubTop { left: 0; }
    .news { width: 66% !important; }
    .news--big { width: 100% !important; }
    .header-center img { width: 70%; }

    /* Sidebar */
    .sidebar-socials_responsive { display: flex; }
    .sidebar-socials_responsive ul {
      display: flex;
      justify-content: center;
      padding: 0;
      width: 100%;
    }
    .header-btn-directtv, .header-btn-directtv > a,
    .header-btn-directradio, .header-btn-directradio > a {
      display: flex;
      justify-content: center;
    }
    .nav-menu-dossiers {
      display: none;
    }

    /* Footer */
    .footer-block { width: 85% !important; padding: 0; }
    .siteHeader { background-position: top; }
  }

  @media screen and (max-width: 680px) {
    /* Header */
    .openSearch { width: 35px; height: 35px; margin: 0 !important; }
    .logo { overflow: initial !important; }
    .siteHeader { padding: 5px !important; height: 65px; }
    .inside { padding: 0 !important; }
    .header-center { flex: 1 !important; justify-content: space-evenly; }
    .openMenu {
      font-size: 10px !important;
      margin: 0 !important;
      overflow: initial;
    }
    .openMenu span {
      width: 26px;
      margin-bottom: 6px !important;
      height: 1px !important;
    }

    /* Homepage */
    .news { width: 100% !important; }
    .news-top-block, .news--big { padding: 0 10px; }


    /* Sidebar */
    .sideFil .widget { text-align: center; }

    /* Footer */
    .footer-block {
      padding: 0 !important;
      width: 100% !important;
      text-align: center;
    }
  }     

  </style>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
      var timeout;

      // Sélectionne le parent de l'élément "Ma commune"
      var $menuItem = $("a").filter(function() {
          return $(this).text().trim() === "Ma commune";
      }).parent();

      // Cible aussi le sous-menu
      var $subMenu = $menuItem.find(".sub-menu");

      // Lorsque la souris entre sur l'onglet principal
      $menuItem.on("mouseenter", function() {
          clearTimeout(timeout);
          $subMenu.stop(true, true).css("display", "block");
      });

      // Lorsque la souris sort de l'onglet principal
      $menuItem.on("mouseleave", function() {
          timeout = setTimeout(function() {
              $subMenu.stop(true, true).css("display", "none");
          }, 300); // délai de 300ms
      });

      // Si la souris entre dans le sous-menu, on empêche le hide
      $subMenu.on("mouseenter", function() {
          clearTimeout(timeout);
      });

      // Quand la souris quitte le sous-menu, on lance le délai
      $subMenu.on("mouseleave", function() {
          timeout = setTimeout(function() {
              $subMenu.stop(true, true).css("display", "none");
          }, 300);
      });
  });

  </script>

  <section class="news">
    
    <?php
    // 1. Fonction pour afficher un article formaté
    function bx1_render_news_article($post, $index = 0, $classes = '', $size = 'medium') {
        setup_postdata($post);

        $videoFileName  = get_post_meta($post->ID, 'wpcf-video-name-news', true);
        $flash_terms    = wp_get_post_terms($post->ID, 'flash_news', array('fields' => 'slugs'));
        $sport          = has_category('sport', $post);
        $redaction      = has_category('dossiers-redaction', $post);
        $bonus          = has_category('bx1-bonus', $post);
        $exclusif       = in_array('oui', wp_get_post_terms($post->ID, 'exclusif-blog', array('fields' => 'slugs')));
        $is_flash_news  = in_array('oui', $flash_terms);
        $even_odd_class = ($index % 2 === 0) ? 'even' : 'odd';
        $video_class    = $videoFileName !== '' ? 'news__article--video' : '';

        ?>
        <article class="news__article <?php echo esc_attr("$video_class $even_odd_class $classes"); ?>">
            <a href="<?php echo get_permalink($post->ID); ?>" title="Lire l'article <?php echo esc_attr(get_the_title($post->ID)); ?>">
                <figure>
                    <?php if ( $is_flash_news ) : ?><span class="flash">Flash info</span><?php endif; ?>
                    <?php if ( $sport ) : ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                    <?php if ( $redaction ) : ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                    <?php if ( $bonus ) : ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                    <?php if ( $exclusif ) : ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                    <?php echo get_the_post_thumbnail($post->ID, $size); ?>
                </figure>
                <h3 class="articletitre"><?php echo get_the_title($post->ID); ?> <span class="date"><?php echo get_the_date('d F Y', $post->ID); ?></span></h3>
            </a>
        </article>
        <?php
        wp_reset_postdata();
    }

// 1. Récupération de la "Big News"
$big_news_transient = 'home_big_news_article_v2';
$big_news_article = get_transient($big_news_transient);

if (false === $big_news_article) {
    $big_news_args = array(
        'post_type'      => array('post', 'ireport'),
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => array(
            'relation' => 'AND',
            array(
                'taxonomy'         => 'featured_news',
                'field'            => 'slug',
                'terms'            => array('oui'),
                'include_children' => false,
            ),
            array(
                'taxonomy'         => 'exclusif-blog',
                'field'            => 'slug',
                'terms'            => array('oui'),
                'operator'         => 'NOT IN',
                'include_children' => false,
            ),
        ),
    );

    $big_news_query = new WP_Query($big_news_args);
    $big_news_article = !empty($big_news_query->posts) ? $big_news_query->posts[0] : null;

    // Cache pour 2 minutes
    set_transient($big_news_transient, $big_news_article, 2 * MINUTE_IN_SECONDS);
}

// 2. Récupération des autres articles
$transient_name = 'home_all_articles_v2';
$all_articles = get_transient($transient_name);

if (false === $all_articles) {
    $argsNews = array(
        'post_type'      => array('post', 'ireport'),
        'posts_per_page' => 25,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'exclusif-blog',
                'field'    => 'slug',
                'terms'    => array('oui'),
                'operator' => 'NOT IN',
            ),
        ),
    );

    $query = new WP_Query($argsNews);
    $all_articles = $query->posts;
    set_transient($transient_name, $all_articles, 2 * MINUTE_IN_SECONDS);
}

// 3. Exclure l'article "Big News" des articles listés ensuite
if ($big_news_article) {
    $all_articles = array_filter($all_articles, function ($post) use ($big_news_article) {
        return $post->ID !== $big_news_article->ID;
    });
    // Réindexer le tableau
    $all_articles = array_values($all_articles);
}

$passe = 0;
$nb_articles = 4;
$total = count($all_articles);
$carousel_ids = [
    '67e39fa425e31',
    '67f68e2c49b63',
    '67e3a0a88da9b',
    '67e3a122e3662',
    '67e54af276d2f',
    '67e3a4e642a1c'
];

// 4. Affichage de la Big News
if ($big_news_article) {
    echo '<section class="news news--big">';
    echo '<span style="display: block; color: #fff; background-color: #E31573; padding: 5px; width: 120px; font-size: 26px; text-align: center; font-weight: bold;">À la Une</span>';
    bx1_render_news_article($big_news_article, 0, 'article__large', 'Big News');
    echo '</section>';
    $passe = 0; // Ne change pas ici puisque la Big News est déjà exclue
}

// 5. Affichage des carrousels et des autres articles
foreach ($carousel_ids as $carousel_id) {
    echo '<section class="news-top-block">';
    for ($i = $passe; $i < $passe + $nb_articles && $i < $total; $i++) {
        bx1_render_news_article($all_articles[$i], $i);
    }
    echo '</section>';
    echo '<div class="bx1_carrousel-main">' . do_shortcode("[bx1_carrousel id=\"$carousel_id\"]") . '</div>';
    $passe += $nb_articles;
}


    ?>


  </section>

  <section class="sideFil">
    <?php dynamic_sidebar('filinfo2'); ?>
    <?php dynamic_sidebar('sidebar-3'); ?>
  </section>  



<?php get_footer('v2'); ?>
