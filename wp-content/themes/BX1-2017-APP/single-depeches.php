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

              <span class="readLater" data-readlater="<?php the_ID(); ?>">À lire plus tard</span>

         <div class="socialShare">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook">Partager sur Facebook</a>
                 <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>%20-%20<?php echo get_permalink(); ?>" target="_blank" class="twitter">Partager sur Twitter</a>
                 <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp">Partager sur Whatsapp</a>
         </div>

               <div class="clearfix"></div>

              <h1><?php the_title(); ?></h1>

              <div class="date"><strong><?php echo get_the_date('d F Y'); ?></strong> - <?php echo get_the_date('H\hi'); ?></div>
              <ul class="tags">
                <?php the_tags('<li>','</li><li>','</li>') ?>
                <li><?php the_category('</li><li>'); ?></li>
              </ul>

		        <?php the_content(); ?>
		        <?php
		          if((types_render_field("source-belga", array("raw"=>"true")))== "1"){
		             echo "<p>Source : Belga</p>";
		          }
		       	?>

               </div>
            </article>

         <?php endwhile; // end of the loop. ?>
         <div class="clearfix">
      </main>

<?php get_footer(); ?>
