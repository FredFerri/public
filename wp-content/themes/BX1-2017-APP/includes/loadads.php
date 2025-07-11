<?php
// initialisation de la session
$getID = curl_init();
curl_setopt($getID, CURLOPT_URL, "https://gestcom.divercom.be/mobile/bx1/77");
curl_setopt($getID, CURLOPT_RETURNTRANSFER, true);
$resultID = json_decode(curl_exec($getID));
curl_close($getID);
$pubId  =   $resultID->uniqId;
$data    = array(
	'lat'   => "50.846812",
	'lng'   => "4.352360",
	'db'    => "true",
	'page'  => "77",
	'url'   => "https://bx1.be/?page_id=386095&theme=app",
	'title' => 'Accueil',
	'type'  => 'news',
	'image' => get_stylesheet_directory_uri() . '/images/nophoto.png',
	'uniqId' => $pubId,
	'tags' => ''
);

$payload = json_encode($data);
$getPub = curl_init();
curl_setopt($getPub, CURLOPT_URL, "https://gestcom.divercom.be/w/bx1/json");
curl_setopt($getPub, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($getPub, CURLOPT_POST, 1);
curl_error($getPub);
curl_setopt(
	$getPub,
	CURLOPT_POSTFIELDS,
	$payload
);
curl_setopt($getPub, CURLOPT_RETURNTRANSFER, true);
$resultPub = curl_exec($getPub);
curl_close($getPub);
if ($resultPub != "[]") {
	$resultPub = json_decode($resultPub);
	$pubContent = $resultPub[0]->content;
	$replace    = array("{", "}");
	$pubContent = str_replace($replace, "", $pubContent);
	$pubitems   = explode(',picture:', $pubContent);
	$link       = str_replace("link:", "", $pubitems[0]);
	$image      = $pubitems[1];
	echo "<a href=\"" . $link . "\" target=\"_blank\"><img style='margin-top: 15px;width:100%;height:100px;' src=\"" . $image .   "\"></a><span style='background-color: #e1e1e1;;display: block;width: 100%;text-align: center;font-weight: bold;font-size: 10px;margin-bottom: 15px;margin-top: -6px;'>Publicité</span>";
} else {
}
