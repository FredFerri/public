<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

    <section class="news">

      <?php if ( have_posts() ) : ?>

         <h1>Replay</h1>

         <form method="get" action="" class="filterForm filterForm--emissions">
           <h4>Filtrer les émissions</h4>
           <div class="filterForm__select">
             <label for="selectTypeEmissions">Émission</label>
             <?php wp_dropdown_categories(
               array(
                  'taxonomy'=>'type_emissions',
                  'id'=>'selectTypeEmissions',
                  'show_option_all'=>'Toutes les émissions',
                  'name'=>'type_emissions',
                  'value_field'=>'slug',
                  'selected'=>$_GET['type_emissions'],
                  'orderby'=>'name'
               )
             ); ?>
           </div>
           <div class="filterForm__select">
             <label for="selectInvites">Invité</label>
             <?php wp_dropdown_categories(
               array(
                  'taxonomy'=>'invite',
                  'id'=>'selectInvites',
                  'show_option_all'=>'Tous les invités',
                  'name'=>'invite',
                  'value_field'=>'slug',
                  'selected'=>$_GET['invite'],
                  'orderby'=>'name'
               )
             ); ?>
           </div>
           <div class="filterForm__select">
             <label for="selectDate">Date</label>
             <input type="text" name="diffusion" id="selectDate" value="<?php echo $_GET['diffusion']; ?>" placeholder="jj-mm-aaaa" data-toggle="datepicker" maxlength="10" />
           </div>
           <input type="submit" value="Filtrer">
           <a href="/emission" title="Voir toutes les émissions" class="filterForm__reset">Réinitialiser</a>
           <div class="clearfix"></div>
         </form>

         <div class="articles">
            <?php
                if(isset($_GET['invite']) && $_GET['invite'] != '0'){
                  $invites=array('taxonomy' => 'invite','field' => 'slug','terms' => $_GET['invite']);
                }
                if(isset($_GET['type_emissions']) && $_GET['type_emissions'] != '0'){
                  $type_emissions=array('taxonomy' => 'type_emissions','field' => 'slug','terms' => $_GET['type_emissions']);
                }
                if(isset($_GET['diffusion']) && $_GET['diffusion'] != ''){
                  $diffusion=strtotime($_GET['diffusion']);
                  $argsTest = array(
                     'post_type'=> array('emission'),
                     'posts_per_page' => 1,
                     'meta_query' => array(
                         array(
                             'key' => 'wpcf-nom-du-fichier-video',
                             'value'   => '',
                             'compare' => '!='
                         ),
                         array(
                            'key' => 'wpcf-horaire-debut',
                            'value'   => $diffusion,
                            'compare' => '>'
                         ),
                         array(
                            'key' => 'wpcf-horaire-debut',
                            'value'   => strtotime('+1 day', $diffusion),
                            'compare' => '<'
                         )
                        ),
                      'tax_query' => array(
                        $invites,$type_emissions
                      )
                   );
                   $queryTest = new WP_Query($argsTest);
                   if($queryTest->have_posts()){
                    $diffusion_new = array(
                      array(
                        'key' => 'wpcf-horaire-debut',
                        'value'   => $diffusion,
                        'compare' => '>'
                      ),
                      array(
                        'key' => 'wpcf-horaire-debut',
                        'value'   => strtotime('+1 day', $diffusion),
                        'compare' => '<'
                      )
                    );
                   }
                   else{
                    $diffusion_old = array(
                                        array(
                                          'year'  => date("Y", $diffusion),
                                          'month' => date("m", $diffusion),
                                          'day'   => date("d", $diffusion),
                                        )
                                     );
                   }
                   wp_reset_postdata();
                }
               $argsNews = array(
                 'post_type'=> array('emission'),
                 'posts_per_page' => 10,
                 'meta_query' => array(
                     array(
                         'key' => 'wpcf-nom-du-fichier-video',
                         'value'   => '',
                         'compare' => '!='
                     ),
                     $diffusion_new
                   ),
                  'tax_query' => array(
                    $invites,$type_emissions
                  ),
                  'orderby' => array('date' => 'DESC'),
                  'paged' => get_query_var('paged'),
                  'date_query' => $diffusion_old
               );
               $queryNews = new WP_Query($argsNews);
               if($queryNews->have_posts()) : ?>
                 <?php
                   while ( $queryNews->have_posts() ) : $queryNews->the_post();
                  $heure = '';
                  if(types_render_field('horaire-debut') == ''){
                    $heure = get_the_date('d F Y à H:i');
                  }
                  else{
                    $heure = types_render_field('horaire-debut',array('format'=>'d F Y \d\e H:i')).' à '.types_render_field('horaire-fin',array('format'=>'H:i'));
                  }
                  if(types_render_field('n-afficher-que-sur-la-grille') != '1'):
                 ?>
                   <article class="news__article">
                   <a href="<?php the_permalink(); ?>" title="Voir l'émission <?php the_title(); ?> ...">
                     <h3><?php the_title(); ?> <span class="date"><?php echo $heure; ?>.</span></h3>
                       <figure>
                           <?php
                            $terms = get_the_terms( $post->ID, 'type_emissions' );
                            $featured_img_url = get_the_post_thumbnail(get_the_ID(),'Emissions');
                            echo $featured_img_url;
                            /*foreach ($terms as $term){
                                $image = apply_filters( 'taxonomy-images-get-terms', '', array(
                                    'taxonomy' => 'type_emissions',
                                        'term_args' => array(
                                            'slug' => $term->slug,
                                            )
                                    ) 
                                );
                                foreach( (array) $image as $img){
                                    echo wp_get_attachment_image( $img->image_id, 'Emissions');
                                }
                            }*/
                          ?>
                       </figure>
                     </a>
                   </article>
                 <?php endif; endwhile; wp_reset_postdata(); ?>
               <?php else: ?>
                <p>Il n'y a pas d'émission correspondant à ces filtres. Essayez peut-être une recherche plus large.<br /><a href="/emission" title="Voir toutes les émissions">Réinitialiser les filtres</a></p>
               <?php endif; ?>
         </div>

         <?php wp_paginate(); ?>

      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

   <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
   </section>

<?php get_footer('v2'); ?>
