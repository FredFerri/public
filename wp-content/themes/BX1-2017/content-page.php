<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package TeleBruxelles
 */
?>

<section class="news">
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
</section>

<section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
</section>

<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'telebruxelles' ),
		'after'  => '</div>',
	) );
?>