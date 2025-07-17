<?php header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<rss xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:spotify="http://www.spotify.com/ns/rss" version="2.0">
  <channel>
    <title>BX1+ - En Stoemelings</title>
    <link>
    https://bx1plus.be/
    </link>
    <description>En Stoemelings, c’est l’émission musicale de Sébastien Van Mulders qui vous présente du lundi au vendredi, de 13h30 à 14h00, un.e artiste musical.e de la Fédération Wallonie-Bruxelles.
    </description>
    <itunes:summary>En Stoemelings, c’est l’émission musicale de Sébastien Van Mulders qui vous présente du lundi au vendredi, de 13h30 à 14h00, un.e artiste musical.e de la Fédération Wallonie-Bruxelles.
    </itunes:summary>
    <copyright>BX1 &#xA9; <?php echo date("Y"); ?>. Tous droits réservés.</copyright>
    <image>
      <url>https://bx1.be/wp-content/uploads/2020/11/Logo-En-Stoemelings-Podcast.png</url>
      <title>En Stoemelings</title>
      <link>https://bx1plus.be/</link>
    </image>
    <itunes:author>BX1</itunes:author>
    <itunes:owner>
      <itunes:name>BX1</itunes:name>
      <itunes:email>web@bx1.be</itunes:email>
    </itunes:owner>
    <itunes:explicit>false</itunes:explicit>
    <itunes:category text="News" />
    <language>fr</language>
    <spotify:countryOfOrigin>be</spotify:countryOfOrigin>
    <lastBuildDate><?php
                    $dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
                    echo $dt->format('D, d M y H:i:s O');
                    ?></lastBuildDate>
    <itunes:image href="https://bx1.be/wp-content/uploads/2020/11/Logo-En-Stoemelings-Podcast.png" />
    <?php
    //Let's use WP functions
    require_once("../../../wp-load.php");
    date_default_timezone_set('Europe/Brussels');
    $loop = new WP_Query(array('post_type' => 'radio-emission', 'meta_key' => '_yoast_wpseo_primary_radio-type_emissions', 'meta_value' => '15803', 'posts_per_page' => -1));
    while ($loop->have_posts()) :
      $loop->the_post();
      $do_not_duplicate[] = $post->ID;
      if (types_render_field('video-chronique') != "") {
    ?>
        <item>
          <title><?php echo get_the_title(); ?></title>
          <guid>https://bx1.be/?p=<?php echo $post->ID; ?></guid>
          <link>https://bx1.be/?p=<?php echo $post->ID; ?></link>
          <pubDate><?php echo date(DATE_RFC822, get_post_meta($post->ID, 'wpcf-date-chronique', true)); ?></pubDate>
          <author>web@bx1.be (BX1)</author>
          <itunes:author>bx1</itunes:author>
          <itunes:explicit>false</itunes:explicit>
          <itunes:image href="https://bx1.be/wp-content/uploads/2020/11/Logo-En-Stoemelings-Podcast.png" />
          <enclosure url="https://bx1.be/videofiles/<?php echo types_render_field('video-chronique'); ?>.mp3" type="audio/mpeg" length="1" />
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