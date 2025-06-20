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
?>

<style>
	table tr td {
		padding: 5px;
	}

	table tr:nth-child(odd) {
		background-color: #ccc;
	}
</style>
<link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
<table style="width: 50%" cellspacing="0" cellpadding="0">
	<tr style="background-color: rgb(155, 15, 79);">
		<th style="background-color: rgb(155, 15, 79);color:#FFFFFF;font-weight: bold;width:30%;border-radius:5px 0 0 5px;padding:10px;">Code de l'émission</th>
		<th style="background-color: rgb(155, 15, 79);color:#FFFFFF;font-weight: bold;width:20%;">Type d'émission</th>
		<th style="background-color: rgb(155, 15, 79);color:#FFFFFF;font-weight: bold;width:10%;">ID du post</th>
		<th style="background-color: rgb(155, 15, 79);color:#FFFFFF;font-weight: bold;width:10%;white-space: nowrap!important;">ID de l'image</th>
		<th style="background-color: rgb(155, 15, 79);color:#FFFFFF;font-weight: bold;width:30%;border-radius:0 5px 5px 0;">Dernière mofidication</th>
	</tr>

	<?php

	$query 		= "SELECT * FROM bx1_daletmeta Order By ID DESC LIMIT 10";
	$results 	= $wpdb->get_results($query);

	foreach ($results as $result) {
		$queryshow = "SELECT * FROM wp_terms WHERE term_id = \"" . $result->ShowID . "\"";
		$showname  = $wpdb->get_results($queryshow);
		foreach ($showname as $show) {
			$emission = $show->name;
		}
		echo "<tr>";
		echo "<td>" . $result->ItemCode . "</td>";
		echo "<td style='text-align:center;'>" . $emission . "</td>";
		echo "<td style='text-align:center;'><a href=\"/wp-admin/post.php?post=" . $result->PostID . "&action=edit\" target=\"_blank\">" . $result->PostID . " <i class=\"fas fa-external-link-alt\"></i></a></td>";
		echo "<td style='text-align:center;'><a href=\"/wp-admin/post.php?post=" . $result->ImageID . "&action=edit\" target=\"_blank\">" . $result->ImageID . " <i class=\"fas fa-external-link-alt\"></i></a></td>";
		echo "<td style='text-align:center;'>" . $result->LastUpdate . "</td>";
		echo "</tr>";
	}
	?>
</table>
<?php
echo "<span style='font-size:8px;'>Dernière génération de la liste : ";
$currentDateTime = new DateTime('now');
$currentDateTime->setTimezone(new DateTimeZone('Europe/Brussels'));
echo $currentDateTime->format('d / m / Y @ H:i:s');
echo "</span>";
?>