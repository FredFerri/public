<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package TeleBruxelles
 */

get_header(); ?>

	<div id="primary"> 

		<?php while ( have_posts() ) : the_post(); ?>

			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer(); ?>
