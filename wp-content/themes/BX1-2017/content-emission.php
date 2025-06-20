<?php

/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1><?php the_title(); ?></h1>

	<?php
	$terms = get_the_terms($post->ID, 'type_emissions');
	$IDArticle = $post->ID;
	foreach ($terms as $term) {
		$termID[]     =   $term->term_id;
	}

	$the_term_id      = $termID[0];
	$termName = get_term($the_term_id)->slug;
	$the_term_name    = $termName;
	?>



	<div class="content">
		<?php
		$videoName = types_render_field('nom-du-fichier-video', array('raw' => 'true'));
		if (!empty($videoName)) { ?>
			<div>
				<div id="videoLive"></div>
				<div id="video"></div>
			</div>

			<script>
				document.addEventListener("gestcomVideo", function(e) {
					jwplayer("video").setup({
						playlist: [{
								sources: [{
									file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4" + "/playlist.m3u8"
								}, {
									file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"
								}],
								<?= get_subtitle_track(types_render_field('nom-du-fichier-video')); ?>
							},
							<?php
							$type_emissions = array('taxonomy' => 'type_emissions', 'field' => 'slug', 'terms' => $the_term_name);
							if (isset($_GET['diffusion']) && $_GET['diffusion'] != '') {
								$diffusion = strtotime($_GET['diffusion']);
								$argsTest = array(
									'post_type' => array('emission'),
									'posts_per_page' => 1,
									'meta_query' => array(
										array(
											'key' => 'wpcf-nom-du-fichier-video',
											'value'   => '',
											'compare' => '!='
										),
										array(
											'key' => 'wpcf-nom-du-fichier-video',
											'value'   => $videoName,
											'compare' => '!='
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
								$queryTest = new WP_Query($argsTest);
								if ($queryTest->have_posts()) {
									$diffusion_new = array(
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
							$argsNews = array(
								'post_type' => array('emission'),
								'posts_per_page' => 10,
								'meta_query' => array(
									array(
										'key' => 'wpcf-nom-du-fichier-video',
										'value'   => '',
										'compare' => '!='
									),
									array(
										'key' => 'wpcf-nom-du-fichier-video',
										'value'   => $videoName,
										'compare' => '!='
									),
									$diffusion_new
								),
								'tax_query' => array(
									$type_emissions
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
									if (types_render_field('horaire-debut') == '') {
										$heure = get_the_date('d F Y à H:i');
									} else {
										$heure = types_render_field('horaire-debut', array('format' => '\d\u d F Y \à H:i'));
									}
								?> {

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
											echo "title : \"" . get_the_title() . " " . $heure . "\",";
											//echo "description : \"" . get_the_title() . "\",";
											foreach ((array) $image as $img) {
												echo "image : \"" . wp_get_attachment_image_url($img->image_id, 'Emissions') . "\",";
											}
										}
										?>
										sources: [{
												file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4" + "/playlist.m3u8"
											}, {
												file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + "<?php echo types_render_field('nom-du-fichier-video'); ?>" + ".mp4"
											}],
											<?= get_subtitle_track(types_render_field('nom-du-fichier-video')); ?>
									},
								<?php endwhile;
								wp_reset_postdata(); ?>
							<?php else: ?>
							<?php endif; ?>
						],
						androidhls: true,
						hlshtml: true,
						displaytitle: "true",
						width: "100%",
						aspectratio: "16:9",
						autostart: false,

						<?php
						if ($_SERVER["REMOTE_ADDR"] == "91.178.100.235") {
							echo "mute: true,";
							$PUB = 'off';
						} else {
							echo "mute: false,";
						}
						?>
						<?php
						//$PUB = 'off';
						if ((is_user_logged_in() && $_COOKIE['nopub'] == 'on' || types_render_field('no-pre-roll') == '1') ||  $PUB == 'off'): //nopub 
						?>
							advertising: false
						<?php else: ?>
							localization: {
								loadingAd: 'Chargement de la publicité',
								liveBroadcast: 'Direct'
							},
							advertising: {
								client: 'vast',
								admessage: 'Cette publicité se termine dans xx secondes',
								skipmessage: 'Continuer vers l\'article dans XX secondes',
								skiptext: 'Continuer',

								skipoffset: 5,
								<?php if (get_term_meta($the_term_id, 'wpcf-video-pre-roll', true) != ''): ?>
									schedule: {
										adbreak1: {
											offset: "pre",
											tag: '<?php echo types_render_termmeta('video-pre-roll', array('term_id' => $the_term_id)); ?>'
										}
									}
								<?php else: ?>

									schedule: (e.detail.vastUrl != undefined && e.detail.vastUrl != null && e.detail.vastUrl != '' ? [{
										tag: e.detail.vastUrl,
										offset: "pre"
									}, {
										tag: e.detail.vastUrl.replace('vst.xml', 'vst2.xml'),
										offset: "pre"
									}] : [])

								<?php endif; ?>
							}
						<?php endif; ?>
					})
				});
			</script>
		<?php } else {

			the_post_thumbnail();
		}  ?>

		<div class="content">
			<?php the_content(); ?>
		</div>

		<div class="meta">

			<h2>Diffusion</h2>
			<?php
			$heure = '';
			if (types_render_field('horaire-debut') == '') {
				$heure = get_the_date('d F Y à H:i');
			} else {
				$heure = types_render_field('horaire-debut', array('format' => 'd F Y \d\e H:i')) . ' à ' . types_render_field('horaire-fin', array('format' => 'H:i'));
			}
			?>
			<div class="date"><?php echo ($heure); ?></div>
			<h2>Partager l'émission</h2>
			<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_whatsapp"></a>
				<a class="a2a_dd"></a>
			</div>
			<ul class="tags">
				<?php the_tags('<li>', '</li><li>', '</li>') ?>
				<li><?php the_category('</li><li>'); ?>
					<?php the_terms($post->ID, 'type_emissions', '<li>', '</li><li>', '</li>'); ?>
					<?php the_terms($post->ID, 'invite', '<li>', '</li><li>', '</li>'); ?></li>
			</ul>
			<?php dynamic_sidebar('sidebar-3'); ?>
		</div>

	</div>
</article>