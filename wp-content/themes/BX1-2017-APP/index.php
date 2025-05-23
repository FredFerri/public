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

get_header(); ?>

<ul class="switch">
  <li class="active"><a href="../news/">Actualités</a></li>
  <li><a href="../depeches/">Direct info</a></li>
</ul>

   <section class="news" id="infinitescroll">

      <?php
      // On inclu les iReporter dans les news et on affiche les featured en 1er
        $argsNews = array(
          'post_type'=> array('post','ireport'),
          'meta_key' => 'wpcf-featured-news',
          'orderby' => array( 'meta_value' => 'DESC', 'date' => 'DESC' ),
          'date_query' => array(
             array(
                   'after' => '48 hours ago'
                   )
          ),
          'meta_query' => array(
            'relation' => 'OR',
              array(
                 'key' => 'wpcf-exclusif-blog',
                 'compare' => 'NOT EXISTS',
              ),
              array(
                 'key' => 'wpcf-exclusif-blog',
                 'value' => '1',
                 'compare' => '!=',
              )
           ),
          'paged' => get_query_var('paged')
        );
        $queryNews = new WP_Query($argsNews);
      ?>

      <?php if ( have_posts() ) : ?>
            
        <h1>Actualités 48h</h1>

        <div class="articles insideScroll">
          <?php
            while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
            $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
            $sport = in_category('sport');
            $redaction = in_category('dossiers-redaction');
            $exclusif = get_post_meta($post->ID, 'wpcf-info-bx1', true);
            $count++;
            $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
          ?>
            <article class="news__article post <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
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
                  <div id="paginatescroll"><?php posts_nav_link(); ?></div>
        </div>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

    </section>

<?php get_footer(); ?>
