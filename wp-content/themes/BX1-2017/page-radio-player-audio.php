<?php
/**
 * Template Name: Player Audio Mobile (App)
 *
 *
 * @package TeleBruxelles
 */
get_header(); ?>
<script>
	jQuery(function(){
		jQuery('body').hide();
		window.location.replace("<?php bloginfo('url'); ?>/radio");
	});
</script>
<?php get_footer(); ?>
