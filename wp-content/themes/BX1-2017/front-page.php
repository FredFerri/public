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

  @media screen and (max-width: 680px) {
    .news {
      width: 100% !important;
    }

  }
</style>

<section class="news">

  <?php
  // 1. Fonction pour afficher un article formaté
  function bx1_render_news_article($post, $index = 0, $classes = '', $size = 'medium', $eager = false) {
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

    $post_thumbnail_id = get_post_thumbnail_id($post->ID);

    ?>
    <article class="news__article <?php echo esc_attr("$video_class $even_odd_class $classes"); ?>">
      <a href="<?php echo get_permalink($post->ID); ?>" title="Lire l'article <?php echo esc_attr(get_the_title($post->ID)); ?>">
        <figure>
          <?php if ($is_flash_news) : ?><span class="flash">Flash info</span><?php endif; ?>
          <?php if ($sport) : ?><span class="flash flash--sport">Sport</span><?php endif; ?>
          <?php if ($redaction) : ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
          <?php if ($bonus) : ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
          <?php if ($exclusif) : ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
          <?= mk_image($post_thumbnail_id, 'medium', '', '', $eager, false, $eager ? "high" : false); ?>
        </figure>
        <h3 class="articletitre"><?php echo get_the_title($post->ID); ?> <span class="date"><?php echo get_the_date('d F Y', $post->ID); ?></span></h3>
      </a>
    </article>
    <?php
    wp_reset_postdata();
  }

  // 1. Récupération de la "Big News"
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

  // 2. Récupération des autres articles
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

  // 3. Exclure l'article "Big News" des articles listés ensuite
  if ($big_news_article) {
    $all_articles = array_filter($all_articles, function ($post) use ($big_news_article) {
      return $post->ID !== $big_news_article->ID;
    });
    $all_articles = array_values($all_articles); // Réindexation
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
    bx1_render_news_article($big_news_article, 0, 'article__large', 'Big News', true);
    echo '</section>';
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