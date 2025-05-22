<?php
/**
 * Template Name: Contacts
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

	<section class="news"> 

	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>

		<form method="get" action="#" id="services">
			<div>
				<label for="selectService">Service</label>
				<select id="selectService" name="selectService">
					<option value="">- Sélectionnez un service -</option>
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
				            <option value="id<?php the_ID(); ?>"><?php the_title(); ?></option>
				          <?php endwhile; ?>
				    <?php wp_reset_postdata(); endif; ?>
				</select>
				<input type="submit" value="OK" />
			</div>
		</form>
		<div class="clearfix"></div>
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
			        <div class="contactList__contact id<?php the_ID(); ?>">
			        	<?php the_content(); ?>
			        </div>
			      <?php endwhile; ?>
			<?php wp_reset_postdata(); endif; ?>
		</div>

	</section>

    <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>

<?php get_footer('v2'); ?>
