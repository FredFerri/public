<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : agenda.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 30 January 2020
 *   Don't edit this code without authorization
 *********************************************/

ini_set('error_reporting', E_ALL);
echo "[";
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once 'functions.php';
$json_file 		= file_get_contents( plugin_dir_path( __FILE__ ) . "../cache/cache.calendar.json");
$response       = json_decode($json_file, true);
//echo "<pre>";
//print_r($response);
//echo "</pre>";
if ($response["fault"]["code"] != "")
{
	echo "Erreur " .$response["fault"]["code"];

	print_r("<br><br><br>".$get_Key);
}
//echo "<pre>";
$data = $response['data'];
$i = 1;
$jsoncontent = null;
foreach ($data as $item)
{
	//print_r($item);
	$title       =   $item['translations']['fr']['name'];
	$title       =   str_replace("'","\'",$title);
	$jsoncontent .= "{\n\tstart : '" . $item['date_next'] . "',\n\ttitle : '".$title."'\n},\n";
	$i++;
}

$jsoncontent = substr($jsoncontent,0,-2);
echo $jsoncontent;
echo "]";
// Recherche
#	$get_data = callAPI('GET', 'https://api.brussels:443/api/agenda/0.0.1/events/search?name=march&eacute;', false);

//echo "</pre>";
//echo "<pre style='background-color: silver;font-family: Consolas;font-size: 12px'>Debug : <br><br>";
//print_r($response );
//echo "</pre>";