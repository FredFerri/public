<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<section class="news news--grille"> 

    <h1>Agenda des événements</h1>

    <form method="get" action="" class="filterForm filterForm--agenda">
     <h4>Filtrer les événements</h4>
     <div class="filterForm__select">
       <label for="selectType">Type d'événement</label>
       <?php wp_dropdown_categories(
         array(
            'taxonomy'=>'type-d-evenement',
            'id'=>'selectType',
            'show_option_all'=>'Tous les types',
            'name'=>'type-d-evenement',
            'value_field'=>'slug',
            'selected'=>$_GET['type-d-evenement'],
            'orderby'=>'name'
         )
       ); ?>
     </div>
     <input type="submit" value="Filtrer">
     <a href="/evenement" title="Voir toutes les événement" class="filterForm__reset">Réinitialiser</a>
     <div class="clearfix"></div>
   </form>

    <ul class="onglets">
      <?php 
        $day = mktime(0,0,0,date('n'),date('j'),date('Y'));
        $i = 1;
        $args = array(
          'post_type' => 'evenement',
          'post_status' => 'publish',
          'posts_per_page' => 100,
          'meta_query' => array(
              array(
                 'key' => 'wpcf-date-de-fin',
                 'value' => $day,
                 'compare' => '>=',
             )
           ),
          'meta_key' => 'wpcf-date-de-debut',
          'orderby' => array( 'meta_value' => 'ASC')
        );
        $eq_query = new WP_Query($args);
        if($eq_query->have_posts()) : // The Loop
          while ($eq_query->have_posts()): $eq_query->the_post();
          $date = types_render_field('date-de-debut',array('format'=>'d/m/Y'));
          if($date != $new_date):
      ?>
        <li><a href="#grille<?php echo $i; ?>" <?php if($i==1): ?>class="active"<?php endif; ?>><?php echo $date ?></a></li>
      <?php
        $i++;
        $new_date = $date;
        endif;
        endwhile;
        wp_reset_query();
        endif;
      ?>
    </ul>

    <?php
      $i = 1;
      $eq_query = new WP_Query($args);
      if($eq_query->have_posts()) : // The Loop
      while ($eq_query->have_posts()): $eq_query->the_post();
      $date = types_render_field('date-de-debut',array('format'=>'d/m/Y'));
        $date_raw = mktime(0,0,0,types_render_field('date-de-debut',array('format'=>'m')),types_render_field('date-de-debut',array('format'=>'d')),types_render_field('date-de-debut',array('format'=>'Y')));
         ?>
      <div class="grille" id="grille<?php echo $i; ?>" <?php if($i==1): ?>style="display:block;"<?php endif; ?>>
        <h2><?php echo $date; ?></h2>
        <ul class="grid">
        <?php 
          $i = 1;
          if(isset($_GET['type-d-evenement']) && $_GET['type-d-evenement'] != '0'){
            $typedevenement=array('taxonomy' => 'type-d-evenement','field' => 'slug','terms' => $_GET['type-d-evenement']);
          }
          $args = array(
            'post_type' => 'evenement',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                   'key' => 'wpcf-date-de-fin',
                   'value' => $date_raw,
                   'compare' => '>='
               ),
               array(
                   'key' => 'wpcf-date-de-debut',
                   'value' => strtotime('+1 day', $date_raw),
                   'compare' => '<'
               )
             ),
            'tax_query' => array(
              $typedevenement
            ),
            'meta_key' => 'wpcf-date-de-debut',
            'orderby' => array( 'meta_value' => 'ASC')
          );
          $sec_query = new WP_Query($args);
          if($sec_query->have_posts()) : // The Loop
            while ($sec_query->have_posts()): $sec_query->the_post();
        ?>
        <li class="grid__row">
            <div class="grid__row__hour grid__row__hour--large">

              <?php //détermine si l'event est sur 1 jour ou plusieurs
                $date_fin_raw = mktime(0,0,0,types_render_field('date-de-fin',array('format'=>'m')),types_render_field('date-de-fin',array('format'=>'d')),types_render_field('date-de-fin',array('format'=>'Y')));
                if($date_raw == $date_fin_raw):
              ?>
                <?php echo types_render_field('date-de-debut',array('format'=>'H:i')); ?><br />
                <?php echo types_render_field('date-de-fin',array('format'=>'H:i')); ?>
              <?php else: ?>
                Du <?php echo types_render_field('date-de-debut',array('format'=>'d/m/Y \à H:i')); ?><br />
                au <?php echo types_render_field('date-de-fin',array('format'=>'d/m/Y \à H:i')); ?>
              <?php endif; ?>
            </div>
            <div class="grid__row__prog grid__row__prog--small">
                <a href="<?php the_permalink(); ?>" title="En savoir plus sur l'émission <?php the_title(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="grid__row__imag">
                <a href="<?php the_permalink(); ?>" title="En savoir plus sur l'émission <?php the_title(); ?>">
                  <figure>
                    <?php the_post_thumbnail('Logo'); ?>
                  </figure>
                </a>
            </div>
          </li>
        <?php
            endwhile;
            wp_reset_query();
          ?>
        <?php else: ?>
          <li>Il n'y a pas d'événement correspondant aux filtres choisis à cette date.<br/><a href="/evenement" title="Voir tous les événement">Réinitialiser les filtres</a></li>
        <?php endif;?>
        </ul>
      </div>
    <?php
      $i++;
      $new_date = $date;
      endwhile;
      wp_reset_query();
      endif;
    ?>
  </section>

  <section class="sideFil">
    <?php dynamic_sidebar('filinfo'); ?>
    <?php get_sidebar(); ?>
  </section>

<?php get_footer('v2'); ?>
