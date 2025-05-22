
            <?php
            if (!isset($videoName)) {
            	$videoName = '';
            }
            ?>
            <div class="clearfix"></div>
           </div><!-- #content -->
            <?php
           if(is_page('Accueil_v2'))
            {?>
                <style>

                    .bottom--emmissions-list{
                        max-width: 15%;
                        display: inline-table;
                        vertical-align: top;
                        margin: 0.65%;
                    }
                    @media only screen and (max-width: 600px) {
                        .bottom--emmissions-list{
                            max-width: 100%;
                            margin-bottom: 20px;
                        }
                    }
                    .bottom--emmissions-list span {
                        display: block;
                        width: 100%;

                        text-align: center;
                        color:#FFFFFF;
                    }
                </style>
                <section class="footer-block" style="background: linear-gradient(0deg, rgba(235,31,124,1) 0%, rgba(235,31,124,1) 25%, rgba(113,6,55,1) 100%);margin-top: 26px;display: inline-block;width: 70%;padding: 10px;background-color: #EB1F7C;color: #FFFFFF;padding-left: 15%;padding-right: 15%;">
                    <h2> Revoir nos dernières émissions TV</h2>
		            <?php
		            if(isset($_GET['diffusion']) && $_GET['diffusion'] != ''){
			            $diffusion=strtotime($_GET['diffusion']);
			            $argsTest = array(
				            'post_type'=> array('emission'),
				            'posts_per_page' => 1,
				            'fields'         => 'ids',
				            'meta_query' => array(
			            	    'relation' => 'AND',
							    array(
							        'key'     => 'wpcf-nom-du-fichier-video',
							        'value'   => array('', $videoName),
							        'compare' => 'NOT IN'
							    ),
					            array(
						            'key' => 'wpcf-horaire-debut',
						            'value'   => $diffusion,
						            'compare' => '>'
					            ),
					            array(
						            'key' => 'wpcf-horaire-debut',
						            'value'   => strtotime('+1 day', $diffusion),
						            'compare' => '<'
					            )
				            ),
				            'tax_query' => array(
					            $type_emissions
				            )
			            );

						$cache_key = 'query_news_' . md5(json_encode($argsNews));
						$cached_results = get_transient($cache_key);

						if (false === $cached_results) {
						    $queryNews = new WP_Query($argsNews);
						    $cached_results = $queryNews->posts;
						    set_transient($cache_key, $cached_results, 3600); // Cache pendant 1h
						} else {
						    $queryNews = (object) ['posts' => $cached_results];
						}

						if ($queryTest->have_posts()) {
						    $diffusion_new = array(
						        'relation' => 'AND',
						        array(
						            'key'     => 'wpcf-horaire-debut',
						            'value'   => $diffusion,
						            'type'    => 'NUMERIC',
						            'compare' => '>'
						        ),
						        array(
						            'key'     => 'wpcf-horaire-debut',
						            'value'   => strtotime('+1 day', $diffusion),
						            'type'    => 'NUMERIC',
						            'compare' => '<'
						        )
						    );
						} else {
						    $diffusion_old = array(
						        array(
						            'column'    => 'post_date',
						            'before'    => date('Y-m-d H:i:s', $diffusion),
						            'inclusive' => true
						        )
						    );
						}

						wp_reset_postdata();

		            }
		            if (!isset($diffusion_new)) {
		            	$diffusion_new = '';
		            }
		            if (!isset($diffusion_old)) {
		            	$diffusion_old = '';
		            }
		            $argsNews = array(
			            'post_type'=> array('emission'),
			            'posts_per_page' => 6,
						'meta_query' => array(
						    'relation' => 'AND',
						    array(
						        'key'     => 'wpcf-nom-du-fichier-video',
						        'value'   => array('', $videoName),
						        'compare' => 'NOT IN'
						    ),
						    $diffusion_new
						),
			            'orderby' => 'date',
			            'order' => 'DESC',
			            'paged' => get_query_var('paged'),
			            'date_query' => $diffusion_old
		            );

		            $queryNews = new WP_Query($argsNews);

					// $cache_key = 'query_news_' . md5(json_encode($argsNews));
					// $cached_results = get_transient($cache_key);

					// if (false === $cached_results) {
					//     $queryNews = new WP_Query($argsNews);
					//     $cached_results = $queryNews->posts;
					//     set_transient($cache_key, $cached_results, 3600); // Cache pendant 1h
					// } else {
					//     $queryNews = (object) ['posts' => $cached_results];
					// }


		            if($queryNews->have_posts()) : ?>
			            <?php
			            while ( $queryNews->have_posts() ) : $queryNews->the_post();
				            $heure = '';
				            if(types_render_field('horaire-debut') == ''){
					            $heure = get_the_date('d F Y');
				            }
				            else{
					            $heure = types_render_field('horaire-debut',array('format'=>'\d\u d F Y'));
				            }
				            ?>

                            <a href="<?php echo get_the_permalink(); ?>"><div class="bottom--emmissions-list">
						            <?php
						            $terms = get_the_terms( $post->ID, 'type_emissions' );
						            foreach ($terms as $term){
							            $image = apply_filters( 'taxonomy-images-get-terms', '', array(
									            'taxonomy' => 'type_emissions',
									            'term_args' => array(
										            'slug' => $term->slug,
									            )
								            )
							            );

							            foreach( (array) $image as $img){?>
                                            <img src="<?php echo wp_get_attachment_image_url( $img->image_id, 'rss-thumb'); ?>">
								            <?php
							            }
                                        $PostTypeSLUG = $term->slug;
						            }
                                    if ($PostTypeSLUG == "lair-du-temps" || $PostTypeSLUG == "autreslugdeposte")
                                        {
	                                        echo "<span><b>" . get_the_title() . "</b></span>";
                                        }
                                    else {
	                                    echo "<span><b>" . get_the_title() . "</b> " . $heure . "</span>";
                                    }
                                        ?>
                                </div></a>

			            <?php endwhile; wp_reset_postdata(); ?>
		            <?php else: ?>
		            <?php endif;?>
                </section>

                
                <section class="footer-block" style="background: linear-gradient(0deg, rgb(255,91,168) 0%, rgb(255,91,168) 25%, rgba(235,31,124,1) 100%);display: inline-block;width: 70%;padding: 10px;color: #FFFFFF;padding-left: 15%;padding-right: 15%;">
                    <h2> &Eacute;couter nos derniers podcasts</h2>
		            <?php
		            if(isset($_GET['diffusion']) && $_GET['diffusion'] != ''){
			            $diffusion=strtotime($_GET['diffusion']);
			            $argsTest = array(
				            'post_type'=> array('radio-chronique', 'radio-emission'),
				            'posts_per_page' => 1,
				            'fields'         => 'ids',				            
				            'meta_query' => array(
			            	    'relation' => 'AND',
							    array(
							        'key'     => 'wpcf-video-chronique',
							        'value'   => array('', $videoName),
							        'compare' => 'NOT IN'
							    ),
					            array(
						            'key' => 'wpcf-date-chronique',
						            'value'   => $diffusion,
						            'compare' => '>'
					            ),
					            array(
						            'key' => 'wpcf-date-chronique',
						            'value'   => strtotime('+1 day', $diffusion),
						            'compare' => '<'
					            )
				            ),
				            'tax_query' => array(
					            $type_emissions
				            )
			            );

						$cache_key = 'query_test_' . md5(json_encode($argsTest));
						$cached_results = get_transient($cache_key);

						if (false === $cached_results) {
						    $queryTest = new WP_Query($argsTest);
						    $cached_results = $queryTest->posts;
						    set_transient($cache_key, $cached_results, 3600); // Cache pendant 1h
						} else {
						    $queryTest = (object) ['posts' => $cached_results];
						}


			            if($queryTest->have_posts()){
				            $diffusion_new = array(
					            array(
						            'key' => 'wpcf-date-chronique',
						            'value'   => $diffusion,
						            'compare' => '>'
					            ),
					            array(
						            'key' => 'wpcf-date-chronique',
						            'value'   => strtotime('+1 day', $diffusion),
						            'compare' => '<'
					            )
				            );
			            }
			            else{
				            $diffusion_old = array(
					            array(
						            'year'  => date("Y", $diffusion),
						            'month' => date("m", $diffusion),
						            'day'   => date("d", $diffusion),
					            )
				            );
			            }
			            wp_reset_postdata();
		            }
		            if (!isset($diffusion_new)) {
		            	$diffusion_new = '';
		            }
		            if (!isset($diffusion_old)) {
		            	$diffusion_old = '';
		            }
		            $argsNews = array(
			            'post_type'=> array('radio-chronique', 'radio-emission'),
			            'posts_per_page' => 6,
			            'meta_query' => array(
				            array(
					            'key' => 'wpcf-video-chronique',
					            'value'   => '',
					            'compare' => '!='
				            ),array(
					            'key' => 'wpcf-video-chronique',
					            'value'   => $videoName,
					            'compare' => '!='
				            ),
				            $diffusion_new
			            ),
			            'orderby' => array('date' => 'DESC'),
			            'paged' => get_query_var('paged'),
			            'date_query' => $diffusion_old
		            );
		            $queryNews = new WP_Query($argsNews);
		            if($queryNews->have_posts()) : ?>
			            <?php
			            while ( $queryNews->have_posts() ) : $queryNews->the_post();
				            $heure = '';
				            if(types_render_field('date-chronique') == ''){
					            $heure = get_the_date('d F Y');
				            }
				            else{
					            $heure = types_render_field('date-chronique',array('format'=>'\d\u d F Y'));
				            }
				            ?>

                            <a href="<?php echo get_the_permalink(); ?>"><div class="bottom--emmissions-list">
						            <?php
						            $termsrch = get_the_terms( $post->ID, 'radio-type_emissions' );
						            if ($termsrch) {					            	
							            foreach ($termsrch as $termr){
								            $PostTypeSLUGRCH = $termr->slug;
							            }
						            }
							            ?>
                                            <?php echo get_the_post_thumbnail( get_the_ID(), 'rss-thumb' ); ?>
								            <?php
						            if ($PostTypeSLUGRCH == "le-12h30-toujours-plus-actu" || $PostTypeSLUGRCH == "toujours-plus-actu")
						            {
							            echo "<span><b>" . get_the_title() . "</b></span>";
						            }
						            else {
							            echo "<span><b>" . get_the_title() . "</b> " . $heure . "</span>";
						            }
						            ?>
                                </div></a>

			            <?php endwhile; wp_reset_postdata(); ?>
		            <?php else: ?>
		            <?php endif;?>
                </section>

            <?php } ?>
           <div class="pubBottom">
            <?php if(is_user_logged_in() && $_COOKIE['nopub'] == 'on'): ?>
                <!-- Nopub activé -->
              <?php else: ?>
                <!-- ads - zone images publicitaires bannering_footer -->
                <div id="gestcom_54"></div>
              <?php endif; ?>
           </div>

           <footer class="footerPartners" >
            <div class="inside">
              <?php
              $argsPartenaires = array(
                'post_type'=> 'partenaires',
                'posts_per_page' => -1
                );

              $queryPartenaires = new WP_Query($argsPartenaires);

              if ( $queryPartenaires->have_posts() ) { ?>

                <div class="row" data-equalizer data-options="equalize_on_stack: true">

                  <?php
                    while ( $queryPartenaires->have_posts() ) : $queryPartenaires->the_post();
                    $partner_link =  types_render_field('partenaires-url');
                    if(empty($partner_link))
                      {
                          $partner_link   = get_the_permalink();
                      }
                  ?>
                  <div style="display: none;">
                    <?php echo $partner_link; ?>
                  </div>
                 <div class="footerPartners__partner">
                    <a href="<?php echo types_render_field("partenaires-url"); ?>" target="_blank" title="Voir le site de <?php the_title(); ?> (ouverture dans un nouvel onglet)">
                      <?php the_post_thumbnail('Logo') ?>
                    </a>
                 </div>

                  <?php endwhile; ?>

                </div>

              <?php
              }
              wp_reset_postdata();
              ?>
            </div>
           </footer><!-- #colophon -->


           <footer class="footerEnd">
            <div class="inside">
              <?php dynamic_sidebar('footer2'); ?>
              <?php wp_nav_menu( array('theme_location' => 'footer3')); ?>
              <p class="footerEnd__signature"><img src="<?php bloginfo('url'); ?>/wp-content/themes/BX1-2017/img/logo.png" width="60" height="56" alt="BX1" /><span>© BX1 <?php echo date("Y"); ?></span></p>
            </div>
           </footer>

        </div>

  <?php if(!is_page('mobilite')): ?>
    <?php wp_footer(); ?>
  <?php endif; ?>        

  <?php
    if(is_page('Accueil_v2')):
      // Si il y a au moins 2 lives (donc au moins le direct tv + un live web), on passe le 1er (le direct tv) et on affiche le 2e uniquement
        $argsVideo = array(
          'post_type'=> array('lives'),
          'posts_per_page' => 1,
          'orderby' => array('date' => 'DESC'),
          'offset' => '1'
        );
        $queryVideo = new WP_Query($argsVideo);
        if($queryVideo->have_posts()) :
          while ( $queryVideo->have_posts() ) : $queryVideo->the_post();
      ?>
        <div class="liveMini">
          <button class="liveMini__close">&times;</button>
          <div class="liveMini__inside">
              <?php
                $extlink = types_render_field('lien-externe');
                if (!empty($extlink))
                    {
                        $link = $extlink;
                    }
                else
                    {
                        $link = the_permalink();
                    }
              ?>
            <a href="<?php echo $link; ?>" title="Voir le direct <?php the_title(); ?>"></a>
            <h4><span>Regarder </span><?php the_title(); ?></h4>
            <div id="videoMini"></div>
            <script>
               jwplayer("videoMini").setup({
                 playlist: [{
                   "sources": [{
                     "file": "https://<?php echo types_render_field('url-du-live'); ?>/playlist.m3u8","type": "mp4"
                   },{
                     "file": "rmtps://<?php echo types_render_field('url-du-live'); ?>"
                   }]
                 }],
                 primary: 'html5',
                 width: '100%',
                 aspectratio: '16:9',
                 autostart: true,
                 androidhls: true,
                 autostart: true,
                 mute: false,
                 advertising: false,
                 volume: 100
               })
            </script>
          </div>
        </div>
      <?php endwhile;wp_reset_postdata(); endif; endif; ?>


   <script src="<?php echo get_template_directory_uri();?>/js/main.js"></script>
   <?php if(is_user_logged_in()): ?>
   <script src="<?php echo get_template_directory_uri();?>/js/admin.js"></script>
   <?php endif; ?>
   <script async src="https://static.addtoany.com/menu/page.js"></script> 
   <!-- A placer en bas de page juste avant la balise /body -->
   <script src="https://gestcom.divercom.be/w/bx1/30" async defer></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4EDZJXK2F4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4EDZJXK2F4');
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



  </body>
</html>
