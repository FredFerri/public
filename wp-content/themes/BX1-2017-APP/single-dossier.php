<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <section class="news">

      <?php while ( have_posts() ) : the_post(); ?>
         <h1>
               <?php the_title(); ?>
         </h1>
         <?php the_content(); ?>

         <div class="articles" id="infinitescroll">
         <?php
            // On affiche 10 news, en commençant par celles mises en avant, et ensuite par date de publication
            $categories = wp_get_post_categories($post->ID);
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $argsNews = array(
              'post_type'=> array('post','ireport','votre-bruxelles'),
              'posts_per_page' => 10,
              'meta_key' => 'wpcf-featured-news',
              'orderby' => array('meta_value' => 'DESC', 'date' => 'DESC'),
              'category__in' => $categories,
              'paged' => $paged
            );
            $queryNews = new WP_Query($argsNews);
            if($queryNews->have_posts()) : ?>
              <?php
                while ( $queryNews->have_posts() ) : $queryNews->the_post();
                $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
                $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
                $sport = in_category('sport');
                $redaction = in_category('dossiers-redaction');
                $exclusif = get_post_meta($post->ID, 'wpcf-info-bx1', true);
                $count++;
                  if(get_option('home_pres') == 'news'){
                    $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
                  }
                  else{
                    $even_odd_class = ( ($count % 2) == 0 ) ? "even" : "odd";
                  }
              ?>
                <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video';}?> post">
                  <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
                    <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
                    <figure>
                      <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                      <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                      <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                      <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                      <?php the_post_thumbnail('medium'); ?>
                    </figure>
                </a>
            </article>

              <?php endwhile;  ?>

            <div id="paginatescroll"><?php echo get_next_posts_link( 'Older Entries',10 ); ?></div>

              <?php wp_reset_postdata();  ?>

              <?php else : ?>

                <?php get_template_part( 'content', 'none' ); ?>

         <?php endif; ?>
         </div>

      <?php endwhile; // end of the loop. ?>
      
   </section>

<?php get_footer(); ?>
