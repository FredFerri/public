<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <?php if(is_search()): ?>
      <title>Recherche : <?php echo get_search_query(); ?> | <?php echo bloginfo('name'); ?></title>
    <?php else: ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">

    <?php wp_head(); ?>

      <script src="https://cdn.jwplayer.com/libraries/Neb1cMqn.js" ></script>
      <script>jwplayer.key="n7VQpXP/SZ7cR00K5ffQht+bYPBv2r+tBwUnmo+h+A5KhLSq";</script>
    
  </head>

  <body <?php body_class(); ?>>

    <div id="loading"></div>

    <div id="wrapper">

    <header class="siteHeader">

      <div class="inside">

        <div class="menuPrincipal">
          <div id="openMenu"></div>
          <nav>
            <form role="search" method="get" class="searchForm" action="<?php echo home_url( '/' ); ?>">
              <div class="searchForm__form">
                <input type="search" id="searchField" class="searchForm__field" value="<?php echo get_search_query() ?>" name="s" placeholder="Chercher" />
              </div>
            </form>
            <?php wp_nav_menu( array( 'menu' => 'App' ) ); ?>
          </nav>
        </div>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Retour à l'accueil" rel="home" class="logo"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.png" alt="BX1 - Médias de Bruxelles" width="45" height="38" /></a>

        <a href="<?php echo home_url('/'); ?>alertez-nous" class="siteHeader__iReporter" title="Formulaire Alertez-nous">Alertez-nous</a>
      </div>
    </header>

    <div class="secondMenu">
      <div class="inside">
        <nav>
          <?php wp_nav_menu( array( 'menu' => 'Second menu' ) ); ?>
        </nav>
      </div>
    </div>
    <div id="page">
      <div class="inside">
	      <div class="pubmobilebx1" data-publocationid="1" data-loaded="0" id="pub0" style="max-width: 640px;"></div>







