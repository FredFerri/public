<?php header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<rss xmlns:googleplay="https://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="https://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:spotify="https://www.spotify.com/ns/rss" version="2.0">
	<channel>
		<title>BX1+ - Acteurs de Bruxelles</title>
		<link>
		https://bx1plus.be/
		</link>
		<description>Les Acteurs de Bruxelles, présenté du lundi au vendredi de 10h à 12h par Soraya Amrani, fait le portrait d'une personnalité bruxelloise, à l'occasion d'une interview long format, en direct et in situ.</description>
		<itunes:summary>Les Acteurs de Bruxelles, présenté du lundi au vendredi de 10h à 12h par Soraya Amrani, fait le portrait d'une personnalité bruxelloise, à l'occasion d'une interview long format, en direct et in situ.</itunes:summary>
		<copyright>BX1 &#xA9; <?php echo date("Y"); ?>. Tous droits réservés.</copyright>
		<image>
			<url>https://bx1plus.be/img/podcasts/logo_acteursdebruxelles_grand.jpg</url>
			<title>Les Acteurs de Bruxelles</title>
			<link>https://bx1plus.be/</link>
		</image>
		<itunes:author>BX1</itunes:author>
		<itunes:owner>
			<itunes:name>BX1</itunes:name>
			<itunes:email>web@bx1.be</itunes:email>
		</itunes:owner>
		<itunes:explicit>false</itunes:explicit>
		<itunes:category text="News" />
		<itunes:explicit>false</itunes:explicit>
		<language>fr</language>
		<spotify:countryOfOrigin>be</spotify:countryOfOrigin>
		<lastBuildDate><?php
							$dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
							echo $dt->format('D, d M Y H:i:s O');
							?></lastBuildDate>
		<itunes:image href="https://bx1plus.be/img/podcasts/logo_acteursdebruxelles_grand.jpg" />
		<?php
		//Let's use WP functions
		require_once("../../../wp-load.php");
		date_default_timezone_set('Europe/Brussels');
		$loop = new WP_Query(array('post_type' => 'radio-emission', 'meta_key' => '_yoast_wpseo_primary_radio-type_emissions', 'meta_value' => '13252'));
		while ($loop->have_posts()) :
			$loop->the_post();
			$do_not_duplicate[] = $post->ID;
			if (types_render_field('video-chronique') != "") {
		?>
				<item>
					<title><?php echo get_the_title(); ?></title>
					<guid>https://bx1.be/?p=<?php echo $post->ID; ?></guid>
					<link>https://bx1.be/?p=<?php echo $post->ID; ?></link>
					<?php if ($date_chronique = get_post_meta($post->ID, 'wpcf-date-chronique', true)): ?>
						<pubDate>
							<?php echo date(DATE_RFC1123, $date_chronique); ?>
						</pubDate>
					<?php endif; ?>
					<author>web@bx1.be (BX1)</author>
					<itunes:author>bx1</itunes:author>
					<itunes:explicit>false</itunes:explicit>
					<image>https://bx1plus.be/img/podcasts/logo_acteursdebruxelles_grand.jpg</image>
					<enclosure url="https://dts.podtrac.com/redirect.mp3/bx1.be/videofiles/<?php echo types_render_field('video-chronique'); ?>.mp3" type="audio/mpeg" length="1" />
					<itunes:duration><?php echo types_render_field('duree-chronique'); ?></itunes:duration>
					<?php

					//Create XML Friendly Title

					$badchar    = array("&");
					$goodchar   = array("-");

					$goodsummary = str_replace($badchar, $goodchar, types_render_field('sous-titre-itunes'));
					?>
					<itunes:summary><?php echo $goodsummary; ?></itunes:summary>
					<description><?php echo $goodsummary; ?></description>
				</item>
		<?php
			}
		endwhile;
		?>
	</channel>
</rss>