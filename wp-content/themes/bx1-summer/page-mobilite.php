<?php

/**
 * Template Name: Blog Mobilité
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<section id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main archives-mobilite" role="main">

      <?php 
       $my_query = new WP_Query( 'post_type=mobilites' );
      if ( $my_query->have_posts() ) : ?>

         <header class="entry-header" style="border-bottom: 4px solid #FF2E4D;margin-bottom: 15px;">
    		<img src="<?php echo get_template_directory_uri();?>/img/mobilitebanner.jpg">
  		 </header><!-- .page-header -->

         <?php /* Start the Loop */ ?>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
         <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
         <?php $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true); ?>

            <div class="news news--mobilite medium-6 columns end">
               <a class="news__link-img" href="<?php the_permalink(); ?>">
                 <?php if ( !empty($videoFileName) ){ ?>
                 <span class="video-label video-label--mobilite">Vidéo</span><span class="video-play"></span>
                 <?php } ?>
                  <?php echo do_shortcode('[url-pic-head]'); ?>
               </a>
               <div class="news__share"><?php echo share(); ?></div>

               <div class="">
                 <div class="large-2 medium-2 left news__entry-date-wrap date--mobilite">
                   <time class="news__entry-date" data-equalizer-watch datetime="<?php the_time( 'Y-m-d' ); ?>" data-equalizer-watch><?php echo get_the_date('j/m'); ?></time>
                 </div>
                 <div class="large-10 medium-10 left">
                   <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php the_permalink(); ?>">
                     <?php the_title(); ?></a>
                   </h3>
                 </div>
               </div>
            </div>

         <?php endwhile; ?>
         </div>

         <?php wp_pagenavi(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

      </main><!-- #main -->
      <div class="row about--mobilite" data-equalizer data-options="equalize_on_stack: true">
      	<div class="large-2 medium-2 left image" data-equalizer-watch>
      		<img class="circle" src="<?php echo get_template_directory_uri();?>/img/mobiliteredac.jpg"><br><br>
      		<span>Philippe Jourdain</span>
      	</div>
      	<div class="large-9 medium-9 left redac--mobilite" data-equalizer-watch>
      		<h2>Bouger à Bruxelles ?</h2>
      		<p style="text-align: justify;">
      		Oui c’est parfaitement possible. Encore faut-il utiliser le bon moyen de locomotion au bon moment et au bon endroit et, mieux, en combiner certains, et parfois tous, pour se déplacer partout dans la Région. Cyclistes, piétons, conducteurs, motards ou usagers du rail. Tout le monde y a sa place. Cette page Mobilité entend vous aider à penser votre mobilité à Bruxelles. Trucs, astuces, nouveautés, redécouvertes, essais, conseils. Notre ambition est bel et bien de vous faire bouger dans les meilleures conditions dans la capitale !
      		</p>
      	</div>
      </div>
   </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

