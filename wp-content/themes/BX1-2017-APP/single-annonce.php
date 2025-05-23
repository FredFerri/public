<?php
/**
 * The template for displaying all single posts.
 *
 * @package TeleBruxelles
 */

get_header(); ?>


  <main>

    <?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


  <div class="content">

         <div class="socialShare">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
            <a href="https://twitter.com/intent/tweet?status=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
            <a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank" class="googleplus">Partager sur Google+</a>
         </div>

              	<div class="clearfix"></div>

              <h1><?php the_title(); ?></h1>

              <div class="date"><strong><?php echo get_the_date('d F Y'); ?></strong> - <?php echo get_the_date('H\hi'); ?></div>
              <ul class="tags">
                <?php the_tags('<li>','</li><li>','</li>') ?>
                <li><?php the_category('</li><li>'); ?></li>
              </ul>


      <div class="content">

        <?php the_content(); ?>

        <?php if(!empty(types_render_field('press-file'))): ?>
        <h2>Fichiers à télécharger</h2>
        <ul>
          <?php
            $urls = types_render_field('press-file');
            $urls = explode(' ',$urls);
            foreach ($urls as $url):
              $arr = explode('/',$url);
              $file_name = end($arr);
          ?>
            <li><a href="<?php echo $url; ?>" title="Télécharger <?php echo $file_name; ?> (ouverture dans un nouvel onglet)" target="_blank"><?php echo $file_name; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

      </div>

   </div>
</article>


    <?php endwhile; // end of the loop. ?>

    <div class="clearfix">
  </main>

<?php get_footer(); ?>
