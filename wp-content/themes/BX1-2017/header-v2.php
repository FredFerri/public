<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_search()): ?>
    <title>Recherche : <?php echo get_search_query(); ?> | <?php echo bloginfo('name'); ?></title>
  <?php else: ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
  <?php endif; ?>
  <?php

  if (isset($post)) {
    $tags = wp_get_post_tags($post->ID);
    echo PHP_EOL;
    foreach ($tags as $tag) {
      echo  "\t<meta property='article:tag' content='" . strtoupper($tag->name) . "' />" . PHP_EOL;
      echo  "\t<meta property='article:tag' content='" . $tag->name . "' />" . PHP_EOL;
      echo  "\t<meta property='article:tag' content='" . strtolower($tag->name) . "' />" . PHP_EOL;
    }

    $cats = wp_get_post_categories($post->ID);
    foreach ($cats as $cat) {
      $catdetails =   get_the_category_by_ID($cat);
      echo  "\t<meta property='article:tag' content='" . strtoupper($catdetails) . "' />" . PHP_EOL;
      echo  "\t<meta property='article:tag' content='" . $catdetails . "' />" . PHP_EOL;
      echo  "\t<meta property='article:tag' content='" . strtolower($catdetails) . "' />" . PHP_EOL;
    }
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
  <script src="https://code.jquery.com/jquery-latest.min.js"></script>
  <meta name="msapplication-config" content="<?php bloginfo('url'); ?>/browserconfig.xml">
  <meta name="theme-color" content="#ffffff" />
  <?php if (is_page('mon-actu') || is_search()): ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <?php endif; ?>
  <?php wp_head(); ?>
  <?php if (is_page('mon-actu')): // redirection vers bonne URL sur Mon BX1 si cookies définis 
  ?>
    <script type="text/javascript">
      var $ = jQuery.noConflict();
      /*!
       * JavaScript Cookie v2.1.4
       * https://github.com/js-cookie/js-cookie
       *
       * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
       * Released under the MIT license
       */
      ! function(e) {
        var n = !1;
        if ("function" == typeof define && define.amd && (define(e), n = !0), "object" == typeof exports && (module.exports = e(), n = !0), !n) {
          var t = window.Cookies,
            o = window.Cookies = e();
          o.noConflict = function() {
            return window.Cookies = t, o
          }
        }
      }(function() {
        function e() {
          for (var e = 0, n = {}; e < arguments.length; e++) {
            var t = arguments[e];
            for (var o in t) n[o] = t[o]
          }
          return n
        }

        function n(t) {
          function o(n, r, i) {
            var c;
            if ("undefined" != typeof document) {
              if (arguments.length > 1) {
                if (i = e({
                    path: "/"
                  }, o.defaults, i), "number" == typeof i.expires) {
                  var a = new Date;
                  a.setMilliseconds(a.getMilliseconds() + 864e5 * i.expires), i.expires = a
                }
                i.expires = i.expires ? i.expires.toUTCString() : "";
                try {
                  c = JSON.stringify(r), /^[\{\[]/.test(c) && (r = c)
                } catch (s) {}
                r = t.write ? t.write(r, n) : encodeURIComponent(String(r)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), n = encodeURIComponent(String(n)), n = n.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent), n = n.replace(/[\(\)]/g, escape);
                var f = "";
                for (var u in i) i[u] && (f += "; " + u, i[u] !== !0 && (f += "=" + i[u]));
                return document.cookie = n + "=" + r + f
              }
              n || (c = {});
              for (var p = document.cookie ? document.cookie.split("; ") : [], d = /(%[0-9A-Z]{2})+/g, l = 0; l < p.length; l++) {
                var g = p[l].split("="),
                  m = g.slice(1).join("=");
                '"' === m.charAt(0) && (m = m.slice(1, -1));
                try {
                  var C = g[0].replace(d, decodeURIComponent);
                  if (m = t.read ? t.read(m, C) : t(m, C) || m.replace(d, decodeURIComponent), this.json) try {
                    m = JSON.parse(m)
                  } catch (s) {}
                  if (n === C) {
                    c = m;
                    break
                  }
                  n || (c[C] = m)
                } catch (s) {}
              }
              return c
            }
          }
          return o.set = o, o.get = function(e) {
            return o.call(o, e)
          }, o.getJSON = function() {
            return o.apply({
              json: !0
            }, [].slice.call(arguments))
          }, o.defaults = {}, o.remove = function(n, t) {
            o(n, "", e(t, {
              expires: -1
            }))
          }, o.withConverter = n, o
        }
        return n(function() {})
      });
      var cat = Cookies.get('bx1_mon_actu_cat');
      var tag = Cookies.get('bx1_mon_actu_tag');
      var form = Cookies.get('bx1_mon_actu_for')
      if ($(location).attr('pathname') == '/mon-actu/' && $(location).attr('href').indexOf('?') == -1 && (cat != undefined || tag != undefined || form != undefined)) {
        var parameters = $(location).attr('href');
        if (cat != 'null') {
          cat = cat.replace('[', '').replace(']', '').split(',');
          for (i = 0; i < cat.length; i++) {
            var towrite = cat[i].replace('"', '').replace('"', '');
            if (parameters.indexOf('?') >= 0) {
              parameters = parameters + '&category[]=' + towrite;
            } else {
              parameters = parameters + '?category[]=' + towrite;
            }
          }
        }
        if (tag != 'null') {
          tag = tag.replace('[', '').replace(']', '').split(',');
          for (i = 0; i < tag.length; i++) {
            var towrite = tag[i].replace('"', '').replace('"', '');
            if (parameters.indexOf('?') >= 0) {
              parameters = parameters + '&post_tag[]=' + towrite;
            } else {
              parameters = parameters + '?post_tag[]=' + towrite;
            }
          }
        }
        if (form != 'null') {
          form = form.replace('[', '').replace(']', '').split(',');
          for (i = 0; i < form.length; i++) {
            var towrite = form[i].replace('"', '').replace('"', '');
            if (parameters.indexOf('?') >= 0) {
              parameters = parameters + '&format-du-contenu[]=' + towrite;
            } else {
              parameters = parameters + '?format-du-contenu[]=' + towrite;
            }
          }
        }
        $(location).attr('href', parameters)
      }
    </script>
  <?php endif; ?>
  <?php if (is_page('mon-actu')): ?>
    <script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
  <?php endif; ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.8.3.min.js"></script>
  <script src="https://cdn.jwplayer.com/libraries/Neb1cMqn.js"></script>
  <script>
    jwplayer.key = "n7VQpXP/SZ7cR00K5ffQht+bYPBv2r+tBwUnmo+h+A5KhLSq";
  </script>
</head>

<body <?php body_class(); ?>>
  <!--[if lt IE 8]>
        <p class="browserupgrade">Vous utilisez une version <strong>obsolète</strong> d'Internet Explorer. Merci de le <a href="http://browsehappy.com/">mettre à jour</a> pour améliorer votre expérience et votre sécurité sur le web.</p>
    <![endif]-->
  <header class="siteHeader realHeader">
    <div class="inside">
      <div class="header-left">
        <a href="#" class="openMenu" aria-expanded="false"><span style="background-color: #D51C70;"></span><span></span><span></span>Menu</a>
        <nav class="menuPrincipal">
          <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav>
        <a href="#" class="openSearch" aria-expanded="false">Recherche</a>
        <?php
        //$radio=false;
        $pagename = get_query_var('postid');
        if (!$pagename && $id > 0) {
          // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object  
          $post = $wp_query->get_queried_object();
          $pagename = $post->post_name;
        }
        $pagetype = types_render_field('bx1-content-type');

        $radio = false;
        if ($pagetype == "Radio (BX1+)" || (array_key_exists('testradio', $_GET) && $_GET["testradio"] == 1)) {
          $radio  = true;
        }
        //echo "\" NOM DE LA PAGE : ". $pagename . "\""; 
        ?>
        <?php if ($radio == true) { ?>
          <a href="<?php echo esc_url(home_url('/radio/')); ?>" title="Retour à l'accueil" rel="home" class="logo"><img style="margin-top:7px!important;" id="logoimg" src="/wp-content/themes/BX1-2017/images/Logo-BX1-2025_Baseline-NEW-min.png" alt="BX1 - Médias de Bruxelles" width="115" height="107" /></a>
        <?php } else {
        ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à l'accueil" rel="home" class="logo"><img id="logoimg" src="/wp-content/themes/BX1-2017/images/Logo-BX1-2025_Baseline-NEW-min.png" width="115" height="107" alt="BX1 - Médias de Bruxelles" loading="eager" /></a>
        <?php } ?>
        <a href="#page" class="visuallyhidden">Passer la navigation</a>
        <form role="search" method="get" class="searchForm" action="<?php echo home_url('/'); ?>">
          <input type="submit" class="searchForm__submit" value="Recherche" />
          <div class="searchForm__form">
            <label for="searchField">Chercher</label>
            <input type="search" id="searchField" class="searchForm__field" value="<?php echo get_search_query() ?>" name="s" title="Rechercher les mots-clefs" />
          </div>
          <a href="#" class="searchForm__close">Fermer</a>
        </form>
      </div>
      <div class="header-center">
        <div class="header-btn-directtv">
          <a href="https://bx1.be/lives/direct-tv/?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>" title="Accéder au direct radio">
            <img src="/wp-content/themes/BX1-2017/images/direct-tv.png" width="110" height="94" alt="" loading="eager" />
          </a>
        </div>
        <div class="header-btn-directradio">
          <a href="https://player.bx1.be/player.php" title="Accéder au direct radio">
            <img src="/wp-content/themes/BX1-2017/images/direct-radio.png" width="106" height="93" alt="" loading="eager" />
          </a>
        </div>
      </div>
      <div class="header-right">
        <div class="header-btn-whatsapp">
          <a href="https://bx1.be/whatsapp/?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>" title="Contactez-nous via WhatsApp">
            <img src="/wp-content/themes/BX1-2017/images/whatsapp.png" width="110" height="102" alt="" loading="eager" />
          </a>
        </div>
        <div class="header-btn-alert">
          <a href="https://bx1.be/alertez-nous?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>" title="Alertez-nous">
            <img src="/wp-content/themes/BX1-2017/images/alertez-nous.png" width="114" height="98" alt="" loading="eager" />
          </a>
        </div>
        <div class="header-btn-monbx1">
          <a href="" title="Mon BX1"><img src="/wp-content/themes/BX1-2017/images/mon-bx1.png" width="96" height="93" alt="" /></a>
        </div>
        <!--           <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__whatsapp" title="whatsapp"></a>
          <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__iReporter" title="Formulaire Alertez-nous"></a> -->
      </div>
    </div>

  </header>

  <header class="siteHeader siteHeader--fixed">
    <div class="inside">
      <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à l'accueil" rel="home" class="logo logo--mini"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="BX1 - Médias de Bruxelles" /></a>
      <div class="secondMenu">
        <nav>
          <?php wp_nav_menu(array('theme_location' => 'second')); ?>
        </nav>
      </div>
      <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__iReporter siteHeader__iReporter--mini" title="Formulaire Alertez-nous">Alertez-nous</a>
    </div>
  </header>

  <div class="nav-menu-v2_container">
    <?php
    wp_nav_menu(array(
      'menu'            => 'Home-V2_menu', // Nom du menu défini dans l'admin WordPress
      'theme_location'  => '', // Laisser vide si le menu n'est pas enregistré dans functions.php
      'container'       => 'nav', // Optionnel, pour envelopper le menu dans une balise <nav>
      'container_class' => 'nav-menu-v2', // Classe CSS pour personnalisation
      // 'menu_class'      => 'menu-home-v2', // Classe appliquée aux <ul>
      'fallback_cb'     => false // Désactiver le fallback sur les menus par défaut
    ));
    ?>
  </div>

  <div class="header-bottom">
    <div class="pubTop">
      <?php if (is_user_logged_in() && (array_key_exists('nopub', $_COOKIE) && $_COOKIE['nopub'] == 'on')): ?>
        <div class="pubTop__ad">
          <span>Publicités désactivées pour cet utilisateur</span>
        </div>
      <?php else: ?>
        <div class="pubTop__ad">
          <!-- ads - zone images publicitaires bannering_header -->
          <div id="gestcom_52"></div>
        </div>
      <?php endif; ?>
      <?php //echo do_shortcode( '[wpv-view name="banner-leaderboard"]'); 
      ?>
    </div>
    <!--     <div class="banner-elections2024" style="text-align: center; width: 90%; margin: 10px auto 0;">
        <a href="https://bx1.be/elections2024/"><img style="width: 100%; max-width: 640px;" src="https://bx1.be/wp-content/uploads/2024/10/Elections-communes-v2-2.gif"></a>
      </div> -->
    <div class="nav-menu-dossiers">
      <div class="nav-menu-dossiers_title"><span>Nos dossiers</span></div>
      <?php
      wp_nav_menu(array(
        'menu'            => 'Home-V2_menu_dossiers', // Nom du menu défini dans l'admin WordPress
        'theme_location'  => '', // Laisser vide si le menu n'est pas enregistré dans functions.php
        'container'       => 'nav', // Optionnel, pour envelopper le menu dans une balise <nav>
        'container_class' => 'nav-menu-dossiers', // Classe CSS pour personnalisation
        // 'menu_class'      => 'menu-home-v2', // Classe appliquée aux <ul>
        'fallback_cb'     => false // Désactiver le fallback sur les menus par défaut
      ));
      ?>
    </div>
  </div>

  <div class="sidebar-socials_responsive">
    <ul>
      <li><a href="https://www.instagram.com/bx1_officiel/"><img
            src="/wp-content/themes/BX1-2017/images/logo-instagram-1.png" alt="Logo Instagram" /></a></li>
      <li><a href="https://www.facebook.com/BX1officiel/"><img
            src="/wp-content/themes/BX1-2017/images/logo-facebook-1.png" alt="Logo Facebook" /></a></li>
      <li><a href="https://www.youtube.com/user/TeleBruxelles"><img
            src="/wp-content/themes/BX1-2017/images/logo-youtube-1.png" alt="Logo YouTube" /></a></li>
      <li><a href="https://bsky.app/profile/bx1.be"><img
            src="/wp-content/themes/BX1-2017/images/logo-bluesky-1.png" alt="Logo BlueSky" /></a></li>
      <li><a href="#"><img src="/wp-content/themes/BX1-2017/images/enveloppe-1.png" alt="Logo e-mail" /></a></li>
    </ul>
  </div>

  <div id="page">
    <div class="inside">