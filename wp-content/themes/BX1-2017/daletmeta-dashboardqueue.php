<?php
// Load the wp-load.php file to access the WordPress environment
require_once(__DIR__ . '/../../../wp-load.php');

// Define the root directory of the website
$WPDIR = $_SERVER['DOCUMENT_ROOT'];

// Determine the current environment (staging or prod), default is 'staging'
$section = (defined('WP_ENV') && WP_ENV) ? WP_ENV : 'staging';

// Set the path to the daletmeta folder based on the environment
$DALETMETA = $WPDIR . "/daletmeta/" . $section;

$THEME_DIR = get_stylesheet_directory_uri();

// Get all XML files (both lowercase and uppercase extensions) in the daletmeta folder
$XMLFiles = array_merge(
	glob($DALETMETA . '/*.xml'),
	glob($DALETMETA . '/*.XML')
);
?>

<style>
	table tr:nth-child(odd) {
		background-color: #ccc;
	}
</style>
<link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">

<table style="width: 50%" cellspacing="0" cellpadding="0">
	<tr style="background-color: rgb(235, 30, 124);">
		<th style="background-color: rgb(235, 30, 124);font-weight: bold;width:40%;padding:10px;color:#FFFFFF;border-radius:5px 0 0 5px;">Nom du fichier</th>
		<th style="background-color:rgb(235, 30, 124);font-weight: bold;width:20%;color:#FFFFFF;">Fichier image?</th>
		<th style="background-color: rgb(235, 30, 124);font-weight: bold;width:20%;color:#FFFFFF;">Fichier vidéo?</th>
		<th style="background-color: rgb(235, 30, 124);font-weight: bold;width:20%;color:#FFFFFF;border-radius:0 5px 5px 0;">Actions</th>
	</tr>
	<?php

	// Exécuter une requête SELECT sur la table wp_termmeta
	$listeemissionsok 	= array();
	$listeemissionsvide	= array();

	$query = "SELECT * FROM wp_termmeta WHERE meta_key = \"wpcf-code-emissioncode-emission-dalet\" AND meta_value != ''";
	$results = $wpdb->get_results($query);
	//echo $query.PHP_EOL;

	// Parcourir les résultats de la requête
	if ($results) {
		foreach ($results as $result) {
			$terme	=	$result->meta_value;
			if ($terme != '' || empty($terme)) {
				array_push($listeemissionsok, array($result->meta_value, $result->term_id));
			} else {
				continue;
			}
		}
	} else {
		echo 'Aucun résultat trouvé.';
	}

	$queryvide 				= "SELECT * FROM wp_termmeta WHERE meta_key = \"wpcf-code-emissioncode-emission-dalet\" AND (meta_value = '' OR meta_value != '')";
	$resultsvide 			= $wpdb->get_results($queryvide);
	//echo $query.PHP_EOL;

	// Parcourir les résultats de la requête
	if ($resultsvide) {
		foreach ($resultsvide as $resultvide) {
			$terme	=	$resultvide->meta_value;
			if ($terme != '' || empty($terme)) {
				array_push($listeemissionsvide, array($resultvide->meta_value, $resultvide->term_id));
			} else {
				continue;
			}
		}
	} else {
		echo 'Aucun résultat trouvé.';
	}
	$selectlist = "<option />" . PHP_EOL;

	foreach ($listeemissionsvide as $selectemission) {
		$queryshow = "SELECT * FROM wp_terms WHERE term_id = \"" . $selectemission['1'] . "\"";
		$showname  = $wpdb->get_results($queryshow);
		foreach ($showname as $show) {
			$emission = $show->name;
		}
		$selectlist .= "<option value=\"" . $selectemission['1'] . "\">" . $emission . "</option>" . PHP_EOL;
	}
	foreach ($XMLFiles as $XML):
		$image_exist    = NULL;
		$video_exist    = NULL;
		$enable_action  = 0;
		$tmpxml			= explode('/', $XML);
		$Filename   	= end($tmpxml);
		$emission_file 	= basename($XML, ".xml");
		$emission_file 	= basename($emission_file, ".xml");

		$has_image = false;

		if (file_exists($DALETMETA . "/" . $emission_file . ".jpg")) {
			// Rename if to have .JPG
			rename($DALETMETA . "/" . $emission_file . ".jpg", $DALETMETA . "/" . $emission_file . ".JPG");
		}

		if (file_exists($DALETMETA . "/" . $emission_file . ".JPG")) {
			$path = $DALETMETA . "/" . $emission_file . ".JPG";
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			$image_exist = '<img src="' . $base64 . '" width=150px;>&nbsp;&nbsp;&nbsp;&nbsp;';
			$enable_action = $enable_action + 1;
			$has_image = true;
		}

		if (!$has_image) {
			$image_exist = '<i class="fas fa-minus-circle fa-lg" style="color:red">&nbsp;&nbsp;&nbsp;Fichier image manquant</i>';
		}

		if (check_if_video_exists($emission_file)) {
			$video_exist = '<i class="fas fa-check-circle fa-lg" style="color: #4bbd00;"></i>';
			$enable_action = $enable_action + 1;
		} else {
			$video_exist = '<i class="fas fa-minus-circle fa-lg" style="color:red">&nbsp;&nbsp;&nbsp;Fichier vidéo manquant</i>';
		}

		$filename 	= basename($Filename, ".xml");
		$filename 	= basename($filename, ".xml");
		echo "<tr>";
		echo "<td style=\"padding: 10px; font-size:24px; font-weight:bolder;\">" . $Filename . "</td>" . PHP_EOL;
		echo "<td style=\"padding: 10px;text-align:center;\">" . $image_exist . "</td>" . PHP_EOL;
		echo "<td style=\"padding: 10px;text-align:center;\">" . $video_exist . "</td>" . PHP_EOL;
		if (file_exists($DALETMETA . "/" . $emission_file . "_codeemission.txt")) {
			echo "<td style=\"padding: 10px;text-align:center;\"> Emmission choisie manuellement</td>";
		} elseif ($enable_action == 2) {
			echo "<td style=\"padding: 10px;text-align:center;\"><select class='chooseemission' data-xmlid='" . $filename . "'>" . PHP_EOL . $selectlist . "</select></td>" . PHP_EOL;
		} else {
			echo "<td style=\"padding: 10px;text-align:center;\"><a href=\"javascript:deleteit('" . $Filename . "');\" data-xmlid=\"1\"><i class=\"fa fa-trash\" style=\"color:red;\" data-xmlid=\"2\"></i></a></td>";
		}
		echo "</tr>";
	endforeach;
	?>
</table>

<script>
	function deleteit(xmlid) {
		let deleteFile = confirm("Voulez-vous vraiment supprimer le fichier '" + xmlid + "' ?");
		if (deleteFile == true) {
			$.ajax({
				type: "GET",
				url: "<?= $THEME_DIR ?>/daletmeta-actions.php?section=prod&action=deletefile&XMLID=" + xmlid,
				async: false
			}).complete(function(res) {
				if (res) {
					res = JSON.parse(res);
				}

				if (res?.error) {
					alert("Erreur lors de la suppression du fichier : " + res.error);
				} else {
					alert("Fichier '" + xmlid + "' supprimé avec succès.");
				}

				get_queue();
			}).responseText;
		} else {}
	}
</script>
<?php
echo "<span style='font-size:8px;'>Dernière génération de la liste : ";
$currentDateTime = new DateTime('now');
$currentDateTime->setTimezone(new DateTimeZone('Europe/Brussels'));
echo $currentDateTime->format('d / m / Y @ H:i:s');
echo "</span>";
?>