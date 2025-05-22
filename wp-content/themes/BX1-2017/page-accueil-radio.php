<?php

/**
 * Template Name: Accueil Radio
 *
 *
 * @package BX1
 */

get_header('v2'); 
?>
  <link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">


 <style>
     .news__article{
        padding-top: 15px;
     }
     .sideFil{
      background-color: #ebebeb;
     }
     
     .listeChroniques, .listeEmissions {
      padding-top: 15px;
     }
     .listeChroniques img, .listeEmissions img{
        margin: auto;
        display: block;
        padding-top: 15px;
        padding-bottom: 7px;
        width:414px!important;
        height: 175px!important;
     }
     .listeBlocTXT{
      height: 61px!important;
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
     .sideFil .mireRadio span, .listeEmissions span, .listeChroniques span {
        display: block;
     }
     .sideFil .mireRadio span.mireradiotitre, .listeEmissions span.titreEmission, .listeChroniques span.titreChronique {
        font-weight: bold;
        padding-left:12px;
     }
     .sideFil .mireRadio span.mireradiosstitre, .listeEmissions span.dateEmission, .listeChroniques span.dateChronique {
        padding-left:20px;
        font-size: 0.8em;
        font-style: italic;
     }
     .sideFil .mireRadio span.spacer{
        padding-bottom: 10px;
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
 </style>

<div class="page-radio-container">
    <div style="margin-bottom: 10px;">
     <h1 class="PageTitle" style="background-color: #e2237a;
      margin-bottom: 0;
      padding: 10px;
      color: #FFF;
      border-radius: 10px 10px 0 0;
      font-family: sys-tt;">En ce moment sur BX1, radio de Bruxelles</h1>
       <div id="radioLive"></div>
       <span style="background-color: #e2237a;
      margin-bottom: 0;
      padding: 10px;
      color: #FFF;
      border-radius: 0 0 10px 10px;
      display:block;
      font-family: sys-tt;">
    <a href="https://bx1.be/grille-radio/?theme=classic" style="display: block; text-align: center; font-size: 1.3em; color: #ffffff; font-weight: bolder">📻 Découvrez la grille des programmes de notre radio 📻</a>
      </span>
      <div style="margin: 15px auto;height:70px;text-align:center;">
          <a href="/whatsapp" style="color: white;font-weight:bold; text-transform: uppercase;background-color: #03C100;border-radius:50px;height:70px;padding:10px;line-height:70px;display:inline-block;"><img style="height:50px!important;" src="<?php echo get_template_directory_uri() ?>/img/icone-logo-whatsapp-vert.png"> contactez-nous via whatsapp au 0460/26.20.20</a>
      </div>
    </div>
    <section class="news news--grille"> 
      <article class="news__article odd colonneChroniques"><span class="titremireRadio">Nos chroniques en podcast</span>
        <div class="listeChroniques">
          <?php
              add_image_size( 'list-thumb', 99999999, 175 );
              add_filter( 'list', 'list-thumb' );
              $loop = new WP_Query( array('post_type' => 'radio-chronique', 'posts_per_page' => 4));
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
                    echo "<a href=\"" . get_the_permalink() . "\"><img src=\"" . $image[0] . "\"></a>";
                    echo "<div class=\"listeBlocTXT\"><span class=\"titreChronique\">" . get_the_title() . "</span>";
                    echo "<span class=\"dateChronique\">" . types_render_field('date-chronique') . "</span></div>";
                  endwhile;
                  wp_reset_postdata();
          ?>
        </div>
      </article>
      <article class="news__article even colonneEmissions"><span class="titremireRadio">Nos émissions en podcast</span>
        <div>
          <div class="listeEmissions">
          <?php
              add_image_size( 'list-thumb', 260, 9999 );
              add_filter( 'list', 'list-thumb' );
              $loop = new WP_Query( array('post_type' => 'radio-emission', 'posts_per_page' => 4));
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
                    echo "<a href=\"" . get_the_permalink() . "\"><img src=\"$newimage\"></a>";
                    echo "<div class=\"listeBlocTXT\"><span class=\"titreEmission\">" . get_the_title() . "</span>";
                    echo "<span class=\"dateEmission\">" . types_render_field('date-chronique') . "</span></div>";
                  endwhile;
                  wp_reset_postdata();
          ?>
        </div>
        </div>
      </article>
      <div class="bottombar loadmore" data-page="2">
        <span>Voir +</span>
      </div>
      <div class="bottombar nomore">
        <span>Aucun contenu supplémentaire à charger</span>
      </div>
    </section>
    <section class="sideFil " style="padding-bottom:50px;">
      <span class="titremireRadio">Nos rendez-vous</span>
    <h2 style="padding-top: 5px; color: #b5115d; text-align:center; margin-bottom: 5px">DU LUNDI AU VENDREDI</h2>

          <?php
              $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'matinale')); 
                  while ( $loop->have_posts() ) : ?>
      <div class="mireRadio">

                    <span class="mireradiotitre">07h00 | <a href="https://bx1.be/radio-type_emissions/bonjour-bruxelles/">Bonjour Bruxelles</a></span><span class="mireradiosstitre spacer">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                    <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
      </div>

    <?php
              $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'le-brunch'));
                  while ( $loop->have_posts() ) : ?>
                    <div class="mireRadio">
                                        <h6 style="border-bottom : 1px solid grey; text-align:center; margin-top: 5px; margin-bottom: 15px">&nbsp;</h6>
          
          <span class="mireradiotitre" style="padding-top: 10px;">09h30 | <a href="https://bx1.be/radio-type_emissions/le-brunch/">Le Brunch</a></span><span class="mireradiosstitre">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                    </div>
                  <?php 
                  endwhile;
                  wp_reset_postdata();
          ?>

          
    <?php
              $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'le-12h30')); 
                  while ( $loop->have_posts() ) : ?>
      <div class="mireRadio">
                    <h6 style="border-bottom : 1px solid grey; text-align:center; margin-top: 5px; margin-bottom: 15px">&nbsp;</h6>
          
                    <span class="mireradiotitre">12h30 | <a href="https://bx1.be/radio-type_emissions/le-12h30/">Le 12h30</a></span><span class="mireradiosstitre spacer">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                    <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
      </div>

       <?php
       $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'la-voix-est-libre'));
       while ( $loop->have_posts() ) : ?>
               <div class="mireRadio">
                    <h6 style="border-bottom : 1px solid grey; text-align:center; margin-top: 5px; margin-bottom: 15px">&nbsp;</h6>
                       <span class="mireradiotitre">13h00 | <a href="https://bx1.be/radio-type_emissions/la-voix-est-libre/?theme=classic">La voix est libre</a></span><span class="mireradiosstitre">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                  <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
               </div>

               
               <?php
       $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'plusactu'));
       while ( $loop->have_posts() ) : ?>
               <div class="mireRadio">
                    <h6 style="border-bottom : 1px solid grey; text-align:center; margin-top: 5px; margin-bottom: 15px">&nbsp;</h6>
                       <span class="mireradiotitre">17h00 | <a href="https://bx1.be/type_emissions/plus-actu/">+d'actu</a></span><span class="mireradiosstitre">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                  <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
               </div>

               <?php
       $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => '18h'));
       while ( $loop->have_posts() ) : ?>
               <div class="mireRadio">
                    <h6 style="border-bottom : 1px solid grey; text-align:center; margin-top: 5px; margin-bottom: 15px">&nbsp;</h6>
                       <span class="mireradiotitre">18h00 | <a href="https://bx1.be/type_emissions/18h-journal/">Le 18h</a></span><span class="mireradiosstitre">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                  <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
               </div>

          

               <h2 style="padding-top: 15px; color: #b5115d; text-align:center; margin-bottom: 5px">DIMANCHE</h2>

          <?php
       $loop = new WP_Query( array('post_type' => 'mire-radio', 'posts_per_page' => 1, 'meta_key' => 'wpcf-nom-emission-chronique','meta_value' => 'club-dimanche'));
       while ( $loop->have_posts() ) : ?>
               <div class="mireRadio">
                    
                       <span class="mireradiotitre">13h00 - 18h00 | <a href="https://bx1.be/radio-type_emissions/club-du-dimanche/">Le Club du Dimanche</a></span><span class="mireradiosstitre">
                    <?php
                    $loop->the_post();
                    $do_not_duplicate[] = $post->ID;
                    echo types_render_field('nom-animation'); ?>
                    </span>
                  <?php 
                  endwhile;
                  wp_reset_postdata();
                  ?>
               </div>

    </section>
