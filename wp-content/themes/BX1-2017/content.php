<?php
/**
 * @package TeleBruxelles
 */
?>


	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span><?php if($flash == '1'): ?><span class="flash">Flash news</span><?php endif; ?></a></h3>
	<a href="<?php the_permalink(); ?>">
	  <figure>
	    <?php the_post_thumbnail('medium'); ?>
	  </figure>
	</a>