<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header(); ?>

  <script>
  
    jQuery(function(){
      window.location.replace("<?php bloginfo('url'); ?>/emissions");
    });

  </script>

<?php get_footer(); ?>
