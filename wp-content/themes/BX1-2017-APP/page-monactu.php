<?php

/**
 * Template Name: Mon actu
 *
 *
 * @package TeleBruxelles
 */

get_header(); ?>


    <section id="infinitescroll">

      <h1>Bibliothèque</h1>
      <?php
        $cookie = $_COOKIE['bibli'];
        if($cookie == NULL){
          $cookie = array("concours","emission","depeches","adresse_after","dossier","evenement","lives","annonce","blog","post","ireport","votre-bruxelles");
        }
        else{
          $cookie = str_replace('\"','',$cookie);
          $cookie = explode(',',$cookie);
        }
      ?>
      <form method="get" action="" class="filterForm filterForm--bibli">
         <h4>Filtrer les contenus</h4>
         <div class="filterForm__select">
           <label for="selectType">Type de contenu</label>
            <div class="checkbox">
             <input type="checkbox" id="post" name="post" value="post" <?php if(in_array('post',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="post">Actualités</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="adresse_after" name="adresse_after" value="adresse_after" <?php if(in_array('adresse_after',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="adresse_after">Adresses @After</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="ireport" name="ireport" value="ireport" <?php if(in_array('ireport',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="ireport">Alertez-nous</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="annonce" name="annonce" value="annonce" <?php if(in_array('annonce',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="annonce">Annonces</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="blog" name="blog" value="blog" <?php if(in_array('blog',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="blog">Blogs</label>
            </div>
           <div class="checkbox">
             <input type="checkbox" id="concours" name="concours" value="concours" <?php if(in_array('concours',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="concours">Concours</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="depeches" name="depeches" value="depeches" <?php if(in_array('depeches',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="depeches">Direct info</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="dossier" name="dossier" value="dossier" <?php if(in_array('dossier',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="dossier">Dossiers</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="emission" name="emission" value="emission" <?php if(in_array('emission',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="emission">Émissions</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="evenement" name="evenement" value="evenement" <?php if(in_array('evenement',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="evenement">Événements</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="lives" name="lives" value="lives" <?php if(in_array('lives',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="lives">Lives</label>
            </div>
            <div class="checkbox">
             <input type="checkbox" id="votre-bruxelles" name="votre-bruxelles" value="votre-bruxelles" <?php if(in_array('votre-bruxelles',$cookie)): ?>checked="checked"<?php endif; ?>>
             <label for="votre-bruxelles">Votre Bruxelles</label>
            </div>
         </div>
         <input type="submit" value="Filtrer">
         <a href="/mon-actu" class="filterForm__reset">Réinitialiser</a>
         <div class="clearfix"></div>
      </form>

      <ul class="directinfo insideScroll">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $argsNews = array(
        'post_type'=> $cookie,
        'posts_per_page' => 25,
        'paged' => $paged
      );
      $queryNews = new WP_Query($argsNews);
      if($queryNews->have_posts()) : ?>
        <?php
          while ( $queryNews->have_posts() ) : $queryNews->the_post();
        ?>
          <li class="post">
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
           </li>

           <?php endwhile; ?>
      </ul>
           <div id="paginatescroll"><?php echo get_next_posts_link( 'Older Entries',25 ); ?></div>

        <?php wp_reset_postdata(); ?>
        </div>

      <?php endif; ?>

    </section>

<?php get_footer(); ?>
