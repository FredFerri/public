<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>


    <section class="news">

		<h1>
			<?php

				if ( is_category( 'sport' ) ) :
					_e( 'Sport', 'telebruxelles' );

				elseif ( is_category() ) :
					echo 'Catégorie : '.single_cat_title( '', false);

				elseif ( is_tag() ) :
					echo 'Mot-clef : '.single_tag_title( '', false);

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'telebruxelles' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'telebruxelles' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'telebruxelles' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'telebruxelles' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'telebruxelles' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'telebruxelles' ) ) . '</span>' );

				elseif ( is_post_type_archive( 'adresse_after') ) :
					_e( 'Adresses de l\'émission @After', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audios', 'telebruxelles' );

				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chats', 'telebruxelles' );

				else :
					_e( 'Archives', 'telebruxelles' );

				endif;
			?>
		</h1>

       <?php if ( have_posts() ) : ?>

       	<div class="articles testpageupdate">
		<?php
          while ( have_posts() ) : the_post();
          $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
          $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
          $sport = in_category('sport');
          $redaction = in_category('dossiers-redaction');
          $bonus = in_category('bx1-bonus');
          $exclusif = get_post_meta($post->ID, 'wpcf-info-bx1', true);
            if(get_post_type() != 'blog' && get_post_type() != 'dossier'):
        ?>
          <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} ?>">
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              <figure>
                <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
              	<?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
              	<?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                <?php if($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                <?php the_post_thumbnail('medium'); ?>
              </figure>
            </a>
          </article>
        <?php endif;endwhile; ?>
        </div>

        <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

  	</section>

  	<section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>

<?php get_footer('v2'); ?>
