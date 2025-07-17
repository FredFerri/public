<?php

/*********************************************
 *   Project : BX1 - PROD
 *   File    : functions.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 09 January 2020
 *   Don't edit this code without authorization
 *********************************************/
ini_set('error_reporting', E_ALL);

function savePhoto($remoteImage, $newname, $size, $job) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $remoteImage);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$fileContents = curl_exec($ch);
	curl_close($ch);
	$newImg = imagecreatefromstring($fileContents);
	if (!empty($size)) {
		$newImg = imagescale($newImg, $size);
	}
	return imagejpeg($newImg, "../cache/img/" . $job . "/{$newname}", 100);
}
function callAPI($method, $url, $data, $zone, $cache = false, $timeout = 3600) {
	date_default_timezone_set("Europe/Brussels");
	// Define logs name and directory
	$logdir     = '../cache/logs/';

	if (!is_dir($logdir)) {
		mkdir($logdir, 0755, true);
	}

	$retention  = 7;
	$logfile    = 'log_' . $zone  . '_' . date("Y-m-d_H-i") . '.log';
	// Create document header
	$log  = "________________________________________________" . PHP_EOL .
		"|             CALL API : START                |" . PHP_EOL .
		"________________________________________________" . PHP_EOL .
		"" . PHP_EOL .
		"Informations : " . PHP_EOL .
		"Called API: " . $zone . ' - ' . date("j F Y, H:i") . PHP_EOL .
		"Method: " . $method . " - Timeout : " . $timeout . " - Cache : " . $cache . PHP_EOL .
		"URL CALLED : " . $url . PHP_EOL .
		"-------------------------" . PHP_EOL;
	// Remove old logs file
	function startsWith($string, $startString) {
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}
	if ($handle = opendir($logdir)) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				if (startsWith('log_' . $zone  . '_', $entry)) {
					if (is_file($logdir . $entry)) {
						// Check if the file is older than X days old
						if (filemtime($logdir . $entry) < (time() - ($retention * 24 * 60 * 60))) {
							// Do the deletion
							unlink($logdir . $entry);
						}
					}
				}
			}
		}
		closedir($handle);
	}
	//Create the new log file
	// file_put_contents($logdir . $logfile, $log, FILE_APPEND);
	$curl = curl_init();
	switch ($method) {
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "CRED":
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
			break;
		default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
	}
	// OPTIONS:
	curl_setopt($curl, CURLOPT_URL, $url);

	// file_put_contents($logdir . $logfile, $log, FILE_APPEND);
	if ($method == "CRED") {
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Authorization: Basic cXEyQmxqVThOa0lqZjF1SGhOT2NJQ29DSmVBYTpSR0w0d0JSQzFtSEVvS0FsbVgzVHBYYzE5dU1h',
		));
	} else {
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Authorization: Basic cXEyQmxqVThOa0lqZjF1SGhOT2NJQ29DSmVBYTpSR0w0d0JSQzFtSEVvS0FsbVgzVHBYYzE5dU1h',
			'Accept: application/json',
		));
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	// EXECUTE:
	$result = curl_exec($curl);
	$httpcode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$log        = "Response Code : " . $httpcode . PHP_EOL .
		"Received content :" . PHP_EOL .
		"" . PHP_EOL;

	$log  = $result . PHP_EOL . "--- ENF OF RECEIVED DATA ---" . PHP_EOL . "" . PHP_EOL;
	// file_put_contents($logdir . $logfile, $log, FILE_APPEND);
	if ($httpcode != 200) {
		exit;
	}
	if (!$result) {
		die("Connection Failure");
	}
	curl_close($curl);
	if ($cache == true && $method == "GET") {
		$zone = strtolower($zone);
		$filename	=	"../cache/cache." . $zone . ".json";
		$now = time();
		$filetime = filemtime($filename);
		if (($now - $filetime) >= $timeout) {
			@unlink($filename);
		} else {
			exit;
		}
		if (!file_exists($filename)) {
			$writejson = fopen($filename, "w");
			fwrite($writejson, $result);
			fclose($writejson);
		}
		$files = glob('../cache/img/*'); // get all file names
		foreach ($files as $file) { // iterate files
			if (is_file($file))
				//echo $file;
				unlink($file); // delete file
		}
		$json_file 		= file_get_contents("../cache/cache.calendar.cur.json");
		$response       = json_decode($json_file, true);
		$data = $response['data'];
		foreach ($data as $item) {
			$link   =   $item['media'][0]["link"];
			if (empty($link)) {
				continue;
			} else {
				$mediacount = 0;
				foreach ($item['media'] as $media) {
					if ($media["type"] == "photo" || $media["type"] == "poster") {
						$imagename = str_replace("https://agendabrussels.imgix.net/", "", $media["link"]);
						$imagename = str_replace("https://media02.cdn.agenda.be/", "", $imagename);
						savePhoto($media["link"], $imagename, 400, "agenda");
						$mediacount++;
						break;
					}
				}
			}
		}
	} elseif ($method == "GETMETEO") {
		$zone = strtolower($zone);
		$filename	=	"../cache/cache." . $zone . ".json";
		$now = time();
		$filetime = filemtime($filename);
		if (($now - $filetime) >= $timeout) {
			@unlink($filename);
		} else {
			exit;
		}
		if (!file_exists($filename)) {
			$writejson = fopen($filename, "w");
			fwrite($writejson, $result);
			fclose($writejson);
		}
	}
	/*$log = "Files List : ".PHP_EOL;
	if ($handle = opendir($logdir)) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				$log .= $entry.PHP_EOL;
			}
		}
		closedir($handle);
	}
	$log .= "--- ENF OF FILE LIST ---".PHP_EOL;*/
	// file_put_contents($logdir . $logfile, $log, FILE_APPEND);
	return $result;
}
function GenerateXMLPodcast() {
	require('../../../../wp-load.php');
	date_default_timezone_set('Europe/Brussels');
	$args = array(
		'hide_empty'      => false,
		'taxonomy' => 'radio-type_emissions',
		'meta_key' => 'wpcf-podcast-pour-cette-emission-chronique',
		'meta_value' => 1
	);
	$podcastcats = get_terms($args);
	foreach ($podcastcats as $category) {
		$xw = xmlwriter_open_memory();
		xmlwriter_set_indent($xw, 1);
		$res = xmlwriter_set_indent_string($xw, ' ');

		xmlwriter_start_document($xw, '1.0', 'UTF-8');

		// Attribute element 'rss'
		xmlwriter_start_element($xw, 'rss');
		xmlwriter_start_attribute($xw, 'xmlns:itunes');
		xmlwriter_text($xw, 'http://www.itunes.com/dtds/podcast-1.0.dtd');
		xmlwriter_start_attribute($xw, 'version');
		xmlwriter_text($xw, '2.0');
		xmlwriter_end_attribute($xw);

		// Start Channel
		xmlwriter_start_element($xw, 'channel');

		// Attribute element 'title'
		xmlwriter_start_element($xw, 'title');
		xmlwriter_text($xw, "BX1 - " . $category->name);
		xmlwriter_end_element($xw); // title

		// Attribute element 'link'
		xmlwriter_start_element($xw, 'link');
		xmlwriter_text($xw, "https://bx1plus.be/");
		xmlwriter_end_element($xw); // link

		// Attribute element 'description'
		$categorymeta = get_metadata('term', $category->term_id);
		xmlwriter_start_element($xw, 'description');
		xmlwriter_text($xw, $categorymeta["wpcf-description-du-podcast"][0]);
		xmlwriter_end_element($xw); // description

		// Attribute element 'itunes:summary'
		xmlwriter_start_element($xw, 'itunes:summary');
		xmlwriter_text($xw, $categorymeta["wpcf-description-du-podcast"][0]);
		xmlwriter_end_element($xw); // itunes:summary

		// Attribute element 'copyright'
		xmlwriter_start_element($xw, 'copyright');
		xmlwriter_text($xw, "BX1 - " . date("Y") . ". Tous droits réservés.");
		xmlwriter_end_element($xw); // copyright

		xmlwriter_start_element($xw, 'image');

		// Attribute element 'url'
		xmlwriter_start_element($xw, 'url');
		xmlwriter_text($xw, $categorymeta["wpcf-pochette-du-podcast"][0]);
		xmlwriter_end_element($xw); // url

		// Attribute element 'title'
		xmlwriter_start_element($xw, 'title');
		xmlwriter_text($xw, $categorymeta["wpcf-pochette-du-podcast"][0]);
		xmlwriter_end_element($xw); // title

		xmlwriter_end_element($xw); // image

		// Attribute element 'itunes:author'
		xmlwriter_start_element($xw, 'itunes:author');
		xmlwriter_text($xw, "BX1");
		xmlwriter_end_element($xw); // itunes:author

		xmlwriter_start_element($xw, 'itunes:owner');

		// Attribute element 'itunes:name'
		xmlwriter_start_element($xw, 'itunes:name');
		xmlwriter_text($xw, "BX1+");
		xmlwriter_end_element($xw); // itunes:name

		// Attribute element 'itunes:email'
		xmlwriter_start_element($xw, 'itunes:email');
		xmlwriter_text($xw, "web@bx1.be");
		xmlwriter_end_element($xw); // itunes:email

		xmlwriter_end_element($xw); // itunes:owner

		// Attribute element 'itunes:explicit'
		xmlwriter_start_element($xw, 'itunes:explicit');
		xmlwriter_text($xw, "false");
		xmlwriter_end_element($xw); // itunes:explicit

		// Attribute element 'itunes:category'
		xmlwriter_start_element($xw, 'itunes:category');
		xmlwriter_start_attribute($xw, 'text');
		xmlwriter_text($xw, 'News');
		xmlwriter_end_attribute($xw);
		xmlwriter_end_element($xw); // itunes:category

		// Attribute element 'language'
		xmlwriter_start_element($xw, 'language');
		xmlwriter_text($xw, "fr");
		xmlwriter_end_element($xw); // language

		// Attribute element 'lastBuildDate'
		xmlwriter_start_element($xw, 'lastBuildDate');
		$dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
		xmlwriter_text($xw, $dt->format('D, d M Y H:i:s O'));
		xmlwriter_end_element($xw); // lastBuildDate

		// Attribute element 'itunes:image'
		xmlwriter_start_element($xw, 'itunes:image');
		xmlwriter_start_attribute($xw, 'href');
		xmlwriter_text($xw, $categorymeta["wpcf-pochette-du-podcast"][0]);
		xmlwriter_end_attribute($xw);
		xmlwriter_end_element($xw); // itunes:image
		wp_reset_query();
		$loop = new WP_Query(
			array(
				'post_type' => array('radio-chronique', 'radio-emission'),
				//'meta_key' => '_yoast_wpseo_primary_radio-type_emissions',
				'meta_value' => $category->term_id,
				'posts_per_page' => -1
			)
		);
		while ($loop->have_posts()) :
			$loop->the_post();
			//$do_not_duplicate[] = $post->ID;
			if (types_render_field('video-chronique') != "") {
				//Attribute element 'item'
				xmlwriter_start_element($xw, 'item');

				// Attribute element 'title'
				xmlwriter_start_element($xw, 'title');
				xmlwriter_text($xw, get_the_title());
				xmlwriter_end_element($xw); // title

				// Attribute element 'guid'
				xmlwriter_start_element($xw, 'guid');
				xmlwriter_text($xw, get_the_ID());
				xmlwriter_end_element($xw); // guid

				// Attribute element 'link'
				xmlwriter_start_element($xw, 'link');
				xmlwriter_text($xw, "https://bx1.be/?p=" . get_the_ID());
				xmlwriter_end_element($xw); // link

				if ($date_chronique = get_post_meta(get_the_ID(), 'wpcf-date-chronique', true)):
					// Attribute element 'pubDate'
					xmlwriter_start_element($xw, 'pubDate');
					xmlwriter_text($xw, date(DATE_RFC1123, $date_chronique));
					xmlwriter_end_element($xw); // pubDate
				endif;

				// Attribute element 'itunes:explicit'
				xmlwriter_start_element($xw, 'itunes:explicit');
				xmlwriter_text($xw, "false");
				xmlwriter_end_element($xw); // itunes:explicit

				// Attribute element 'itunes:image'
				xmlwriter_start_element($xw, 'itunes:image');
				xmlwriter_start_attribute($xw, 'href');
				xmlwriter_text($xw, $categorymeta["wpcf-pochette-du-podcast"][0]);
				xmlwriter_end_attribute($xw);
				xmlwriter_end_element($xw); // itunes:image

				// Attribute element 'enclosure'
				xmlwriter_start_element($xw, 'enclosure');
				xmlwriter_start_attribute($xw, 'url');
				xmlwriter_text($xw, "https://dts.podtrac.com/redirect.mp3/bx1.be/videofiles/" . types_render_field('video-chronique') . ".mp3");
				xmlwriter_start_attribute($xw, 'type');
				xmlwriter_text($xw, "audio/mpeg");
				xmlwriter_start_attribute($xw, 'length');
				xmlwriter_text($xw, "1");
				xmlwriter_end_attribute($xw);
				xmlwriter_end_element($xw); // enclosure

				// Attribute element 'itunes:duration'
				xmlwriter_start_element($xw, 'itunes:duration');
				xmlwriter_text($xw, types_render_field('duree-chronique'));
				xmlwriter_end_element($xw); // itunes:duration

				$badchar    = array("&");
				$goodchar   = array("-");
				$goodsummary = str_replace($badchar, $goodchar, types_render_field('sous-titre-itunes'));

				// Attribute element 'itunes:summary'
				xmlwriter_start_element($xw, 'itunes:summary');
				xmlwriter_text($xw, $goodsummary);
				xmlwriter_end_element($xw); // itunes:summary

				// Attribute element 'description'
				xmlwriter_start_element($xw, 'description');
				xmlwriter_text($xw, $goodsummary);
				xmlwriter_end_element($xw); // description

				xmlwriter_end_element($xw); // item
			}
		endwhile;

		xmlwriter_end_element($xw); // channel

		xmlwriter_end_element($xw); // rss

		xmlwriter_end_document($xw);

		$myxmlfile = xmlwriter_output_memory($xw);

		$myfile = fopen("../../../../rss/podcast/" . $category->slug . ".xml", "w") or die("Unable to open file!");
		fwrite($myfile, $myxmlfile);
		fclose($myfile);
	}
}
