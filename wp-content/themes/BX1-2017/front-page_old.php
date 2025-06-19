<?php

/**
 * Template Name: Accueil V2
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>
  <?php echo get_the_content(); ?>
  <?php // Si pas d'option d'affichage, ou si affichage est sur "Actualités"
  $presentation = get_option('home_pres');
  // var_dump($presentation);
  ?>

  <style type="text/css">

  	/* Règles générales */

  	@font-face {
	  font-family: 'Futura Std Book';
	  src: url('https://bx1.be/wp-content/themes/BX1-2017/font/FuturaStdBook.otf') format('opentype');
	  font-weight: normal;
	  font-style: normal;
	  font-display: swap; /* Améliore le chargement de la police */
	}

	body {
		font-family: 'Futura Std Book', Arial, sans-serif !important;
	}

	.news-top-block {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}
	.news-top-block .news__article {
		flex: 0 0 48% !important;
		box-sizing: border-box;
	}	

	/* Header */

	.logo img {
		width: 90px;
	}		

  	.siteHeader img {
	    max-width: 100%;
	    height: auto;
	    display: block;  		
  	}

  	.header-bottom {
  		display: flex;
  		flex-direction: row;
  		justify-content: space-between;
  		margin: auto;
  		width: 1200px;
  		align-items: end;
  	}

	#menu-home-v2_menu {
		display: flex;
		justify-content: space-between;
		align-items: start;
		flex-direction: row;
		margin-top: 30px;
		padding: 0;
	}

	#menu-home-v2_menu li {
		list-style: none;
		position: relative;
	}

	#menu-home-v2_menu li a {
		color: #000;
		font-size: 23px;
		letter-spacing: 1.6px;
		text-decoration: none;
	} 

	#menu-home-v2_menu li a:hover {
		text-decoration: none;
		color: #535353;
	}	  

	#menu-home-v2_menu .sub-menu {
		display: none;
		padding: 0;
		margin-top: 10px;
		position: absolute;
		z-index: 999;
	}

	#menu-home-v2_menu .sub-menu li a {
		font-size: 18px;
		letter-spacing: initial;
	}

	#menu-home-v2_menu > li::first-letter {
		font-weight: bolder;
		font-size: 29px;
	}

	/* 1. Onglet "Info" – première lettre en magenta (#EC1F7C) */
	#menu-home-v2_menu > li:nth-child(1)::first-letter {
	  color: #EC1F7C;
	}

	/* 2. Onglet "Reportages" – première lettre en bleu sombre (#084266) */
	#menu-home-v2_menu > li:nth-child(2)::first-letter {
	  color: #305B9E;
	}

	/* 3. Onglet "Sport" – première lettre en orange (#EC9C2B) */
	#menu-home-v2_menu > li:nth-child(3)::first-letter {
	  color: #EC9C2B;
	}

	/* 4. Onglet "Culture" – première lettre en turquoise (#0F8B8D) */
	#menu-home-v2_menu > li:nth-child(4)::first-letter {
	  color: #0F8B8D;
	}

	/* 5. Onglet "Émissions" – première lettre en gris (#8F8F8F) */
	#menu-home-v2_menu > li:nth-child(5)::first-letter {
	  color: #8F8F8F;
	}

	/* 6. Onglet "Ma commune" – première lettre en violet foncé (#B1125C) */
	#menu-home-v2_menu > li:nth-child(6)::first-letter {
	  color: #B1125C;
	}  	

	#menu-home-v2_menu > li:nth-child(6) .sub-menu > li {
		background-color: #B1125C;
		padding: 2px 5px;
		border-bottom: 2px solid #fff;
		width: 215px;
	}

	#menu-home-v2_menu > li:nth-child(6) .sub-menu > li:hover {
		background-color: #D51C70;
	}

	#menu-home-v2_menu > li:nth-child(6) .sub-menu > li a {
		color: #fff;
	}  	

	.header-btn-monbx1 {
		display: none;
	}

	.header-btn-directtv img:hover, .header-btn-directradio img:hover, .header-btn-whatsapp img:hover, .header-btn-alert img:hover, .header-btn-monbx1 img:hover {
		opacity: 0.8 !important;
	}	

	.header-btn-directtv img, .header-btn-directradio img, .header-btn-whatsapp img, .header-btn-alert img, .header-btn-monbx1 img {
		transition: opacity 0.3s ease;
	}		

	.siteHeader {
	  background-image: url('https://bx1.be/wp-content/uploads/2025/03/barre-menu-navigation.png');
	  background-size: cover;
	}

	.siteHeader--fixed {
		border-bottom: none;
	}

	.siteHeader__iReporter {
		background: url('https://bx1.be/wp-content/uploads/2025/03/alertez-nous.png');
		top: 26px;
		width: 120px;
		height: 55px;

	}

	.siteHeader__whatsapp {
		background: url('https://bx1.be/wp-content/uploads/2025/03/whatsapp.png');
		top: 26px;
		width: 120px;
		height: 55px;
		float: right;
		position: absolute;  	  	
	}  	  

	.siteHeader__iReporter--mini {
		background: url('https://bx1.be/wp-content/uploads/2025/04/alertez-nous_white.png') no-repeat !important;
		background-position: center !important;
		background-size: cover !important;
		width: 55px;	
		top: 0 !important;
		height: 39px !important;
		margin-bottom: 0 !important;
		margin-top: 0!important;
	}

	.siteHeader .inside {
		display: flex;
		justify-content: space-between;
		max-width: 1230px !important;
	}	

	.header-right, .header-center, .header-left {
		display: flex;
		align-items: center;
		flex: 1.2 1 0%;
		justify-content: space-evenly;
	}

	.header-center {
		flex: 2;
		justify-content: center;
	}

	.openMenu, .openSearch {
		position: initial;
		float: initial;
	}

	.openMenu{
		color: #D51C70 !important;
	}

	.openMenu span {
		background-color: #D51C70 !important;
	}

	.openSearch {
		margin: 0 23px;
	}

	.openSearch, .siteHeader__iReporter, .siteHeader__whatsapp {
		color: #fff !important;
	}

	.openMenu:visited, .openMenu:visited span {
		background-color: #D51C70 !important;
		color: #D51C70 !important;
	}

	.openMenu:hover {
		color: #B5115D !important;
	}	

	.openMenu:hover span {
		background-color: #B5115D !important;
	}	

	.openSearch, .openSearch:hover {
		background: url('https://bx1.be/wp-content/uploads/2025/04/loupe.png');
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		margin-top: 0;
	}	


	/* Homepage */

	.news {
		margin-left: 0;
	}	

	.secondMenu nav li a {
		color: #fff !important;
	}	

	.news__article .articletitre {
		max-width: 95%;
	}

  	.pubTop {
  		position: relative;
  		left: 120px;
  	}	

	#menu-home-v2_menu_dossiers {
		padding: 0;
		margin: 0;
	}

	#menu-home-v2_menu_dossiers li {
		background-color: #D51C70;
		padding: 3px 0px 3px 10px;
		margin-bottom: 1px;
		list-style: none;
		width: auto !important;
	}

	#menu-home-v2_menu_dossiers li a {
		color: #fff;
	}

	#menu-home-v2_menu_dossiers li a:hover {
		text-decoration: none;
		text-shadow: 1px 1px 33px #fff;
	}

	.nav-menu-dossiers {
		width: 295px;
		padding-right: 25px;
	}

	.nav-menu-dossiers_title {
		background-color: #e3e3e3;
		padding: 3px 0px 3px 10px;
		font-weight: bold;
	}  	

	.news__article h3 {
		margin-top: 0.5em;
		margin-bottom: 0 !important;
		color: #000;
	}

	.news__article.even, .news__article:nth-child(2n) {
		margin-right: 8px;
	}

	.news--big {
		position: relative;
		top: -46px;
	}

	#block-18, #block-20, #block-28 {
		display: none;
	}	

	#page .inside {
		display: flex;
		justify-content: space-between;
	}

	#page .inside .bx1_carrousel-main:last-child {
		margin-bottom: 0 !important;
	}	


	/* Sidebar */

	.sidebar-socials_responsive {
		display: none;
	}

	.sidebar-socials {
		position: absolute;
		right: -55px;
		width: 25px;
	}

	.sidebar-socials li img {
		width: 25px;
	}

	.sidebar-socials li {
		margin-top: 0;
		margin-bottom: 10px;
		border-bottom: none !important;
	}	

	.btn-direct-info {
		margin: 12px 0;
		background-color: #EB1F7C;
		padding: 2px 10px;
	}

	.btn-direct-info a {
		color: #fff;
	}

	.btn-direct-info a:hover {
		text-decoration: none;
		text-shadow: 1px 1px 33px #fff;
	}	


	/* Footer */

	.footerEnd {
		text-align: center;
	}

	.footerEnd .inside {
		display: initial !important;
	}

	.footerPartners .inside {
		display: flex;
		justify-content: center !important;
	}	


	/* Media Queries */
	@media screen and (max-width: 1560px) {
	  /* Header */
	  .header-bottom { width: 1020px; }
	  .siteHeader .inside { width: 1020px !important; }
	  .openMenu, .openSearch, .siteHeader__iReporter { margin: 0 !important; }

	  /* Homepage */
	  .pubTop { left: 30px; }
	  .news { width: 650px !important; }
	  .nav-menu-dossiers { padding-right: 38px; }
	}

	@media screen and (max-width: 1060px) {
	  /* Header */
	  #menu-home-v2_menu { display: none; }
	  .header-bottom {
	    width: auto;
	    flex-direction: column;
	    align-items: center;
	  }
	  .siteHeader { height: 95px; padding-top: 0; }
	  .realHeader { display: flex; }
	  .logo img { width: 75px !important; }
	  .openMenu { font-size: 13px !important; }
	  .openMenu span { width: 38px; margin-bottom: 10px !important; }
	  .siteHeader .inside { width: auto !important; }

	  /* Homepage */
	  .pubTop { left: 0; }
	  .news { width: 66% !important; }
	  .news--big { width: 100% !important; }
	  .header-center img { width: 70%; }

	  /* Sidebar */
	  .sidebar-socials_responsive { display: flex; }
	  .sidebar-socials_responsive ul {
	    display: flex;
	    justify-content: center;
	    padding: 0;
	    width: 100%;
	  }
	  .header-btn-directtv, .header-btn-directtv > a,
	  .header-btn-directradio, .header-btn-directradio > a {
	    display: flex;
	    justify-content: center;
	  }
	  .nav-menu-dossiers {
	  	display: none;
	  }

	  /* Footer */
	  .footer-block { width: 85% !important; padding: 0; }
	  .siteHeader { background-position: top; }
	}

	@media screen and (max-width: 680px) {
	  /* Header */
	  .openSearch { width: 35px; height: 35px; margin: 0 !important; }
	  .logo { overflow: initial !important; }
	  .siteHeader { padding: 5px !important; height: 65px; }
	  .inside { padding: 0 !important; }
	  .header-center { flex: 1 !important; justify-content: space-evenly; }
	  .openMenu {
	    font-size: 10px !important;
	    margin: 0 !important;
	    overflow: initial;
	  }
	  .openMenu span {
	    width: 26px;
	    margin-bottom: 6px !important;
	    height: 1px !important;
	  }

	  /* Homepage */
	  .news { width: 100% !important; }
	  .news-top-block, .news--big { padding: 0 10px; }


	  /* Sidebar */
	  .sideFil .widget { text-align: center; }

	  /* Footer */
	  .footer-block {
	    padding: 0 !important;
	    width: 100% !important;
	    text-align: center;
	  }
	} 	  

  </style>

  <script type="text/javascript">
	jQuery(document).ready(function($) {
	    var timeout;

	    // Sélectionne le parent de l'élément "Ma commune"
	    var $menuItem = $("a").filter(function() {
	        return $(this).text().trim() === "Ma commune";
	    }).parent();

	    // Cible aussi le sous-menu
	    var $subMenu = $menuItem.find(".sub-menu");

	    // Lorsque la souris entre sur l'onglet principal
	    $menuItem.on("mouseenter", function() {
	        clearTimeout(timeout);
	        $subMenu.stop(true, true).css("display", "block");
	    });

	    // Lorsque la souris sort de l'onglet principal
	    $menuItem.on("mouseleave", function() {
	        timeout = setTimeout(function() {
	            $subMenu.stop(true, true).css("display", "none");
	        }, 300); // délai de 300ms
	    });

	    // Si la souris entre dans le sous-menu, on empêche le hide
	    $subMenu.on("mouseenter", function() {
	        clearTimeout(timeout);
	    });

	    // Quand la souris quitte le sous-menu, on lance le délai
	    $subMenu.on("mouseleave", function() {
	        timeout = setTimeout(function() {
	            $subMenu.stop(true, true).css("display", "none");
	        }, 300);
	    });
	});

  </script>

	<section class="news">
		
		<?php
		// 1. Fonction pour afficher un article formaté
		function bx1_render_news_article($post, $index = 0, $classes = '', $size = 'medium') {
		    setup_postdata($post);

		    $videoFileName  = get_post_meta($post->ID, 'wpcf-video-name-news', true);
		    $flash_terms    = wp_get_post_terms($post->ID, 'flash_news', array('fields' => 'slugs'));
		    $sport          = has_category('sport', $post);
		    $redaction      = has_category('dossiers-redaction', $post);
		    $bonus          = has_category('bx1-bonus', $post);
		    $exclusif       = in_array('oui', wp_get_post_terms($post->ID, 'exclusif-blog', array('fields' => 'slugs')));
		    $is_flash_news  = in_array('oui', $flash_terms);
		    $even_odd_class = ($index % 2 === 0) ? 'even' : 'odd';
		    $video_class    = $videoFileName !== '' ? 'news__article--video' : '';

		    ?>
		    <article class="news__article <?php echo esc_attr("$video_class $even_odd_class $classes"); ?>">
		        <a href="<?php echo get_permalink($post->ID); ?>" title="Lire l'article <?php echo esc_attr(get_the_title($post->ID)); ?>">
		            <figure>
		                <?php if ( $is_flash_news ) : ?><span class="flash">Flash info</span><?php endif; ?>
		                <?php if ( $sport ) : ?><span class="flash flash--sport">Sport</span><?php endif; ?>
		                <?php if ( $redaction ) : ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
		                <?php if ( $bonus ) : ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
		                <?php if ( $exclusif ) : ?><span class="flash exclusif">Info BX1</span><?php endif; ?>
		                <?php echo get_the_post_thumbnail($post->ID, $size); ?>
		            </figure>
		            <h3 class="articletitre"><?php echo get_the_title($post->ID); ?> <span class="date"><?php echo get_the_date('d F Y', $post->ID); ?></span></h3>
		        </a>
		    </article>
		    <?php
		    wp_reset_postdata();
		}

		// 2. Récupérer les articles (mise en cache si possible)
		$transient_name = 'home_all_articles_v2';
		$all_articles = get_transient($transient_name);

		if (false === $all_articles) {
		    $argsNews = array(
		        'post_type'      => array('post', 'ireport'),
		        'posts_per_page' => 25,
		        'orderby'        => 'date',
		        'order'          => 'DESC',
		        'tax_query'      => array(
		            'relation' => 'AND',
		            array(
		                'taxonomy' => 'exclusif-blog',
		                'field'    => 'slug',
		                'terms'    => array('oui'),
		                'operator' => 'NOT IN',
		            ),
		        ),
		    );

		    $query = new WP_Query($argsNews);
		    $all_articles = $query->posts;
		    set_transient($transient_name, $all_articles, 2 * MINUTE_IN_SECONDS);
		}

		$passe = 0;
		$nb_articles = 4;
		$total = count($all_articles);
		$carousel_ids = [
		    '67e39fa425e31',
		    '67f68e2c49b63',
		    '67e3a0a88da9b',
		    '67e3a122e3662',
		    '67e54af276d2f',
		    '67e3a4e642a1c'
		];

		if (!empty($all_articles)) {
		    echo '<section class="news news--big">';
		    echo '<span style="display: block; color: #fff; background-color: #E31573; padding: 5px; width: 120px; font-size: 26px; text-align: center; font-weight: bold;">À la Une</span>';
		    bx1_render_news_article($all_articles[0], 0, 'article__large', 'Big News');
		    echo '</section>';
		    $passe = 1;
		}

		foreach ($carousel_ids as $carousel_id) {
		    echo '<section class="news-top-block">';
		    for ($i = $passe; $i < $passe + $nb_articles && $i < $total; $i++) {
		        bx1_render_news_article($all_articles[$i], $i);
		    }
		    echo '</section>';
		    echo '<div class="bx1_carrousel-main">' . do_shortcode("[bx1_carrousel id=\"$carousel_id\"]") . '</div>';
		    $passe += $nb_articles;
		}
		?>


	</section>

    <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>	







<?php get_footer('v2'); ?>
