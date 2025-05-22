<?php 



include_once("../../../wp-load.php");
$version = "1.07";
$listeemissions = array();
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
$query = "SELECT * FROM wp_termmeta WHERE meta_key = \"wpcf-code-emissioncode-emission-dalet\"";
$results = $wpdb->get_results($query);
echo "<pre>";
//echo $query.PHP_EOL;

// Parcourir les résultats de la requête
if ($results) {
	foreach ($results as $result) {
		array_push($listeemissions, array($result->meta_value, $result->term_id));
	}
} else {
	echo 'Aucun résultat trouvé.';
}
//print_r($listeemissions);
$directory = "";
function SetDirectory(){
	global  $directory;
	$directory = '/data/sites/bx1.be/daletmeta/staging';
}
SetDirectory();
function checkemission($emission_file, $emissionarray,$XML)
	{
		global  $directory;
		global $wpdb;
		$i=0;
		$code_emission 	= 0;
		$image_exist	= 0;
		$video_exist	= 0;
		$repertoire = SetDirectory();
		foreach($emissionarray as $codeemission)
			{
				if(strpos($emission_file, $codeemission[0]) !== false){
					$code_emission = $codeemission[1];
				}
				$i++;
			}
		if(file_exists($directory."/".$emission_file.".JPG"))
			{
				$image_exist = 1;
			}
		if(file_exists($directory."/../../httpdocs/videofiles/".$emission_file.".mp4"))
			{
				$video_exist = 1;
			}
		if ($code_emission != 0 && $image_exist == 1 && $video_exist == 1)
			{
				$query = "SELECT * FROM wp_terms WHERE term_id = ".$code_emission;
				$results = $wpdb->get_results($query);
				foreach ($results as $result) {
					echo "Fichier " . $emission_file . " - Prêt pour la création de l'émission ".$code_emission." ( " . $result->name . " )".PHP_EOL;
				}
				$xmldata 	= simplexml_load_file($XML) or die("Failed to load");
				$Emission   = $xmldata->Emission;
				$pubdate	= $xmldata->Publication;
				$difdate	= $xmldata->DateEmission;
				$Contenu	= $xmldata->TexteArticle;
				print_r($xmldata);
				$post_id = 99;
				$query = "INSERT INTO bx1_daletmeta(filename,TexteArticleSum,ShowID,PostID) VALUES('" . $XML . "','" . md5($Contenu) . "'," . $code_emission . "," . $post_id . ")" ;
				$results = $wpdb->get_results($query);
			}	
	}
$XMLFiles = array_merge(
	glob($directory . '/*.xml'),
	glob($directory . '/*.XML')
);

foreach ($XMLFiles as $XML) {
	$Filename   = end(explode('/', $XML));
	$logcontent .= "\n Reading file : " . $XML;
	$filename = basename($XML, ".xml");
	$filename = basename($filename, ".XML");	
	checkemission($filename, $listeemissions,$XML);
	
}
echo "</pre>";
?>
