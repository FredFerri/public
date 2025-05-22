<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<style>
     .news__article{
        padding-top: 15px;
     }
     .sideFil{
      background-color: #ebebeb;
     }
     
     .listeArvhice {
      padding-top: 15px;
     }
     .listeArvhice img{
        margin: auto;
        display: block;
        padding-top: 15px;
        padding-bottom: 7px;
     }
     .sideFil .titremireRadio, .news .titremireRadio{
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1.2em;
        background-color:#e2237a;
        color:#FFF;
        text-align: center;
        display: block;
        border-radius:5px;
     }
     .sideFil .mireRadio span, .listeArvhice span {
        display: block;
     }
     .sideFil .mireRadio span.mireradiotitre, .listeArvhice span.titreChronique {
        font-weight: bold;
        padding-left:12px;
     }
     .sideFil .mireRadio span.mireradiosstitre, .listeArvhice span.dateChronique {
        padding-left:20px;
        font-size: 0.8em;
        font-style: italic;
     }
     .sideFil .mireRadio span.spacer{
        padding-bottom: 15px;
     }
     .news .bottombar{
      border-radius: 5px;
      background-color:#EB1F7C;
      padding: 5px;
      text-align: center;
      font-weight: bold;
      text-decoration: none;
      width: 100%;
      display: block;
     }
     .news .bottombar.loadmore{
      cursor: pointer;
     }
     .news .bottombar span{
      color: #FFF;
     }
     .news .bottombar.nomore{
      display: none;
      background-color: #ebebeb;
     }
     .news .bottombar.nomore span{
      color:#EB1F7C;
     }
     .timer{
      width: 100%;
      margin: auto;
      text-align: center;
      font-size: 50px;
     }
     .timer .box{
      background: rgba(255,93,177,1);
      background: -moz-linear-gradient(top, rgba(255,93,177,1) 0%, rgba(239,1,124,1) 100%);
      background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,93,177,1)), color-stop(100%, rgba(239,1,124,1)));
      background: -webkit-linear-gradient(top, rgba(255,93,177,1) 0%, rgba(239,1,124,1) 100%);
      background: -o-linear-gradient(top, rgba(255,93,177,1) 0%, rgba(239,1,124,1) 100%);
      background: -ms-linear-gradient(top, rgba(255,93,177,1) 0%, rgba(239,1,124,1) 100%);
      background: linear-gradient(to bottom, rgba(255,93,177,1) 0%, rgba(239,1,124,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff5db1', endColorstr='#ef017c', GradientType=0 );
      padding: 14px;
      border-radius: 17px;
      color:#FFF;
     }
     .titreattente{
        padding-top: 15px;
        font-weight: bold;
        font-size: 25px;
        text-align: center;
     }
     .bloc, .bloc .blocimg, .bloc .blocimg img{
      /*height: 175px!important;*/
     }
     .bloc{
      display: flex;
      width: 100%;
      margin-bottom: 15px;
      text-decoration: none!important;
     }
     ..bloc .blocimg, .bloc .bloctxt{
      width: 50%
     }
     .bloc .blocimg img{
      border-radius: 10px 0 0 10px;
      padding: 0;
     }
     .bloc .bloctxt{
      width: 50%;
      padding-top: 15px;
      border-radius:0 10px 10px 0;
      background-color: #ef017c;
      color:#FFF;
     }
     .texteChronique{
      padding-top: 15px;
    padding-left: 20px;
    font-size: 0.8em;
     }
 </style>
    <section class="news">

      <?php if ( have_posts() ) : ?>

         <h1>Les archives des émissions</h1>
         <div class="listeArvhice">
        <?php
            add_image_size( 'list-thumb', 99999999, 175 );
            add_filter( 'list', 'list-thumb' );
            $loop = new WP_Query( array('post_type' => 'radio-emission', 'posts_per_page' => 50));
                while ( $loop->have_posts() ) :
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'list-thumb');
                  $imagelink  = explode(".", $image[0]);
                  $imageext   = end($imagelink);
                  $imageextl  = strlen(".".$imageext);
                  $newimageln = substr($image[0], 0,-$imageextl);
                  $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                  echo "<a href=\"" . get_the_permalink() . "\" style=\"text-decoration:none;\"><div class=\"bloc\"><div class=\"blocimg\"><img src=\"" . $image[0] . "\"></div><div class=\"bloctxt\">";
                  echo "<span class=\"titreChronique\">" . get_the_title() . "</span>";
                  echo "<span class=\"dateChronique\">" . types_render_field('date-chronique') . "</span>";
                  echo "<span class=\"texteChronique\">" . types_render_field('sous-titre-itunes') . "</span></div></div></a>";
                endwhile;
                wp_reset_postdata();
        ?>
      </div>
      <div class="bottombar loadmore" data-page="2" data-type="archive" data-section="chronique">
      <span>Voir +</span>
      </div>
      <div class="bottombar nomore">
        <span>Aucun contenu supplémentaire à charger</span>
      </div>
      <?php else : ?>

         <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

   </section>

   <section class="sideFil " style="padding-bottom:50px;">
    <span class="titremireRadio">Le programme du <?php echo date("d/m");?></span>
        <?php
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'acteur-jour'));
                while ( $loop->have_posts() ) : ?>
                  <div class="mireRadio">
                  <h6 style="border-bottom : 1px solid grey;"><img src="<?php echo get_template_directory_uri();?>/img/emission/radio/logoactbxl.png"></h5>
                  
                  
                  <?php 
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  $acteurgenre = "acteur";
                  if (types_render_field('sexe-invite') == "Femme")
                    {
                      $acteurgenre = "actrice";
                    }
                  ?>
                  <span class="mireradiotitre">10h00 | L’<?php echo $acteurgenre; ?> du jour</span><span class="mireradiosstitre">
                  <?php
                  echo types_render_field('nom-invite') . " &ndash; " . types_render_field('fonction-de-linvite'); ?>
                  </span>
                  </div>
                <?php 
                endwhile;
                wp_reset_postdata();
        ?>
    <div class="mireRadio">
        <h6 style="border-bottom : 1px solid grey;"><img src="<?php echo get_template_directory_uri();?>/img/emission/radio/logotjsplusactu.png"></h5>
            <?php
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'invite-politique'));
                while ( $loop->have_posts() ) :?>
                  <span class="mireradiotitre">12h20 | L’invité politique</span><span class="mireradiosstitre spacer">
                  <?php 
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('nom-invite') . " &ndash; " . types_render_field('fonction-de-linvite'); ?>
                  </span>
                <?php  
                endwhile;
                wp_reset_postdata();
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'invite-societe'));
                while ( $loop->have_posts() ) : ?>
                  <span class="mireradiotitre">13h15 | L’invité société</span><span class="mireradiosstitre spacer">
                  <?php
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('nom-invite') . " &ndash; " . types_render_field('fonction-de-linvite'); ?>
                  </span>
                <?php  
                endwhile;
                wp_reset_postdata();
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'invite-culture'));
                while ( $loop->have_posts() ) : ?>
                  <span class="mireradiotitre">13h35 | L’invité culture</span><span class="mireradiosstitre spacer">
                  <?php
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('nom-invite') . " &ndash; " . types_render_field('fonction-de-linvite'); ?>
                  </span>
                <?php                    
                endwhile;
                wp_reset_postdata();
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'invite-lcr'));
                while ( $loop->have_posts() ) : ?>
                  <span class="mireradiotitre">13h45 | L’invité LCR</span><span class="mireradiosstitre">
                  <?php
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('nom-invite') . " &ndash; " . types_render_field('fonction-de-linvite'); ?>
                  </span>
                <?php  
                endwhile;
                wp_reset_postdata();
        ?>
    </div>
            <?php
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'bruxelles-vit'));
                while ( $loop->have_posts() ) : ?>
                  <div class="mireRadio">
                  <h6 style="border-bottom : 1px solid grey;"><img src="<?php echo get_template_directory_uri();?>/img/emission/radio/logobxlvit.png"></h5>
                  <span class="mireradiotitre">14h00 | Bruxelles vit en direct</span><span class="mireradiosstitre">
                  <?php
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('lieu-evenement'); ?>
                  </span>
                </div>
                <?php  
                endwhile;
                wp_reset_postdata();
            $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'podcast-jour'));
                while ( $loop->have_posts() ) : ?>
                  <div class="mireRadio">
                  <h6 style="border-bottom : 1px solid grey;"><img src="<?php echo get_template_directory_uri();?>/img/emission/radio/logopluspodcast.png"></h5>
                  <span class="mireradiotitre">16h00 | Le podcast du jour</span><span class="mireradiosstitre">
                  <?php
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  echo types_render_field('nom-podcast-ou-invite'); ?>
                  </span>
                  </div>
                <?php  
                endwhile;
                wp_reset_postdata();
              
        ?>
        
  </section>

<?php get_footer('v2'); ?>