</div>

  
<script>
    document.addEventListener("gestcomVideo", function(e) {
        jwplayer("radioLive").setup({
            playlist: [{
                "sources": [{
                    "file": "https://59959724487e3.streamlock.net:443/radio/live/playlist.m3u8"
                },{
                    "file": "rtmps://59959724487e3.streamlock.net:443/radio/live"
                }]
            }],
            primary: 'html5',
            width: '100%',
            aspectratio: '16:9',
            stretching: "exactfit",
            volume: 100,
            autostart: true,
            androidhls: true,
    <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): //nopub ?>
            advertising: false
    <?php else: ?>
            localization: {
                loadingAd : 'Chargement de la publicité',
                liveBroadcast : 'vous regardez BX1+ en Direct'
            },
              advertising: {
                  client: 'vast',
                  admessage: 'Cette publicité se termine dans xx secondes',
                  skipmessage: 'Continuer vers l\'article dans XX secondes',
                  skiptext: 'Continuer',
                  skipoffset: 5,
              <?php if(get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
                  schedule: {
                      adbreak1: {
                                  offset: "pre",
                                  tag: '<?php echo types_render_termmeta('video-pre-roll',array('term_id'=>$the_term_id)); ?>'
                          }
                  }        
              <?php else: ?>
                  
                  schedule: (e.detail.vastUrl!=undefined && e.detail.vastUrl!=null && e.detail.vastUrl!='' ? [{ tag: e.detail.vastUrl, offset: "pre" },{ tag: e.detail.vastUrl.replace('vst.xml','vst2.xml'), offset: "pre" }] : [])             
                      
              <?php endif; ?>
            }
    <?php endif; ?>
        })
    });
</script>
<?php get_footer('v2'); ?>