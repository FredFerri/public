<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : download-ics.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 04 June 2020
 *   Don't edit this code without authorization
 *********************************************/
include 'ICS.php';
$EventID = $_POST['eventid'];
$dt = new DateTime("now", new DateTimeZone('Europe/Brussels'));
$CurrentTime =$dt->format('YmdHi');
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=invite-' . $EventID . '-' . $CurrentTime . '.ics');

$ics = new ICS(array(
	'location' => $_POST['location'],
	'description' => $_POST['description'],
	'dtstart' => $_POST['date_start'],
	'dtend' => $_POST['date_end'],
	'summary' => $_POST['summary'],
	'url' => $_POST['url']
));

echo $ics->to_string();