<?php
// Load the wp-load.php file to access the WordPress environment
require_once(__DIR__ . '/../../../wp-load.php');
require_once(__DIR__ . "/../../../wp-admin/includes/image.php");
require_once(__DIR__ . "/../../../wp-admin/includes/file.php");
require_once(__DIR__ . "/../../../wp-admin/includes/media.php");

// Define the root directory of the website
$WPDIR = $_SERVER['DOCUMENT_ROOT'];
$WPURL = get_site_url();

// Determine the current environment (staging or prod), default is 'staging'
$section = (defined('WP_ENV') && WP_ENV) ? WP_ENV : 'staging';

// Set the path to the daletmeta folder based on the environment
$DALETMETA = $WPDIR . "/daletmeta/" . $section;

$THEME_DIR = get_stylesheet_directory_uri();

if (isset($_GET["section"]) && isset($_GET["file"])) {
	$section 	= $_GET["section"];
	$filename	= $_GET["file"];

	$post_id 	= '';
	//$desc 		= $description;
	$url 		= $WPURL . "/wp-content/uploads/DaletMetaImg/" . $filename . ".JPG";
	//$url = "https://staging.bx1.be/wp-content/uploads/DaletMetaImg/EJL999998.JPG";


	$tmp 		= download_url($url);

	$file_array = array(
		'name' 		=> basename($url),
		'tmp_name' 	=> $tmp
	);

	$attachmentuploadfile_id = media_handle_sideload($file_array);
	// If error in storing the image
	if (is_wp_error($attachmentuploadfile_id)) {
		return $attachmentuploadfile_id;
		@unlink($file_array['tmp_name']);
	}
	if ($_GET["action"] == "update") {
		$PostID = $_GET["postid"];
		delete_post_thumbnail($PostID);
		set_post_thumbnail($PostID, $attachmentuploadfile_id);
	}
	print_r($attachmentuploadfile_id);
	@unlink($tmp);
}
