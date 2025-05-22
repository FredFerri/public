<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : index.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 30 September 2020
 *   Don't edit this code without authorization
 *********************************************/?>
<?xml version="1.0" encoding="utf-8"?>
	<rss version="2.0">
	<channel>
	<title>BX1 CIRB News App</title>
	<link>http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?></link>
	<description>BX1 Mire TV</description>
	<language>fr</language>
<?php
if(isset($_GET['l']))
    {
        $limit = $_GET['l'];
    }
else
    {
        $limit = 10;
    }
//Let's use WP functions
require_once("../../wp-load.php");
  $loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => $limit));
    while ( $loop->have_posts() ) :
	    $loop->the_post();
	    $do_not_duplicate[] = $post->ID;
	    ?>
	    <item>
	        <guid isPermaLink="true"><?php echo get_permalink($post->ID);?></guid>
	        <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
	        <title><?php echo get_the_title_rss();?></title>
		    <description><?php echo get_the_content($post->ID);?></description>
		    <link><?php echo get_permalink($post->ID);?></link>
		    <author>actu@bx1.be</author>
            <enclosure type="<?php
                $id1 = get_post_thumbnail_id($post->ID);
                $type =  get_post_mime_type( $id1 );
                echo $type;
                    ?>" url="<?php
                $image  =   wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                echo $image[0]; ?>" />
	    </item>
	<?php
    endwhile;
    wp_reset_postdata();
  ?>
</channel>
</rss>
