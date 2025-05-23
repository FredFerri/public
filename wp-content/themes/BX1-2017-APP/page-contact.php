<?php
/**
 * Template Name: Contacts
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>

	<section class="news"> 

	<h1><?php the_title(); ?></h1>

		<div class="contactList">
			<?php
			    $argsContact = array(
			      'post_type'=> 'contacts',
			      'posts_per_page' => -1,
			      'orderby' => 'title',
			      'order' => 'ASC'
			    );
			    $queryContact = new WP_Query($argsContact);
			    if($queryContact->have_posts()) : ?>
			      <?php while($queryContact->have_posts()):$queryContact->the_post(); ?>
			        	<h3><?php the_title(); ?></h3>
			        	<?php the_content(); ?>
			      <?php endwhile; ?>
			<?php wp_reset_postdata(); endif; ?>
		</div>

	</section>

<?php get_footer(); ?>
