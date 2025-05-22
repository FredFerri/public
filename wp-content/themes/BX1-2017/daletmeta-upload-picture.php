<?php
if (isset($_GET["section"]) && isset($_GET["file"])){
	$section 	= $_GET["section"];
	$filename	= $_GET["file"];
	switch ($section){
		case 'staging':
			$WPDIR = '/data/sites/bx1.be/staging.bx1.be';
			$WPURL = 'staging.bx1.be';
			break;
		case 'prod':
			$WPDIR = '/data/sites/bx1.be/httpdocs';	
			$WPURL = 'bx1.be';
			break;
	}
	include_once($WPDIR."/wp-load.php");
	require_once($WPDIR."/wp-admin/includes/image.php");
	require_once($WPDIR."/wp-admin/includes/file.php");
	require_once($WPDIR."/wp-admin/includes/media.php");
	$post_id 	= '';
	//$desc 		= $description;
	$url 		= "https://" . $WPURL . "/wp-content/uploads/DaletMetaImg/".$filename.".JPG";
	//$url = "https://staging.bx1.be/wp-content/uploads/DaletMetaImg/EJL999998.JPG";
	$tmp 		= download_url( $url );
	$file_array = array(
		'name' 		=> basename( $url ),
		'tmp_name' 	=> $tmp
	);
	$attachmentuploadfile_id = media_handle_sideload( $file_array );
	// If error in storing the image
	if ( is_wp_error($attachmentuploadfile_id) ) {
		return $attachmentuploadfile_id;
		@unlink($file_array['tmp_name']);
	}
	if ($_GET["action"] == "update")
		{
			$PostID = $_GET["postid"];
			delete_post_thumbnail($PostID);
			set_post_thumbnail( $PostID, $attachmentuploadfile_id );
		}
	print_r($attachmentuploadfile_id);
	@unlink( $tmp );
}

?>
