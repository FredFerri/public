<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package TeleBruxelles
 */

get_header(); ?>

	<section class="news">
		<h1>Erreur 404</h1>
		<p>La page que vous cherchez n'a pas été trouvée. Vous pouvez peut-être essayer de trouver le contenu qui vous intéresse avec le formulaire de recherche ci-dessous.</p>
		<?php get_search_form(); ?>
	</section>

	<section class="sideFil">
      <?php dynamic_sidebar('filinfo'); ?>
      <?php get_sidebar('sidebar-1'); ?>
    </section>

<?php get_footer(); ?>
