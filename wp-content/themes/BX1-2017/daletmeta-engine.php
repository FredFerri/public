<?php
date_default_timezone_set('Europe/Brussels');

// Load the wp-load.php file to access the WordPress environment
require_once(__DIR__ . '/../../../wp-load.php');

// Define the root directory of the website
$WPDIR = $_SERVER['DOCUMENT_ROOT'];
$WPURL = get_site_url();

// Determine the current environment (staging or prod), default is 'staging'
$section = (defined('WP_ENV') && WP_ENV) ? WP_ENV : 'staging';

// Set the path to the daletmeta folder based on the environment
$DALETMETA = $WPDIR . "/daletmeta/" . $section;

$THEME_DIR = get_stylesheet_directory_uri();

$version 			= "1.13";

if (!isset($_GET["DEBUG"]) || $_GET["DEBUG"] != 1) {
	$_GET["DEBUG"] = 0;
}
//echo $version;
$listeemissions 	= array();
$logcontent			= '';
// Créer une instance de la classe wpdb
$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

// Vérifier si la connexion à la base de données a réussi
if ($wpdb->ready) {
	//	echo 'Connexion à la base de données réussie !';
} else {
	echo 'Erreur lors de la connexion à la base de données : ' . $wpdb->last_error;
	exit;
}
global $wpdb;

// Exécuter une requête SELECT sur la table wp_termmeta
$query = "SELECT * FROM wp_termmeta WHERE meta_key = \"wpcf-code-emissioncode-emission-dalet\" AND meta_value != ''";
$results = $wpdb->get_results($query);
//echo $query.PHP_EOL;

// Parcourir les résultats de la requête
if ($results) {
	foreach ($results as $result) {
		$terme	=	$result->meta_value;
		if ($terme != '' || empty($terme)) {
			array_push($listeemissions, array($result->meta_value, $result->term_id));
		} else {
			continue;
		}
	}
} else {
	echo 'Aucun résultat trouvé.';
}
//print_r($listeemissions);
$daletdir 	= "";
$videodir	= "";
$wpdirectory = "";
$wpsiteurl = "";

