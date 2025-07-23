<?php
if (!isset($videoName)) {
	$videoName = '';
}
?>
<div class="clearfix"></div>
</div><!-- #content -->
<?php
if (is_page('Accueil_v2')) { ?>
	<style>
		.bottom--emmissions-list {
			max-width: 15%;
			display: inline-table;
			vertical-align: top;
			margin: 0.65%;
		}

		@media only screen and (max-width: 600px) {
			.bottom--emmissions-list {
				max-width: 100%;
				margin-bottom: 20px;
			}
		}

		.bottom--emmissions-list span {
			display: block;
			width: 100%;

			text-align: center;
			color: #FFFFFF;
		}
	</style>
	<section class="footer-block" style="background: linear-gradient(0deg, rgba(235,31,124,1) 0%, rgba(235,31,124,1) 25%, rgba(113,6,55,1) 100%);margin-top: 26px;display: inline-block;width: 70%;padding: 10px;background-color: #EB1F7C;color: #FFFFFF;padding-left: 15%;padding-right: 15%;">
		<h2> Revoir nos dernières émissions TV</h2>
		<?php
		if (isset($_GET['diffusion']) && $_GET['diffusion'] != '') {
			$diffusion = strtotime($_GET['diffusion']);
			$argsTest = array(
				'post_type' => array('emission'),
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
			'post_type' => array('emission'),
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


		if ($queryNews->have_posts()) : ?>
			<?php
			while ($queryNews->have_posts()) : $queryNews->the_post();
				$heure = '';
				if (types_render_field('horaire-debut') == '') {
					$heure = get_the_date('d F Y');
				} else {
					$heure = types_render_field('horaire-debut', array('format' => '\d\u d F Y'));
				}
			?>

				<a href="<?php echo get_the_permalink(); ?>">
					<div class="bottom--emmissions-list">
						<?php
						$terms = get_the_terms($post->ID, 'type_emissions');
						foreach ($terms as $term) {
							$image = apply_filters(
								'taxonomy-images-get-terms',
								'',
								array(
									'taxonomy' => 'type_emissions',
									'term_args' => array(
										'slug' => $term->slug,
									)
								)
							);

							foreach ((array) $image as $img) { ?>
								<img src="<?php echo wp_get_attachment_image_url($img->image_id, 'rss-thumb'); ?>">
						<?php
							}
							$PostTypeSLUG = $term->slug;
						}
						if ($PostTypeSLUG == "lair-du-temps" || $PostTypeSLUG == "autreslugdeposte") {
							echo "<span><b>" . get_the_title() . "</b></span>";
						} else {
							echo "<span><b>" . get_the_title() . "</b> " . $heure . "</span>";
						}
						?>
					</div>
				</a>

			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php else: ?>
		<?php endif; ?>
	</section>


	<section class="footer-block" style="background: linear-gradient(0deg, rgb(255,91,168) 0%, rgb(255,91,168) 25%, rgba(235,31,124,1) 100%);display: inline-block;width: 70%;padding: 10px;color: #FFFFFF;padding-left: 15%;padding-right: 15%;">
		<h2> &Eacute;couter nos derniers podcasts</h2>
		<?php
		if (isset($_GET['diffusion']) && $_GET['diffusion'] != '') {
			$diffusion = strtotime($_GET['diffusion']);
			$argsTest = array(
				'post_type' => array('radio-chronique', 'radio-emission'),
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


			if ($queryTest->have_posts()) {
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
			} else {
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
			'post_type' => array('radio-chronique', 'radio-emission'),
			'posts_per_page' => 6,
			'meta_query' => array(
				array(
					'key' => 'wpcf-video-chronique',
					'value'   => '',
					'compare' => '!='
				),
				array(
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
		if ($queryNews->have_posts()) : ?>
			<?php
			while ($queryNews->have_posts()) : $queryNews->the_post();
				$heure = '';
				if (types_render_field('date-chronique') == '') {
					$heure = get_the_date('d F Y');
				} else {
					$heure = types_render_field('date-chronique', array('format' => '\d\u d F Y'));
				}
			?>

				<a href="<?php echo get_the_permalink(); ?>">
					<div class="bottom--emmissions-list">
						<?php
						$termsrch = get_the_terms($post->ID, 'radio-type_emissions');
						if ($termsrch) {
							foreach ($termsrch as $termr) {
								$PostTypeSLUGRCH = $termr->slug;
							}
						}
						?>
						<?php echo get_the_post_thumbnail(get_the_ID(), 'rss-thumb'); ?>
						<?php
						if ($PostTypeSLUGRCH == "le-12h30-toujours-plus-actu" || $PostTypeSLUGRCH == "toujours-plus-actu") {
							echo "<span><b>" . get_the_title() . "</b></span>";
						} else {
							echo "<span><b>" . get_the_title() . "</b> " . $heure . "</span>";
						}
						?>
					</div>
				</a>

			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php else: ?>
		<?php endif; ?>
	</section>

<?php } ?>
<div class="pubBottom">
	<?php if (is_user_logged_in() && (array_key_exists('nopub', $_COOKIE) && $_COOKIE['nopub'] == 'on')): ?>
		<!-- Nopub activé -->
	<?php else: ?>
		<!-- ads - zone images publicitaires bannering_footer -->
		<div id="gestcom_54"></div>
	<?php endif; ?>
</div>

<footer class="footerPartners">
	<div class="inside">
		<?php
		$argsPartenaires = array(
			'post_type' => 'partenaires',
			'posts_per_page' => -1
		);

		$queryPartenaires = new WP_Query($argsPartenaires);

		if ($queryPartenaires->have_posts()) { ?>

			<div class="row" data-equalizer data-options="equalize_on_stack: true">

				<?php
				while ($queryPartenaires->have_posts()) : $queryPartenaires->the_post();
					$partner_link =  types_render_field('partenaires-url');
					if (empty($partner_link)) {
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
		<?php wp_nav_menu(array('theme_location' => 'footer3')); ?>
		<p class="footerEnd__signature">
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
			<span>© BX1 <?php echo date("Y"); ?></span>
		</p>
	</div>
</footer>

</div>

<?php if (!is_page('mobilite')): ?>
	<?php wp_footer(); ?>
<?php endif; ?>

<?php
if (is_page('Accueil_v2')):
	// Si il y a au moins 2 lives (donc au moins le direct tv + un live web), on passe le 1er (le direct tv) et on affiche le 2e uniquement
	$argsVideo = array(
		'post_type' => array('lives'),
		'posts_per_page' => 1,
		'orderby' => array('date' => 'DESC'),
		'offset' => '1'
	);
	$queryVideo = new WP_Query($argsVideo);
	if ($queryVideo->have_posts()) :
		while ($queryVideo->have_posts()) : $queryVideo->the_post();
?>
			<div class="liveMini">
				<button class="liveMini__close">&times;</button>
				<div class="liveMini__inside">
					<?php
					$extlink = types_render_field('lien-externe');
					if (!empty($extlink)) {
						$link = $extlink;
					} else {
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
									"file": "https://<?php echo types_render_field('url-du-live'); ?>/playlist.m3u8",
									"type": "mp4"
								}, {
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
<?php endwhile;
		wp_reset_postdata();
	endif;
endif; ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		function bindMenuHover(menuText) {
			var timeout;

			// Cibler les <a> DANS #menu-home-v2_menu
			var $menuItem = $("#menu-home-v2_menu a").filter(function() {
				return $(this).text().trim() === menuText;
			}).parent();

			var $subMenu = $menuItem.find(".sub-menu");

			$menuItem.on("mouseenter", function() {
				clearTimeout(timeout);
				$subMenu.stop(true, true).css("display", "block");
			});

			$menuItem.on("mouseleave", function() {
				timeout = setTimeout(function() {
					$subMenu.stop(true, true).css("display", "none");
				}, 300);
			});

			$subMenu.on("mouseenter", function() {
				clearTimeout(timeout);
			});

			$subMenu.on("mouseleave", function() {
				timeout = setTimeout(function() {
					$subMenu.stop(true, true).css("display", "none");
				}, 300);
			});
		}

		// Appliquer le comportement aux deux onglets
		bindMenuHover("Ma commune");
		bindMenuHover("Info");
	});
</script>



<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<?php if (is_user_logged_in()): ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>
<?php endif; ?>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- A placer en bas de page juste avant la balise /body -->
<script src="https://gestcom.divercom.be/w/bx1/30" async defer></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4EDZJXK2F4"></script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'G-4EDZJXK2F4');
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</body>

</html>