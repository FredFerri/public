<?php 

/**
 * Template Name: A lire plus tard (app)
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<div id="infinitescroll"> 

	<?php while ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>

	<?php endwhile; // end of the loop. ?>

	<?php
      // On inclu les iReporter dans les news et on affiche les featured en 1er
		$cookie = $_COOKIE['readlater'];
		$cookie = str_replace('\\','', $cookie);
		$cookie = str_replace('["','', $cookie);
		$cookie = str_replace('"]','', $cookie);
		$cookie = explode('","',$cookie);
        $argsNews = array(
          'post_type'=> array('post','ireport','votre-bruxelles'),
          'meta_key' => 'wpcf-featured-news',
          'orderby' => array( 'meta_value' => 'DESC', 'date' => 'DESC' ),
   		  'post__in' => $cookie,
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

        <div class="articles insideScroll">
          <?php
            while ( $queryNews->have_posts() ) : $queryNews->the_post();
            $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
            $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
            $sport = in_category('sport');
            $count++;
            $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
          ?>
            <article class="news__article post <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
              <a href="<?php the_permalink(); ?>">
                <figure>
                    <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                    <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                    <?php the_post_thumbnail('medium'); ?>
                </figure>
                <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
              </a>
              <span class="readLater" data-readlater="<?php echo $post->ID; ?>">À lire plus tard</span>
            </article>
          <?php endwhile; ?>
                  <div id="paginatescroll"><?php echo get_next_posts_link('Older Entries',10); ?></div>
        </div>

    <?php else: ?>

    	<p>Il n'y a pas d'articles dans la liste de lecture.</p>

    <?php endif; ?>
	

</div><!-- #primary -->

<?php get_footer(); ?>
