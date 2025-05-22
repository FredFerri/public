<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
    <title>Télé Bruxelles JT</title>
    <link>http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?></link>
    <description>Télé Bruxelles JT feed</description>
    <language>fr</language>
<?php 
//Let's use WP functions
require_once("../../wp-load.php");

  $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'jt1230'));
    while ( $loop->have_posts() ) :
      $loop->the_post();
      $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
  <?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;     
    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>12H30</category>
  </item>
  <?php
  endwhile;
  wp_reset_postdata();
  $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'interview'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>INTERVIEW</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
    $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'jt1800'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>18H00</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
    $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'MEMISSION'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>M</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
    $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'after'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>AFTER</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
    $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'experts'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>EXPERTS</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
    $loop = new WP_Query( array('post_type' => 'programms-tv-mire', 'posts_per_page' => 1, 'meta_key' => 'wpcf-programme-mire','meta_value' => 'octave'));
    while ( $loop->have_posts() ) : $loop->the_post();
    $do_not_duplicate[] = $post->ID;
      ?>
    <item>
      <guid><?php echo $post->ID;?></guid>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <title><?php echo get_the_title_rss();?></title>
<?php
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;    
 ?>
    <comments><?php echo  $newimage;?></comments>
    <category>OCTAVE</category>
  </item>
  <?php
    endwhile;
    wp_reset_postdata();
  ?>
</channel>
</rss>