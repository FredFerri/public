<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(is_search()): ?>
      <title>Recherche : <?php echo get_search_query(); ?> | <?php echo bloginfo('name'); ?></title>
    <?php else: ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>
    <?php
    $tags = wp_get_post_tags($post->ID);
    echo PHP_EOL;
    foreach ( $tags as $tag ) {
    echo  "\t<meta property='article:tag' content='" . strtoupper($tag->name) . "' />".PHP_EOL;
    echo  "\t<meta property='article:tag' content='" . $tag->name . "' />".PHP_EOL;
    echo  "\t<meta property='article:tag' content='" . strtolower($tag->name) . "' />".PHP_EOL;
    }
    $cats = wp_get_post_categories($post->ID);
    foreach ( $cats as $cat ) {
        $catdetails =   get_the_category_by_ID($cat);
	    echo  "\t<meta property='article:tag' content='" . strtoupper($catdetails) . "' />".PHP_EOL;
	    echo  "\t<meta property='article:tag' content='" . $catdetails . "' />".PHP_EOL;
	    echo  "\t<meta property='article:tag' content='" . strtolower($catdetails) . "' />".PHP_EOL;
    }
    //print_r();
    //echo get_the_category_by_ID(3);
    ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('url'); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php bloginfo('url'); ?>/manifest.json">
    <link rel="mask-icon" href="<?php bloginfo('url'); ?>/safari-pinned-tab.svg" color="#ec217d">
    <link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico">
    <meta name="msapplication-config" content="<?php bloginfo('url'); ?>/browserconfig.xml">
    <meta name="theme-color" content="#ffffff" />
    <?php if(is_page('mon-actu') || is_search()): ?>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <?php endif; ?>
    <?php wp_head(); ?>
    <?php if(is_page('mon-actu')): // redirection vers bonne URL sur Mon BX1 si cookies définis ?>
      <script type="text/javascript">
      var $ = jQuery.noConflict();
      /*!
       * JavaScript Cookie v2.1.4
       * https://github.com/js-cookie/js-cookie
       *
       * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
       * Released under the MIT license
       */
      !function(e){var n=!1;if("function"==typeof define&&define.amd&&(define(e),n=!0),"object"==typeof exports&&(module.exports=e(),n=!0),!n){var t=window.Cookies,o=window.Cookies=e();o.noConflict=function(){return window.Cookies=t,o}}}(function(){function e(){for(var e=0,n={};e<arguments.length;e++){var t=arguments[e];for(var o in t)n[o]=t[o]}return n}function n(t){function o(n,r,i){var c;if("undefined"!=typeof document){if(arguments.length>1){if(i=e({path:"/"},o.defaults,i),"number"==typeof i.expires){var a=new Date;a.setMilliseconds(a.getMilliseconds()+864e5*i.expires),i.expires=a}i.expires=i.expires?i.expires.toUTCString():"";try{c=JSON.stringify(r),/^[\{\[]/.test(c)&&(r=c)}catch(s){}r=t.write?t.write(r,n):encodeURIComponent(String(r)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),n=encodeURIComponent(String(n)),n=n.replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent),n=n.replace(/[\(\)]/g,escape);var f="";for(var u in i)i[u]&&(f+="; "+u,i[u]!==!0&&(f+="="+i[u]));return document.cookie=n+"="+r+f}n||(c={});for(var p=document.cookie?document.cookie.split("; "):[],d=/(%[0-9A-Z]{2})+/g,l=0;l<p.length;l++){var g=p[l].split("="),m=g.slice(1).join("=");'"'===m.charAt(0)&&(m=m.slice(1,-1));try{var C=g[0].replace(d,decodeURIComponent);if(m=t.read?t.read(m,C):t(m,C)||m.replace(d,decodeURIComponent),this.json)try{m=JSON.parse(m)}catch(s){}if(n===C){c=m;break}n||(c[C]=m)}catch(s){}}return c}}return o.set=o,o.get=function(e){return o.call(o,e)},o.getJSON=function(){return o.apply({json:!0},[].slice.call(arguments))},o.defaults={},o.remove=function(n,t){o(n,"",e(t,{expires:-1}))},o.withConverter=n,o}return n(function(){})});
        var cat = Cookies.get('bx1_mon_actu_cat');
        var tag = Cookies.get('bx1_mon_actu_tag');
        var form = Cookies.get('bx1_mon_actu_for')
        if($(location).attr('pathname') == '/mon-actu/' && $(location).attr('href').indexOf('?') == -1 && (cat != undefined || tag != undefined || form != undefined)){
            var parameters = $(location).attr('href');
            if(cat != 'null'){
              cat = cat.replace('[','').replace(']','').split(',');
              for(i= 0;i<cat.length;i++){
                var towrite = cat[i].replace('"','').replace('"','');
                if(parameters.indexOf('?') >= 0){
                  parameters = parameters+'&category[]='+towrite;
                }
                else{
                  parameters = parameters+'?category[]='+towrite;
                }
              }
            }
            if(tag != 'null'){
              tag = tag.replace('[','').replace(']','').split(',');
              for(i= 0;i<tag.length;i++){
                var towrite = tag[i].replace('"','').replace('"','');
                if(parameters.indexOf('?') >= 0){
                  parameters = parameters+'&post_tag[]='+towrite;
                }
                else{
                  parameters = parameters+'?post_tag[]='+towrite;
                }
              }
            }
            if(form != 'null'){
              form = form.replace('[','').replace(']','').split(',');
              for(i= 0;i<form.length;i++){
                var towrite = form[i].replace('"','').replace('"','');
                if(parameters.indexOf('?') >= 0){
                  parameters = parameters+'&format-du-contenu[]='+towrite;
                }
                else{
                  parameters = parameters+'?format-du-contenu[]='+towrite;                  
                }
              }
            }
            $(location).attr('href',parameters)
        }
      </script>
    <?php endif; ?>
    <?php if(is_page('mon-actu')): ?>
      <script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
    <?php endif; ?>
    <script src="<?php echo get_template_directory_uri();?>/js/vendor/modernizr-2.8.3.min.js" ></script>
    <script src="https://cdn.jwplayer.com/libraries/Neb1cMqn.js" ></script>
    <script>jwplayer.key="n7VQpXP/SZ7cR00K5ffQht+bYPBv2r+tBwUnmo+h+A5KhLSq";</script>
  </head>
  <body <?php body_class(); ?>>
    <!--[if lt IE 8]>
        <p class="browserupgrade">Vous utilisez une version <strong>obsolète</strong> d'Internet Explorer. Merci de le <a href="http://browsehappy.com/">mettre à jour</a> pour améliorer votre expérience et votre sécurité sur le web.</p>
    <![endif]-->
    <header class="siteHeader">
      <div class="inside">
                <?php 
            //$radio=false;
            $pagename = get_query_var('postid');
            if ( !$pagename && $id > 0 ) {  
                  // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object  
                  $post = $wp_query->get_queried_object();  
                  $pagename = $post->post_name;  
              }
            $pagetype = types_render_field('bx1-content-type');
            if ( $pagetype == "Radio (BX1+)" || $_GET["testradio"] == 1)
              {
                $radio  = true;
              }
            //echo "\" NOM DE LA PAGE : ". $pagename . "\""; ?>
        <?php if( $radio == true )
              {?>
                <a href="<?php echo esc_url( home_url( '/radio/' ) ); ?>" title="Retour à l'accueil" rel="home" class="logo"><img style="margin-top:7px!important;" id="logoimg" src="<?php echo get_template_directory_uri();?>/img/logoradio.png" alt="BX1 - Médias de Bruxelles" /></a>
              <?php }
              else {
                ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Retour à l'accueil" rel="home" class="logo"><img id="logoimg" src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="BX1 - Médias de Bruxelles" /></a>
      <?php } ?>
        <a href="#page" class="visuallyhidden">Passer la navigation</a>
        <a href="#" class="openMenu" aria-expanded="false"><span></span><span></span><span></span>Menu</a>
        <nav class="menuPrincipal">
          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
        <a href="#" class="openSearch" aria-expanded="false">Recherche</a>
        <form role="search" method="get" class="searchForm" action="<?php echo home_url( '/' ); ?>">
          <input type="submit" class="searchForm__submit" value="Recherche" />
          <div class="searchForm__form">
            <label for="searchField">Chercher</label>
            <input type="search" id="searchField" class="searchForm__field" value="<?php echo get_search_query() ?>" name="s" title="Rechercher les mots-clefs" />
          </div>
          <a href="#" class="searchForm__close">Fermer</a>
        </form>
        <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__iReporter" title="Formulaire Alertez-nous">Alertez-nous</a>
        <div class="meteo">
         <?php
         if (get_option('show_meteo') == "true" || $_GET["testmeteo"] == "true")
            {
                ?>

          <?php
	            $url = "https://".$_SERVER['HTTP_HOST']."/wp-content/themes/BX1-2017/cache/cache.meteo.json";
	            $headers = get_headers($url, 1);
	            if($headers[0] == 'HTTP/1.1 200 OK'){
		            $json = file_get_contents($url);
		            $data = json_decode($json,true);
		            $today = date("Y-m-d H:i:s");
		            $count = 0;
	            }
	            else {
		            $url = "https://api.openweathermap.org/data/2.5/forecast/daily?q=Brussels,be&units=metric&cnt=4&appid=ea18c0706135505149200c3836f29800";
		            $headers = get_headers($url, 1);
		            if($headers[0] == 'HTTP/1.1 200 OK'){
			            $json = file_get_contents($url);
			            $data = json_decode($json,true);
			            $today = date("Y-m-d H:i:s");
			            $count = 0;
		            }
	            }

	            $CAS    = array(
		            '200' => 'TJ12',
		            '201' => 'TJ12',
		            '210' => 'TJ12',
		            '230' => 'TJ12',
		            '231' => 'TJ12',
		            '232' => 'TJ12',
		            '202' => 'TJ16',
		            '211' => 'TJ16',
		            '212' => 'TJ16',
		            '221' => 'TJ16',
		            '300' => 'TJ7',
		            '301' => 'TJ7',
		            '302' => 'TJ7',
		            '310' => 'TJ7',
		            '311' => 'TJ7',
		            '312' => 'TJ10',
		            '313' => 'TJ10',
		            '314' => 'TJ10',
		            '321' => 'TJ10',
		            '500' => 'TJ10',
		            '501' => 'TJ10',
		            '502' => 'TJ10',
		            '503' => 'TJ10',
		            '504' => 'TJ10',
		            '520' => 'TJ11',
		            '521' => 'TJ11',
		            '522' => 'TJ11',
		            '531' => 'TJ11',
		            '511' => 'TJ21',
		            '600' => 'TJ14',
		            '601' => 'TJ14',
		            '611' => 'TJ15',
		            '612' => 'TJ15',
		            '613' => 'TJ15',
		            '615' => 'TJ15',
		            '616' => 'TJ15',
		            '602' => 'TJ22',
		            '620' => 'TJ22',
		            '621' => 'TJ22',
		            '622' => 'TJ22',
		            '701' => 'TJ26',
		            '711' => 'TJ26',
		            '721' => 'TJ26',
		            '731' => 'TJ26',
		            '741' => 'TJ26',
		            '751' => 'TJ26',
		            '761' => 'TJ26',
		            '762' => 'TJ26',
		            '771' => 'TJ26',
		            '781' => 'TJ26',
		            '800' => 'TJ1',
		            '801' => 'TJ2',
		            '802' => 'TJ3',
		            '803' => 'TJ4',
		            '804' => 'TJ4'
	            );
	            $textes = array(
		            'STJ1' => 'Ciel serein',
		            'STJ2' => 'Ciel peu nuageux',
		            'STJ3' => 'Ciel très nuageux',
		            'STJ4' => 'Couvert',
		            'STJ5' => 'Brouillard',
		            'STJ6' => 'Pluie',
		            'STJ7' => 'Bruine',
		            'STJ8' => 'Neige',
		            'STJ9' => 'Pluie et neige',
		            'STJ10' => 'Pluie et bruine',
		            'STJ11' => 'Averses de pluie',
		            'STJ12' => 'Averses orageuses',
		            'STJ13' => 'Averses de neige orageuses',
		            'STJ14' => 'Averses de neige',
		            'STJ15' => 'Averses de pluie et neige',
		            'STJ16' => 'Orage',
		            'STJ17' => 'Orageux',
		            'STJ18' => 'Verglas',
		            'STJ21' => 'Plaques de glace causées par de la pluie verglaçante',
		            'STJ22' => 'Chute de neige faible',
		            'STJ24' => 'Brumeux',
		            'STJ26' => 'Bancs de brouillard locaux',
		            'STJ27' => 'Brouillard givrant'
	            );
	            ?>
	            <ul>
		            <li class="meteo__block"><a href="#" class="siteHeader__radio" id="radiobtn"><img style="height:80px!important" src="/wp-content/themes/BX1-2017/img/directradio_bis.png" height="80px"></a></li>
		            <?php
		            foreach($data["list"] as $donnee){
			            /*echo "Donnée : <pre>" . $count.PHP_EOL;
						print_r($donnee);*/

			            // On commence par la 1re prévision, correspondant au temps actuel
			            if($count == 0){
				            $icon           = strval($donnee["weather"][0]["id"]);
				            $icon           = $CAS[$icon];
				            $description    = strval($donnee["weather"][0]["description"]);
				            //echo "Icone : " . $CAS[$icon];
				            ?>
				            <li class="meteo__block meteo__block--now">
					            <span class="meteo__block__date">En ce moment</span>
					            <span class="meteo__block__icon meteo__block__icon--<?php echo $icon; ?>" title="<?php echo $description; ?>"><?php echo $description; ?></span>
					            <span class="meteo__block__temp"><?php echo round($donnee["temp"]["max"],0); ?>&nbsp;<span>°C</span></span>
				            </li>
				            <?php
			            }
			            else{
				            // On affiche ensuite les autres jours (en exluant le 1er, déjà affiché, les autres prévisions de la journée et l'avant-midi du lendemain, pour n'avoir que les après-midi des jours suivants)
				            //if($donnee->city == 'Bruxelles' && $prev['date'] != $today && ($prev['period'] == 'PM' || $prev['period'] == 'DAY')){
				            if( $count <= 4){ ?>
					            <li class="meteo__block">
						            <!-- <span class="meteo__block__date"><?php echo substr($prev->titleday,0,3); ?></span> -->
						            <span class="meteo__block__icon meteo__block__icon--<?php $icon = $CAS[$donnee["weather"][0]["id"]];echo $icon; ?>" title="<?php echo $donnee["weather"][0]["description"]; ?>"><?php echo $donnee["weather"][0]["description"]; ?></span>
						            <span class="meteo__block__temp"><?php echo round($donnee["temp"]["max"],0); ?>&nbsp;<span>°C</span></span>
					            </li>
				            <?php }
			            }
			            $count++;
		            }
		            ?>
	            </ul>


          <?php }
                else{?>
          <ul>
              <li class="meteo__block"><a href="#" class="siteHeader__radio" id="radiobtn"><img style="height:80px!important" src="/wp-content/themes/BX1-2017/img/directradio_bis.png" height="80px"></a></li>
          </ul>
          <?php      }
         ?>
        </div>
      </div>

    </header>

    <header class="siteHeader siteHeader--fixed">
      <div class="inside">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Retour à l'accueil" rel="home" class="logo logo--mini"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="BX1 - Médias de Bruxelles" /></a>
        <div class="secondMenu">
          <nav>
            <?php wp_nav_menu( array( 'theme_location' => 'second' ) ); ?>
          </nav>
        </div>
        <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__iReporter siteHeader__iReporter--mini" title="Formulaire Alertez-nous">Alertez-nous</a>
      </div>
    </header>

    <div class="secondMenu">
      <div class="inside">

        <nav>
          <?php wp_nav_menu( array( 'theme_location' => 'second' ) ); ?>
        </nav>

        <ul class="social social--top">
          <li class="social__icon social__icon--twitter"><a href="https://twitter.com/bx1officiel?lang=fr" target="_blank" title="Profil Twitter de @BX1Officiel">Twitter</a></li>
          <li class="social__icon social__icon--facebook"><a href="https://www.facebook.com/BX1officiel/" target="_blank" title="Page Facebook de @BX1officiel">Facebook</a></li>
          <li class="social__icon social__icon--youtube"><a href="https://www.youtube.com/user/TeleBruxelles" target="_blank" title="Chaîne Youtube de BX1">Youtube</a></li>
          <li class="social__icon social__icon--instagram"><a href="https://www.instagram.com/bx1_officiel/" target="_blank" title="Profil Instagram de bx1_officiel">Instagram</a></li>
        </ul>

      </div>
    </div>


    <div class="tvFiles">
      <div class="inside">
      <?php
      $emission_actuelle = get_transient('emission_actuelle');

      if (false === $emission_actuelle) {
          $actuel = time() + 7200;

          $args = array(
              'post_type' => 'emission',
              'post_status' => 'publish',
              'posts_per_page' => 1,
              'fields' => 'ids',
              'meta_query' => array(
                  'relation' => 'AND',
                  array(
                      'key' => 'wpcf-horaire-debut',
                      'value' => $actuel,
                      'compare' => '<='
                      // 'type' retiré
                  ),
                  array(
                      'key' => 'wpcf-horaire-fin',
                      'value' => $actuel,
                      'compare' => '>'
                      // 'type' retiré
                  )
              )
          );

          $query = new WP_Query($args);
          if ($query->have_posts()) {
              $emission_actuelle = $query->posts[0];
              set_transient('emission_actuelle', $emission_actuelle, 30);
          }
      }

      var_dump($emission_actuelle);

      if ($emission_actuelle) {
          $post = get_post($emission_actuelle);
          setup_postdata($post);
          ?>
          <div class="tvFiles__atTv">
            <p><span>Sur BX1 TV Maintenant&nbsp;:</span>
              <?php if(function_exists('types_render_field') && types_render_field('n-afficher-que-sur-la-grille') == '1'): ?>
                "<?php the_title(); ?>"
              <?php else : ?>
                "<a href='../../lives/direct-tv/' title='Voir le direct TV'><?php the_title(); ?></a>"
              <?php endif; ?>
            </p>
          </div>
          <?php
          wp_reset_postdata();
      }
      ?>

        <?php
          if( $radio != true )
                {?>
        <nav class="tvFiles__files">
              <?php
              $args = array(
                'post_type' => 'dossier',
                'post_status' => 'publish',
                'order' => 'DESC',
                'orderby' => 'date',
                'posts_per_page' => 5,
              );
              $eq_query = new WP_Query( $args );
              if ($eq_query->have_posts()) : // The Loop
              ?>
            <ul>
              <?php
              while ($eq_query->have_posts()): $eq_query->the_post();
              ?>
              <li>
                 <a href="<?php the_permalink(); ?>" title="Voir le dossier <?php the_title(); ?>"><?php the_title(); ?></a>
              </li>
              <?php endwhile; wp_reset_query(); ?>
             </ul>
            <?php endif; ?>

              <?php
              $argsNews = array(
                  'post_type'      => array('post', 'ireport', 'votre-bruxelles'),
                  'posts_per_page' => 1,
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  'tax_query'      => array(
                      array(
                          'taxonomy' => 'flash_news',
                          'field'    => 'slug',
                          'terms'    => array('oui'),
                      ),
                  ),
              );
              $queryNews = new WP_Query($argsNews);

              if($queryNews->have_posts()) : ?>
                <?php while ( $queryNews->have_posts() ) : $queryNews->the_post(); ?>
                  <?php if(get_the_modified_date('d/m/Y') == date('d/m/Y')): ?>
                  <div class="flashNews">FLASH INFO&nbsp;: <a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
                    <?php the_title(); ?>
                  </a>
                  </div>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php wp_reset_query(); endif; ?>
        </nav>
        <?php } ?>
      </div>
    </div>

    <div class="pubTop">
      <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): ?>
          <div class="pubTop__ad">
            <span>Publicités désactivées pour cet utilisateur</span>
          </div>
        <?php else: ?>
          <div class="pubTop__ad">
            <!-- ads - zone images publicitaires bannering_header -->
            <div id="gestcom_52"></div>
          </div>
        <?php endif; ?>
        <?php //echo do_shortcode( '[wpv-view name="banner-leaderboard"]'); ?>
    </div>
<!--     <div class="banner-elections2024" style="text-align: center; width: 90%; margin: 10px auto 0;">
    	<a href="https://bx1.be/elections2024/"><img style="width: 100%; max-width: 640px;" src="https://bx1.be/wp-content/uploads/2024/10/Elections-communes-v2-2.gif"></a>
    </div> -->

    <div id="page">
      <div class="inside">

