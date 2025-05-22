<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */
?>

<li>
	<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	<?php if(get_post_type() == 'post' || get_post_type() == 'concours' || get_post_type() == 'ireport' || get_post_type() == 'votre-bruxelles' || get_post_type() == 'adresse_after' || get_post_type() == 'dossier' || get_post_type() == 'lives' || get_post_type() == 'communiques-presse') : ?>
        <p class="date"><?php echo get_the_date('d F Y'); ?></p>
	<?php endif; ?>
	<?php if(get_post_type() == 'emission') : ?>
		<?php
		$heure = '';
		if(types_render_field('horaire-debut') == ''){
			$heure = get_the_date('d F Y à H:i');
		}
		else{
			$heure = types_render_field('horaire-debut',array('format'=>'d F Y \d\e H:i')).' à '.types_render_field('horaire-fin',array('format'=>'H:i'));
		}
		?>
        <p class="date">Émission diffusée&nbsp;: <?php echo $heure; ?></p>
	<?php endif; ?>
	<?php if(get_post_type() == 'depeches') : ?>
        <p class="date"><?php echo get_the_date('d F Y - H:i'); ?></p>
	<?php endif; ?>
	<?php if(get_post_type() == 'evenement') : ?>
        <p class="date"><?php echo types_render_field('lieu'); ?> | <?php
			$date_debut = types_render_field('date-de-debut',array('format'=>'d/m/Y'));
			$date_fin = types_render_field('date-de-fin',array('format'=>'d/m/Y'));
			if($date_debut == $date_fin):
				?>
                Le <?php echo types_render_field('date-de-debut',array('format'=>'d/m/Y')); ?> de <?php echo types_render_field('date-de-debut',array('format'=>'H:i')); ?> à <?php echo types_render_field('date-de-fin',array('format'=>'H:i')); ?>
			<?php else : ?>
                Du <?php echo types_render_field('date-de-debut',array('format'=>'d/m/Y \à H:i')); ?> au <?php echo types_render_field('date-de-fin',array('format'=>'d/m/Y \à H:i')); ?>
			<?php endif; ?></p>
	<?php endif; ?>
	<?php the_excerpt(); ?>
</li>