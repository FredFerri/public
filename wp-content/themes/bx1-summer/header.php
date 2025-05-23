<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package TeleBruxelles
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="google-site-verification" content="gsFNYcMKAZegw7kyyD6LX9_SFrbF-SG2z-4kR6Qu-PI" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="shortcut icon" href="/favicon.ico" />

  <?php wp_head(); ?>

  <script type="text/javascript" src="https://c.pebblemedia.be/js/c.js"></script>
  <script type="text/javascript" src="https://pool-pebblemedia.adhese.com/tag/tag.js"></script>

  <?php if ( is_single() ) { ?>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php 
      if(get_the_excerpt() == "" && get_the_content() != "")
        {
          $fbdesc = get_the_excerpt();
        }
      elseif(get_the_excerpt() != "" && get_the_content() == "") 
        {
          $fbdesc = get_the_content();
        } 
      else
        {
          $fbdesc = get_the_title();
        }
   ?>
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:image:url" content="<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>" />
    <meta property="og:description" content="<?php echo $fbdesc; ?>" />
    <?php endwhile; ?>
    <?php endif; ?>
    
  <?php } ?>
  <script src="<?php echo get_template_directory_uri();?>/js/modernizr.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.js"></script>
  <script>jwplayer.key = "uV+9Z88Ot1pSaRYTCyutEuffNeCwl8SCX1R0uQ==";</script>
  
</head>

