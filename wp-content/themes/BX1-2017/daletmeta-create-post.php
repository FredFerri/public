<?php
// Disable WordPress theme loading since this is a standalone script
define('WP_USE_THEMES', false);

// Load WordPress core functionality so we can use WordPress functions
require_once(__DIR__ . '/../../../wp-load.php');

// Get the root directory path of the website from server variables
$WPDIR = $_SERVER['DOCUMENT_ROOT'];

// Check if we're in staging or production environment
// If WP_ENV is defined, use it; otherwise default to 'staging'
$section = (defined('WP_ENV') && WP_ENV) ? WP_ENV : 'staging';

// Build the path to the daletmeta folder based on environment
$DALETMETA = $WPDIR . "/daletmeta/" . $section;

// Get the current theme's URL
$THEME_DIR = get_stylesheet_directory_uri();

// Get parameters from the URL query string
$imgattached 	= $_GET["attachid"];     // ID of attached image
$codeemi		= $_GET["codeemission"]; // Emission code
$XML			= $DALETMETA . '/' . $_GET['file']; // Full path to XML file
$filename 		= basename($XML, ".xml"); // Get filename without .xml extension
$filename 		= basename($filename, ".XML"); // Also remove .XML (uppercase)

// Load and parse the XML file, or stop execution if it fails
$xmldata 		= simplexml_load_file($XML) or die("Failed to load");

// Extract data from XML into variables
$Emission   	= (string) $xmldata->Emission;      // Emission name
$Titre			= (string) $xmldata->TitreArticle;  // Article title
$difdate		= $xmldata->Publication;            // Publication date
$premdiff		= (string) $xmldata->DatePremDiff;  // First broadcast date
$Contenu		= (string) $xmldata->TexteArticle;  // Article content
$ItemCde		= (string) $xmldata->Itemcode;      // Item code

// Create a new database connection using WordPress database credentials
$wpdatabase 		= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

// Query to get the broadcast time for this emission
$queryheure	= "SELECT meta_value FROM wp_termmeta WHERE term_id = " . $codeemi . " AND meta_key = 'wpcf-horaire-diffusion'";
$resultheure = $wpdatabase->get_results($queryheure);

// Extract the broadcast time from query results
foreach ($resultheure as $heureemission) {
	$heure = $heureemission->meta_value;
}

// Process the first broadcast date
$premdiff	= explode("T", $premdiff); // Split date and time
$premdiff 	= $premdiff[0] . "T" . $heure . ":00.000"; // Combine date with broadcast time
$premdiff   = strtotime($premdiff); // Convert to timestamp

// Handle different date scenarios based on URL parameter
if ($_GET['difdate'] == 1) {
	// Convert UTC time to Brussels timezone
	$utcTimezone = new DateTimeZone('UTC');
	$dt = new DateTime($difdate, $utcTimezone);

	// Change timezone to Brussels
	$bxlTimezone = new DateTimeZone('Europe/Brussels');
	$dt->setTimezone($bxlTimezone);

	// Format the date for WordPress
	$difdate	=	$dt->format('Y-m-d H:i:s T');
	$publication	= 'publish'; // Set post status to published
} else {
	// Use the first broadcast date instead
	$difdate		= $premdiff;
	$publication	= 'publish'; // Set post status to published
}

// Prepare data array for creating a new WordPress post
$post_data 	= array(
	'post_title'    => $Titre,        // Post title
	'post_content'  => $Contenu,      // Post content
	'post_status'   => $publication,  // Post status (publish/draft/etc)
	'post_author'   => 30,            // Author ID
	'post_date'     => $difdate,      // Publication date
	'post_type'	  	=> 'emission',    // Custom post type
	'meta_input'	=> array(         // Custom fields for the post
		'wpcf-nom-du-fichier-video'	=> $filename,
		'wpcf-horaire-debut'		=> $premdiff,
		'wpcf-bx1-content-type'		=> 'tv',
		'wpcf-banniere-pub-haut'	=> '',
		'wpcf-banniere-pub-droite'	=> '',
		'wpcf-horaire-fin'			=> '',
		'wpcf-featured-news'		=> ''
	)
);

// Create the post in WordPress and get the post ID
$postid = wp_insert_post($post_data, true);

// Create error object (though not used effectively here)
$error = new WP_Error($postid);

// Set the featured image for the post
set_post_thumbnail($postid, $imgattached);

// Create another database connection (redundant - could reuse $wpdatabase)
$wpdatabs 			= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

// Insert relationship between post and emission category
$query 				= "INSERT INTO wp_term_relationships(object_id,term_taxonomy_id,term_order) VALUES('" . $postid . "'," . $codeemi . ",0)";
$results 			= $wpdatabs->get_results($query);

// Get the content of the newly created post
$checkcontent		= "SELECT * FROM `wp_posts` WHERE ID = " . $postid;
$postcontent		= $wpdatabs->get_results($checkcontent);

// Extract post content from query results
foreach ($postcontent as $content) {
	$CurrentContent = $content->post_content;
}

// Insert metadata into custom table for tracking
$query 		= "INSERT INTO bx1_daletmeta(filename,TexteArticleSum,ShowID,PostID,ItemCode,ImageID) VALUES('" . $XML . "','" . md5($CurrentContent) . "'," . $codeemi . "," . $postid . ",'" . $ItemCde . "'," . $imgattached . ")";
$results 	= $wpdatabs->get_results($query);

// Commented out debug line
//echo $query;
