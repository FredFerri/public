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

        <a href="<?= $radio ? esc_url(home_url('/radio/')) : esc_url(home_url('/')) ?>" title="Retour à l'accueil" rel="home" class="logo">

          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 410 379">
            <path fill="url(#a)" d="M357.3 341.7V291L302 240.9l55.2-50.7v-53l-83.5 78.1-50.6-45.5C162.3 113.9 104 149.6 104 149.6l28.2 33.9c11.2-.9 34.2-17.3 65.1 13 12.3 12.1 30.8 27.4 48.8 44.3l-48.8 45.6c-30.9 30.4-58.1 13.6-69.2 12.7l-24 34.3s66.2 28.4 119.2-20.2l50.8-47.1 83.2 75.6z" />
            <path fill="url(#b)" d="m367.3 341.7 38.6-.1.6-196.2-38.9-17.9-.3 214.2z" />
            <path fill="#ec207d" d="M338.9 154.6v52.5l67.6-61.5-39-18.1-28.6 27.1zm-233.2-16.2c-23.4 0-45.1 8.2-62.5 21.7V1.4L4.1 29v211c0 56 45.7 101.7 101.7 101.7S207.5 296 207.5 240c-.1-56-45.8-101.6-101.8-101.6zm0 164.1c-34.2 0-62.5-28.3-62.5-62.5s28.3-62.5 62.5-62.5 62 28.3 62 62.5c0 34.3-27.7 62.5-62 62.5z" />
            <path fill="url(#c)" d="M43.3 160v75s0-31.6 34.3-50.7c-1-29.4-2.8-41-2.8-41s-17.7 5.5-31.5 16.7z" />
            <g fill="#545c60">
              <path d="M1.4 377.4 5 352.1h.4l10.3 20.8 10.2-20.8h.4l3.7 25.3h-2.5L25 359.3l-9 18.1h-.6l-9.1-18.3-2.5 18.3H1.4zm53.1-6.6 2 1.1c-.6 1.3-1.4 2.4-2.3 3.2s-1.9 1.4-3 1.8-2.3.6-3.7.6c-3.1 0-5.4-1-7.2-3-1.7-2-2.6-4.3-2.6-6.8 0-2.4.7-4.5 2.2-6.4 1.8-2.4 4.3-3.6 7.4-3.6 3.2 0 5.7 1.2 7.6 3.6 1.4 1.7 2 3.8 2.1 6.4H40.3c0 2.2.7 4 2.1 5.4 1.3 1.4 3 2.1 5 2.1 1 0 1.9-.2 2.8-.5s1.7-.8 2.3-1.3 1.3-1.4 2-2.6zm0-5c-.3-1.3-.8-2.3-1.4-3.1s-1.4-1.4-2.4-1.9-2.1-.7-3.2-.7c-1.8 0-3.4.6-4.7 1.8-1 .9-1.7 2.2-2.2 3.9h13.9zm-5.8-16.3h3.7l-5.1 5.3H45l3.7-5.3zm31.4 27.1c-1.3.6-2.8.9-4.3.9-2.7 0-4.9-1-6.8-2.9s-2.8-4.2-2.8-6.9.9-5.1 2.8-7 4.1-2.9 6.8-2.9c1.5 0 2.9.3 4.1.9 1.3.6 2.4 1.5 3.4 2.8V351h2.4v17.8c-.2 1.7-.8 3.3-1.8 5-1.2 1.3-2.4 2.2-3.8 2.8zm1.2-3.6c1.4-1.5 2.2-3.3 2.2-5.5 0-1.4-.3-2.7-1-3.8-.6-1.1-1.5-2.1-2.7-2.7-1.2-.7-2.4-1-3.8-1-1.3 0-2.5.3-3.7 1-1.1.7-2.1 1.6-2.7 2.8-.7 1.2-1 2.5-1 3.8s.3 2.6 1 3.8a8.06 8.06 0 0 0 2.7 2.8c1.1.7 2.4 1 3.7 1 2.1 0 3.8-.7 5.3-2.2zm14.3-22c.5 0 1 .2 1.4.6s.6.9.6 1.4-.2 1-.6 1.4-.9.6-1.4.6-1-.2-1.4-.6-.6-.9-.6-1.4.2-1 .6-1.4.9-.6 1.4-.6zm-1.2 7.7h2.4v18.7h-2.4v-18.7zm20.5-.9c2.9 0 5.3 1 7.2 3.1 1.8 1.9 2.6 4.2 2.6 6.8v9.9h-2.5v-4.3c-1.3 2.5-3.8 3.9-7.3 4.2-2.9 0-5.2-1-7-2.9-1.8-2-2.7-4.2-2.7-6.8s.9-4.9 2.6-6.8c1.8-2.1 4.2-3.2 7.1-3.2zm0 2.4c-2 0-3.7.7-5.1 2.2s-2.2 3.3-2.2 5.4c0 1.4.4 2.7 1.1 3.9.7 1.3 2 2.3 3.7 3.2 4.4 1 7.5-1 9.4-6 .1-1.6-.1-3.1-.5-4.6-.3-.7-.8-1.3-1.3-1.9-1.4-1.5-3.1-2.2-5.1-2.2zm28.1.1-1.5 1.6c-1.3-1.3-2.6-1.9-3.8-1.9-.8 0-1.5.3-2 .8-.6.5-.8 1.1-.8 1.8a2.34 2.34 0 0 0 .7 1.7c.5.6 1.4 1.2 2.9 2 1.8.9 3 1.8 3.7 2.7a5.29 5.29 0 0 1 .9 3 5.28 5.28 0 0 1-1.6 3.9c-1.1 1.1-2.4 1.6-4 1.6-1.1 0-2.1-.2-3.1-.7s-1.8-1.1-2.4-1.9l1.5-1.7c1.2 1.4 2.5 2.1 3.9 2.1 1 0 1.8-.3 2.5-.9s1-1.3 1-2.2c0-.7-.2-1.3-.7-1.8-.4-.5-1.5-1.2-3-2-1.7-.9-2.8-1.7-3.5-2.6-.6-.8-.9-1.8-.9-2.9 0-1.4.5-2.6 1.5-3.5s2.2-1.4 3.7-1.4c1.5-.2 3.2.6 5 2.3zm35.7 16.3c-1.3.6-2.8.9-4.3.9-2.7 0-4.9-1-6.8-2.9s-2.8-4.2-2.8-6.9.9-5.1 2.8-7 4.1-2.9 6.8-2.9c1.5 0 2.9.3 4.1.9 1.3.6 2.4 1.5 3.4 2.8V351h2.4v17.8c-.2 1.7-.8 3.3-1.8 5-1.2 1.3-2.5 2.2-3.8 2.8zm1.2-3.6c1.4-1.5 2.2-3.3 2.2-5.5 0-1.4-.3-2.7-1-3.8-.6-1.1-1.5-2.1-2.7-2.7-1.2-.7-2.4-1-3.8-1-1.3 0-2.5.3-3.7 1-1.1.7-2.1 1.6-2.7 2.8-.7 1.2-1 2.5-1 3.8s.3 2.6 1 3.8a8.06 8.06 0 0 0 2.7 2.8c1.1.7 2.4 1 3.7 1 2.1 0 3.8-.7 5.3-2.2z" />
              <use href="#d" />
              <path d="M234 352h8c2 0 3.5.2 4.6.7s1.9 1.2 2.6 2.2c.6 1 .9 2.1.9 3.3 0 1.1-.3 2.2-.8 3.1-.6.9-1.4 1.7-2.4 2.2 1.3.5 2.4 1 3.1 1.6s1.3 1.3 1.7 2.2a6.71 6.71 0 0 1 .6 2.8c0 2-.7 3.8-2.2 5.2s-3.5 2.1-6 2.1h-10V352h-.1zm2.5 2.5v8.1h4.5c1.8 0 3-.2 3.9-.5.8-.3 1.5-.8 2-1.5s.7-1.5.7-2.3c0-1.2-.4-2.1-1.2-2.7-.8-.7-2.1-1-3.9-1h-6v-.1zm0 10.7v9.7h6.2c1.8 0 3.2-.2 4.1-.5.9-.4 1.6-.9 2.1-1.7s.8-1.6.8-2.5c0-1.1-.4-2.1-1.1-2.9s-1.7-1.4-3-1.7c-.9-.2-2.4-.3-4.5-.3h-4.6v-.1zm23.2 3.7v-2.3c.2-1.1.4-2 .8-2.8.8-2 1.9-3.4 3.2-4.3s2.5-1.4 3.3-1.4c.7 0 1.4.2 2.1.6l-1.2 2c-1.1-.4-2.1-.1-3.2.9-1 1-1.8 2.1-2.2 3.3-.3 1.1-.4 3-.4 6v6.3h-2.5v-8.3h.1zm15.4-10.6h2.4v8.8c0 2.1.1 3.6.3 4.4a4.26 4.26 0 0 0 2 2.7c1 .7 2.1 1 3.5 1 1.3 0 2.5-.3 3.4-1 .9-.6 1.6-1.5 1.9-2.6.3-.7.4-2.3.4-4.6v-8.8h2.5v9.2c0 2.6-.3 4.5-.9 5.8s-1.5 2.3-2.7 3.1c-1.2.7-2.7 1.1-4.5 1.1s-3.4-.4-4.6-1.1-2.1-1.8-2.7-3.1-.9-3.3-.9-6v-8.9h-.1zm23.8.4h2.9l5 7 5-7h2.9l-6.4 8.9 7.2 9.8h-2.9l-5.7-7.9-5.7 7.9h-2.9l7.1-9.8-6.5-8.9z" />
              <use x="128.8" href="#d" />
              <path d="M348.9 351.5h2.4v26h-2.4v-26zm11.2 0h2.4v26h-2.4v-26zm27.4 19.3 2 1.1c-.6 1.3-1.4 2.4-2.3 3.2s-1.9 1.4-3 1.8-2.3.6-3.7.6c-3.1 0-5.4-1-7.2-3-1.7-2-2.6-4.3-2.6-6.8 0-2.4.7-4.5 2.2-6.4 1.8-2.4 4.3-3.6 7.4-3.6 3.2 0 5.7 1.2 7.6 3.6 1.4 1.7 2 3.8 2.1 6.4h-16.8c0 2.2.7 4 2.1 5.4 1.3 1.4 3 2.1 5 2.1 1 0 1.9-.2 2.8-.5s1.7-.8 2.3-1.3c.7-.5 1.3-1.4 2.1-2.6zm0-5c-.3-1.3-.8-2.3-1.4-3.1s-1.4-1.4-2.4-1.9-2.1-.7-3.2-.7c-1.8 0-3.4.6-4.7 1.8-1 .9-1.7 2.2-2.2 3.9h13.9zm20.7-5.5-1.5 1.6c-1.3-1.3-2.6-1.9-3.8-1.9-.8 0-1.5.3-2 .8-.6.5-.8 1.1-.8 1.8a2.34 2.34 0 0 0 .7 1.7c.5.6 1.4 1.2 2.9 2 1.8.9 3 1.8 3.7 2.7a5.29 5.29 0 0 1 .9 3 5.28 5.28 0 0 1-1.6 3.9c-1.1 1.1-2.4 1.6-4 1.6-1.1 0-2.1-.2-3.1-.7s-1.8-1.1-2.4-1.9l1.5-1.7c1.2 1.4 2.5 2.1 3.9 2.1 1 0 1.8-.3 2.5-.9s1-1.3 1-2.2c0-.7-.2-1.3-.7-1.8-.4-.5-1.5-1.2-3-2-1.7-.9-2.8-1.7-3.5-2.6-.6-.8-.9-1.8-.9-2.9 0-1.4.5-2.6 1.5-3.5s2.2-1.4 3.7-1.4c1.5-.2 3.3.6 5 2.3z" />
            </g>
            <defs>
              <linearGradient id="a" x1="103.963" x2="406.512" y1="234.621" y2="234.621" gradientUnits="userSpaceOnUse">
                <stop offset=".022" stop-color="#292c2f" />
                <stop offset=".968" stop-color="#767e84" />
              </linearGradient>
              <linearGradient id="b" x1="271.901" x2="269.888" y1="255.186" y2="172.335" gradientUnits="userSpaceOnUse">
                <stop stop-color="#ea217c" />
                <stop offset="1" stop-color="#b5125e" />
              </linearGradient>
              <linearGradient id="c" x1="73.786" x2="45.173" y1="188.878" y2="189.392" gradientUnits="userSpaceOnUse">
                <stop stop-color="#ea217c" />
                <stop offset="1" stop-color="#b5125e" />
              </linearGradient>
              <path id="d" d="m209.1 370.8 2 1.1c-.6 1.3-1.4 2.4-2.3 3.2s-1.9 1.4-3 1.8-2.3.6-3.7.6c-3.1 0-5.4-1-7.2-3-1.7-2-2.6-4.3-2.6-6.8 0-2.4.7-4.5 2.2-6.4 1.8-2.4 4.3-3.6 7.4-3.6 3.2 0 5.7 1.2 7.6 3.6 1.4 1.7 2 3.8 2.1 6.4h-16.8c0 2.2.7 4 2.1 5.4 1.3 1.4 3 2.1 5 2.1 1 0 1.9-.2 2.8-.5s1.7-.8 2.3-1.3c.7-.5 1.4-1.4 2.1-2.6zm0-5c-.3-1.3-.8-2.3-1.4-3.1s-1.4-1.4-2.4-1.9-2.1-.7-3.2-.7c-1.8 0-3.4.6-4.7 1.8-1 .9-1.7 2.2-2.2 3.9h13.9z" />
            </defs>
          </svg>
        </a>

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
      <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à l'accueil" rel="home" class="logo logo--mini">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 403 341">
          <path fill="url(#mini-a)" d="M353.3 340.7V290L298 239.9l55.2-50.7v-53s-40.2 37.9-83.5 78.1l-50.6-45.5C158.3 112.9 100 148.6 100 148.6l28.2 33.9c11.2-.9 34.2-17.3 65.1 13 12.3 12.1 30.8 27.4 48.8 44.3-18 16.9-36.5 33.5-48.8 45.6-30.9 30.4-58.1 13.6-69.2 12.7l-24 34.3s66.2 28.4 119.2-20.2l50.8-47.1c43.1 40.2 83.2 75.6 83.2 75.6Z" />
          <path fill="url(#mini-b)" d="m363.3 340.7 38.6-.1s.6-193 .6-196.2l-38.9-17.9-.3 214.2Z" />
          <path fill="#fff" d="M334.9 153.6v52.5l67.6-61.5-39-18.1-28.6 27.1ZM101.7 137.4c-23.4 0-45.1 8.2-62.5 21.7V.4L.1 28v211c0 56 45.7 101.7 101.7 101.7S203.5 295 203.5 239c-.1-56-45.8-101.6-101.8-101.6Zm0 164.1c-34.2 0-62.5-28.3-62.5-62.5s28.3-62.5 62.5-62.5 62 28.3 62 62.5c0 34.3-27.7 62.5-62 62.5Z" />
          <path fill="url(#mini-c)" d="M39.3 159v75s0-31.6 34.3-50.7c-1-29.4-2.8-41-2.8-41s-17.7 5.5-31.5 16.7Z" />
          <defs>
            <linearGradient id="mini-a" x1="99.9687" x2="353.31" y1="238.47" y2="238.47" gradientUnits="userSpaceOnUse">
              <stop offset=".02151" stop-color="#DBDBDB" />
              <stop offset=".9677" stop-color="#fff" />
            </linearGradient>
            <linearGradient id="mini-b" x1="385.058" x2="370.042" y1="254.186" y2="174.101" gradientUnits="userSpaceOnUse">
              <stop stop-color="#fff" />
              <stop offset="1" stop-color="#DADADA" />
            </linearGradient>
            <linearGradient id="mini-c" x1="69.7855" x2="41.1732" y1="187.878" y2="188.392" gradientUnits="userSpaceOnUse">
              <stop stop-color="#fff" />
              <stop offset="1" stop-color="#DCDCDC" />
            </linearGradient>
          </defs>
        </svg>
      </a>
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