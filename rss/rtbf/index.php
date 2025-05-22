<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">
  <channel>
    <title>BX1</title>
    <link>http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?></link>
    <description>BX1 JT feed</description>
    <language>fr</language>
<?php 
//Let's use WP functions
require_once("../../wp-load.php");

//We get all POSTS with a term_taxonomy of 95, or all Journal Télévisé
$feed_query = 'select wp.ID, wp.post_title, wp.post_date_gmt, wm.meta_value 
from wp_posts wp 
LEFT JOIN wp_term_relationships wr
ON wp.ID = wr.object_id 
LEFT JOIN wp_postmeta wm
ON wp.ID = wm.post_id
WHERE wr.term_taxonomy_id = 95 AND
wm.meta_key = "wpcf-nom-du-fichier-video" AND
wp.post_status = "publish"
ORDER by wp.ID desc
LIMIT 10;';

//Query the DB
$results = $wpdb->get_results($feed_query);

//Print results


foreach( $results as $result ) {
?>
<item>
	<title><?php echo htmlspecialchars($result->post_title);?></title>
	<link>http://bx1.be/?p=<?php echo $result->ID;?></link>
	<pubDate><?php echo gmdate(r,strtotime($result->post_date_gmt)); ?></pubDate>
	<guid isPermaLink="false"><?php echo $result->ID;?></guid>
	<video>rtmp://62.210.248.77:1935/vod/mp4:<?php echo $result->meta_value;?>.mp4</video>
</item> 
<?php
}

?>
  </channel>
</rss>
