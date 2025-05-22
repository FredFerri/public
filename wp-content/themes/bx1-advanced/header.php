<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package TeleBruxelles
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="/favicon.ico"/>

<?php wp_head(); ?>
<script type="text/javascript" src="https://c.pebblemedia.be/js/c.js"></script>
<script type="text/javascript" src="https://pool-pebblemedia.adhese.com/tag/tag.js"></script>

<?php
  if ( is_single() ) { ?>
  <meta property="og:url"                content="<?php the_permalink(); ?>" />
  <meta property="og:type"               content="article" />
  <meta property="og:title"              content="<?php the_title(); ?>" />
  <meta property="og:description"        content="<?php the_content(); ?>" />
  <meta property="og:image"              content="<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>" />
  <?php
  }
?>
</head>

<body <?php body_class(); ?>>
<?php include_once("img/icons.svg"); ?>
<div class="off-canvas-wrap" data-offcanvas>
   <div class="inner-wrap">
      <!-- Off Canvas Menu -->
      <aside class="left-off-canvas-menu">
      <?php $defaults = array(
               'theme_location'  => 'primary',
               'container_class' => 'top-bar-section',
               'menu_class'      => 'menu',
               'depth'           => -1,
               'items_wrap'      => '<ul id="%1$s" class="%2$s"><form role="search" method="get" class="search-form" action="'. home_url( '/' ) .'"><input type="search" class="search-field-topbar" placeholder="Rechercher..." value="'. get_search_query() .'" name="s" /></form><li><a href="/">Accueil</a></li>%3$s</ul>'
            );
            wp_nav_menu( $defaults );
      ?>
      </aside>
      <a class="exit-off-canvas"></a>
      <div id="page" class="hfeed site">
         <header id="masthead" class="site-header" role="banner">
            <div class="pattern"></div>
            <div class="row collapse top-page-row">

              <?php
                // Check if the view "Featured News" is empty AND if we are on the homepage
                // That is, if there is a box checked in the posts "News"
                // If not, display another header
                $argsView = array('name' => 'featured-news');
                $featuredNewsView = trim( render_view( $argsView ) );

                $featuredNewsViewContent = get_view_query_results('279');
                if (!empty($featuredNewsViewContent) && is_front_page()) {
              ?>
               <div class="large-10 large-centered columns hero hero--expanded">
                  <div class="hero__ctawrapper">
                     <h1 class="visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
                     <a class="hero__item logo-telebxl-link logo-telebxl-link--expanded" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php include_once("img/bx1-logo.svg"); ?><span class="logo-baseline">Médias de Bruxelles</span></a><!--
                    --><div class="hero__item hero__actions hero__actions--expanded"><!--
                          --><a href="/live" class="hero-main-cta hero-btn live-feed-btn" id="live-feed"><svg class="hero-main-cta__icon"><use xlink:href="#icon-play" /></svg> <span class="hero-main-cta__label">En live</span></a><!--

                          --><a class="hero-main-cta hero-btn last-news-btn" href="/dernier-jt" id="last-news"><svg class="hero-main-cta__icon"><use xlink:href="#icon-tv" /></svg> <span class="hero-main-cta__label">Dernier JT</span></a><!--
                          --><a class="hero-main-cta hero-btn hero-btn-menu left-off-canvas-toggle" href="#"><svg class="hero-main-cta__icon hero-main-cta__icon--menu"><use xlink:href="#icon-menu" /></svg> <span class="hero-main-cta__label">Menu</span></a>
                        </div>

                     <div class="hero-social--expanded">
                        <a class="hero-btn hero-btn--expanded hero-btn-twitter" href="https://twitter.com/BX1_actu"><svg><use xlink:href="#icon-twitter" /></svg></a>
                        <a class="hero-btn hero-btn--expanded hero-btn-facebook" href="https://www.facebook.com/bx1officiel"><svg><use xlink:href="#icon-facebook" /></svg></a>
                        <a class="hero-btn hero-btn--expanded hero-btn-youtube" href="https://www.youtube.com/user/TeleBruxelles"><svg><use xlink:href="#icon-youtube" /></svg></a>
                     </div>
                     <div class="weather weather--expanded">
                      <div class="weather-day"></div>
                      <div class="weather-forecast"></div>
                     </div>
                  </div>
                  <div class="hero__videowrapper hide-for-small-only">
                     <?php echo $featuredNewsView; ?>
                     <?php $vidDernierJT = array('name' => 'dernier-jt-vid-name'); ?>
                     <script>
                     jQuery("#live-feed").on('click', function() {
                        jQuery('.featured-news-title').hide();
                        jwplayer("featured-video").setup({
                            image: "",
                            sources: [{
                                file: "rtmp://149.202.81.107:1935/live/live.sdp"},{
                                file: "http://149.202.81.107:1935/live/live.sdp/playlist.m3u8"
                            }],
                            primary: "html5",
                            width: "100%",
                            aspectratio: "16:9",
                            autostart: true,
                            androidhls: true,
                            advertising: {
                              client: 'vast',
                              schedule: {
                                adbreak1: {
                                  offset: "pre",
                                  tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                                },
                                adbreak2: {
                                  offset: "post",
                                  tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                                }
                              }
                            }

                        });
                     });
                     jQuery("#last-news").on('click', function() {
                        jQuery('.featured-news-title').hide();
                        jwplayer("featured-video").setup({
                            image: "",
                            sources: [{
                                file: "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo render_view( $vidDernierJT ); ?>" + ".mp4"},{
                                file: "http://149.202.81.107:1935/vod/mp4:" + "<?php echo render_view( $vidDernierJT ); ?>" + ".mp4" + "/playlist.m3u8"
                            }],
                            primary: "html5",
                            width: "100%",
                            aspectratio: "16:9",
                            autostart: true,
                            androidhls: true,
                            advertising: {
                              client: 'vast',
                              schedule: {
                                adbreak1: {
                                  offset: "pre",
                                  tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                                },
                                adbreak2: {
                                  offset: "post",
                                  tag: 'http://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                                }
                              }
                            }

                        });
                     });
                     </script>
                  </div>
               </div>

               <?php } else { ?>

               <div class="large-10 large-centered columns hero hero--condensed">
                  <h1 class="visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
                  <a class="hero__item hero__logo logo-telebxl-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php include_once("img/bx1-logo.svg"); ?> <span class="logo-baseline">Médias de Bruxelles</span></a><!--

                --><div class="hero__item hero__actions">
                      <a class="hero-main-cta hero-btn live-feed-btn" href="/live"  id="live-feed"><svg class="hero-main-cta__icon"><use xlink:href="#icon-play" /></svg> <span class="hero-main-cta__label">En live</span></a><!--
                      --><a class="hero-main-cta hero-btn last-news-btn" href="/dernier-jt" id="last-news"><svg class="hero-main-cta__icon"><use xlink:href="#icon-tv" /></svg> <span class="hero-main-cta__label">Dernier JT</span></a><!--
                      --><a class="hero-main-cta hero-btn hero-btn-menu left-off-canvas-toggle" href="#"><svg class="hero-main-cta__icon hero-main-cta__icon--menu"><use xlink:href="#icon-menu" /></svg> <span class="hero-main-cta__label">Menu</span></a>
                    </div><!--

                 --><div class="hero__item hero__social">
                      <a class="hero-btn hero-btn-twitter" href="https://twitter.com/BX1_actu"><svg><use xlink:href="#icon-twitter" /></svg></a>
                      <a class="hero-btn hero-btn-facebook" href="https://www.facebook.com/bx1officiel"><svg><use xlink:href="#icon-facebook" /></svg></a>
                      <a class="hero-btn hero-btn-youtube" href="https://www.youtube.com/user/TeleBruxelles"><svg><use xlink:href="#icon-youtube" /></svg></a>
                    </div><!--

                 --><div class="hero__item hero__weather">
                       <div class="weather">
                         <div class="weather-day"></div>
                         <div class="weather-forecast"></div>
                       </div>
                    </div>

                  </div>
               </div>

               <?php } ?>

            </div>

            <div class="row">
               <div class="large-12 columns">
                  <nav id="site-navigation" class="main-navigation top-bar hide-for-small" role="navigation">
                     <?php $defaults = array(
                              'theme_location'  => 'primary',
                              'container_class' => 'top-bar-section',
                              'menu_class'      => 'menu',
                              'items_wrap'      => '<ul id="%1$s" class="%2$s"><li><a href="/"><svg class="icon-home"><use xlink:href="#icon-home" /></svg></a></li>%3$s<li class="search-item-topbar"><a id="get-search-input" href="/"><svg class="icon-search-topbar"><use xlink:href="#icon-search" /></svg></a><form role="search" method="get" class="search-form" action="'. home_url( '/' ) .'"><input type="search" class="search-field-topbar" placeholder="Rechercher..." value="'. get_search_query() .'" name="s" /></form></li></ul>',
                              'walker' => new My_Walker_Nav_Menu()
                           );
                           wp_nav_menu( $defaults );
                     ?>
                  </nav><!-- #site-navigation -->
               </div>
            </div>
         </header><!-- #masthead -->


        <div class="row-ads row-ads--top">
          <?php if ( is_front_page() ) { ?>

          <?php //echo do_shortcode('[wpv-view name="banner-leaderboard"]'); ?>
          <div id="pebbleTopLarge" class="text-center">
            <script type="text/javascript"> adhese.tag({ format: "TopLarge", publication:"tele-bruxelles", location: "homepage",});</script>
          </div>

          <?php } else { ?>

          <div id="pebbleTopLarge" lass="text-center">
            <script type="text/javascript"> adhese.tag({ format: "TopLarge", publication:"tele-bruxelles", location: "others",});</script>
          </div>

          <?php } ?>
         </div>

         <div id="content" class="site-content row">
