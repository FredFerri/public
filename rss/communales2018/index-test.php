<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<?php 
//Let's use WP functions
require_once("../../../wp-load.php");

//We get all POSTS with a category description set to the zipcode
$feed_query = 'select wp.ID, wp.post_title, wp.post_excerpt, wp.post_content, wp.post_modified_gmt, wp.post_date_gmt, wt.description, wm.meta_value  
from wp_posts wp , wp_postmeta wm,  wp_term_relationships wr, wp_term_taxonomy wt WHERE  
wt.description = '.basename(__DIR__).'  AND 
wt.term_taxonomy_id = wr.term_taxonomy_id AND 
wt.term_taxonomy_id AND 
wr.object_id = wp.ID AND 
wp.ID = wm.post_id AND 
wm.meta_key = "wpcf-video-name-news" AND
wp.post_status = "publish"
ORDER by wp.ID desc
LIMIT 1000;';

//Query the DB
$results = $wpdb->get_results($feed_query);

//Print results


foreach( $results as $result ) {
$excerpt = explode('.',$result->post_content);
?>
<vivreici>
<article>
	<id><?php echo $result->ID;?></id>
	<permalink>http://bx1.be/?p=<?php echo $result->ID;?></permalink>
	<title><?php echo htmlspecialchars($result->post_title);?></title>
	<excerpt><?php echo htmlspecialchars(strip_tags($excerpt[0]));?></excerpt>
	<content><?php echo htmlspecialchars(strip_tags($result->post_content));?></content>
	<timestamp><?php echo strtotime($result->post_date_gmt);?></timestamp>
	<timestampmodified><?php echo strtotime($result->post_modified_gmt);?></timestampmodified>
	<thumbnail></thumbnail>
	<postalcode><?php echo basename(__DIR__);?></postalcode>
	<media>
		<location>rtmp://62.210.248.77:1935/vod/mp4:<?php echo $result->meta_value;?>.mp4</location>
	</media>
</article> 
<?php
}

?>
</vivreici>
