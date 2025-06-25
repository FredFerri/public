<?php
// Load the wp-load.php file to access the WordPress environment
require_once(__DIR__ . '/../../../wp-load.php');
require_once(__DIR__ . "/../../../wp-admin/includes/image.php");
require_once(__DIR__ . "/../../../wp-admin/includes/file.php");
require_once(__DIR__ . "/../../../wp-admin/includes/media.php");

// Determine the current environment (staging or prod), default is 'staging'
$section = (defined('WP_ENV') && WP_ENV) ? WP_ENV : 'staging';

// Define the root directory of the website
$WPDIR = $_SERVER['DOCUMENT_ROOT'];

// Set the path to the daletmeta folder based on the environment
$DALETMETA = $WPDIR . "/daletmeta/" . $section;
$THEME_DIR = get_stylesheet_directory_uri();

if ($_GET["action"] == "deletemedia" && !empty($_GET["mediaid"])) {
	wp_delete_attachment($_GET["mediaid"], true);
} elseif ($_GET['action'] == "deletefile" && isset($_GET['XMLID'])) {
	if (file_exists($DALETMETA . "/" . $_GET['XMLID'])) {
		unlink($DALETMETA . "/" . $_GET['XMLID']);
	} else {
		echo "{\"error\": \"File not found: " . $DALETMETA . "/" . $_GET['XMLID'] . "\"}";
	}
} elseif ($_GET["action"] == "updatepost" && !empty($_GET["postid"])) {
	$XML			= $_GET['file'];
	$filename 		= basename($XML, ".xml");
	$filename 		= basename($filename, ".XML");
	$xmldata 		= simplexml_load_file($XML) or die("Failed to load");
	$Emission   	= (string) $xmldata->Emission;
	$Titre			= (string) $xmldata->TitreArticle;
	$difdate		= (string) $xmldata->Publication;
	$premdiff		= (string) $xmldata->DatePremDiff;
	$Contenu		= (string) $xmldata->TexteArticle;
	$ItemCde		= (string) $xmldata->Itemcode;
	$premdiff		= strtotime($premdiff);
	//echo $premdiff;
	if ($difdate != "") {
		//$difdate		= strtotime($difdate);
		$publication	= 'publish';
	} else {
		$difdate 		= new DateTime("now", new DateTimeZone('Europe/Brussels'));
		$difdate		= strtotime($difdate->format('Y-m-d H:i:s'));
		$publication	= 'draft';
	}
	$post_update = array(
		'ID'         	=> $_GET["postid"],
		'post_title'    => $Titre,
		'post_content'  => $Contenu,
		'post_status'   => $publication,
		'post_author'   => 1,
		'post_date'     => $difdate,
		'post_type'	  	=> 'emission',
		'meta_input'	=> array(
			'wpcf-nom-du-fichier-video'	=> $filename,
			'wpcf-horaire-debut'		=> $premdiff
		)
	);

	wp_update_post($post_update);
} elseif ($_GET['action'] == "addemissionfile" && isset($_GET['ShowID']) && isset($_GET['XMLID'])) {
	$emissionfile 	= fopen($DALETMETA . "/" . $_GET['XMLID'] . "_codeemission.txt", "w") or die("Unable to open file!");
	$txt = $_GET['ShowID'];
	fwrite($emissionfile, $txt);
	fclose($emissionfile);
}