<body <?php body_class(); ?>>
  <?php include_once( "img/icons.svg"); ?>
  <div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
      <?php // Off Canvas Menu ?>
      <aside class="left-off-canvas-menu">
        <?php
          $defaults = array(
            'theme_location'=> 'primary',
            'container_class' => 'top-bar-section',
            'menu_class' => 'menu',
            'depth' => -1,
            'items_wrap' => '<ul id="%1$s" class="%2$s"><form role="search" method="get" class="search-form" action="'. home_url( '/' ) .'"><input type="search" class="search-field-topbar" placeholder="Rechercher..." value="'. get_search_query() .'" name="s" /></form><li><a href="/">Accueil</a></li>%3$s</ul>'
            );
          wp_nav_menu( $defaults );
        ?>
      </aside>
      <a class="exit-off-canvas"></a>
      <div id="page" class="hfeed site">
        <header id="masthead" class="site-header">
          <div class="pattern"></div>
          <div class="row collapse top-page-row">

          <?php
            // Get latest Featured News if they exist
            // ==> Hero is expanded
            $args = array(
              'post_type'=> 'post',
              'posts_per_page' => 2,
              'meta_key' => 'wpcf-featured-news',
              'meta_value' => 1
              );

            $queryFeaturedNews = new WP_Query($args);
            if ( $queryFeaturedNews->have_posts() && is_front_page() ) {
              $index = 1;
            ?>

            <div class="large-10 large-centered columns hero hero--expanded">
              <div class="hero__ctawrapper">
                <h1 class="visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
                <a class="hero__item logo-telebxl-link logo-telebxl-link--expanded" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <?php include_once( "img/bx1-logo.svg"); ?><span class="logo-baseline">Médias de Bruxelles</span>
                </a><!--
             --><div class="hero__item hero__actions hero__actions--expanded"><!--
               --><a class="hero-main-cta hero-btn live-feed-btn" href="/live" id="live-feed">
                    <svg class="hero-main-cta__icon">
                      <use xlink:href="#icon-play" />
                    </svg>
                    <span class="hero-main-cta__label">En live</span>
                  </a><!--
               --><a class="hero-main-cta hero-btn last-news-btn" href="/dernier-jt" id="last-JT">
                    <svg class="hero-main-cta__icon">
                      <use xlink:href="#icon-tv" />
                    </svg>
                    <span class="hero-main-cta__label">Dernier JT</span>
                  </a><!--

                --><a class="hero-main-cta hero-btn hero-btn-menu left-off-canvas-toggle" href="#">
                    <svg class="hero-main-cta__icon hero-main-cta__icon--menu">
                      <use xlink:href="#icon-menu" />
                    </svg>
                    <span class="hero-main-cta__label">Menu</span>
                  </a>
                </div>

                <?php if ($queryFeaturedNews->post_count > 1){ ?>
                  <div class="featured-vid-tools">
                    <a href="<?php echo get_permalink($queryFeaturedNews->posts[0]->ID); ?>" class="hero-main-cta hero-btn hero-featured-vod hero-featured-vod--1" id="hero-featured-vod--1">
                      <svg class="hero-main-cta__icon">
                        <use xlink:href="#icon-play"></use>
                      </svg>
                      <span class="hero-main-cta__label">À la une</span>
                    </a><!--
                 --><a href="<?php echo get_permalink($queryFeaturedNews->posts[1]->ID) ?>" class="hero-main-cta hero-btn hero-featured-vod hero-featured-vod--2" id="hero-featured-vod--2">
                      <svg class="hero-main-cta__icon">
                        <use xlink:href="#icon-play"></use>
                      </svg>
                      <span class="hero-main-cta__label">À voir</span>
                     </a>
                 </div>
                <?php } ?>

                <?php
                  // Get Live Exclu Web Page
                  $liveExcluWebSlug = 'live-exclu-web';
                  $args = array(
                    'name'        => $liveExcluWebSlug,
                    'post_type'   => 'page',
                    'post_status' => 'publish',
                    'numberposts' => 1
                  );
                  $my_posts = get_posts($args);
                  if( $my_posts ) :
                  ?>
                    <a href="<?php echo get_permalink($my_posts[0]->ID); ?>" class="hero-main-cta hero-btn hero-live-exclu-web" id="exclu-web-live-stream" id="live-exclu-web">Live - Exclu web</a>

                    <script>
                    // Load Live Exclu Web Stream
                    jQuery("#live-exclu-web").on('click', function(e) {
                      if ($(window).width() > 640) {
                        e.preventDefault();
                      }
                      jQuery('.featured-news-title').hide();

                      setTimeout(function(){
                        jQuery('.jw-sharing-text').val("<?php echo the_permalink() ?>");
                      }, 2000);

                      jwplayer("featured-video").setup({
                        playlist: [{
                          "sources": [{
                            "file": "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo do_shortcode('[types field="exclu-web-id" output="raw"][/types]') ?>" + ".mp4"},{
                            "file": "http://149.202.81.107:1935/vod/mp4:" + "<?php echo do_shortcode('[types field="exclu-web-id" output="raw"][/types]') ?>" + ".mp4" + "/playlist.m3u8",type: "mp4"},{
                            "file": "rtsp://149.202.81.107:1935/vod/" + "<?php echo do_shortcode('[types field="exclu-web-id" output="raw"][/types]') ?>" + ".mp4"
                            }]
                        }],
                        primary: 'html5',
                        flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
                        width: '100%',
                        aspectratio: '16:9',
                        autostart: true,
                        androidhls: true,
                        advertising: {
                          client: 'vast',
                          schedule: {
                            adbreak1: {
                              offset: 'pre',
                              tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                            },
                            adbreak2: {
                              offset: 'post',
                              tag: 'http://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                            }
                          }
                        }
                      })

                    });
                    </script>
                  <?php
                  endif;
                  ?>

              </div><?php // hero__ctawrapper  ?>

              <div class="hero__videowrapper hide-for-small-only">
                <div id="featured-video"></div>
                <?php while ( $queryFeaturedNews->have_posts() ) : $queryFeaturedNews->the_post(); ?>

                <?php
                  $featuredNewsImg = do_shortcode('[wpv-post-featured-image size="Header image" output="url"]');
                  $featuredNewsVideoName = do_shortcode('[types field="video-name-news" output="raw"][/types]');
                ?>

                <?php
                // Load first Featured News
                if ($index == 1){
                ?>
                  <h2 class="featured-news-title featured-news-title--<?php echo $index; ?>"><?php the_title(); ?></h2>
                  <script>
                  jwplayer("featured-video").setup({
                    playlist: [{
                      "title": "<?php the_title(); ?>",
                      "image": "<?php echo $featuredNewsImg; ?>",
                      "sources": [{
                        "file": "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4"},{
                        "file": "http://149.202.81.107:1935/vod/mp4:" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4" + "/playlist.m3u8",type: "mp4"},{
                        "file": "rtsp://149.202.81.107:1935/vod/" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4"}
                      ]
                    }],
                    primary: 'html5',
                    flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
                    width: '100%',
                    aspectratio: '16:9',
                    androidhls: true,
                    advertising: {
                      client: 'vast',
                      schedule: {
                        adbreak1: {
                          offset: 'pre',
                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                        },
                        adbreak2: {
                          offset: 'post',
                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                        }
                      }
                    }
                  });

                  setTimeout(function(){
                    jQuery('.jw-sharing-text').val("<?php echo the_permalink() ?>");
                  }, 2000);
                  </script>
                <?php
                }
                ?>
                <script>


                  var featuredVidIndex = '<?php echo '#hero-featured-vod--' . $index; ?>';

                  jQuery(featuredVidIndex).on('click', function(e) {
                    if ($(window).width() > 640) {
                      e.preventDefault();
                    }
                  jQuery('.featured-news-title').hide();
                  jQuery('.featured-news-title').html('<?php echo the_title() ?>').show();

                  setTimeout(function(){
                    jQuery('.jw-sharing-text').val("<?php echo the_permalink() ?>");
                  }, 2000);

                    jwplayer("featured-video").setup({
                      playlist: [{
                        "title": "<?php the_title(); ?>",
                        "image": "<?php echo $featuredNewsImg; ?>",
                        "sources": [{
                          "file": "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4"},{
                          "file": "http://149.202.81.107:1935/vod/mp4:" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4" + "/playlist.m3u8",type: "mp4"},{
                          "file": "rtsp://149.202.81.107:1935/vod/" + "<?php echo $featuredNewsVideoName; ?>" + ".mp4"
                          }]
                      }],
                      primary: 'html5',
                      flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
                      width: '100%',
                      autostart: true,
                      aspectratio: '16:9',
                      androidhls: true,
                      advertising: {
                        client: 'vast',
                        schedule: {
                          adbreak1: {
                            offset: 'pre',
                            tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                          },
                          adbreak2: {
                            offset: 'post',
                            tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                          }
                        }
                      }
                    });
                  });
                </script>

                <?php $index++ ?>
                <?php endwhile; ?>

                <?php
                // Get data for Last JT
                $argsDernierJT = array(
                  'post_type'=> 'emission',
                  'posts_per_page' => 1,
                  'tax_query' => array(
                      array(
                        'taxonomy' => 'emissions',
                        'field' => 'slug',
                        'terms' => '001-journal-12-30',
                        ),
                      ),
                  );

                $queryNameDernierJT = new WP_Query($argsDernierJT);
                if ( $queryNameDernierJT->have_posts() ) {
                  while ( $queryNameDernierJT->have_posts() ) : $queryNameDernierJT->the_post();
                ?>
                <script>
                  // Load last JT in hero on click on Dernier JT button
                  jQuery("#last-JT").on('click', function(e) {
                    if ($(window).width() > 640) {
                      e.preventDefault();
                    }
                    jQuery('.featured-news-title').hide();

                    setTimeout(function(){
                      jQuery('.jw-sharing-text').val("<?php echo the_permalink() ?>");
                    }, 2000);

                    jwplayer("featured-video").setup({
                      playlist: [{
                        "sources": [{
                          "file": "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo do_shortcode('[types field="nom-du-fichier-video" output="raw"][/types]') ?>" + ".mp4"},{
                          "file": "http://149.202.81.107:1935/vod/mp4:" + "<?php echo do_shortcode('[types field="nom-du-fichier-video" output="raw"][/types]') ?>" + ".mp4" + "/playlist.m3u8",type: "mp4"},{
                          "file": "rtsp://149.202.81.107:1935/vod/" + "<?php echo do_shortcode('[types field="nom-du-fichier-video" output="raw"][/types]') ?>" + ".mp4" 
                          }]
                      }],
                      primary: 'html5',
                      flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
                      width: '100%',
                      autostart: true,
                      aspectratio: '16:9',
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
                    })

                  });
                </script>
                <?php endwhile; ?>
                <?php } wp_reset_postdata(); ?>

                <script>
                  // Load live stream in hero on click on Live button
                  jQuery("#live-feed").on('click', function(e) {
                    if ($(window).width() > 640) {
                      e.preventDefault();
                    }
                    jQuery('.featured-news-title').hide();

                    setTimeout(function(){
                      jQuery('.jw-sharing-text').val("<?php echo $url = site_url('/live/'); ?>");
                    }, 2000);

                    jwplayer("featured-video").setup({
                      playlist: [{
                        "sources": [{
                          "file": "rtmp://149.202.81.107:1935/stream/live"
                        }, {
                          "file": "http://149.202.81.107:1935/stream/live/playlist.m3u8"
                        ,type: "mp4"},{
                          "file": "rtsp://149.202.81.107:1935/stream/live"
                        }]
                      }],
                      primary: 'html5',
                      flashplayer: '<?php echo get_template_directory_uri();?>/js/jwplayer/jwplayer.flash.swf',
                      width: '100%',
                      aspectratio: '16:9',
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
                    })
                  });
                </script>

              </div><?php // hero__videowrapper hide-for-small-only ?>
            </div><?php // large-10 large-centered columns hero hero--expanded ?>
            <div class="large-10 large-centered hero columns hero-2nd-row-expanded-wrap">
              <div class="hero-2nd-row-expanded">
                <div class="hero-social--expanded">
                  <a class="hero-btn hero-btn--expanded hero-btn-twitter" target="_blank" href="<?php echo getKatTwitterPage(); ?>">
                    <svg>
                      <use xlink:href="#icon-twitter" />
                    </svg>
                  </a><!--
               --><a class="hero-btn hero-btn--expanded hero-btn-facebook" target="_blank" href="<?php echo getKatFbPage(); ?>">
                    <svg>
                      <use xlink:href="#icon-facebook" />
                    </svg>
                  </a><!--
               --><a class="hero-btn hero-btn--expanded hero-btn-youtube" target="_blank" href="<?php echo getKatYoutubePage(); ?>">
                    <svg>
                      <use xlink:href="#icon-youtube" />
                    </svg>
                  </a>
                </div>
                <div class="weather weather--expanded">
                  <div class="weather-day"></div>
                  <div class="weather-forecast"></div>
                </div>
              </div>
            </div><?php // large-10 large-centered columns hero hero--expanded ?>

            <?php } else { ?>
            <?php
            // There isn't any Featured News
            // ==> Hero is condensed
            ?>

            <div class="large-10 large-centered columns hero hero--condensed">
              <h1 class="visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
              <a class="hero__item hero__logo logo-telebxl-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php include_once( "img/bx1-logo.svg"); ?> <span class="logo-baseline">Médias de Bruxelles</span>
              </a><!--

           --><div class="hero__item hero__actions">
                <a class="hero-main-cta hero-btn live-feed-btn" href="/live" id="live-feed">
                  <svg class="hero-main-cta__icon">
                    <use xlink:href="#icon-play" />
                  </svg>
                  <span class="hero-main-cta__label">En live</span>
                </a><!--
             --><a class="hero-main-cta hero-btn last-news-btn" href="/dernier-jt" id="last-news">
                  <svg class="hero-main-cta__icon">
                    <use xlink:href="#icon-tv" />
                  </svg>
                  <span class="hero-main-cta__label">Dernier JT</span>
                </a><!--
             --><a class="hero-main-cta hero-btn hero-btn-menu left-off-canvas-toggle" href="#">
                  <svg class="hero-main-cta__icon hero-main-cta__icon--menu">
                    <use xlink:href="#icon-menu" />
                  </svg>
                  <span class="hero-main-cta__label">Menu</span>
                </a>
              </div><!--
           --><div class="hero__item hero__social">
                <a class="hero-btn hero-btn-twitter" target="_blank" href="<?php echo getKatTwitterPage(); ?>">
                  <svg>
                    <use xlink:href="#icon-twitter" />
                  </svg>
                </a>
                <a class="hero-btn hero-btn-facebook" target="_blank" href="<?php echo getKatFbPage(); ?>">
                  <svg>
                    <use xlink:href="#icon-facebook" />
                  </svg>
                </a>
                <a class="hero-btn hero-btn-youtube" target="_blank" href="<?php echo getKatYoutubePage(); ?>">
                  <svg>
                    <use xlink:href="#icon-youtube" />
                  </svg>
                </a>
              </div><!--
           --><div class="hero__item hero__weather">
                <div class="weather">
                  <div class="weather-day"></div>
                  <div class="weather-forecast"></div>
                </div>
              </div>

              <?php
                // Get Live Exclu Web Page
                $liveExcluWebSlug = 'live-exclu-web';
                $args = array(
                  'name'        => $liveExcluWebSlug,
                  'post_type'   => 'page',
                  'post_status' => 'publish',
                  'numberposts' => 1
                );
                $my_posts = get_posts($args);
                if( $my_posts ) :
                ?>
                  <a href="<?php echo get_permalink($my_posts[0]->ID); ?>" class="hero-main-cta hero-btn hero-live-exclu-web" id="exclu-web-live-stream" id="live-exclu-web">Live - Exclu web</a>

                <?php
                endif;
                ?>

            </div><?php // large-10 large-centered columns hero hero--condensed ?>
          </div><?php // row collapse top-page-row ?>

          <?php } wp_reset_postdata(); ?>

          </div>

          <div class="row">
            <div class="large-12 columns">
              <nav id="site-navigation" class="main-navigation top-bar hide-for-small">
                <?php
                  $defaults = array(
                    'theme_location' => 'primary',
                    'container_class' => 'top-bar-section',
                    'menu_class' => 'menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="/"><svg class="icon-home"><use xlink:href="#icon-home" /></svg></a></li>%3$s<li class="search-item-topbar"><a id="get-search-input" href="/"><svg class="icon-search-topbar"><use xlink:href="#icon-search" /></svg></a><form role="search" method="get" class="search-form" action="'. home_url( '/' ) .'"><input type="search" class="search-field-topbar" placeholder="Rechercher..." value="'. get_search_query() .'" name="s" /></form></li></ul>',
                    'walker' => new My_Walker_Nav_Menu()
                    );
                  wp_nav_menu( $defaults );
                ?>
              </nav><!-- #site-navigation -->
            </div>
          </div>
        </header><?php // #masthead ?>

        <div class="row-ads row-ads--top">
          <?php if ( is_front_page() ) { ?>

          <?php //echo do_shortcode( '[wpv-view name="banner-leaderboard"]'); ?>
          <div id="pebbleTopLarge" class="text-center">
            <script type="text/javascript">
              adhese.tag({
                format: "TopLarge",
                publication: "tele-bruxelles",
                location: "homepage",
              });
            </script>
          </div>

          <?php } else { ?>

          <div id="pebbleTopLarge" lass="text-center">
            <script type="text/javascript">
              adhese.tag({
                format: "TopLarge",
                publication: "tele-bruxelles",
                location: "others",
              });
            </script>
          </div>

          <?php } ?>
        </div>

        <div id="content" class="site-content row">