function SetDirectory($dalet, $video, $wpdirtory, $wpsiturl, $stagingprod) {
	global  $daletdir;
	global 	$videodir;
	global 	$wpdirectory;
	global 	$wpsiteurl;
	global 	$stage;
	$daletdir 		= $dalet;
	$videodir   	= $video;
	$wpdirectory	= $wpdirtory;
	$wpsiteurl		= $wpsiturl;
	$stage 			= $stagingprod;
}
SetDirectory($DALETMETA, "", $WPDIR, $WPURL, $section);
function checkemission($emission_file, $emissionarray, $XML) {
	global  $daletdir;
	global 	$wpdirectory;
	global 	$wpsiteurl;
	global 	$stage;

	$traitementemission = FALSE;
	$i = 0;

	require_once(__DIR__ . '/../../../wp-load.php');
	require_once(__DIR__ . '/../../../wp-admin/includes/image.php');
	require_once(__DIR__ . '/../../../wp-admin/includes/file.php');
	require_once(__DIR__ . '/../../../wp-admin/includes/media.php');

	$xmlfilename	= basename($XML);
	$xmldata 		= simplexml_load_file($XML) or die("Failed to load");
	$Emission   	= (string) $xmldata->Emission;
	$Titre			= (string) $xmldata->TitreArticle;
	$difdate		= (string) $xmldata->Publication;
	$Contenu		= (string) $xmldata->TexteArticle;
	$ItemCde		= (string) $xmldata->Itemcode;
	$wpdb 			= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	$checkifpexist	= "SELECT COUNT(*) FROM bx1_daletmeta WHERE ItemCode = '" . $ItemCde . "'";
	$ifpostexist	= $wpdb->get_var($checkifpexist);

	if ($ifpostexist == 1) {
		$checkpost 			= new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		$checkifpexist		= "SELECT * FROM bx1_daletmeta WHERE ItemCode = '" . $ItemCde . "'";
		$postexist 			= $checkpost->get_results($checkifpexist);

		//print_r("Retour : ".$postexist.PHP_EOL);
		foreach ($postexist as $page) {
			$MediaID 			= $page->ImageID;
			$PostID				= $page->PostID;
			$OriginalContent	= $page->TexteArticleSum;

			//Delete Picture
			$ch = curl_init();
			if (empty($difdate) || $difdate == '') {
				$difdate = 0;
			} else {
				$difdate = 1;
			}
			try {


				curl_setopt($ch, CURLOPT_URL, $wpsiteurl . "/wp-content/themes/BX1-2017/daletmeta-actions.php?section=" . $stage . "&action=deletemedia&mediaid=" . $MediaID);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
				$response = curl_exec($ch);
				if (curl_errno($ch)) {
					echo curl_error($ch);
					die();
				}
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($http_code == intval(200)) {
					$postcreation = $response;
				} else {
					echo "Ressource introuvable : " . $http_code;
				}
			} catch (\Throwable $th) {
				throw $th;
			} finally {
				curl_close($ch);
			}
			//Upload New picture
			$ch = curl_init();
			try {
				curl_setopt($ch, CURLOPT_URL, $wpsiteurl . "/wp-content/themes/BX1-2017/daletmeta-upload-picture.php?action=update&postid=" . $PostID . "&section=" . $stage . "&file=" . $emission_file);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
				$response = curl_exec($ch);
				if (curl_errno($ch)) {
					echo curl_error($ch);
					die();
				}
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($http_code == intval(200)) {
					$attach_id = $response;
					$query 		= "UPDATE bx1_daletmeta SET ImageID = " . $attach_id . " WHERE PostID = " . $PostID;
					$wpdb->get_results($query);
				} else {
					echo "Ressource introuvable : " . $http_code;
				}
			} catch (\Throwable $th) {
				throw $th;
			} finally {
				curl_close($ch);
			}
			// Vérification du contenu du post	
			$checkcontent		= "SELECT * FROM `wp_posts` WHERE ID = " . $PostID;
			$postcontent		= $wpdb->get_results($checkcontent);
			foreach ($postcontent as $content) {
				$CurrentContent = md5($content->post_content);
			}

			if ($CurrentContent == $OriginalContent) {
				if (md5($Contenu) != $CurrentContent) {
					$ch = curl_init();
					if (empty($difdate) || $difdate == '') {
						$difdate = 0;
					} else {
						$difdate = 1;
					}
					try {
						curl_setopt($ch, CURLOPT_URL, $wpsiteurl . "/wp-content/themes/BX1-2017/daletmeta-actions.php?section=" . $stage . "&action=updatepost&postid=" . $PostID . "&file=" . $XML);
						curl_setopt($ch, CURLOPT_HEADER, false);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
						curl_setopt($ch, CURLOPT_TIMEOUT, 5);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
						curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
						$response = curl_exec($ch);
						if (curl_errno($ch)) {
							echo curl_error($ch);
							die();
						}
						$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						if ($http_code == intval(200)) {
							$postcreation = $response;
							print_r($postcreation);
						} else {
							echo "Ressource introuvable : " . $http_code;
						}
					} catch (\Throwable $th) {
						throw $th;
					} finally {
						curl_close($ch);
					}
				} else {
				}
			}
			$traitementemission = TRUE;
		}
	} else {
		$code_emission 	= 0;
		$image_exist	= 0;
		$video_exist	= 0;

		if (file_exists($daletdir . "/" . $emission_file . "_codeemission.txt")) {
			$contentfile = fopen($daletdir . "/" . $emission_file . "_codeemission.txt", "r");
			while ($line = fgets($contentfile)) {
				$code_emission = $line;
			}
			fclose($contentfile);
		} else {
			foreach ($emissionarray as $codeemission) {
				if (strpos($emission_file, $codeemission[0]) !== false) {
					$code_emission = $codeemission[1];
				} else {
				}
				$i++;
			}
		}

		if (file_exists($daletdir . "/" . $emission_file . ".jpg")) {

			// IF folder "DaletMetaImg" does not exist, create it
			if (!file_exists($wpdirectory . "/wp-content/uploads/DaletMetaImg/"))
				mkdir($wpdirectory . "/wp-content/uploads/DaletMetaImg/", 0777, true);


			copy($daletdir . "/" . $emission_file . ".jpg", $wpdirectory . "/wp-content/uploads/DaletMetaImg/" . $emission_file . ".jpg");

			$image_exist = 1;
		}

		if (file_exists($daletdir . "/" . $emission_file . ".JPG")) {

			// IF folder "DaletMetaImg" does not exist, create it
			if (!file_exists($wpdirectory . "/wp-content/uploads/DaletMetaImg/"))
				mkdir($wpdirectory . "/wp-content/uploads/DaletMetaImg/", 0777, true);


			copy($daletdir . "/" . $emission_file . ".JPG", $wpdirectory . "/wp-content/uploads/DaletMetaImg/" . $emission_file . ".JPG");

			$image_exist = 1;
		}

		if (check_if_video_exists($emission_file)) {
			$video_exist = 1;
		}
		if ($code_emission != 0 && $image_exist == 1 && $video_exist == 1) {
			$post_id 	= '';
			$desc 		= $Emission;
			$ch = curl_init();
			try {
				curl_setopt($ch, CURLOPT_URL, $wpsiteurl . "/wp-content/themes/BX1-2017/daletmeta-upload-picture.php?section=" . $stage . "&file=" . $emission_file);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

				$response = curl_exec($ch);

				if (curl_errno($ch)) {
					echo curl_error($ch);
					die();
				}

				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($http_code == intval(200)) {
					$attach_id = $response;
					echo "ATTACH ID = " . $attach_id;
				} else {
					echo "Ressource introuvable : " . $http_code;
				}
			} catch (\Throwable $th) {
				throw $th;
			} finally {
				curl_close($ch);
			}
			$ch = curl_init();


			if (empty($difdate) || $difdate == '') {
				$difdate = 0;
			} else {
				$difdate = 1;
			}
			try {
				//echo "https://".$wpsiteurl."/wp-content/themes/BX1-2017/daletmeta-create-post.php?section=".$stage."&action=" . $action . "&codeemission=" . $code_emission . "&difdate=" . $difdate . "&attachid=". $attach_id . "&file=".$xmlfilename;
				curl_setopt($ch, CURLOPT_URL, $wpsiteurl . "/wp-content/themes/BX1-2017/daletmeta-create-post.php?section=" . $stage . "&action=" . $action . "&codeemission=" . $code_emission . "&difdate=" . $difdate . "&attachid=" . $attach_id . "&file=" . $xmlfilename);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

				$response = curl_exec($ch);

				if (curl_errno($ch)) {
					echo curl_error($ch);
					die();
				}

				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if ($http_code == intval(200)) {
					$postcreation = $response;
					echo $postcreation;
				} else {
					echo "Ressource introuvable : " . $http_code;
				}
			} catch (\Throwable $th) {
				throw $th;
			} finally {
				curl_close($ch);
			}
			$traitementemission = TRUE;
		}
	}

	return $traitementemission;
}

$XMLFiles = array_merge(
	glob($DALETMETA . '/*.xml'),
	glob($DALETMETA . '/*.XML')
);

foreach ($XMLFiles as $XML) {
	$tmpxml		= explode('/', $XML);
	$Filename   = end($tmpxml);
	$logcontent .= "\n Reading file : " . $Filename;
	$filename 	= basename($XML, ".xml");
	$filename 	= basename($filename, ".XML");
	$emissionvalide = checkemission($filename, $listeemissions, $XML);

	if ($emissionvalide == TRUE) {

		@rename($XML, $DALETMETA . "/../archive/" . $section . "/" . $filename . ".xml");
		@rename($DALETMETA . "/" . $filename . ".JPG", $DALETMETA . "/../archive/" . $section . "/" . $filename . ".JPG");
		@rename($DALETMETA . "/" . $filename . "_codeemission.txt", $DALETMETA . "/../archive/" . $section . "/" . $filename . "_codeemission.txt");
	}
}
