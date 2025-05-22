<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$section 	= $_GET["section"];

switch ($section){
	case 'staging':
		$WPDIR 		= '/data/sites/bx1.be/staging.bx1.be';
		$WPURL 		= 'staging.bx1.be';
		$DALETMETA	= '/data/sites/bx1.be/daletmeta/staging';
		break;
	case 'prod':
		$WPDIR 		= '/data/sites/bx1.be/httpdocs';	
		$WPURL 		= 'bx1.be';
		$DALETMETA	= '/data/sites/bx1.be/daletmeta/prod';
		break;
}
$imgattached 	= $_GET["attachid"];
$codeemi		= $_GET["codeemission"];
$XML			= $DALETMETA . '/' . $_GET['file'];
$filename 		= basename($XML, ".xml");
$filename 		= basename($filename, ".XML");
$xmldata 		= simplexml_load_file($XML) or die("Failed to load");
$Emission   	= (string) $xmldata->Emission;
$Titre			= (string) $xmldata->TitreArticle;
$difdate		= $xmldata->Publication;
$premdiff		= (string) $xmldata->DatePremDiff;
$Contenu		= (string) $xmldata->TexteArticle;
$ItemCde		= (string) $xmldata->Itemcode;


	$wpdatabase 		= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	$queryheure	= "SELECT meta_value FROM wp_termmeta WHERE term_id = " . $codeemi . " AND meta_key = 'wpcf-horaire-diffusion'" ;
	$resultheure= $wpdatabase->get_results($queryheure);
	foreach($resultheure as $heureemission){
		$heure = $heureemission->meta_value;
	}
	
	
	$premdiff	= explode("T", $premdiff);
	$premdiff 	= $premdiff[0]."T".$heure.":00.000";
	$premdiff   = strtotime($premdiff);
	if ($_GET['difdate'] == 1)
		{
			//$difdate		= strtotime($difdate);
			/*date_default_timezone_set("Europe/Brussels");
			$difdate = date("Y-d-m H:i:s", strtotime($difdate." UTC"));
			echo $difdate;*/
			$utcTimezone = new DateTimeZone( 'UTC' );
			$dt = new DateTime($difdate, $utcTimezone);
			
			// change the timezone of the object without changing its time
			$bxlTimezone = new DateTimeZone( 'Europe/Brussels' );
	
			$dt->setTimezone($bxlTimezone);
	
			// format the datetime
			$difdate	=	$dt->format('Y-m-d H:i:s T');
			
			
			$publication	= 'publish';
		}
	else
		{
			$difdate		= $premdiff;
			$publication	= 'publish';
		}
	$post_data 	= array(
  		'post_title'    => $Titre,
  		'post_content'  => $Contenu,
  		'post_status'   => $publication,  
  		'post_author'   => 30,
  		'post_date'     => $difdate,
  		'post_type'	  	=> 'emission',
  		'meta_input'	=> array(
	  			'wpcf-nom-du-fichier-video'	=> $filename,
	  			'wpcf-horaire-debut'		=> $premdiff,
				'wpcf-bx1-content-type'		=> 'tv',
				'wpcf-banniere-pub-haut'	=> '',
				'wpcf-banniere-pub-droite'	=> '',
				'wpcf-horaire-fin'			=> '',
				'wpcf-featured-news'		=> ''
  			)
  		);
 $postid = wp_insert_post( $post_data, true );
 $error = new WP_Error($postid);
set_post_thumbnail( $postid, $imgattached );
$wpdatabs 			= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$query 				= "INSERT INTO wp_term_relationships(object_id,term_taxonomy_id,term_order) VALUES('" . $postid . "'," . $codeemi . ",0)" ;
$results 			= $wpdatabs->get_results($query);
$checkcontent		= "SELECT * FROM `wp_posts` WHERE ID = " . $postid;
$postcontent		= $wpdatabs->get_results($checkcontent);
foreach ( $postcontent as $content )
	{
		$CurrentContent = $content->post_content;
	}
$query 		= "INSERT INTO bx1_daletmeta(filename,TexteArticleSum,ShowID,PostID,ItemCode,ImageID) VALUES('" . $XML . "','" . md5($CurrentContent) . "'," . $codeemi . "," . $postid . ",'" . $ItemCde . "'," . $imgattached . ")" ;
$results 	= $wpdatabs->get_results($query);
//echo $query;


