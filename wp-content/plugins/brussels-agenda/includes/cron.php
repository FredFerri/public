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
// Création des fichiers cache pour l'agenda
//  Création du fichier du mois en cours
	$now = date("Y-m-d");
	$month = date("m");
	callAPI('GET', 'https://apidata.brussels/v1/event/search?languages_spoken=!nl&place_zip=1000,1030,1040,1050,1060,1070,1080,1081,1082,1083,1090,1140,1150,1160,1170,1180,1190,1200,1210,1620,1630,1640,1780,1950,1970&main_category_id=1,23,49,57,70,71,74,84,90,102,118&month=' . $month . '&size=100000', false, "calendar.cur",true,3600);