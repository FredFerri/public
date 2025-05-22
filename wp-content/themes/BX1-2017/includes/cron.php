<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : cron.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 09 January 2020
 *   Don't edit this code without authorization
 *********************************************/
ini_set('error_reporting', E_ALL);
include_once 'functions.php';

//  Création du fichier du mois en cours
	$now = date("Y-m-d");
	$month = date("m");
// Création des fichiers cache pour YES! by Actiris
	// Création des fichiers cache pour la météo
	if($_GET['job'] == "METEO")
		{
			//callAPI('GETMETEO','https://rmipro.meteo.be/products/bx1/5373bc0393d004fc/web_forecast',false,"meteo",true,300);
			//callAPI('GETMETEO','http://api.openweathermap.org/data/2.5/forecast?lat=50.8333&lon=4.35&appid=992a8b6a87d7403d958b89475d6fff00&lang=fr&units=metric',false,"meteo",true,300);
			callAPI('GETMETEO','https://api.openweathermap.org/data/2.5/forecast/daily?q=Brussels,be&units=metric&cnt=4&appid=ea18c0706135505149200c3836f29800',false,"meteo",true,300);
		}
	elseif($_GET['job'] == "PODCASTS")
		{
			GenerateXMLPodcast();
		}
	// Création des fichiers cache pour l'agenda
	else
		{
			callAPI( 'GET', 'https://apidata.brussels/v1/event/search?languages_spoken=fr&place_zip=1000,1030,1040,1050,1060,1070,1080,1081,1082,1083,1090,1140,1150,1160,1170,1180,1190,1200,1210,1620,1630,1640,1780,1950,1970&main_category_id=1,23,49,57,70,71,74,84,90,102,118&month=' . $month . '&size=100000', false, "calendar.cur", true, 3500 );
			//callAPI( 'GET', 'https:// apidata.brussels/v1/event/511278', false, "calendar.cur.test", true, 3500 );
		}
