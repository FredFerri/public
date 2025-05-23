<?php
/**
 * The template for displaying the homepage.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main">

         <section>
            <h2 class="section-title section-title--news">L’info en images <span class="section-title-all"><a href="/news">Toute l'info</a></span></h2>

            <?php dynamic_sidebar( 'info-bar' ); ?>

            <?php
            // Get data for last news
            // We want the last 8 news that are not `featured`
            // And excluding the `Sport` category
            $argsNews = array(
              'post_type'=> 'post',
              'posts_per_page' => 8,
              'meta_key' => 'wpcf-featured-news',
              'meta_value' => 0,
              'category__not_in' => array( 3 )
              );

            $queryNews = new WP_Query($argsNews);

            if ( $queryNews->have_posts() ) { ?>

              <div class="row" data-equalizer data-options="equalize_on_stack: true">

                <?php
                  while ( $queryNews->have_posts() ) : $queryNews->the_post();
                  $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
                ?>

               <div class="news large-6 medium-4 columns end">
                  <a class="news__link-img" href="<?php the_permalink(); ?>">
                    <?php if ( !empty($videoFileName) ){ ?>
                    <span class="video-label video-label--news">Vidéo</span><span class="video-play"></span>
                    <?php } ?>
                     <?php echo do_shortcode('[url-pic-head]'); ?>
                  </a>
                  <div class="news__share"><?php echo share(); ?></div>

                  <div class="">
                    <div class="small-3 large-2 left news__entry-date-wrap">
                      <time class="news__entry-date" data-equalizer-watch datetime="<?php the_time( 'Y-m-d' ); ?>" data-equalizer-watch><?php echo get_the_date('j/m'); ?></time>
                    </div>
                    <div class="small-9 large-10 left">
                      <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?></a>
                      </h3>
                    </div>
                  </div>

               </div>

                <?php endwhile; ?>

              </div>

            <?php
            }
            wp_reset_postdata();
            ?>

         </section>

         <section>
            <h2 class="section-title section-title--depeche">Fil d'actu <span class="section-title-all"><a href="/depeches">Toutes les dépêches</a></span></h2>
            <?php
            // Get data for Last JT
            $argsDepeches = array(
              'post_type'=> 'depeches',
              'posts_per_page' => 6,
              );

            $queryDepeches = new WP_Query($argsDepeches);

            if ( $queryDepeches->have_posts() ) { ?>

              <dl class="accordion depeches-accordion" data-accordion="">

                <?php
                  while ( $queryDepeches->have_posts() ) : $queryDepeches->the_post();
                ?>

                 <dd class="accordion-navigation">
                    <a href="#id_<?php echo $post->post_name; ?>">
                    <span class="accordion-nav-date"><?php echo do_shortcode('[wpv-post-date format="j F Y"]'); ?></span>
                    <?php the_title(); ?>
                    </a>
                    <div id="id_<?php echo $post->post_name; ?>" class="content">
                    <?php echo do_shortcode('[wpv-post-excerpt]'); ?>
                    <p>Belga</p>

                    <?php echo share(); ?>
                    </div>
                 </dd>

                <?php endwhile; ?>

                </dl>

            <?php
            }
            wp_reset_postdata();
            ?>

         </section>

      </main><!-- #main -->
   </div><!-- #primary -->

   <?php get_sidebar(); ?><!-- #secondary -->

</div><!-- #content -->

  <?php if ( is_front_page() ) { ?>

    <?php //echo do_shortcode('[wpv-view name="banner-leaderboard"]'); ?>

    <div class="row-ads row-ads--bottom">
      <div id="pebbleSplash">
        <script type="text/javascript"> adhese.tag({ format: "Splash", publication:"tele-bruxelles", location: "homepage",});</script>
      </div>
    </div>

   <section class="row">
      <div class="large-12 columns">
         <h2 class="section-title section-title--sport">Sport <span class="section-title-all"><a href="/category/sport/">Tout le sport</a></span></h2>

          <?php
            // Get data for last news
            // We want the last 8 news that are not `featured`
            // And excluding the `Sport` category
            $argsNews = array(
              'post_type'=> 'post',
              'posts_per_page' => 3,
              'meta_key' => 'wpcf-featured-news',
              'meta_value' => 0,
              'category__in' => 3
              );

            $queryNews = new WP_Query($argsNews);

            if ( $queryNews->have_posts() ) { ?>

              <div class="row" data-equalizer data-options="equalize_on_stack: true">

                <?php
                  while ( $queryNews->have_posts() ) : $queryNews->the_post();
                  $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
                ?>

               <div class="news news--sport large-4 medium-6 columns end">
                  <a class="news__link-img" href="<?php the_permalink(); ?>">
                    <?php if ( !empty($videoFileName) ){ ?>
                    <span class="video-label video-label--sport">Vidéo</span><span class="video-play"></span>
                    <?php } ?>
                     <?php echo do_shortcode('[url-pic-head]'); ?>
                  </a>
                  <div class="news__share"><?php echo share(); ?></div>

                  <div class="">
                    <div class="small-3 large-2 medium-2 left news__entry-date-wrap">
                      <time class="news__entry-date" data-equalizer-watch datetime="<?php the_time( 'Y-m-d' ); ?>" data-equalizer-watch><?php echo get_the_date('j/m'); ?></time>
                    </div>
                    <div class="small-9 large-10 medium-10 left">
                      <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?></a>
                      </h3>
                    </div>
                  </div>

               </div>

                <?php endwhile; ?>

              </div>

            <?php
            }
            wp_reset_postdata();
            ?>

      </div>
   </section>

   <section class="row">
      <div class="large-12 columns">
         <h2 class="section-title section-title--emissions">Émissions <span class="section-title-all"><a href="/emissions">Toutes les émissions</a></span></h2>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
            <?php include('inc/get-type-emissions.php'); ?>
         </div>
      </div>
   </section>

   <?php } else { ?>

  <div class="row-ads row-ads--bottom">
    <div id="pebbleSplash">
      <script type="text/javascript"> adhese.tag({ format: "Splash", publication:"tele-bruxelles", location: "others",});</script>
    </div>
  </div>

   <?php } ?>

<?php get_footer(); ?>
