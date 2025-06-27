<?php

/**
 * The template for displaying search results pages.
 *
 * @package TeleBruxelles
 */


get_header('v2');

$category = array();
if (isset($_GET['category']) && $_GET['category']) {
	$category = $_GET['category'];
}

?>

<section class="sideFil sideFil--big sideFil--big--search">

	<?php if (have_posts()): ?>

		<form method="get" action="" class="filterForm filterForm--search">
			<div>
				<h4>Filtrer les résultats</h4>
			</div>
			<div class="filterForm__select" data-placeholder="Toutes les communes">
				<label for="selectCat">Commune</label>
				<select name="category[]" id="selectCat" class="postform" multiple="multiple">
					<option class="level-0" value="anderlecht" <?php if (in_array('anderlecht', $category)) {
																					echo 'selected';
																				} ?>>Anderlecht</option>
					<option class="level-0" value="auderghem" <?php if (in_array('auderghem', $category)) {
																				echo 'selected';
																			} ?>>Auderghem</option>
					<option class="level-0" value="berchem-sainte-agathe" <?php if (in_array('berchem-sainte-agathe', $category)) {
																								echo 'selected';
																							} ?>>Berchem-Sainte-Agathe</option>
					<option class="level-0" value="bruxelles-ville" <?php if (in_array('bruxelles-ville', $category)) {
																						echo 'selected';
																					} ?>>Bruxelles-ville</option>
					<option class="level-0" value="drogenbos" <?php if (in_array('drogenbos', $category)) {
																				echo 'selected';
																			} ?>>Drogenbos</option>
					<option class="level-0" value="etterbeek" <?php if (in_array('etterbeek', $category)) {
																				echo 'selected';
																			} ?>>Etterbeek</option>
					<option class="level-0" value="evere" <?php if (in_array('evere', $category)) {
																			echo 'selected';
																		} ?>>Evere</option>
					<option class="level-0" value="forest" <?php if (in_array('forest', $category)) {
																			echo 'selected';
																		} ?>>Forest</option>
					<option class="level-0" value="ganshoren" <?php if (in_array('ganshoren', $category)) {
																				echo 'selected';
																			} ?>>Ganshoren</option>
					<option class="level-0" value="ixelles" <?php if (in_array('ixelles', $category)) {
																				echo 'selected';
																			} ?>>Ixelles</option>
					<option class="level-0" value="jette" <?php if (in_array('jette', $category)) {
																			echo 'selected';
																		} ?>>Jette</option>
					<option class="level-0" value="koekelberg" <?php if (in_array('koekelberg', $category)) {
																					echo 'selected';
																				} ?>>Koekelberg</option>
					<option class="level-0" value="crainhem" <?php if (in_array('crainhem', $category)) {
																				echo 'selected';
																			} ?>>Crainhem</option>
					<option class="level-0" value="linkebeek" <?php if (in_array('linkebeek', $category)) {
																				echo 'selected';
																			} ?>>Linkebeek</option>
					<option class="level-0" value="molenbeek-saint-jean" <?php if (in_array('molenbeek-saint-jean', $category)) {
																								echo 'selected';
																							} ?>>Molenbeek-Saint-Jean</option>
					<option class="level-0" value="rhode-saint-genese" <?php if (in_array('rhode-saint-genese', $category)) {
																							echo 'selected';
																						} ?>>Rhode-Saint-Genèse</option>
					<option class="level-0" value="saint-gilles" <?php if (in_array('saint-gilles', $category)) {
																					echo 'selected';
																				} ?>>Saint-Gilles</option>
					<option class="level-0" value="saint-josse-ten-noode" <?php if (in_array('saint-josse-ten-noode', $category)) {
																								echo 'selected';
																							} ?>>Saint-Josse-ten-Noode</option>
					<option class="level-0" value="schaerbeek" <?php if (in_array('schaerbeek', $category)) {
																					echo 'selected';
																				} ?>>Schaerbeek</option>
					<option class="level-0" value="uccle" <?php if (in_array('uccle', $category)) {
																			echo 'selected';
																		} ?>>Uccle</option>
					<option class="level-0" value="watermael-boitsfort" <?php if (in_array('watermael-boitsfort', $category)) {
																								echo 'selected';
																							} ?>>Watermael-Boitsfort</option>
					<option class="level-0" value="wemmel" <?php if (in_array('wemmel', $category)) {
																			echo 'selected';
																		} ?>>Wemmel</option>
					<option class="level-0" value="wezembeek-oppem" <?php if (in_array('wezembeek-oppem', $category)) {
																						echo 'selected';
																					} ?>>Wezembeek-Oppem</option>
					<option class="level-0" value="woluwe-saint-lambert" <?php if (in_array('woluwe-saint-lambert', $category)) {
																								echo 'selected';
																							} ?>>Woluwe-Saint-Lambert</option>
					<option class="level-0" value="woluwe-saint-pierre" <?php if (in_array('woluwe-saint-pierre', $category)) {
																								echo 'selected';
																							} ?>>Woluwe-Saint-Pierre</option>
				</select>
			</div>
			<div class="filterForm__select" data-placeholder="Tous les formats">
				<label for="selectFormat">Format</label>
				<?php wp_dropdown_categories(
					array(
						'taxonomy' => 'format-du-contenu',
						'id' => 'selectFormat',
						'name' => 'format-du-contenu',
						'value_field' => 'slug',
						'selected'     => (!empty($_GET['format-du-contenu']) && is_array($_GET['format-du-contenu']))
							? implode(',', $_GET['format-du-contenu'])
							: '',
						'orderby' => 'name',
						'multiple' => true
					)
				); ?>
			</div>
			<div>
				<label for="searchField">Termes de recherche</label>
				<input type="search" class="search-field" id="searchField" value="<?php echo get_search_query(); ?>" name="s" />
				<input type="submit" value="Filtrer">
				<div class="clearfix"></div>
		</form>

		<h1>Résultats pour&nbsp;: <span><?php echo get_search_query(); ?></span></h1>
		<?php while (have_posts()) : the_post(); ?>

			<ul>
				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('content', 'search');
				?>

			</ul>

		<?php endwhile; ?>

		<?php wp_paginate(); ?>

	<?php else : ?>

		<?php get_template_part('content', 'none'); ?>

	<?php endif; ?>

</section>

<section class="sideFil">
	<?php dynamic_sidebar('filinfo2'); ?>
	<?php dynamic_sidebar('sidebar-3'); ?>
</section>

<?php get_footer('v2'); ?>