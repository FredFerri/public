<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <?php if (is_search()): ?>
    <title>Recherche : <?php echo get_search_query(); ?> | <?php echo bloginfo('name'); ?></title>
  <?php else: ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
  <?php endif; ?>

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">

  <?php wp_head(); ?>

  <script src="https://cdn.jwplayer.com/libraries/Neb1cMqn.js"></script>
  <script>
    jwplayer.key = "n7VQpXP/SZ7cR00K5ffQht+bYPBv2r+tBwUnmo+h+A5KhLSq";
  </script>

</head>

<body <?php body_class(); ?>>

  <div id="loading"></div>

  <div id="wrapper">

    <header class="siteHeader">

      <div class="inside">

        <div class="menuPrincipal">
          <div id="openMenu"></div>
          <nav>
            <form role="search" method="get" class="searchForm" action="<?php echo home_url('/'); ?>">
              <div class="searchForm__form">
                <input type="search" id="searchField" class="searchForm__field" value="<?php echo get_search_query() ?>" name="s" placeholder="Chercher" />
              </div>
            </form>
            <?php wp_nav_menu(array('menu' => 'App')); ?>
          </nav>
        </div>

        <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à l'accueil" rel="home" class="logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="45" height="38" fill="none" viewBox="0 0 403 341">
            <path fill="url(#a)" d="M353.3 340.7V290L298 239.9l55.2-50.7v-53l-83.5 78.1-50.6-45.5C158.3 112.9 100 148.6 100 148.6l28.2 33.9c11.2-.9 34.2-17.3 65.1 13 12.3 12.1 30.8 27.4 48.8 44.3l-48.8 45.6c-30.9 30.4-58.1 13.6-69.2 12.7l-24 34.3s66.2 28.4 119.2-20.2l50.8-47.1 83.2 75.6z" />
            <path fill="url(#b)" d="m363.3 340.7 38.6-.1.6-196.2-38.9-17.9-.3 214.2z" />
            <path fill="#ec207d" d="M334.9 153.6v52.5l67.6-61.5-39-18.1-28.6 27.1zm-233.2-16.2c-23.4 0-45.1 8.2-62.5 21.7V.4L.1 28v211c0 56 45.7 101.7 101.7 101.7S203.5 295 203.5 239c-.1-56-45.8-101.6-101.8-101.6zm0 164.1c-34.2 0-62.5-28.3-62.5-62.5s28.3-62.5 62.5-62.5 62 28.3 62 62.5c0 34.3-27.7 62.5-62 62.5z" />
            <path fill="url(#c)" d="M39.3 159v75s0-31.6 34.3-50.7c-1-29.4-2.8-41-2.8-41s-17.7 5.5-31.5 16.7z" />
            <defs>
              <linearGradient id="a" x1="99.963" x2="402.512" y1="233.621" y2="233.621" gradientUnits="userSpaceOnUse">
                <stop offset=".022" stop-color="#292c2f" />
                <stop offset=".968" stop-color="#767e84" />
              </linearGradient>
              <linearGradient id="b" x1="267.901" x2="265.888" y1="254.186" y2="171.335" gradientUnits="userSpaceOnUse">
                <stop stop-color="#ea217c" />
                <stop offset="1" stop-color="#b5125e" />
              </linearGradient>
              <linearGradient id="c" x1="69.786" x2="41.173" y1="187.878" y2="188.392" gradientUnits="userSpaceOnUse">
                <stop stop-color="#ea217c" />
                <stop offset="1" stop-color="#b5125e" />
              </linearGradient>
            </defs>
          </svg>


          <a href="<?php echo home_url('/'); ?>alertez-nous?theme=<?= isset($_GET['theme']) ? esc_attr($_GET['theme']) : 'classic' ?>" class="siteHeader__iReporter" title="Formulaire Alertez-nous">Alertez-nous</a>
      </div>
    </header>

    <div class="secondMenu">
      <div class="inside">
        <nav>
          <?php wp_nav_menu(array('menu' => 'Second menu')); ?>
        </nav>
      </div>
    </div>
    <div id="page">
      <div class="inside">
        <div class="pubmobilebx1" data-publocationid="1" data-loaded="0" id="pub0" style="max-width: 640px;"></div>