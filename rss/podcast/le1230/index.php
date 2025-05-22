<?xml version="1.0" encoding="utf-8" ?>
<rss xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:spotify="http://www.spotify.com/ns/rss" version="2.0">
<channel>
    <title>BX1+ - Le 12h30</title>
    <link>
    https://bx1plus.be/
  </link>
    <description>Murielle Berck, Jim Moskovics, Fanny Rochez et Vanessa Lhuillier font une synthèse de l’actualité de la mi-journée dans le 12h30, à suivre du lundi au vendredi.</description>
    <itunes:summary>Murielle Berck, Jim Moskovics, Fanny Rochez et Vanessa Lhuillier font une synthèse de l’actualité de la mi-journée dans le 12h30, à suivre du lundi au vendredi.</itunes:summary>
    <copyright>BX1 &#xA9; <?php echo date("Y");?>. Tous droits réservés.</copyright> 
    <image>
      <url>https://bx1.be/wp-content/uploads/2022/01/Logo-12h30-Podcast.jpg</url> 
      <title>Le 12h30</title> 
      <link>https://bx1plus.be/</link>
    </image>
    <itunes:author>BX1</itunes:author> 
    <itunes:owner>
      <itunes:name>BX1+</itunes:name>
      <itunes:email>web@bx1.be</itunes:email>
    </itunes:owner>
    <itunes:explicit>no</itunes:explicit>
    <itunes:category text="News" />
    <itunes:explicit>false</itunes:explicit>
    <itunes:summary/>    
    <language>fr</language>
    <spotify:countryOfOrigin>be</spotify:countryOfOrigin>
    <lastBuildDate><?php 
$dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
echo $dt->format('D, d M Y H:i:s O');
    ?></lastBuildDate> 
    <itunes:image href="https://bx1.be/wp-content/uploads/2022/01/Logo-12h30-Podcast.jpg" />
<?php 
//Let's use WP functions
require_once("../../../wp-load.php");
date_default_timezone_set('Europe/Brussels');
  $loop = new WP_Query( array('post_type' => 'radio-emission', 'meta_key' => '_yoast_wpseo_primary_radio-type_emissions','meta_value' => '13259','posts_per_page' => -1));
    while ( $loop->have_posts() ) :
      $loop->the_post();
      $do_not_duplicate[] = $post->ID;
      if (types_render_field('video-chronique') != ""){
      ?>
    <item>  
      <title><?php echo get_the_title(); ?></title>
      <guid>https://bx1.be/?p=<?php echo $post->ID;?></guid>
      <link>https://bx1.be/?p=<?php echo $post->ID;?></link>
      <pubDate><?php echo date(DATE_RFC1123, get_post_meta ($post->ID, 'wpcf-date-chronique', true));?></pubDate>
      <author>web@bx1.be (BX1)</author>
      <itunes:author>bx1</itunes:author>
      <itunes:explicit>false</itunes:explicit>
      <itunes:image href="https://bx1.be/wp-content/uploads/2022/01/Logo-12h30-Podcast.jpg" />
      <enclosure url="https://dts.podtrac.com/redirect.mp3/bx1.be/videofiles/<?php echo types_render_field('video-chronique');?>.mp3" type="audio/mpeg" length="1"/>
      <itunes:duration><?php echo types_render_field('duree-chronique');?></itunes:duration>
      <?php

        //Create XML Friendly Title

        $badchar    = array("&");
        $goodchar   = array("-");

        $goodsummary = str_replace($badchar, $goodchar, types_render_field('sous-titre-itunes'));
        ?>
      <itunes:summary><?php echo $goodsummary;?></itunes:summary>
      <description><?php echo $goodsummary;?></description>
    </item>
  <?php
}
    endwhile;
 ?>
</channel>
</rss>