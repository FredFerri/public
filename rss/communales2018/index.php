<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
    <title>BX1 - Communales 2018</title>
    <link>https://bx1.be/rss/communales2018/</link>
    <description>BX1 - Communales 2018</description>
    <language>fr</language>
<?php 
//Let's use WP functions
require_once("../../wp-load.php");
  $loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '-1', 'tag' => 'communales-2018'));
    while ( $loop->have_posts() ) :
      $loop->the_post();
      $do_not_duplicate[] = $post->ID;
      //add_image_size( 'rss-thumb', 260, 9999 );
      //add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;     
      $newimage   = $image[0];
      $categories = wp_get_post_categories($post->ID);
      $catcount   = count($categories);
      ?>  <item>
    <guid><?php echo $post->ID;?></guid>
    <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
    <title><?php echo get_the_title();?></title>
    <link><?php echo get_permalink($post->ID);?></link>
    <description><?php echo get_the_excerpt();?></description>
    <enclosure url="<?php echo  $newimage;?>" type="image/jpeg"/>
<?php 
$id2cp	=	array('4' => '1070', '5' => '1160', '6' => '1082', '7' => '1000', '3718' => '1620', '3718' => '1620', '3927' => '1630', '2506' => '1040', '9' => '1140', '10' => '1190', '11' => '1083', '12' => '1050', '13' => '1090', '14' => '1081', '3680' => '1950', '3925' => '1950', '3917' => '1630', '15' => '1080', '4440' => '1080', '2540' => '1640', '16' => '1060', '17' => '1210', '18' => '1030', '19' => '1180', '20' => '1170', '3147' => '1780', '3929' => '1780', '3930' => '1970', '6674' => '1970', '21' => '1200', '22' => '1150');
if(in_array('4',$categories)){$cp = '1070';}
if(in_array('5',$categories)){$cp = '1160';}
if(in_array('6',$categories)){$cp = '1082';}
if(in_array('7',$categories)){$cp = '1000';}
if(in_array('3718',$categories)){$cp = '1620';}
if(in_array('3718',$categories)){$cp = '1620';}
if(in_array('3927',$categories)){$cp = '1630';}
if(in_array('2506',$categories)){$cp = '1040';}
if(in_array('9',$categories)){$cp = '1140';}
if(in_array('10',$categories)){$cp = '1190';}
if(in_array('11',$categories)){$cp = '1083';}
if(in_array('12',$categories)){$cp = '1050';}
if(in_array('13',$categories)){$cp = '1090';}
if(in_array('14',$categories)){$cp = '1081';}
if(in_array('3680',$categories)){$cp = '1950';}
if(in_array('3925',$categories)){$cp = '1950';}
if(in_array('3917',$categories)){$cp = '1630';}
if(in_array('15',$categories)){$cp = '1080';}
if(in_array('4440',$categories)){$cp = '1080';}
if(in_array('2540',$categories)){$cp = '1640';}
if(in_array('16',$categories)){$cp = '1060';}
if(in_array('17',$categories)){$cp = '1210';}
if(in_array('18',$categories)){$cp = '1030';}
if(in_array('19',$categories)){$cp = '1180';}
if(in_array('20',$categories)){$cp = '1170';}
if(in_array('3147',$categories)){$cp = '1780';}
if(in_array('3929',$categories)){$cp = '1780';}
if(in_array('3930',$categories)){$cp = '1970';}
if(in_array('6674',$categories)){$cp = '1970';}
if(in_array('21',$categories)){$cp = '1200';}
if(in_array('22',$categories)){$cp = '1150';}
?>
    <category><?php echo $cp; ?></category>
  </item>
<?php
  if ($catcount >= 4)
    {
      for ($i=3; $i < $catcount; $i++) { 
      	foreach ($categories as $communeID ) {
      		$finalcp	=	$id2cp[$communeID];
      		if($finalcp != $cp && $communeID != '4687' && $communeID != '1')
      			{ ?><item>
    <guid><?php echo $post->ID;?></guid>
    <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
    <title><?php echo get_the_title();?></title>
    <link><?php echo get_permalink($post->ID);?></link>
    <description><?php echo get_the_excerpt();?></description>
    <enclosure url="<?php echo  $newimage;?>" type="image/jpeg"/>
	<category><?php echo $finalcp; ?></category>
	</item>
      			<?php }
      	}
        

      }
    }
  endwhile;
  wp_reset_postdata();
  ?>
</channel>
</rss>

