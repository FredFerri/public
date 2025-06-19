<?php

/**
 * Template Name: Mon actu
 *
 *
 * @package TeleBruxelles
 */

get_header('v2');

$category = array();
$post_tag = '';
$format_contenu = '';

if ($_GET['category']) {
  $category = $_GET['category'];
} 
if ($_GET['post_tag']) {
  $post_tag = $_GET['post_tag'];
} 
if ($_GET['format-du-contenu']) {
  $format_contenu = $_GET['format-du-contenu'];
} 

?>

    <section class="news">

        <form method="get" action="" class="filterForm filterForm--monactu">
         <div>
           <h4>Vos choix d'actualités</h4>
           <p>Vos choix sont enregistrés sur cet appareil pour vos visites futures.</p>
         </div>
         <div class="filterForm__select" data-placeholder="Toutes les communes">
           <label for="selectCat">Commune</label>
           <select name="category[]" id="selectCat" class="postform" multiple="multiple">
				<option class="level-0" value="anderlecht" <?php if(in_array('anderlecht',$category)){echo 'selected';} ?>>Anderlecht</option>
				<option class="level-0" value="auderghem" <?php if(in_array('auderghem',$category)){echo 'selected';} ?>>Auderghem</option>
				<option class="level-0" value="berchem-sainte-agathe" <?php if(in_array('berchem-sainte-agathe',$category)){echo 'selected';} ?>>Berchem-Sainte-Agathe</option>
				<option class="level-0" value="bruxelles-ville" <?php if(in_array('bruxelles-ville',$category)){echo 'selected';} ?>>Bruxelles-ville</option>
				<option class="level-0" value="drogenbos" <?php if(in_array('drogenbos',$category)){echo 'selected';} ?>>Drogenbos</option>
				<option class="level-0" value="etterbeek" <?php if(in_array('etterbeek',$category)){echo 'selected';} ?>>Etterbeek</option>
				<option class="level-0" value="evere" <?php if(in_array('evere',$category)){echo 'selected';} ?>>Evere</option>
				<option class="level-0" value="forest" <?php if(in_array('forest',$category)){echo 'selected';} ?>>Forest</option>
				<option class="level-0" value="ganshoren" <?php if(in_array('ganshoren',$category)){echo 'selected';} ?>>Ganshoren</option>
				<option class="level-0" value="ixelles" <?php if(in_array('ixelles',$category)){echo 'selected';} ?>>Ixelles</option>
				<option class="level-0" value="jette" <?php if(in_array('jette',$category)){echo 'selected';} ?>>Jette</option>
				<option class="level-0" value="koekelberg" <?php if(in_array('koekelberg',$category)){echo 'selected';} ?>>Koekelberg</option>
				<option class="level-0" value="crainhem" <?php if(in_array('crainhem',$category)){echo 'selected';} ?>>Crainhem</option>
				<option class="level-0" value="linkebeek" <?php if(in_array('linkebeek',$category)){echo 'selected';} ?>>Linkebeek</option>
				<option class="level-0" value="molenbeek-saint-jean" <?php if(in_array('molenbeek-saint-jean',$category)){echo 'selected';} ?>>Molenbeek-Saint-Jean</option>
				<option class="level-0" value="rhode-saint-genese" <?php if(in_array('rhode-saint-genese',$category)){echo 'selected';} ?>>Rhode-Saint-Genèse</option>
				<option class="level-0" value="saint-gilles" <?php if(in_array('saint-gilles',$category)){echo 'selected';} ?>>Saint-Gilles</option>
				<option class="level-0" value="saint-josse-ten-noode" <?php if(in_array('saint-josse-ten-noode',$category)){echo 'selected';} ?>>Saint-Josse-ten-Noode</option>
				<option class="level-0" value="schaerbeek" <?php if(in_array('schaerbeek',$category)){echo 'selected';} ?>>Schaerbeek</option>
				<option class="level-0" value="uccle" <?php if(in_array('uccle',$category)){echo 'selected';} ?>>Uccle</option>
				<option class="level-0" value="watermael-boitsfort" <?php if(in_array('watermael-boitsfort',$category)){echo 'selected';} ?>>Watermael-Boitsfort</option>
				<option class="level-0" value="wemmel" <?php if(in_array('wemmel',$category)){echo 'selected';} ?>>Wemmel</option>
				<option class="level-0" value="wezembeek-oppem" <?php if(in_array('wezembeek-oppem',$category)){echo 'selected';} ?>>Wezembeek-Oppem</option>
				<option class="level-0" value="woluwe-saint-lambert" <?php if(in_array('woluwe-saint-lambert',$category)){echo 'selected';} ?>>Woluwe-Saint-Lambert</option>
				<option class="level-0" value="woluwe-saint-pierre" <?php if(in_array('woluwe-saint-pierre',$category)){echo 'selected';} ?>>Woluwe-Saint-Pierre</option>
			</select>
         </div>
         <div class="filterForm__select" data-placeholder="Tous les mots-clés">
           <label for="selectTags">Mots-clés</label>
           <?php wp_dropdown_categories(
              array(
                  'taxonomy'    => 'post_tag',
                  'id'          => 'selectTags',
                  'name'        => 'post_tag',
                  'value_field' => 'slug',
                  'selected'    => is_array($post_tag) 
                                      ? implode(',', $post_tag) 
                                      : (strpos($post_tag, ',') !== false 
                                          ? $post_tag 
                                          : trim($post_tag)),
                  'orderby'     => 'name',
                  'multiple'    => true
              )

           ); ?>
         </div>
         <div class="filterForm__select" data-placeholder="Tous les formats">
             <label for="selectFormat">Format</label>
             <?php wp_dropdown_categories(
               array(
                  'taxonomy'=>'format-du-contenu',
                  'id'=>'selectFormat',
                  'name'=>'format-du-contenu',
                  'value_field'=>'slug',
                  'selected'    => is_array($format_contenu) 
                                      ? implode(',', $format_contenu) 
                                      : (strpos($format_contenu, ',') !== false 
                                          ? $format_contenu 
                                          : trim($format_contenu)),
                  'orderby'=>'name',
                  'multiple'=>true
               )
             ); ?>
           </div>
         <input type="submit" value="Filtrer">
         <a href="/mon-actu" title="Voir toutes les actualités" class="filterForm__reset">Réinitialiser</a>
         <div class="clearfix"></div>
       </form>

       <div class="articles">
      <?php
      if(isset($_GET['category']) && $_GET['category'] != '0'){
        $category=array('taxonomy' => 'category','field' => 'slug','terms' => $_GET['category']);
      }
      if(isset($_GET['post_tag']) && $_GET['post_tag'] != '0'){
        $post_tag=array('taxonomy' => 'post_tag','field' => 'slug','terms' => $_GET['post_tag']);
      }
      if(isset($_GET['format-du-contenu']) && $_GET['format-du-contenu'] != '0'){
        $formatducontenu=array('taxonomy' => 'format-du-contenu','field' => 'slug','terms' => $_GET['format-du-contenu']);
      }
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      // On affiche 10 news, en commençant par celles mises en avant, et ensuite par date de publication
      $argsNews = array(
        'post_type'=> array('post','ireport','votre-bruxelles'),
        'posts_per_page' => 10,
        'meta_key' => 'wpcf-featured-news',
        'orderby' => array( 'meta_value' => 'DESC', 'date' => 'DESC' ),
          'tax_query' => array(
            $category,$post_tag,$formatducontenu
          ),
        'paged' => $paged
      );
      $queryNews = new WP_Query($argsNews);
      if($queryNews->have_posts()) : ?>
        <?php
          while ( $queryNews->have_posts() ) : $queryNews->the_post();
          $videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
          $flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
          $sport = in_category('sport');
          $redaction = in_category('dossiers-redaction');
          $bonus = in_category('bx1-bonus');
          $exclusif = get_post_meta($post->ID, 'wpcf-info-bx1', true);
          $count++;
            if(get_option('home_pres') == 'news'){
              $even_odd_class = ( ($count % 2) == 0 ) ? "odd" : "even";
            }
            else{
              $even_odd_class = ( ($count % 2) == 0 ) ? "even" : "odd";
            }
        ?>
          <article class="news__article <?php if($videoFileName != ''){echo 'news__article--video ';} echo $even_odd_class; ?>">
            <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
              <figure>
                <?php if($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
                <?php if($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
                <?php if($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
                <?php if($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
                <?php if($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
                <?php the_post_thumbnail('medium'); ?>
              </figure>
              <h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
            </a>
          </article>
        <?php wp_reset_postdata(); endwhile; ?>
        </div>

        <?php if ($queryNews->max_num_pages > 1 && $paged): ?>
          <div class="wp-paginate font-inherit">
              <?php
                  $big = 99999999;
                  echo paginate_links(array(
                      'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                      'format' => '/page/%#%',
                      'total' => $queryNews->max_num_pages,
                      'current' => max(1, get_query_var('paged')),
                      'show_all' => false,
                      'end_size' => 2,
                      'mid_size' => 3,
                      'prev_next' => true,
                      'prev_text' => '«',
                      'next_text' => '»',
                      'type' => 'list'
                  )); 
              ?>
          </div>
        <?php endif; ?>

      <?php else : ?>

         <p>Il n'y a pas d'article corresponant à ces filtres. Essayez peut-être une recherche plus large.<br /><a href="/mon-actu" title="Voir toutes les actualités">Réinitialiser les filtres</a></p>

      <?php endif; ?>

    </section>

    <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>


<?php get_footer('v2'); ?>
