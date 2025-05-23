<?php
/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header">
      <div class="entry-meta">
         <?php telebruxelles_posted_on(); ?>
      </div><!-- .entry-meta -->
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

   </header><!-- .entry-header -->

   <div class="entry-content">
      <?php the_content(); ?>
   </div><!-- .entry-content -->
</article><!-- #post-## -->