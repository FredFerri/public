<?php 

/**
 * Template Name: A lire plus tard (app)
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

<script>
	
	jQuery(function(){
		jQuery('body').hide();
		window.location.replace("<?php bloginfo('url'); ?>/news");
	});

</script>

<?php get_footer(); ?>
